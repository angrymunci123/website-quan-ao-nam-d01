<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordResetMail;

class AuthController extends Controller
{
    public function auth_user($user)
    {
        if ($user) {
            if ($user->role == 'Chủ Cửa Hàng' || $user->role == 'Nhân Viên') {
                return redirect('/admin');
            } elseif ($user->role == 'Khách Hàng') {
                return view('/ktcstore');
            }
        }
        return view("login")->with('error', 'Vui lòng đăng nhập để tiếp tục.');
    }

    public function login_form()
    {
        if (Auth::check()) {
            return $this->auth_user(Auth::user());
        }

        return view('login');
    }

    public function logout_admin(Request $request)
    {
        Auth::logout();
        $request->session()->forget('user_id');
        $request->session()->forget('fullname');
        $request->session()->forget('role');
        $request->session()->forget('email');
        return redirect("/login");
    }

    public function logout_customer(Request $request)
    {
        Auth::logout();
        $request->session()->forget('user_id');
        $request->session()->forget('fullname');
        $request->session()->forget('role');
        $request->session()->forget('email');
        return redirect("/ktcstore");
    }

    private function setSessionData(Request $request, $user)
    {
        $request->session()->put('user_id', $user->user_id);
        $request->session()->put('fullname', $user->fullname);
        $request->session()->put('email', $user->email);
        $request->session()->put('role', $user->role);
        $request->session()->put('email', $user->email);
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
        } else {
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                if ($user->role == 'Chủ Cửa Hàng' || $user->role == 'Nhân Viên') {
                    $this->setSessionData($request, $user);
                    return redirect('/admin');
                }

                if ($user->role == 'Khách Hàng') {
                    $this->setSessionData($request, $user);
                    return redirect('/ktcstore');
                }

                return back()->with('fail', 'Tài khoản có thể chưa được phân quyền.');
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

    public function forgot_password()
    {
        if (Auth::check()) {
            return $this->auth_user(Auth::user());
        }
        return view('forgotten_password');
    }

    public function send_token(Request $request)
    {
        if (Auth::check()) {
            return $this->auth_user(Auth::user());
        }

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $password_token = Str::random(30);
            $user->password_token = $password_token;
            $user->save();
            Mail::to($user->email)->send(new PasswordResetMail($password_token, $user->email));
            return back()->with('success', 'Mã xác minh đã dược gửi tới hòm thư của bạn');
        }
        return back()->with('fail', 'Địa chỉ email chưa đăng kí tài khoản');
    }
    public function checking_reset_token($password_token, $email)
    {
        $user = User::where('email', $email)->first();
        if ($user) {
            if ($password_token == $user->password_token) {
                return view('reset_password')->with('email', $email);
            }
            return back()->with('fail', 'Mật khẩu và xác nhận mật khẩu chưa khớp');
        }
        return redirect('/');
    }
    public function reset_password_process(Request $request)
    {
        $user = $request->email;
        $new_password = $request->new_password;
        $confirm_new_password = $request->confirm_new_password;

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('fail', 'Địa chỉ email không tồn tại trong hệ thống!');
        }

        if ($new_password === $confirm_new_password) {
            $user->password = bcrypt($request->new_password);
            $user->password_token = null;
            $user->save();
            return redirect('/login')->with('success', 'Đổi mật khẩu thành công!');
        }

        return back()->with('fail', 'Mật khẩu mới và xác nhận mật khẩu không trùng khớp!');
    }
}
