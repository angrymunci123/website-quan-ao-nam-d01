<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    // //Dashboard
    // public function view_dashboard()
    // {
    //     if (!Auth::check()) {
    //         return redirect('login');
    //     }
    //     return view('admin.dashboard.dashboard');
    // }

    // //User
    // public function user_list()
    // {
    //     if (!Auth::check()) {
    //         return redirect('login');
    //     }
    //     $users = User::orderBy('fullname','asc')->paginate(10);
    //     return view('admin.user.user_list', compact('users'));
    // }

    public function view_dashboard()
    {
        if (!Auth::check()) {
            return redirect('login');
        }
    
        $user = Auth::user();
        if ($user->role !== 'Admin') {
            return redirect('/ktcstore'); // Hoặc trang khách hàng tương ứng
        }
    
        return view('admin.dashboard.dashboard');
    }
    
    //User
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
}
