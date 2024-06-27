<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function user_info() 
    {
        $users = User::where('user_id', '=', session('user_id'))->get();
        return view('admin.user.user_info', compact('users'));
    }
    
    public function user_list() 
    {
        $users = User::get()->all();
        return view('admin.user.user_list');
    }
}
