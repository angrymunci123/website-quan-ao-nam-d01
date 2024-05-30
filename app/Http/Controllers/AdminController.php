<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function loginAdmin()
    {
        if (Auth::check()) {
            return view('admin.dashboard.dashboard');
        }
        return view('admin.login');
    }

    public function loginProcess(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $check = Auth::attempt($credentials);
        if ($check) {
            $email_account = User::where('email', '=', $request->email)->first();
            $request->session()->put('user_id', $email_account->user_id);
            $request->session()->put('full_name', $email_account->full_name);
            $request->session()->put('password', $email_account->password);
            $request->session()->put('position', $email_account->position);
            return view('admin.dashboard.dashboard');
        }
        return redirect('admin')->with('fail', 'Invalid email address or password.');
    }


    public function logoutAdmin(Request $request)
    {
        Auth::logout();
        $request->session()->forget('user_id');
        $request->session()->forget('first_name');
        $request->session()->forget('last_name');
        $request->session()->forget('role');
        $request->session()->forget('password');
        return redirect('admin');
    }

    //Dashboard
    public function view_dashboard()
    {
        if (!Auth::check()) {
            return redirect('admin');
        }
        return view('admin.dashboard.dashboard');
    }

    //User
    public function user_list() 
    {
        if (!Auth::check()) {
            return redirect('admin');
        }
        return view('admin.user.user_list');
    }


    //Product
    public function product_management() 
    {
        if (!Auth::check()) {
            return redirect('admin');
        }
        return view('admin.product.product_list');
    }


    //Brand
    public function brand_management() 
    {
        if (!Auth::check()) {
            return redirect('admin');
        }
        return view('admin.brand.list');
    }

    //Category



}
