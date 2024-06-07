<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function registerCustomer()
    {
        if (Auth::check()) {
            return view('customer.index');
        }
        return view('register_cus');
    }
    
}
