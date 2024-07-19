<?php

namespace App\Http\Controllers;

use App\Models\Order_Detail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Models\Product_Detail;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Product_Review;
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

        $orders = Order::where('user_id', session('user_id'))
        ->orderBy('order_id', "desc")
        ->get();
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
    
        $ratings = Product_Review::whereIn('product_id', $product_order->pluck('product_id'))
            ->where('user_id', $user_id)
            ->pluck('product_id');
    
        return view("customer.order_detail_cus", compact('order_details', 'product_order', 'ratings'));
    }

    public function cancel_order($order_id)
    {
        $order = Order::find($order_id);
        if (!$order) {
            return redirect('/ktcstore/order_history');
        }

        if ($order->user_id != session('user_id')) {
            return redirect('/ktcstore');
        }

        $order_status = ['Đã xác nhận', 'Đang giao hàng', 'Đã giao hàng'];

        if (in_array($order->status, $order_status)) {
            return back()->with('fail', 'Đơn hàng đã được xác nhận hoặc đang trong quá trình giao hàng!');
        }

        else if ($order->status == "Đã hủy") {
            return back()->with('fail', 'Đơn hàng đã được hủy bởi quản trị viên cửa hàng!');
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

        return back()->with('success', 'Hủy đơn hàng thành công!');
    }

    public function personal_info()
    {
        if (!Auth::check()) {
            return redirect('/ktcstore');
        }
    
        $user = Auth::user();
        if ($user->role !== 'Khách Hàng') {
            return redirect('/ktcstore'); 
        }

        $user_info = User::where('user_id', '=', session('user_id'))->get();
        return view('customer.Customer.cus_info', compact('user_info'));
    }

    public function edit_personal_info()
    {
        if (!Auth::check()) {
            return redirect('/ktcstore');
        }
    
        $user = Auth::user();
        if ($user->role !== 'Khách Hàng') {
            return redirect('/ktcstore'); 
        }

        $user_info = User::where('user_id', '=', session('user_id'))->get();
        return view('customer.Customer.edit_cus_info', compact('user_info'));
    }

    public function update_personal_info(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/ktcstore');
        }
    
        $user = Auth::user();
        if ($user->role !== 'Khách Hàng') {
            return redirect('/ktcstore'); 
        }
        
        $fullname = $request->fullname;
        $email = $request->email;
        $phone_number = $request->phone_number;
        $address = $request->address;
        DB::table('users')->where("user_id", "=", session('user_id'))
        ->update([
            'fullname' => $fullname,
            'email' => $email,
            'phone_number' => $phone_number,
            'address' => $address
        ]);

        return redirect('/ktcstore/personal_info')->with('success', 'Cập nhật thông tin cá nhân thành công!');
    }
    
    public function change_password()
    {
        return view('customer.Customer.cus_password');
    }

    public function product_review(Request $request)
    {
        $order_id = $request->order_id;
        $product_id = $request->product_id;
        $product_detail_id = $request->product_detail_id;
        $product_name = $request->product_name;
        $product_info = Product::where('product_name', '=', $product_name)->where('product_detail_id', '=', $product_detail_id)
        ->join('product_detail', 'products.product_id', '=', 'product_detail.product_id')->get();
        $product_order = Order::where('order_id', '=',  $order_id)->get();
        return view('customer.reviews', compact('product_info', 'product_order'));
    }

    public function send_review(Request $request) 
    {
        $rating = $request->rating;
        $content = $request->content;
        $user = session('user_id');
        $product = $request->product_id;
        $product_name = $request->product_name;
    
        $image = NULL;
    
        if ($request->hasFile('image')) 
        {
            $image = time() . $request->image->getClientOriginalName();
            $request->image->move(public_path('image'), $image);
        }
    
        DB::table('product_reviews')->insert([
            'user_id' => $user,
            'product_id' => $product,
            'rating' => $rating,
            'content' => $content,
            'image' => $image,
            'created_at' => now(),
            'updated_at' => null
        ]);
    
        return redirect('/ktcstore/product/'.$product_name)->with('success', 'Đánh giá sản phẩm thành công! Cám ơn bạn đã mua hàng tại KTC Store');
    }
}
