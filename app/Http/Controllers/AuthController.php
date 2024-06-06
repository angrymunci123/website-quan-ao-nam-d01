<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function login_form()
    {
        if (Auth::check()) {
            return view('admin.dashboard.dashboard');
        }
        return view('login');
    }

    public function loginProcess(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->position == 'admin') {
                $request->session()->put('user_id', $user->user_id);
                $request->session()->put('full_name', $user->full_name);
                $request->session()->put('position', $user->position);
                return view('admin.dashboard.dashboard');
            }

            else if ($user->position == 'customer') {
                $request->session()->put('user_id', $user->user_id);
                $request->session()->put('full_name', $user->full_name);
                $request->session()->put('position', $user->position);
                return view('customer.mainpage');
            }

            // else {
            //     Auth::logout();
            //     return redirect('login')->with('fail', 'Tài khoản này có thể chưa được cấp quyền. Vui lòng thử lại sau.');
            // }
        }
    return redirect('login')->with('fail', 'Sai địa chỉ email hoặc mật khẩu. Vui lòng thử lại.');
    }
}
