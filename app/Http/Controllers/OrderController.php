<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Order_Detail;

class OrderController extends Controller
{
    public function order_list() 
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        if ($user->role !== 'Admin') {
            return redirect('/ktcstore'); 
        }

        return view("admin.order.order_list");
    }
}
