<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function registerCustomer()
    {
        if (Auth::check()) {
            return view('register_cus');
        }
        return view('customer.index');
    }
    public function login_customer()
    {
        if (Auth::check()) {
            return view('login_cus');
        }
        return view('customer.index');
    }
}
