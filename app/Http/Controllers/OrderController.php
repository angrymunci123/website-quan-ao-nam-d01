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

        $orders = Order::paginate(10);
        Paginator::useBootstrap();
        return view("admin.order.order_list", compact('orders'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function order_detail($order_id)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        if ($user->role !== 'Admin') {
            return redirect('/ktcstore'); 
        }

        $order_details = Order::join('order_detail', 'order.order_id', '=', 'order_detail.order_id')
            ->join('users', 'order.user_id', '=', 'users.user_id')
            ->where('order.order_id', '=', $order_id)
            ->select('order.*', 'order_detail.*', 'order.created_at as order_created_at')
            ->get();

        $product_order = Order_Detail::join('product_detail', 'order_detail.product_detail_id', '=', 'product_detail.product_detail_id')
            ->join('products', 'product_detail.product_id', '=', 'products.product_id')
            ->where('order_detail.order_id', '=', $order_id)
            ->select('order_detail.*', 'products.product_id', 'products.product_name')
            ->get();
        return view("admin.order.order_detail", compact('order_details', 'product_order'));
    }
}
