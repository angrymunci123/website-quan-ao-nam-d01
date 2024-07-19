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
    public function view_dashboard() 
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        if ($user->role !== 'Chủ Cửa Hàng' || $user->role !== 'Nhân Viên') {
            return redirect('/ktcstore'); 
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
