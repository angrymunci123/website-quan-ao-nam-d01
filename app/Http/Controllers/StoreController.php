<?php

namespace App\Http\Controllers;

use App\Models\Order_Detail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Models\Product_Detail;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StoreController extends Controller
{
    public function mainpage()
    {
        return view("customer.index");
    }

    public function contact()
    {
        return view("customer.contact");
    }

    public function shopping_cart()
    {
        // $total = 0;
        // $total_in_cart = 0;
        // foreach(session('shopping_cart') as $product_id => $details) {
        //     $total += $details['price'] * $details['quantity'];
        //     $total_in_cart += $total;
        // }

        // return view('customer.shopping-cart', ['total' => $total, 'total_in_cart' => $total_in_cart]);
        return view('customer.shopping-cart');
    }

    public function shop()
    {
        $products = Product::leftJoin("product_detail", "products.product_id", "=", "product_detail.product_id")
            ->where('product_detail.size', '=', 'S')
            ->select('products.product_id', 'products.product_name', DB::raw('MAX(product_detail.image) as image'), DB::raw('MAX(product_detail.price) as price'), DB::raw('MAX(product_detail.sale_price) as sale_price'))
            ->groupBy('products.product_id', 'products.product_name')
            ->paginate(16);
        Paginator::useBootstrap();

        // Xử lý chuẩn hóa tên sản phẩm
        foreach ($products as $product) {
            $standardized_product_name = $product->product_name;
            $standardized_product_name = strtolower($standardized_product_name);
            $standardized_product_name = preg_replace('/[áàảãạăắằẳẵặâấầẩẫậ]/u', 'a', $standardized_product_name);
            $standardized_product_name = preg_replace('/[éèẻẽẹêếềểễệ]/u', 'e', $standardized_product_name);
            $standardized_product_name = preg_replace('/[íìỉĩị]/u', 'i', $standardized_product_name);
            $standardized_product_name = preg_replace('/[óòỏõọôốồổỗộơớờởỡợ]/u', 'o', $standardized_product_name);
            $standardized_product_name = preg_replace('/[úùủũụưứừửữự]/u', 'u', $standardized_product_name);
            $standardized_product_name = preg_replace('/[ýỳỷỹỵ]/u', 'y', $standardized_product_name);
            $standardized_product_name = preg_replace('/[đ]/u', 'd', $standardized_product_name);
            $standardized_product_name = preg_replace('/[^a-z0-9\s-]/', '', $standardized_product_name);
            $standardized_product_name = preg_replace('/\s+/', ' ', $standardized_product_name);
            $standardized_product_name = preg_replace('/^-+|-+$/', '', $standardized_product_name);
            $standardized_product_name = preg_replace('/\s/', '-', $standardized_product_name);

            $product->standardized_product_name = $standardized_product_name;
        }

        return view("customer.shop", compact('products'))->with('i', (request()->input('page', 1) - 1) * 16);
    }


    public function product_detail($product_name)
    {
        $product_details = Product::where("products.product_name", "=", $product_name)
            ->join('brands', "products.brand_id", "=", "brands.brand_id")
            ->join('product_detail', 'products.product_id', '=', 'product_detail.product_id')
            ->where('product_detail.size', '=', 'S')
            ->get([
                'brands.brand_name', 'products.product_id', 'products.product_name', 'product_detail.price', 'product_detail.sale_price',
                'product_detail.product_detail_id', 'product_detail.image', 'products.description', 'product_detail.quantity', 'product_detail.size'
            ]);

        if ($product_details->isNotEmpty()) {
            $product_id = $product_details->first()->product_id;
            $product_size = Product_Detail::where("product_detail.product_id", "=", $product_id)
                ->get(['product_detail.product_detail_id', 'product_detail.product_id', 'product_detail.size']);

            $product_colors = Product_Detail::where("product_detail.product_id", "=", $product_id)
                ->distinct()
                ->get(['product_detail.color']);
            return view("customer.product-details", compact('product_details', 'product_size', 'product_colors'));
        }
    }

    public function blog()
    {
        return view("customer.blog");
    }

    public function blog_detail()
    {
        return view("customer.blog-details");
    }

    public function about()
    {
        return view("customer.about");
    }

    public function add_to_cart(Request $request, $product_id, $product_detail_id)
    {
        $product = Product::find($product_id);
        $product_detail = Product_Detail::find($product_detail_id);

        if (!$product || !$product_detail) {
            abort(404);
        }

        $shopping_cart = session()->get('shopping_cart');
        $chosen_quantity = $request->quantity;
        $total_quantity = $product_detail->quantity;

        if (!$shopping_cart) {
            $shopping_cart = [
                $product_id . '_' . $product_detail_id => [
                    "product_id" => $product->product_id,
                    "product_detail_id" => $product_detail_id,
                    "product_name" => $product->product_name,
                    "quantity" => $chosen_quantity,
                    "price" => $product_detail->price,
                    "sale_price" => $product_detail->sale_price,
                    "size" => $product_detail->size,
                    "color" => $product_detail->color,
                    "image" => $product_detail->image,
                    "total_quantity" => $total_quantity
                    // Các thông tin khác của sản phẩm
                ]
            ];

            session()->put('shopping_cart', $shopping_cart);
        }

        else
        {
            if (isset($shopping_cart[$product_id . '_' . $product_detail_id]))
            {
                $shopping_cart[$product_id . '_' . $product_detail_id]['quantity']++;
            }
            else
            {
                $shopping_cart[$product_id . '_' . $product_detail_id] = [
                    "product_id" => $product->product_id,
                    "product_detail_id" => $product_detail_id,
                    "product_name" => $product->product_name,
                    "quantity" => $chosen_quantity,
                    "price" => $product_detail->price,
                    "sale_price" => $product_detail->sale_price,
                    "size" => $product_detail->size,
                    "color" => $product_detail->color,
                    "image" => $product_detail->image,
                    "total_quantity" => $total_quantity
                ];
            }

            session()->put('shopping_cart', $shopping_cart);
        }

        return redirect()->back()->with('success', 'Đã thêm sản phẩm vào giỏ hàng!');
    }

    public function plus_quantity($product_id, $product_detail_id)
    {
        $shopping_cart = session()->get('shopping_cart');
        if (isset($shopping_cart[$product_id . '_' . $product_detail_id])) {
            $stock_quantity = $shopping_cart[$product_id . '_' . $product_detail_id]['total_quantity'];
            if ($shopping_cart[$product_id . '_' . $product_detail_id]['quantity'] < $stock_quantity) {
                $shopping_cart[$product_id . '_' . $product_detail_id]['quantity']++;
                session()->put('shopping_cart', $shopping_cart);
            }

            else {
                session()->flash('fail', 'Số lượng đã đạt giới hạn số lượng sản phẩm có sẵn!');
            }
        }
        return redirect()->back();
    }

    public function minus_quantity($product_id, $product_detail_id)
    {
        $shopping_cart = session()->get('shopping_cart');
        if (isset($shopping_cart[$product_id . '_' . $product_detail_id])) {
            if ($shopping_cart[$product_id . '_' . $product_detail_id]['quantity'] > 1) {
                $shopping_cart[$product_id . '_' . $product_detail_id]['quantity']--;
                session()->put('shopping_cart', $shopping_cart);
            }
            else {
                session()->flash('fail', 'Số lượng sản phẩm không thể giảm xuống 0!');
            }
        }
        return redirect()->back();
    }

    public function remove_from_cart($product_id, $product_detail_id)
    {
        $shopping_cart = session()->get('shopping_cart');
        if (isset($shopping_cart[$product_id . '_' . $product_detail_id])) {
            unset($shopping_cart[$product_id . '_' . $product_detail_id]);
            session()->put('shopping_cart', $shopping_cart);
        }
        session()->flash('success', 'Sản phảm đã được xóa khỏi giỏ hàng.');
        return redirect()->back();
    }

    public function checkout()
    {
        $shopping_cart = session()->get('shopping_cart');
        if (isset($shopping_cart))
        {
            $customer = User::where("user_id", "=", session('user_id'))->first();
            return view("customer.checkout", compact(['customer', 'shopping_cart']));
        }
    }

    public function purchase(Request $request) {
        $payment_method = $request->payment_method;
        $consignee = $request->consignee;
        $address = $request->address;
        $phone_number = $request->phone_number;
        $consignee = $request->consignee;
        $shipping_unit = $request->shipping_unit;
        $create_product_order = DB::table('order')->insert([
            'status' => 'Đang chờ xác nhận',
            'consignee' => $consignee,
            'phone_number' => $phone_number,
            'address' => $address,
            'payment_method' => $payment_method,
            'shipping_unit' => $shipping_unit,
            'user_id' => session('user_id'),
            'created_at' => now(),
            'updated_at' => NULL
        ]);

        $shopping_cart = session()->get('shopping_cart', []);
        if (empty($shopping_cart)) {
            return redirect('/ktcstore/checkout')->with('fail', 'Giỏ hàng của bạn đang trống.');
        }
        if ($create_product_order) {
            $select_order = Order::where('user_id', '=', session('user_id'))->orderBy('order_id', 'desc')->first();
                foreach ($shopping_cart as $recordData) {
                    DB::table('order_detail')->insert([
                        'order_id' => $select_order->order_id,
                        'product_detail_id' => $recordData['product_detail_id'],
                        'price' => $recordData['price'],
                        'quantity' => $recordData['quantity']
                    ]);
            session()->forget('shopping_cart');
            }
        }
        return redirect('/ktcstore/order_history')->with('success', 'Đã đặt hàng thành công!');
    }

    public function order_history()
    {
        $order = Order::join('order_detail', 'order.order_id', '=', 'order_detail.order_id')
                    ->select('order.*', 'order_detail.price', 'order_detail.quantity') 
                    ->where('order.user_id', '=', session('user_id'))
                    ->get();
        return view('customer.order_history', compact('order'));
    }

    public function order_detail($order_id)
    {
        $user_id = session('user_id');
        
        $order_details = Order::join('order_detail', 'order.order_id', '=', 'order_detail.order_id')
                        ->join('users', 'order.user_id', '=', 'users.user_id')
                        ->where('order.order_id', '=', $order_id)
                        ->where('users.user_id', '=', $user_id)
                        ->get();

        $product_order = Order_Detail::join('product_detail', 'order_detail.product_detail_id', '=', 'product_detail.product_detail_id')
                        ->join('products', 'product_detail.product_id', '=', 'products.product_id')
                        ->where('order_detail.order_id', '=', $order_id)
                        ->select('order_detail.*', 'products.product_id', 'products.product_name')
                        ->get();
        return view("customer.order_detail_cus", compact('order_details', 'product_order'));
    }

    public function cancel_order($order_id) {
        $orders = Order::find($order_id);
        $customer_id = $orders->customer_id;
        // if ($customer_id != Auth::user()->order_id)  
        // {
        //     return redirect('/storeIndex');
        // }
        if ($orders->status == 'Đã xác nhận')
        {
            return redirect('/ktcstore/order_history')->with('notification', 'Đơn hàng đã được xác nhận!');
        }
        $orders->status = 'Đã hủy';
        $orders->save();

        return redirect('/storeIndex/order_history')->with('notification', 'Hủy đơn hàng thành công!');
    }
}
