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

        $orders = Order::orderBy('order_id', 'desc')->paginate(10);
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
        return view("admin.order.order_detail", compact(['order_details', 'product_order']));
    }

    public function confirm_order(Request $request)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        if ($user->role !== 'Admin') {
            return redirect('/ktcstore');
        }

        $order_id = $request->order_id;
        $order = DB::table('order')->where('order_id', $order_id)->first();
        if (!$order) {
            return back()->with('notification', 'Đã có lỗi xảy ra, vui lòng thử lại sau');
        }

        $order_status = '';
        switch ($order->status) {
            case "Đang chờ xác nhận":
                $order_status = "Đã xác nhận";
                break;

            case "Đã xác nhận":
                $order_status = "Đang giao hàng";
                break;

            case "Đang giao hàng":
                $order_status = "Đã giao hàng";
                break;

            case "Đã hủy":
                return back()->with('fail', 'Không thể xác nhận đơn hàng này vì khách hàng đã hủy đơn hàng');

            default:
                return back()->with('fail', 'Đã có lỗi xảy ra, vui lòng thử lại sau');
        }

        DB::table('order')->where('order_id', $order_id)->update([
            'status' => $order_status
        ]);

        return back()->with('success', 'Cập nhật trạng thái đơn hàng thành công!');
    }

    public function update_order_status(Request $request)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        if ($user->role !== 'Admin') {
            return redirect('/ktcstore');
        }

        $order_id = $request->order_id;
        $order_details = Order::where('order.order_id', '=', $order_id)->get();

        return view('admin.order.update_order_status', compact('order_details'));
    }

    public function cancel_order(Request $request)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        if ($user->role !== 'Admin') {
            return redirect('/ktcstore');
        }

        $order_id = $request->order_id;
        $order = DB::table('order')->where('order_id', $order_id)->first();
        if (!$order) {
            return back()->with('fail', 'Đã có lỗi xảy ra, vui lòng thử lại sau');
        }

        switch ($order->status) {
            case "Đang chờ xác nhận":
                DB::table('order')->where('order_id', $order_id)->update([
                    'status' => 'Đã hủy'
                ]);
                break;

            case "Đã hủy":
                return back()->with('fail', 'Đơn hàng này đã được khách hàng hủy trước đó!');

            default:
                return back()->with('fail', 'Đã có lỗi xảy ra, vui lòng thử lại sau');
        }

        return back()->with('notification', 'Hủy đơn hàng thành công');
    }

    public function update_status_process(Request $request)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        if ($user->role !== 'Admin') {
            return redirect('/ktcstore');
        }

        $consignee = $request->consignee;
        $phone_number = $request->phone_number;
        $address = $request->address;
        $shiping_unit = $request->shiping_unit;
        $status = $request->status;
        $order_id = $request->order_id;
        DB::table('order')->where("order_id", "=", "$order_id")->update([
            'consignee' => $consignee,
            'phone_number' => $phone_number,
            'address' => $address,
            'shipping_unit' => $shiping_unit,
            'status' => $status,
            'updated_at' => now()
        ]);
        return redirect('/admin/order/order_detail/order_id='.$order_id)->with('success', 'Xác nhận đơn hàng thành công!');
    }
}
