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
use Illuminate\Support\Str;
use App\Models\Product_Review;
use App\Models\News;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;

class StoreController extends Controller
{
    public function mainpage()
    {
        $products = Product::leftJoin("product_detail", "products.product_id", "=", "product_detail.product_id")
            ->leftJoin(
                DB::raw('(SELECT product_id, MIN(sale_price) AS min_sale_price FROM product_detail GROUP BY product_id) AS min_prices'),
                function ($join) {
                    $join->on('product_detail.product_id', '=', 'min_prices.product_id')
                        ->on('product_detail.sale_price', '=', 'min_prices.min_sale_price');
                }
            )
            ->where('product_detail.size', '=', 'S')
            ->select(
                'products.product_id',
                'products.product_name',
                DB::raw('MAX(product_detail.image) as image'),
                DB::raw('MAX(product_detail.price) as price'),
                DB::raw('MAX(product_detail.sale_price) as sale_price')
            )
            ->groupBy('products.product_id', 'products.product_name')
            ->orderBy('products.product_id')
            ->take(12)
            ->get();

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

        $display_news = News::get()->take(3);

        return view('customer.index', compact(['products', 'standardized_product_name', 'display_news']));
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
        return view("customer.shop", compact(['products']))->with('i', (request()->input('page', 1) - 1) * 16);
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
                ->where('product_detail.quantity', '>', 0)
                ->get(['product_detail.product_detail_id', 'product_detail.product_id', 'product_detail.size', 'product_detail.quantity']);

            $product_colors = Product_Detail::where("product_detail.product_id", "=", $product_id)
                ->where('product_detail.quantity', '>', 0)
                ->distinct()
                ->get(['product_detail.color']);
        }

        // Fetch customer reviews
        $customer_review = Product_Review::where('product_id', '=', $product_id)
            ->join('Users', 'product_reviews.user_id', '=', 'users.user_id')
            ->take(2)
            ->get(['users.fullname', 'product_reviews.rating', 'product_reviews.content', 'product_reviews.image', 'product_reviews.created_at']);

        // Fetch other products
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

