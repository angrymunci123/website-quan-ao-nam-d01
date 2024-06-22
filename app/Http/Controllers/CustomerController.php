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

        if ($order->status == 'Đã xác nhận') {
            return redirect('/ktcstore/order_history')->with('notification', 'Đơn hàng đã được xác nhận!');
        }

        $order->status = 'Đã hủy';
        $order->save();

        // Lấy chi tiết đơn hàng
        $orderDetails = Order_Detail::where('order_id', $order_id)->get();

        // Cập nhật số lượng sản phẩm
        foreach ($orderDetails as $orderDetail) {
            $product_detail = Product_Detail::find($orderDetail->product_detail_id);
            if ($product_detail) {
                $product_detail->quantity += $orderDetail->quantity;
                $product_detail->save();
            }
        }

        return redirect('/ktcstore/order_history')->with('notification', 'Hủy đơn hàng thành công!');
    }
}
