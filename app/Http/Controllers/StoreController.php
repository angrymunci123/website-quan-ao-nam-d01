<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Models\Product_Detail;
use App\Models\User;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product_Review;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;

class StoreController extends Controller
{
    public function mainpage()
    {
        $hot_sales = Product::leftJoin("product_detail", "products.product_id", "=", "product_detail.product_id")
            ->leftJoin(
                DB::raw('(SELECT product_id, MIN(sale_price) AS min_sale_price FROM product_detail GROUP BY product_id) AS min_prices'),
                function ($join) {
                    $join->on('product_detail.product_id', '=', 'min_prices.product_id')
                        ->on('product_detail.sale_price', '=', 'min_prices.min_sale_price');
                }
            )
            ->where('product_detail.size', '=', 'S')
            ->select('products.product_id', 'products.product_name', DB::raw('MAX(product_detail.image) as image'), DB::raw('MAX(product_detail.price) as price'), DB::raw('MAX(product_detail.sale_price) as sale_price'))
            ->groupBy('products.product_id', 'products.product_name')
            ->orderBy('products.product_id')
            ->get();

        $new_arrivals = Product::leftJoin("product_detail", "products.product_id", "=", "product_detail.product_id")
            ->leftJoin(
                DB::raw('(SELECT product_id, MIN(sale_price) AS min_sale_price FROM product_detail GROUP BY product_id) AS min_prices'),
                function ($join) {
                    $join->on('product_detail.product_id', '=', 'min_prices.product_id')
                        ->on('product_detail.sale_price', '=', 'min_prices.min_sale_price');
                }
            )
            ->where('product_detail.size', '=', 'S')
            ->select('products.product_id', 'products.product_name', DB::raw('MAX(product_detail.image) as image'), DB::raw('MAX(product_detail.price) as price'), DB::raw('MAX(product_detail.sale_price) as sale_price'))
            ->groupBy('products.product_id', 'products.product_name')
            ->orderBy('products.created_at', 'desc')
            ->limit(8)
            ->get();

        $sale_items = Product::leftJoin("product_detail", "products.product_id", "=", "product_detail.product_id")
            ->leftJoin(
                DB::raw('(SELECT product_id, MIN(sale_price) AS min_sale_price FROM product_detail GROUP BY product_id) AS min_prices'),
                function ($join) {
                    $join->on('product_detail.product_id', '=', 'min_prices.product_id')
                        ->on('product_detail.sale_price', '=', 'min_prices.min_sale_price');
                }
            )
            ->where('product_detail.size', '=', 'S')
            ->where('product_detail.sale_price', '>', 0)
            ->select('products.product_id', 'products.product_name', DB::raw('MAX(product_detail.image) as image'), DB::raw('MAX(product_detail.price) as price'), DB::raw('MAX(product_detail.sale_price) as sale_price'))
            ->groupBy('products.product_id', 'products.product_name')
            ->orderBy('products.product_id')
            ->get();

        foreach ([$hot_sales, $new_arrivals, $sale_items] as $products) {
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
        }

        return view('customer.index', compact(['hot_sales', 'new_arrivals', 'sale_items']));
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
        }

        $customer_review = Product_Review::where('product_id', '=', $product_id)->join('Users', 'product_reviews.user_id', '=', 'users.user_id')
            ->take(2)->get(['users.fullname', 'product_reviews.rating', 'product_reviews.content', 'product_reviews.image', 'product_reviews.created_at']);

        $other_products = Product::leftJoin("product_detail", "products.product_id", "=", "product_detail.product_id")
            ->where('product_detail.size', '=', 'S')
            ->where('products.product_id', '!=', $product_id)
            ->select('products.product_id', 'products.product_name', DB::raw('MAX(product_detail.image) as image'), DB::raw('MAX(product_detail.price) as price'), DB::raw('MAX(product_detail.sale_price) as sale_price'))
            ->groupBy('products.product_id', 'products.product_name')
            ->take(4)
            ->get();

        return view("customer.product-details", compact('product_details', 'product_size', 'product_colors', 'customer_review', 'other_products'));
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
        $chosen_quantity = $request->quantity;
        $size = $request->size;
        $color = $request->color;

        $product = Product::find($product_id);
        $product_detail = Product_Detail::where('product_id', '=', $product_id)
                                ->where('size', $size)
                                ->first();
        $product_detail_id = $product_detail->product_detail_id;
        $total_quantity = $product_detail->quantity;

