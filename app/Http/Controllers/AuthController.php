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
        if (Auth::check()) {
            $user = Auth::user();
            if ($user) 
            {
                if ($user->role == 'Admin') 
                {
                    return view('admin.dashboard.dashboard');
                } 
                
                else if ($user->role == 'Khách Hàng') 
                {
                    return view('customer.index');
                }
            } else 
            {
                return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để tiếp tục.');
            }
        }

        return view('login');
    }

    public function logout_admin(Request $request) {
        Auth::logout();
        $request->session()->forget('user_id');
        $request->session()->forget('fullname');
        $request->session()->forget('role');
        return redirect("/login");
    }

    public function logout_customer(Request $request) {
        Auth::logout();
        $request->session()->forget('user_id');
        $request->session()->forget('fullname');
        $request->session()->forget('role');
        return view("customer.index");
    }

    private function setSessionData(Request $request, $user)
    {
        $request->session()->put('user_id', $user->user_id);
        $request->session()->put('fullname', $user->fullname);
        $request->session()->put('role', $user->role);
    }

    public function loginProcess(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('fail', 'Tài khoản hiện chưa được đăng ký. Vui lòng đăng ký để mua hàng tại KTC Store');
        }

        else {
            if (Auth::attempt($credentials)) 
            {
                $user = Auth::user();
                if ($user->role == 'Admin') {
                    $this->setSessionData($request, $user);
                    return view('admin.dashboard.dashboard');
                }

                if ($user->role == 'Khách Hàng') {
                    $this->setSessionData($request, $user);
                    return view('customer.index');
                }
            }
            return back()->with('fail', 'Sai địa chỉ email hoặc mật khẩu. Vui lòng thử lại.');
        }
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

        $hashedPassword = bcrypt($request->password);

        $email_in_db = DB::table('users')->where('email', '=', $email)->first();
        if (!$email_in_db) {
            if ($password == $confirm_password || $confirm_password == $password) {
                DB::table('users')->insert([
                    'fullname' => $full_name,
                    'email' => $email,
                    'phone_number' => $phone_number,
                    'password' => $hashedPassword,
                    'address' => $address,
                    'role' => 'Khách Hàng',
                    'created_at' => now(),
                    'updated_at' => NULL
                ]);
                return redirect('/login')->with('success', 'Đăng Ký Tài Khoản Thành Công!');
            } else {
                return back()->with('fail', 'Thông tin hoặc mật khẩu với xác nhận mật khẩu chưa đúng. Vui lòng kiểm tra lại thông tin!');
            }
        } else {
            return back()->with('fail', 'Địa chỉ email này đã tồn tại! Vui lòng sử dụng địa chỉ email khác.');
        }
    }

}
