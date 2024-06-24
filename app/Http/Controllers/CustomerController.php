<?php

namespace App\Http\Controllers;

use App\Models\Order_Detail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Models\Product_Detail;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    public function order_history()
    {
        if (!Auth::check()) {
            return redirect('/ktcstore');
        }
    
        $user = Auth::user();
        if ($user->role !== 'Khách Hàng') {
            return redirect('/ktcstore'); 
        }

        $orders = Order::where('order.user_id', session('user_id'))->get();
        return view('customer.order_history', compact('orders'));
    }

    public function order_detail($order_id)
    {
        $user_id = session('user_id');

        $order_details = Order::join('order_detail', 'order.order_id', '=', 'order_detail.order_id')
            ->join('users', 'order.user_id', '=', 'users.user_id')
            ->where('order.order_id', '=', $order_id)
            ->where('users.user_id', '=', $user_id)
            ->select('order.*', 'order_detail.*', 'order.created_at as order_created_at')
            ->get();

        $product_order = Order_Detail::join('product_detail', 'order_detail.product_detail_id', '=', 'product_detail.product_detail_id')
            ->join('products', 'product_detail.product_id', '=', 'products.product_id')
            ->where('order_detail.order_id', '=', $order_id)
            ->select('order_detail.*', 'products.product_id', 'products.product_name')
            ->get();
        return view("customer.order_detail_cus", compact('order_details', 'product_order'));
    }

    public function cancel_order($order_id)
    {
        $order = Order::find($order_id);
        if (!$order) {
            return redirect('/ktcstore/order_history');
        }

        if ($order->user_id != auth()->id()) {
            return redirect('/ktcstore');
        }

        $order_status = ['Đã xác nhận', 'Đang giao hàng', 'Đã giao hàng'];

        if (in_array($order->status, $order_status)) {
            return back()->with('notification', 'Đơn hàng đã được xác nhận hoặc đang trong quá trình giao hàng!');
        }

        else if ($order->status == "Đã hủy") {
            return back()->with('notification', 'Đơn hàng đã được hủy bởi quản trị viên cửa hàng!');
        }

        $order->status = 'Đã hủy';
        $order->save();

        $order_details = Order_Detail::where('order_id', $order_id)->get();

        foreach ($order_details as $order_detail) {
            $product_detail = Product_Detail::find($order_detail->product_detail_id);
            if ($product_detail) {
                $product_detail->quantity += $order_detail->quantity;
                $product_detail->save();
            }
        }

        return back()->with('notification', 'Hủy đơn hàng thành công!');
    }
}