    public function add_to_cart(Request $request)
    {
        // Kiểm tra xem đã đăng nhập chưa
        if (!Auth::check()) {
            return redirect('/ktcstore')->with('fail', 'Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng.');
        }
        // Lấy thông tin sản phẩm
        $product_id = $request->product_id;
        $chosen_quantity = (int)$request->quantity;
        $size = $request->size;
        $color = $request->color;
        $product = Product::find($product_id);
        $product_detail = Product_Detail::where('product_id', $product_id)
            ->where('size', $size)
            ->where('color', $color)
            ->first();
        // Nếu product hoặc detail không tồn tại thì abort 404
        if (!$product || !$product_detail) {
            abort(404);
        }
        // Kiểm tra số lượng sản phẩm tồn kho
        $total_quantity = $product_detail->quantity;
        if ($total_quantity == 0) {
            return redirect()->back()->with('fail', 'Kích cỡ sản phẩm này đã hết hàng.');
        }
        if ($chosen_quantity > $total_quantity) {
            return redirect()->back()->with('fail', 'Số lượng bạn chọn vượt quá số lượng có sẵn trong kho.');
        }
        // Lấy thông tin user và shopping cart hiện tại
        $user_id = auth()->id();
        $shopping_cart = session()->get('shopping_cart_' . $user_id, []);
        $shopping_cart_item = $product_id . '_' . $product_detail->product_detail_id;
        // Nếu có item này trong cart rồi thì tăng quantity
        if (isset($shopping_cart[$shopping_cart_item])) {
            $new_quantity = $shopping_cart[$shopping_cart_item]['quantity'] + $chosen_quantity;
            // Kiểm tra số lượng tồn kho
            if ($new_quantity > $total_quantity) {
                return redirect()->back()->with('fail', 'Số lượng bạn chọn vượt quá số lượng có sẵn trong kho.');
            }
            $shopping_cart[$shopping_cart_item]['quantity'] = $new_quantity;
        } else {
            $shopping_cart[$shopping_cart_item] = [
                "product_id" => $product->product_id,
                "product_detail_id" => $product_detail->product_detail_id,
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
        //lấy dữ liệu session giỏ hàng theo id người dùng
        $shopping_cart = session()->get('shopping_cart_' . $user_id);

        if (isset($shopping_cart[$product_id . '_' . $product_detail_id])) {
            $product_detail = Product_Detail::find($product_detail_id);

            if (!$product_detail) {
                session()->flash('fail', 'Sản phẩm không tồn tại trong cửa hàng.');
                return redirect()->back();
            }

            $stock_quantity = $product_detail->quantity;
            $current_quantity = $shopping_cart[$product_id . '_' . $product_detail_id]['quantity'];


            //nếu số lượng sp hiện tại nhỏ hơn số lượng có sẵn sẽ tăng số lượng
            if ($current_quantity < $stock_quantity) {
                $shopping_cart[$product_id . '_' . $product_detail_id]['quantity']++;
                session()->put('shopping_cart_' . $user_id, $shopping_cart);
            }

            //nếu số lượng sp hiện tại nhỏ hơn số lượng có sẵn sẽ cập nhật sang số lượng tối da hiện tại
            else if ($current_quantity > $stock_quantity) {
                $shopping_cart[$product_id . '_' . $product_detail_id]['quantity'] = $stock_quantity;
                session()->put('shopping_cart_' . $user_id, $shopping_cart);
                session()->flash('fail', 'Số lượng sản phẩm đã đạt số lượng tối đa và đã được cập nhật thành số lượng tối đa.');
            }

            //nếu số lượng sp hiện tại bằng số lượng có sẵn sẽ thông báo đã đạt số lượng tối đa
            else if ($current_quantity == $stock_quantity) {
                session()->flash('fail', 'Số lượng sản phẩm đã đạt số lượng tối đa.');
            }

            //nếu số lượng sp hiện tại bằng 0 sẽ xóa sản phẩm khỏi giỏ hàng
            else if ($stock_quantity == 0) {

                unset($shopping_cart[$product_id . '_' . $product_detail_id]);
                session()->put('shopping_cart_' . $user_id, $shopping_cart);
                session()->flash('fail', 'Sản phẩm đã hết hàng và bị xóa khỏi giỏ hàng.');
            }
        } else {
            session()->flash('fail', 'Sản phẩm không có trong giỏ hàng.');
        }

        return redirect()->back();
    }

    public function minus_quantity($product_id, $product_detail_id)
    {
        $user_id = auth()->id();
        $shopping_cart = session()->get('shopping_cart_' . $user_id);

        if (isset($shopping_cart[$product_id . '_' . $product_detail_id])) {
            $product_detail = Product_Detail::find($product_detail_id);

            if (!$product_detail) {
                session()->flash('fail', 'Sản phẩm không tồn tại trong cửa hàng.');
                return redirect()->back();
            }

            $current_quantity = $shopping_cart[$product_id . '_' . $product_detail_id]['quantity'];


            //nếu số lượng sản phẩm trong giỏ hàng lớn hơn 1 sẽ giảm số lượng
            if ($current_quantity > 1) {
                $shopping_cart[$product_id . '_' . $product_detail_id]['quantity']--;

                session()->put('shopping_cart_' . $user_id, $shopping_cart);
            }

            //nếu số lượng sản phẩm trong giỏ hàng bằng 1, ấn giảm só lượng sẽ trả về thông báo
            else if ($current_quantity == 1) {

                session()->put('shopping_cart_' . $user_id, $shopping_cart);
                session()->flash('fail', 'Sản phẩm không thể giảm xuống 0.');
            }


            //nếu số lượng sản phẩm có sẵn trong kho bằng 0 sẽ xóa sản phẩm khỏi giỏ hàng
            if ($product_detail->quantity == 0) {

                unset($shopping_cart[$product_id . '_' . $product_detail_id]);
                session()->put('shopping_cart_' . $user_id, $shopping_cart);
                session()->flash('fail', 'Sản phẩm đã hết hàng và bị xóa khỏi giỏ hàng.');
            }
        } else {
            session()->flash('fail', 'Sản phẩm không có trong giỏ hàng.');
        }

        return redirect()->back();
    }

    // Xóa sản phẩm khỏi giỏ hàng
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
        // lấy giỏ hàng từ session theo id người dùng hoặc khởi tạo là mảng rỗng nếu không tìm thấy giỏ hàng
        $shopping_cart = session()->get('shopping_cart_' . $user_id, []);

        if (empty($shopping_cart)) {
            return redirect('/ktcstore')->with('fail', 'Giỏ hàng của bạn trống.');
        }

        //  is_updated được sử dụng để kiểm tra có thay đổi về số lượng sản phẩm hay các sản phẩm trong giỏ hàng hay không
        $is_updated = false;


        foreach ($shopping_cart as $cart_item => $product) {
            $product_id = $product['product_id'];
            $product_detail_id = $product['product_detail_id'];
            $quantity = $product['quantity'];
            $size = $product['size'];
            $color = $product['color'];

            $product = Product::find($product_id);

            if (!$product) {
                session()->flash('fail', 'Sản phẩm không tồn tại trong cửa hàng.');
                unset($shopping_cart[$cart_item]);
                $is_updated = true;
                continue;
                //continue được sử dụng để bỏ qua và tiếp tục với dòng sản phẩm tiếp theo trong giỏ hàng
            }

            // tìm chi tiết sản phẩm với size và color đã cho
            $product_detail = Product_Detail::where('product_detail_id', $product_detail_id)
                ->where('product_id', $product_id)
                ->where('size', $size)
                ->where('color', $color)
                ->first();

            if (!$product_detail) {
                session()->flash('fail', 'Thông tin chi tiết sản phẩm không hợp lệ.');
                unset($shopping_cart[$cart_item]);
                $is_updated = true;
                continue;
            }

            if ($product_detail->quantity == 0) {
                session()->flash('fail', 'Sản phẩm đã hết hàng hoặc đang không có sẵn trong cửa hàng.');
                unset($shopping_cart[$cart_item]);
                $is_updated = true;
                continue;
            }



            // kiểm tra xem số lượng sản phẩm trong giỏ hàng có vượt quá số lượng có sẵn trong kho không
            if ($quantity > $product_detail->quantity) {

                $shopping_cart[$cart_item]['quantity'] = $product_detail->quantity;
                session()->flash('fail', 'Số lượng một số sản phẩm đã đạt số lượng tối đa và đã được cập nhật.');
                $is_updated = true;
            }
        }


        // nếu giỏ hàng đã được cập nhật, lưu thay đổi và chuyển hướng đến trang giỏ hàng
        if ($is_updated) {
            session()->put('shopping_cart_' . $user_id, $shopping_cart);

            // Kiểm tra xem giỏ hàng còn sản phẩm không sau khi cập nhật
            if (empty($shopping_cart)) {

                return redirect('/ktcstore')->with('fail', 'Giỏ hàng của bạn hiện đã trống.');
            }

            // Nếu giỏ hàng vẫn còn sản phẩm và đã có thông báo lỗi từ trước
            if (session()->has('fail')) {
                return redirect('/ktcstore/shopping-cart');
            }

            // Nếu không có thông báo lỗi, chuyển hướng đến trang giỏ hàng với thông báo thành công
            return redirect('/ktcstore/shopping-cart')->with('success', 'Giỏ hàng của bạn đã được cập nhật thành công.');
        }

        // Nếu không có thay đổi nào sẽ chuyển đến trang thanh toán
        $customer = User::find($user_id);
        return view("customer.checkout", compact('customer', 'shopping_cart'));
    }

    public function purchase(Request $request)
    {
        // Lấy thông tin khách hàng và giỏ hàng
        $payment_method = $request->payment_method;
        $consignee = $request->consignee;
        $address = $request->address;
        $phone_number = $request->phone_number;
        $user_id = auth()->id();
        $notes = $request->notes;
        $shopping_cart = session()->get('shopping_cart_' . $user_id, []);

        if (empty($shopping_cart)) {
            return redirect('/ktcstore/checkout')->with('fail', 'Giỏ hàng của bạn đang trống.');
        }

        DB::beginTransaction();
        // Thêm đơn hàng và chi tiết đơn hàng
        try {
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
                $product_detail = Product_Detail::find($cart_data['product_detail_id']);

                if (!$product_detail) {
                    throw new \Exception('Sản phẩm không tồn tại trong kho.');
                }

                if ($product_detail->quantity < $cart_data['quantity']) {
                    $shopping_cart[$cart_data['product_id'] . '_' . $cart_data['product_detail_id']]['quantity'] = $product_detail->quantity;
                    session()->put('shopping_cart_' . $user_id, $shopping_cart);
                    throw new \Exception('Số lượng một số sản phẩm đã đạt số lượng tối đa và đã được cập nhật.');
                }

                DB::table('order_detail')->insert([
                    'order_id' => $new_order_id,
                    'product_detail_id' => $cart_data['product_detail_id'],
                    'price' => $cart_data['sale_price'] ?: $cart_data['price'],
                    'quantity' => $cart_data['quantity'],
                    'created_at' => now(),
                    'updated_at' => NULL
                ]);

                $product_detail->quantity -= $cart_data['quantity'];
                $product_detail->save();
            }


            DB::commit();
            // Nếu phương thức thanh toán là chuyển khoản
            if ($payment_method == "Chuyển khoản") {
                session()->put('new_order_id', $new_order_id);
                DB::table('order')->where("order_id", $new_order_id)->update([
                    'status' => 'Đã hủy thanh toán',
                    'updated_at' => now()
                ]);
                // Gửi thông tin sang VNPAY
                $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
                $vnp_Returnurl = route('vnpay_return');
                $vnp_TmnCode = "VRNE42A3";
                $vnp_HashSecret = "YK1OFOLRCMEYE0OPJ2ZL71S33GL0RD7H";
                $vnp_TxnRef = "KTC-" . $user_id . $new_order_id;
                $vnp_OrderInfo = "Thanh toán hóa đơn";
                $vnp_OrderType = "Đơn hàng KTC Store";
                $vnp_Amount = $request->total_price * 100;
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

                if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                    $inputData['vnp_BankCode'] = $vnp_BankCode;
                }
                if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
                    $inputData['vnp_Bill_State'] = $vnp_Bill_State;
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
                // Mail::to(session()->get('email'))->send(new OrderMail($shopping_cart));
                session()->forget('shopping_cart_' . $user_id);
                return redirect('/ktcstore/order_history')->with('success', 'Đã đặt hàng thành công!');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('/ktcstore/checkout')->with('fail', 'Đã xảy ra lỗi khi đặt hàng: ' . $e->getMessage());
        }
    }

    // Khi nhận return từ VNPay
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
            // Mã 00 là thanh toán thành công
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
                // Các mã khác là đã có thể có lỗi thanh toán xảy ra từ bên người dùng hoặc bên VNPay khiến thanh toán không được hoàn tất
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

    public function search_product(Request $request)
    {
        $search_keywords = $request->keywords;
        if ($search_keywords) {
            Paginator::useBootstrap();
            $products = Product::where('product_name', 'LIKE', "%$search_keywords%")
                ->leftJoin("product_detail", "products.product_id", "=", "product_detail.product_id")
                ->where('product_detail.size', '=', 'S')
                ->select('products.product_id', 'products.product_name', DB::raw('MAX(product_detail.image) as image'), DB::raw('MAX(product_detail.price) as price'), DB::raw('MAX(product_detail.sale_price) as sale_price'))
                ->groupBy('products.product_id', 'products.product_name')
                ->paginate(16);
            Paginator::useBootstrap();

            return view("customer.shop", compact(['products']))->with('i', (request()->input('page', 1) - 1) * 16);
        }
    }
}
