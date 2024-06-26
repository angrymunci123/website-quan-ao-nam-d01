<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use \Illuminate\Support\Facades\Crypt;

class AdminController extends Controller
{
    public function view_dashboard()
    {
        if (!Auth::check()) {
            return redirect('login');
        }
    
        $user = Auth::user();
        if ($user->role !== 'Admin') {
            return redirect('/ktcstore');
        }
    
        return view('admin.dashboard.dashboard');
    }
    
    public function user_list()
    {
        if (!Auth::check()) {
            return redirect('login');
        }
    
        $user = Auth::user();
        if ($user->role !== 'Admin') {
            return redirect('/ktcstore'); 
        }
    
        $users = User::orderBy('fullname','asc')->paginate(10);
        return view('admin.user.user_list', compact('users'));
    }

    public function personal_info(){
        $user_info = User::where('user_id', '=', session('user_id'))->get();
        return view('admin.user.user_info', compact('user_info'));
    }

    public function change_password(){
        return view ('admin.user.password');
    }
}
