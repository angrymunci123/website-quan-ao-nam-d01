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
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function order_history()
    {
        if (!Auth::check()) {
            return redirect('/ktcstore');
        }

        $user = Auth::user();
        if ($user->role !== 'Khách Hàng') 
        {
            return redirect('/ktcstore');
        }

        $orders = Order::where('user_id', session('user_id'))
            ->orderBy('order_id', "desc")
            ->paginate(10);

        Paginator::useBootstrap();
        return view('customer.order_history', compact('orders'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function order_pending()
    {
        if (!Auth::check()) {
            return redirect('/ktcstore');
        }

        $user = Auth::user();
        if ($user->role !== 'Khách Hàng') 
        {
            return redirect('/ktcstore');
        }

        $orders = Order::where('user_id', session('user_id'))
            ->where('status', '=', 'Đang chờ xác nhận')
            ->orderBy('order_id', "desc")
            ->paginate(10);

        Paginator::useBootstrap();
        return view('customer.order_history', compact('orders'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function order_confirmed()
    {
        if (!Auth::check()) {
            return redirect('/ktcstore');
        }

        $user = Auth::user();
        if ($user->role !== 'Khách Hàng') 
        {
            return redirect('/ktcstore');
        }

        $orders = Order::where('user_id', session('user_id'))
            ->where('status', '=', 'Đã xác nhận')
            ->orderBy('order_id', "desc")
            ->paginate(10);

        Paginator::useBootstrap();
        return view('customer.order_history', compact('orders'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function order_delivering()
    {
        if (!Auth::check()) {
            return redirect('/ktcstore');
        }

        $user = Auth::user();
        if ($user->role !== 'Khách Hàng') 
        {
            return redirect('/ktcstore');
        }

        $orders = Order::where('user_id', session('user_id'))
            ->where('status', '=', 'Đang giao hàng')
            ->orderBy('order_id', "desc")
            ->paginate(10);

        Paginator::useBootstrap();
        return view('customer.order_history', compact('orders'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function order_delivered()
    {
        if (!Auth::check()) {
            return redirect('/ktcstore');
        }

        $user = Auth::user();
        if ($user->role !== 'Khách Hàng') 
        {
            return redirect('/ktcstore');
        }

        $orders = Order::where('user_id', session('user_id'))
            ->where('status', '=', 'Đã giao hàng')
            ->orderBy('order_id', "desc")
            ->paginate(10);

        Paginator::useBootstrap();
        return view('customer.order_history', compact('orders'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function order_canceled()
    {
        if (!Auth::check()) {
            return redirect('/ktcstore');
        }

        $user = Auth::user();
        if ($user->role !== 'Khách Hàng') 
        {
            return redirect('/ktcstore');
        }

        $orders = Order::where('user_id', session('user_id'))
            ->where('status', '=', 'Đã hủy')
            ->orderBy('order_id', "desc")
            ->paginate(10);

        Paginator::useBootstrap();
        return view('customer.order_history', compact('orders'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function check_order_exist($order_id)
    {
        $check_order_id = Order::where('order_id', $order_id)->exists();
            
        if (!$check_order_id) 
        {
            return false;
        }
        
        return true;
    }

    public function order_detail($order_id)
    {
        $user_id = session('user_id');
        
        if (!$this->check_order_exist($order_id)) 
        {
            return redirect('/ktcstore');  
        }

        $order_details = Order::join('order_detail', 'order.order_id', '=', 'order_detail.order_id')
            ->join('users', 'order.user_id', '=', 'users.user_id')
            ->where('order.order_id', '=', $order_id)
            ->where('users.user_id', '=', $user_id)
            ->select('order.*', 'order_detail.*', 'order.created_at as order_created_at')
            ->get();
    
        $product_order = Order_Detail::join('product_detail', 'order_detail.product_detail_id', '=', 'product_detail.product_detail_id')
            ->join('products', 'product_detail.product_id', '=', 'products.product_id')
            ->where('order_detail.order_id', '=', $order_id)
            ->select('order_detail.*', 'products.product_id', 'products.product_name', 'product_detail.size', 'product_detail.color')
            ->get();
    
        $ratings = Product_Review::whereIn('product_id', $product_order->pluck('product_id'))
            ->where('user_id', $user_id)
            ->pluck('product_id');
    
        return view("customer.order_detail_cus", compact('order_details', 'product_order', 'ratings'));
    }

    public function cancel_order($order_id)
    {
        $order = Order::find($order_id);
        if (!$order) 
        {
            return redirect('/ktcstore/order_history');
        }

        if ($order->user_id != session('user_id')) 
        {
            return redirect('/ktcstore');
        }

        if (!$this->check_order_exist($order_id)) 
        {
            return redirect('/ktcstore');  
        }

        $order_status = ['Đã xác nhận', 'Đang giao hàng', 'Đã giao hàng'];

        if (in_array($order->status, $order_status)) 
        {
            return back()->with('fail', 'Đơn hàng đã được xác nhận hoặc đang trong quá trình giao hàng!');
        } 
        
        else if ($order->status == "Đã hủy") 
        {
            return back()->with('fail', 'Đơn hàng đã được hủy bởi quản trị viên cửa hàng!');
        }

        $order->status = 'Đã hủy';
        $order->save();

        $order_details = Order_Detail::where('order_id', $order_id)->get();

        foreach ($order_details as $order_detail) 
        {
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
        if ($user->role !== 'Khách Hàng') 
        {
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
        if ($user->role !== 'Khách Hàng') 
        {
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
        if ($user->role !== 'Khách Hàng') 
        {
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
        if (!Auth::check()) {
            return redirect('/ktcstore');
        }

        $user = Auth::user();
        if ($user->role !== 'Khách Hàng') 
        {
            return redirect('/ktcstore');
        }

        return view('customer.Customer.cus_password');
    }

    public function change_password_process(Request $request) 
    {
        if (!Auth::check()) {
            return redirect('/ktcstore');
        }

        $user = Auth::user();
        if ($user->role !== 'Khách Hàng') 
        {
            return redirect('/ktcstore');
        }

        $user = User::find(session('user_id'));

        if ($user) {
            $current_password = $request->current_password;
            $new_password = $request->new_password;
            $confirm_new_password = $request->confirm_new_password;

            if (Hash::check($current_password, $user->password)) 
            {
                if ($new_password === $confirm_new_password) 
                {
                    $user->password = bcrypt($new_password);
                    $user->password_token = null;
                    $user->save();
                    return redirect('/ktcstore/personal_info')->with('success', 'Đổi mật khẩu thành công!');
                } 
                
                else 
                {
                    return back()->with('fail', 'Mật khẩu mới và xác nhận mật khẩu không trùng khớp!');
                }
            } 
            
            else 
            {
                return back()->with('fail', 'Sai mật khẩu hiện tại! Vui lòng thử lại');
            }
        }

        return back()->with('fail', 'Không tìm thấy người dùng!');
    }

    public function product_review(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/ktcstore');
        }

        $user = Auth::user();
        if ($user->role !== 'Khách Hàng') 
        {
            return redirect('/ktcstore');
        }

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
        if (!Auth::check()) {
            return redirect('/ktcstore');
        }

        $user = Auth::user();
        if ($user->role !== 'Khách Hàng') 
        {
            return redirect('/ktcstore');
        }

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

        return redirect('/ktcstore/product/' . $product_name)->with('success', 'Đánh giá sản phẩm thành công! Cám ơn bạn đã mua hàng tại KTC Store');
    }

    public function search_order(Request $request) 
    {
        $order_id = $request->order_id;
        if ($order_id) {
            $orders = Order::where('user_id', session('user_id'))
            ->where('order_id',  $order_id)
            ->orderBy('order_id', 'desc')
            ->paginate(10);
            Paginator::useBootstrap();

            if ($orders->isEmpty()) 
            {
                return view('customer.order_history', compact('orders'));
            } 
            
            else 
            {
                return view('customer.order_history', compact('orders'))->with('i', (request()->input('page', 1) - 1) * 5);
            }

        } 
    }
}
