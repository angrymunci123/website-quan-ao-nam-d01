<?php

namespace App\Http\Controllers;

use App\Models\Order_Detail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Models\Product_Detail;
use App\Models\User;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StoreController extends Controller
{
    public function mainpage()
    {
            $products = Product::leftJoin("product_detail", "products.product_id", "=", "product_detail.product_id")
                ->leftJoin(DB::raw('(SELECT product_id, MIN(sale_price) AS min_sale_price FROM product_detail GROUP BY product_id) AS min_prices'), function($join) {
                    $join->on('product_detail.product_id', '=', 'min_prices.product_id')
                        ->on('product_detail.sale_price', '=', 'min_prices.min_sale_price');
                })
                ->where('product_detail.size', '=', 'S')
                ->select('products.product_id', 'products.product_name', DB::raw('MAX(product_detail.image) as image'), DB::raw('MAX(product_detail.price) as price'), DB::raw('MAX(product_detail.sale_price) as sale_price'))
                ->groupBy('products.product_id', 'products.product_name')
                ->orderBy('products.product_id')
                ->paginate(16);
        Paginator::useBootstrap();

        // Xử lý chuẩn hóa tên sản phẩm
        foreach ($products as $product) 
        {
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

        return view("customer.index");
    }

    public function contact()
    {
        return view("customer.contact");
    }

    public function shopping_cart()
    {
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

        $brand_sidebars = Brand::get();
        $category_sidebars = Category::get();
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

        return view("customer.shop", compact(['products', 'brand_sidebars', 'category_sidebars']))->with('i', (request()->input('page', 1) - 1) * 16);
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

        $user_id = auth()->id(); 

        $shopping_cart = session()->get('shopping_cart_' . $user_id, []);

        $chosen_quantity = $request->quantity;
        $total_quantity = $product_detail->quantity;
        $size = $request->size;
        $color = $request->color;

        $shopping_cart_item = $product_id . '_' . $product_detail_id;
        if (isset($shopping_cart[$shopping_cart_item])) {
            // Nếu sản phẩm đã có trong giỏ hàng, cập nhật số lượng
            $shopping_cart[$shopping_cart_item]['quantity'] += $chosen_quantity;
        } else {
            // Nếu chưa có, thêm sản phẩm vào giỏ hàng
            $shopping_cart[$shopping_cart_item] = [
                "product_id" => $product->product_id,
                "product_detail_id" => $product_detail_id,
                "product_name" => $product->product_name,
                "quantity" => $chosen_quantity,
                "price" => $product_detail->price,
                "sale_price" => $product_detail->sale_price,
                "size" => $size,
                "color" => $color,
                "image" => $product_detail->image,
                "total_quantity" => $total_quantity
            ];
        }
        session()->put('shopping_cart_' . $user_id, $shopping_cart);

        return redirect()->back()->with('success', 'Đã thêm sản phẩm vào giỏ hàng!');
    }

    public function plus_quantity($product_id, $product_detail_id)
    {
        $user_id = auth()->id();
        $shopping_cart = session()->get('shopping_cart_' . $user_id);

        if (isset($shopping_cart[$product_id . '_' . $product_detail_id])) {
            $stock_quantity = $shopping_cart[$product_id . '_' . $product_detail_id]['total_quantity'];
            if ($shopping_cart[$product_id . '_' . $product_detail_id]['quantity'] < $stock_quantity) {
                $shopping_cart[$product_id . '_' . $product_detail_id]['quantity']++;
                session()->put('shopping_cart_' . $user_id, $shopping_cart);
            } else {
                session()->flash('fail', 'Số lượng đã đạt giới hạn số lượng sản phẩm có sẵn!');
            }
        }
        return redirect()->back();
    }

    public function minus_quantity($product_id, $product_detail_id)
    {
        $user_id = auth()->id();
        $shopping_cart = session()->get('shopping_cart_' . $user_id);

        if (isset($shopping_cart[$product_id . '_' . $product_detail_id])) {
            if ($shopping_cart[$product_id . '_' . $product_detail_id]['quantity'] > 1) {
                $shopping_cart[$product_id . '_' . $product_detail_id]['quantity']--;
                session()->put('shopping_cart_' . $user_id, $shopping_cart);
            } else {
                session()->flash('fail', 'Số lượng sản phẩm không thể giảm xuống 0!');
            }
        }
        return redirect()->back();
    }

    public function remove_from_cart(Request $request)
    {
        $user_id = auth()->id();
        $product_id = $request->input('product_id');
        $product_detail_id = $request->input('product_detail_id');
    
        $shopping_cart = session()->get('shopping_cart_' . $user_id);
        if (isset($shopping_cart[$product_id . '_' . $product_detail_id])) {
            unset($shopping_cart[$product_id . '_' . $product_detail_id]);
            session()->put('shopping_cart_' . $user_id, $shopping_cart);
        }
        session()->flash('success', 'Sản phẩm đã được xóa khỏi giỏ hàng.');
        return redirect()->back();
    }

    public function checkout()
    {
        $user_id = auth()->id();
        $shopping_cart = session()->get('shopping_cart_' . $user_id);
        if (isset($shopping_cart)) {
            $customer = User::where("user_id", "=", session('user_id'))->first();
            return view("customer.checkout", compact(['customer', 'shopping_cart']));
        }
    }

    public function purchase(Request $request)
    {
        $payment_method = $request->payment_method;
        $consignee = $request->consignee;
        $address = $request->address;
        $phone_number = $request->phone_number;
        $shipping_unit = $request->shipping_unit;
    
        $create_order = DB::table('order')->insert([
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
    
        $shopping_cart = session()->get('shopping_cart_' . auth()->id(), []);
        if (empty($shopping_cart)) {
            return redirect('/ktcstore/checkout')->with('fail', 'Giỏ hàng của bạn đang trống.');
        }
    
        if ($create_order) {
            $select_order = Order::where('user_id', session('user_id'))->orderBy('order_id', 'desc')->first();
    
            foreach ($shopping_cart as $recordData) {
                if ($recordData['price'] && $recordData['sale_price'] == 0) {
                    $price_to_use = $recordData['price'];
                }

                else if ($recordData['sale_price'] && $recordData['sale_price'] < $recordData['price']) {
                    $price_to_use = $recordData['sale_price'];
                }
    
                DB::table('order_detail')->insert([
                    'order_id' => $select_order->order_id,
                    'product_detail_id' => $recordData['product_detail_id'],
                    'price' => $price_to_use,
                    'quantity' => $recordData['quantity'],
                    'created_at' => now(),
                    'updated_at' => NULL
                ]);

                $product_detail = Product_Detail::find($recordData['product_detail_id']);
                if ($product_detail) 
                {
                    $product_detail->quantity -= $recordData['quantity'];
                    $product_detail->save();
                }
            }

            session()->forget('shopping_cart_' . auth()->id());
    
            return redirect('/ktcstore/order_history')->with('success', 'Đã đặt hàng thành công!');
        }
    
        return redirect('/ktcstore/checkout')->with('fail', 'Đã xảy ra lỗi khi đặt hàng.');
    }

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

    public function filter_price_under200() 
    {
        $products = Product::leftJoin("product_detail", "products.product_id", "=", "product_detail.product_id")
            ->where('product_detail.size', '=', 'S')
            ->where('product_detail.price','<', 200000)
            ->select('products.product_id', 'products.product_name', DB::raw('MAX(product_detail.image) as image'), DB::raw('MAX(product_detail.price) as price'), DB::raw('MAX(product_detail.sale_price) as sale_price'))
            ->groupBy('products.product_id', 'products.product_name')
            ->paginate(16);
        Paginator::useBootstrap();

        $brand_sidebars = Brand::get();
        $category_sidebars = Category::get();
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
        return view("customer.shop", compact(['products', 'brand_sidebars', 'category_sidebars']))->with('i', (request()->input('page', 1) - 1) * 16);
    }

    public function filter_price($price_range) 
    {
        $price = Product::leftJoin("product_detail", "products.product_id", "=", "product_detail.product_id")
            ->where('product_detail.size', '=', 'S');
    
        switch ($price_range) {
            case 'under-200':
                $price->where('product_detail.price', '<', 200000);
                break;

            case '200-500':
                $price->whereBetween('product_detail.price', [200000, 500000]);
                break;

            case '500-800':
                $price->whereBetween('product_detail.price', [500000, 800000]);
                break;

            case '800-1000':
                $price->whereBetween('product_detail.price', [800000, 1000000]);
                break;

            case '1000-1500':
                $price->whereBetween('product_detail.price', [1000000, 1500000]);
                break;

            case '1500-2000':
                $price->whereBetween('product_detail.price', [1500000, 2000000]);
                break;

            case 'over-2000':
                $price->where('product_detail.price', '>', 2000000);
                break;

            default:
                break;
        }

        $products = $price->select('products.product_id', 'products.product_name', DB::raw('MAX(product_detail.image) as image'), DB::raw('MAX(product_detail.price) as price'), DB::raw('MAX(product_detail.sale_price) as sale_price'))
            ->groupBy('products.product_id', 'products.product_name')
            ->paginate(16);
        Paginator::useBootstrap();

        $brand_sidebars = Brand::get();
        $category_sidebars = Category::get();

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

        return view("customer.shop", compact(['products', 'brand_sidebars', 'category_sidebars']))->with('i', (request()->input('page', 1) - 1) * 16);
    }

    public function filter_brand($brand_name) 
    {
        $brand = Product::leftJoin("product_detail", "products.product_id", "=", "product_detail.product_id")
            ->leftJoin("brands", "products.brand_id", "=", "brands.brand_id")
            ->where('product_detail.size', '=', 'S');
    
        switch ($brand_name) {
            case 'Adam':
                $brand->where('brands.brand_name', 'Adam');
                break;
                
            case 'Atino':
                $brand->where('brands.brand_name', 'Atino');
                break;

            case 'Adidas':
                $brand->where('brands.brand_name', 'Adidas');
                break;

            case 'Nike':
                $brand->where('brands.brand_name', 'Nike');
                break;

            case 'Puma':
                $brand->where('brands.brand_name', 'Puma');
                break;

            case 'H&M':
                $brand->where('brands.brand_name', 'H&M');
                break;

            case 'Calvin-Klein':
                $brand->where('brands.brand_name', 'Calvin Klein');
                break;

            case 'Valentino':
                $brand->where('brands.brand_name', 'Valentino');
                break;

            case 'Levis':
                $brand->where('brands.brand_name', 'Levis');
                break;

            default:
                break;
        }

        $products = $brand->select('products.product_id', 'products.product_name', DB::raw('MAX(product_detail.image) as image'), DB::raw('MAX(product_detail.price) as price'), DB::raw('MAX(product_detail.sale_price) as sale_price'))
            ->groupBy('products.product_id', 'products.product_name')
            ->paginate(16);
        Paginator::useBootstrap();

        $brand_sidebars = Brand::get();
        $category_sidebars = Category::get();

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

        return view("customer.shop", compact(['products', 'brand_sidebars', 'category_sidebars']))->with('i', (request()->input('page', 1) - 1) * 16);
    }

    public function filter_category($category_name) 
    {
        $category = Product::leftJoin("product_detail", "products.product_id", "=", "product_detail.product_id")
            ->leftjoin("category", "products.category_id", "=", "category.category_id")
            ->where('product_detail.size', '=', 'S');
    
        switch ($category_name) {
            case 'Áo':
                $category->where('category.category_name', 'Áo');
                break;
                
            case 'Quần':
                $category->where('category.category_name', 'Quần');
                break;

            case 'Giày':
                $category->where('category.category_name', 'Giày');
                break;

            case 'Dép':
                $category->where('category.category_name', 'Dép');
                break;

            case 'Tất':
                $category->where('category.category_name', 'Tất');
                break;

            default:
                break;
        }

        $products = $category->select('products.product_id', 'products.product_name', DB::raw('MAX(product_detail.image) as image'), DB::raw('MAX(product_detail.price) as price'), DB::raw('MAX(product_detail.sale_price) as sale_price'))
            ->groupBy('products.product_id', 'products.product_name')
            ->paginate(16);
        Paginator::useBootstrap();

        $brand_sidebars = Brand::get();
        $category_sidebars = Category::get();

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

        return view("customer.shop", compact(['products', 'brand_sidebars', 'category_sidebars']))->with('i', (request()->input('page', 1) - 1) * 16);
    }

    public function filter_size($size) 
    {
        $products = Product::leftJoin("product_detail", "products.product_id", "=", "product_detail.product_id")
            ->leftJoin("brands", "products.brand_id", "=", "brands.brand_id")
            ->where('product_detail.size', '=', $size)
            ->select('products.product_id', 'products.product_name', DB::raw('MAX(product_detail.image) as image'), DB::raw('MAX(product_detail.price) as price'), DB::raw('MAX(product_detail.sale_price) as sale_price'))
            ->groupBy('products.product_id', 'products.product_name')
            ->paginate(16);
        
        Paginator::useBootstrap();

        $brand_sidebars = Brand::get();
        $category_sidebars = Category::get();

        return view("customer.shop", compact('products', 'brand_sidebars', 'category_sidebars'))->with('i', (request()->input('page', 1) - 1) * 16);
    }

    public function search_product(Request $request) {
        if (isset($_GET['keywords'])) {
            Paginator::useBootstrap();
            $search_keywords = $_GET['keywords'];
        
            $products = Product::where('product_name', 'LIKE', "%$search_keywords%")
            ->leftJoin("product_detail", "products.product_id", "=", "product_detail.product_id")
            ->where('product_detail.size', '=', 'S')
            ->select('products.product_id', 'products.product_name', DB::raw('MAX(product_detail.image) as image'), DB::raw('MAX(product_detail.price) as price'), DB::raw('MAX(product_detail.sale_price) as sale_price'))
            ->groupBy('products.product_id', 'products.product_name')
            ->paginate(16);
            Paginator::useBootstrap();

            $brand_sidebars = Brand::get();
            $category_sidebars = Category::get();
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

            return view("customer.Product.Search.search", compact(['products', 'brand_sidebars', 'category_sidebars']))->with('i', (request()->input('page', 1) - 1) * 16);
        }
    }

}
