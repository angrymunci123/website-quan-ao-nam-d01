<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login_form()
    {
        $user = Auth::user();
        if (Auth::check()) {
            if ($user->role == 'Admin') {
                return view('admin.dashboard.dashboard');
            }

            else if ($user->role == 'Khách Hàng') {
                return view('customer.mainpage');
            }
        }
        return view('login');
    }

    public function loginProcess(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role == 'Admin') {
                $request->session()->put('user_id', $user->user_id);
                $request->session()->put('full_name', $user->full_name);
                $request->session()->put('role', $user->role);
                return view('admin.dashboard.dashboard');
            }

            else if ($user->role == 'Khách Hàng') {
                $request->session()->put('user_id', $user->user_id);
                $request->session()->put('full_name', $user->full_name);
                $request->session()->put('role', $user->role);
                return view('customer.mainpage');
            }
        }
    return redirect('login')->with('fail', 'Sai địa chỉ email hoặc mật khẩu. Vui lòng thử lại.');
    }

    public function register() 
    {
        return view('register');
    }

    public function registerProcess(Request $request) 
    {
        $full_name = $request->full_name;
        $email = $request->email;
        $phone_number = $request->phone_number;
        $password = $request->password;
        $confirm_password = $request->confirm_password;
        $address = $request->address;
        if ($password == $confirm_password || $confirm_password == $password) {
        DB::table('users')->insert([
            'fullname' => $full_name,
            'email' => $email,
            'phone_number' => $phone_number,
            'password' => Hash::make('password'),
            'address' => $address,
            'role' => 'Khách Hàng',
            'created_at' => now(),
            'updated_at' => NULL
        ]);
            return redirect('/login')->with('notification', 'Đăng Ký Tài Khoản Thành Công!');
        }

        else {
            return back()->with('notification', 'Thông tin hoặc mật khẩu với xác nhận mật khẩu chưa đúng. Vui lòng kiểm tra lại thông tin!');
        }
        
    }
    
}