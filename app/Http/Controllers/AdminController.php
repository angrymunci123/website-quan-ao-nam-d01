<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Order_Detail;
use Carbon\Carbon;

class AdminController extends Controller
{
    // public function view_dashboard() 
    // {
        // if (!Auth::check()) {
        //     return redirect('login');
        // }
    
        // $user = Auth::user();
        // if ($user->role !== 'Chủ cửa hàng' || $user->role !== 'Nhân Viên') {
        //     return redirect('/ktcstore'); 
        // }

    //     $total_products = Product::count();
    //     $total_brands = Brand::count();

    //     $total_order = Order::where('status', '=', 'Đã Giao Hàng')->count();

    //     $today_date = Carbon::now()->format('Y-m-d');
    //     $this_month = Carbon::now()->format('m');
    //     $this_year = Carbon::now()->format('Y');

    //     $today_orders = Order::whereDate('created_at', $today_date)->where('status', '=', 'Đang Chờ Xác Nhận')->count();
    //     $month_orders = Order::whereMonth('created_at', $this_month)->where('status', '=', 'Đang Chờ Xác Nhận')->count();
    //     $year_orders = Order::whereYear('created_at', $this_year)->where('status', '=', 'Đang Chờ Xác Nhận')->count();
    //     $units_sold = Order::join("order_detail", "product_order.order_id", "=", "order_detail.order_id")
    //                 ->where('status', '=', 'Đang Chờ Xác Nhận')->count();
    //     $total_order_detail = Order_Detail::count();

    //     $month_chart = Order::selectRaw('MONTH(created_at) as month, CAST(COUNT(*) AS UNSIGNED) as count')
    //     ->whereYear('created_at', date('Y'))
    //     ->groupBy('month')
    //     ->orderBy('month')
    //     ->get();
    //         $labels = [];
    //         $data = [];
    //         $colors = ['#FF6384', '#36A2EB', '#FFCE56', '#8BC34A', '#FF5722', '#009688', '#795548', '#9C27B0', '#2196F3', '#FF9800', '#CDDC39', '#607D8B'];
    //         for ($i = 1; $i < 12; $i++) {
    //             $month = date('F', mktime(0,0,0,$i,1));
    //             $count = 0;

    //             foreach($month_chart as $current_month) {
    //             if ($current_month->month == $i) {
    //                 $count = $current_month->count;
    //                 break;
    //             }
    //             }

    //             array_push($labels, $month);
    //             array_push($data, $count);
    //         }

    //         $datasets = [
    //             [
    //             'label' => 'Product_Order',
    //             'data' => $data,
    //             'backgroundColor' => $colors,
    //             'dataType' => 'integer' 
    //             ]
    //         ];

    //     return view('admin.dashboard.dashboard', compact('labels','datasets','total_products', 'total_brands', 'total_order', 'today_orders', 'month_orders', 'year_orders', 'units_sold'));
    // }

    public function view_dashboard() 
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $order_data = Order::select(DB::raw('COUNT(*) as count'))
        ->whereYear('created_at', date('Y'))
        ->groupBy(DB::raw("Month(created_at)"))
        ->pluck('count');

        $num_of_months = Order::selectRaw('DISTINCT MONTH(created_at) AS month')
                ->orderBy('month')
                ->get();

        return view('admin.dashboard.dashboard', compact('order_data', 'num_of_months'));
    }

    
    public function user_list()
    {
        if (!Auth::check()) {
            return redirect('login');
        }
    
        $user = Auth::user();
        if ($user->role !== 'Chủ Cửa Hàng' || $user->role !== 'Nhân Viên') {
            return redirect('/ktcstore'); 
        }
    
        $users = User::orderBy('user_id','asc')->paginate(10);
        return view('admin.user.user_list', compact('users'));
    }

    public function personal_info(){
        $user_info = User::where('user_id', '=', session('user_id'))->get();
        return view('admin.user.user_info', compact('user_info'));
    }

    public function edit_personal_info()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
    
        $user = Auth::user();
        if ($user->role !== 'Admin') {
            return redirect('/ktcstore'); 
        }

        $user_info = User::where('user_id', '=', session('user_id'))->get();
        return view('admin.user.edit_user_info', compact('user_info'));
    }

    public function update_personal_info(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
    
        $user = Auth::user();
        if ($user->role !== 'Admin') {
            return redirect('/ktcstore'); 
        }
        
        $fullname = $request->fullname;
        $email = $request->email;
        $phone_number = $request->phone_number;
        $address = $request->address;
        DB::table('users')->where("user_id", "=", session('user_id'))
        ->update([
            'fullname' => $fullname,
            'email' => $email,
            'phone_number' => $phone_number,
            'address' => $address
        ]);

        return redirect('/admin/personal_info')->with('success', 'Cập nhật thông tin cá nhân thành công!');
    }

    public function change_password(){
        return view ('admin.user.password');
    }
}
