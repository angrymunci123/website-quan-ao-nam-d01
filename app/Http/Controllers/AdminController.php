<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Order_Detail;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function view_dashboard()
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        if ($user->role === 'Khách Hàng') {
            return redirect('/ktcstore'); 
        }
      
        else {
            $order_data = Order::select(DB::raw('COUNT(*) as count'))
                ->whereYear('created_at', date('Y'))
                ->where('order.status', 'Đã giao hàng')
                ->groupBy(DB::raw("Month(created_at)"))
                ->pluck('count')->toArray();

            $revenue_data = Order_Detail::join('order', 'order_detail.order_id', '=', 'order.order_id')
                ->select(DB::raw('SUM(order_detail.price * order_detail.quantity) as total'))
                ->whereYear('order.created_at', date('Y'))
                ->where('order.status', 'Đã giao hàng')
                ->groupBy(DB::raw('MONTH(order.created_at)'))
                ->orderBy(DB::raw('MONTH(order.created_at)'))
                ->pluck('total')
                ->map(function ($item) {
                    return (float) $item;
                })
                ->toArray();

            $num_of_months = Order::join('order_detail', 'order.order_id', '=', 'order_detail.order_id')
                ->selectRaw('DISTINCT MONTH(order.created_at) AS month')
                ->orderBy('month')
                ->pluck('month')->toArray();

            $count_user = User::count();

            $count_pending_order = Order::where('status', 'Đang chờ xác nhận')->count();
            $count_delivered_order = Order::where('status', 'Đã giao hàng')->count();

            $count_revenue_current_month = Order_Detail::join('order', 'order_detail.order_id', '=', 'order.order_id')
                ->select(DB::raw('SUM(order_detail.price * order_detail.quantity) as total'))
                ->whereYear('order.created_at', date('Y'))
                ->whereMonth('order.created_at', date('m'))
                ->where('order.status', 'Đã giao hàng')
                ->groupBy(DB::raw('MONTH(order.created_at)'))
                ->orderBy(DB::raw('MONTH(order.created_at)'))
                ->first();

            $current_revenue = 0;

            if ($count_revenue_current_month) 
            {
                $current_revenue = (float) $count_revenue_current_month->total;
            }

            return view('admin.dashboard.dashboard', compact('order_data', 'revenue_data', 'num_of_months', 'count_user', 
                'count_pending_order', 'count_delivered_order', 'current_revenue'));
        }
    }

    public function user_list()
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        if ($user->role === 'Khách Hàng') {
            return redirect('/ktcstore'); 
        }
    
        $users = User::where(function ($user_query) {
            $user_query->where('role', 'Khách Hàng')
                  ->orWhere('role', 'Nhân Viên');
        })
        ->orderBy('user_id', 'asc')
        ->paginate(10);

        return view('admin.user.user_list', compact('users'));
    }

    public function update_role(Request $request)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        if ($user->role === 'Khách Hàng') {
            return redirect('/ktcstore'); 
        }

        $user_id = $request->user_id;
        $role = $request->role;
        
        DB::table('users')->where('user_id', '=', $user_id)
        ->update([
            'role' => $role,
            'updated_at' => now()
        ]);

        return back()->with('success', 'Phân quyền người dùng thành công');
    }

    public function personal_info()
    {
        $user = Auth::user();
        if ($user->role === 'Khách Hàng') {
            return redirect('/ktcstore'); 
        }

        $user_info = User::where('user_id', '=', session('user_id'))->get();
        return view('admin.user.user_info', compact('user_info'));
    }

    public function edit_personal_info()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();
        if ($user->role === 'Khách Hàng') {
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
        if ($user->role === 'Khách Hàng') {
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

    public function change_password() 
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
    
        $user = Auth::user();
        if ($user->role === 'Khách Hàng') {
            return redirect('/ktcstore'); 
        }

        return view ('admin.user.password');
    }

    public function change_password_process(Request $request) 
    {
        if (!Auth::check()) 
        {
            return redirect('/login');
        }

        $user = Auth::user();

        if ($user->role === 'Khách Hàng') 
        {
            return redirect('/ktcstore'); 
        }

        $user = User::find(session('user_id'));

        if ($user) {
            $current_password = $request->current_password;
            $new_password = $request->new_password;
            $confirm_new_password = $request->confirm_new_password;

            if (Hash::check($current_password, $user->password)) 
            {
                if ($new_password === $confirm_new_password) 
                {
                    $user->password = bcrypt($new_password);
                    $user->password_token = null;
                    $user->save();
                    return redirect('/admin/personal_info')->with('success', 'Đổi mật khẩu thành công!');
                } 
                
                else 
                {
                    return back()->with('fail', 'Mật khẩu mới và xác nhận mật khẩu không trùng khớp!');
                }
            } 
            
            else 
            {
                return back()->with('fail', 'Sai mật khẩu hiện tại! Vui lòng thử lại');
            }
        }

        return back()->with('fail', 'Không tìm thấy người dùng!');
    }
  
}