        if (!$product || !$product_detail) {
            abort(404);
        }

        $user_id = auth()->id();

        $shopping_cart = session()->get('shopping_cart_' . $user_id, []);
        $shopping_cart_item = $product_id . '_' . $product_detail_id;
        if (isset($shopping_cart[$shopping_cart_item])) {
            $shopping_cart[$shopping_cart_item]['quantity'] += $chosen_quantity;
        } else {
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
        if (!Auth::check()) {
            return redirect('/ktcstore');
        }

        $user_id = auth()->id();
        $shopping_cart = session()->get('shopping_cart_' . $user_id);
        if (!isset($shopping_cart)) {
            return redirect('/ktcstore');
        }
        $customer = User::where("user_id", "=", session('user_id'))->first();
        return view("customer.checkout", compact(['customer', 'shopping_cart']));
    }

    public function purchase(Request $request)
    {
        $payment_method = $request->payment_method;
        $consignee = $request->consignee;
        $address = $request->address;
        $phone_number = $request->phone_number;
        $user_id = session('user_id');
        $notes = $request->notes;
        $total_price = $request->total_price;

        $shopping_cart = session()->get('shopping_cart_' . auth()->id(), []);

        if (empty($shopping_cart)) {
            return redirect('/ktcstore/checkout')->with('fail', 'Giỏ hàng của bạn đang trống.');
        }

        try {
            DB::beginTransaction();
            $new_order_id = DB::table('order')->insertGetId([
                'status' => 'Đang chờ xác nhận',
                'consignee' => $consignee,
                'phone_number' => $phone_number,
                'address' => $address,
                'payment_method' => $payment_method,
                'notes' => $notes,
                'user_id' => $user_id,
                'created_at' => now(),
                'updated_at' => NULL
            ]);

            foreach ($shopping_cart as $cart_data) {
                $price_to_use = $cart_data['sale_price'] ? $cart_data['sale_price'] : $cart_data['price'];

                DB::table('order_detail')->insert([
                    'order_id' => $new_order_id,
                    'product_detail_id' => $cart_data['product_detail_id'],
                    'price' => $price_to_use,
                    'quantity' => $cart_data['quantity'],
                    'created_at' => now(),
                    'updated_at' => NULL
                ]);

                $product_detail = Product_Detail::find($cart_data['product_detail_id']);
                if ($product_detail) {
                    $product_detail->quantity -= $cart_data['quantity'];
                    $product_detail->save();
                }
            }

            DB::commit();

            session()->put('new_order_id', $new_order_id);

            if ($payment_method == "Chuyển khoản") {
                DB::table('order')->where("order_id", $new_order_id)->update([
                    'status' => 'Đã hủy',
                    'updated_at' => now()
                ]);

                $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
                $vnp_Returnurl = route('vnpay_return');
                $vnp_TmnCode = "VRNE42A3"; // Mã website tại VNPAY
                $vnp_HashSecret = "YK1OFOLRCMEYE0OPJ2ZL71S33GL0RD7H"; // Chuỗi bí mật
                $vnp_TxnRef = "KTC-" . $user_id . $new_order_id; // Mã đơn hàng
                $vnp_OrderInfo = "Thanh toán hóa đơn";
                $vnp_OrderType = "Đơn hàng KTC Store";
                $vnp_Amount = $total_price * 100; 
                $vnp_Locale = "vn";
                $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
                $inputData = array(
                    "vnp_Version" => "2.1.0",
                    "vnp_TmnCode" => $vnp_TmnCode,
                    "vnp_Amount" => $vnp_Amount,
                    "vnp_Command" => "pay",
                    "vnp_CreateDate" => date('YmdHis'),
                    "vnp_CurrCode" => "VND",
                    "vnp_IpAddr" => $vnp_IpAddr,
                    "vnp_Locale" => $vnp_Locale,
                    "vnp_OrderInfo" => $vnp_OrderInfo,
                    "vnp_OrderType" => $vnp_OrderType,
                    "vnp_ReturnUrl" => $vnp_Returnurl,
                    "vnp_TxnRef" => $vnp_TxnRef,
                );

                if ($request->has('vnp_BankCode') && $request->vnp_BankCode != "") {
                    $inputData['vnp_BankCode'] = $request->vnp_BankCode;
                }
              
                if ($request->has('vnp_Bill_State') && $request->vnp_Bill_State != "") {
                    $inputData['vnp_Bill_State'] = $request->vnp_Bill_State;
                }

                ksort($inputData);
                $query = "";
                $i = 0;
                $hashdata = "";
                foreach ($inputData as $key => $value) {
                    if ($i == 1) {
                        $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                    } else {
                        $hashdata .= urlencode($key) . "=" . urlencode($value);
                        $i = 1;
                    }
                    $query .= urlencode($key) . "=" . urlencode($value) . '&';
                }

                $vnp_Url = $vnp_Url . "?" . $query;
                if (isset($vnp_HashSecret)) {
                    $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
                    $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
                }
                return redirect()->to($vnp_Url);
            } else if ($payment_method == "Thanh toán khi nhận hàng") {
                session()->forget('shopping_cart_' . auth()->id());
           
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }

            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
                $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }
            return redirect()->to($vnp_Url);
        } else if ($payment_method = "Thanh toán khi nhận hàng") {
            Mail::to(session()->get('email'))->send(new OrderMail($shopping_cart));
            session()->forget('shopping_cart_' . auth()->id());
                return redirect('/ktcstore/order_history')->with('success', 'Đã đặt hàng thành công!');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('/ktcstore/checkout')->with('fail', 'Đã xảy ra lỗi khi đặt hàng.');
        }
    }

    public function vnpay_return()
    {
        $vnp_HashSecret = "YK1OFOLRCMEYE0OPJ2ZL71S33GL0RD7H"; 
        $vnp_SecureHash = $_GET['vnp_SecureHash'];
        $inputData = array();
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }
        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        if ($secureHash == $vnp_SecureHash) {
            if ($_GET['vnp_ResponseCode'] == '00') {
                $new_order_id = session()->get('new_order_id');
                DB::table('order')->where("order_id", "=", "$new_order_id")->update([
                    'status' => "Đã xác nhận",
                    'updated_at' => now()
                ]);
                $shopping_cart = session()->get('shopping_cart_' . auth()->id(), []);
                Mail::to(session()->get('email'))->send(new OrderMail($shopping_cart));
                session()->forget('shopping_cart_' . auth()->id());
                session()->forget('new_order_id');
                return redirect('/ktcstore/order_history')->with('success', 'Thanh toán và đặt hàng thành công');
            } else {
                $new_order_id = session()->get('new_order_id');
                DB::table('order_detail')->where('order_id', $new_order_id)->delete();
                DB::table('order')->where('order_id', $new_order_id)->delete();
                session()->forget('new_order_id');
                return redirect('/ktcstore/order_history')->with('fail', 'Thanh toán và đặt hàng thất bại');
            }
        } else {
            $new_order_id = session()->get('new_order_id');
            DB::table('order_detail')->where('order_id', $new_order_id)->delete();
            DB::table('order')->where('order_id', $new_order_id)->delete();
            session()->forget('new_order_id');
            return redirect('/ktcstore/order_history')->with('fail', 'Thanh toán và đặt hàng thất bại');
        }
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

        $products = $price->select('products.product_id', 'products.product_name', 
        DB::raw('MAX(product_detail.image) as image'), 
        DB::raw('MAX(product_detail.price) as price'), 
        DB::raw('MAX(product_detail.sale_price) as sale_price'))
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
      
        $products = $brand->select('products.product_id', 'products.product_name', 
        DB::raw('MAX(product_detail.image) as image'), 
        DB::raw('MAX(product_detail.price) as price'), 
        DB::raw('MAX(product_detail.sale_price) as sale_price'))
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
            case 'Áo Sơmi':
                $category->where('category.category_name', 'Áo Sơmi');
                break;

            case 'Quần Âu':
                $category->where('category.category_name', 'Quần Âu');
                break;

            case 'Áo Nỉ':
                $category->where('category.category_name', 'Áo Nỉ');
                break;

            case 'Áo Thun':
                $category->where('category.category_name', 'Áo Thun');
                break;

            case 'Áo Nỉ':
                $category->where('category.category_name', 'Áo Nỉ');
                break;

            case 'Áo Khoác':
                $category->where('category.category_name', 'Áo Khoác');
                break;

            case 'Quần Sooc':
                $category->where('category.category_name', 'Quần Sooc');
                break;

            default:
                break;
        }

        $products = $category->select('products.product_id', 'products.product_name', 
        DB::raw('MAX(product_detail.image) as image'), 
        DB::raw('MAX(product_detail.price) as price'), 
        DB::raw('MAX(product_detail.sale_price) as sale_price'))
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


    public function search_product(Request $request)
    {
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
