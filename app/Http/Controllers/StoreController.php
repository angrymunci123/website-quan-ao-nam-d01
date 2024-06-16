<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Models\Product_Detail;
use App\Models\Product;
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


    public function checkout()
    {
        return view("customer.checkout");
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

    // public function add_to_cart(Request $request) {
    //     $product_id = $request->product_id;
    //     $product_detail_id = $request->product_detail_id;
    //     $size = $request->size;
    //     $color = $request->color;
    //     $quantity = $request->quantity;
    //     $product = Product_Detail::join('products', 'product_detail.product_id', '=', 'products.product_id')
    //         ->where('product_detail.product_detail_id', '=' , $product_detail_id)
    //         ->where('products.product_id', '=' , $product_id)
    //         ->findOrFail($product_detail_id);
    //     $shopping_cart = session()->get('shopping_cart', []);

    //     if (isset($shopping_cart[$product_detail_id])) {
    //         $shopping_cart[$product_detail_id]['quantity']++;
    //     }

    //     else {
    //         $shopping_cart[$product_detail_id] = [
    //             'product_id' => $product->product_id,
    //             'product_detail_id' => $product->product_detail_id,
    //             'product_name' => $product->product_name,
    //             'price' => $product->price,
    //             'size' => $size,
    //             'color' => $color,
    //             'image' => $product->image,
    //             'quantity' => $quantity
    //         ];
    //     }
    //     session()->put('shopping_cart', $shopping_cart);
    //     return redirect()->back()->with('success', 'Đã thêm sản phẩm vào giỏ hàng');
    // }
    public function add_to_cart($product_id, $product_detail_id)
    {
        $product = Product::find($product_id);
        $product_detail = Product_Detail::find($product_detail_id);

        if (!$product || !$product_detail) {
            abort(404);
        }

        $shopping_cart = session()->get('shopping_cart');
        $total_quantity = $product->quantity;

        if (!$shopping_cart) {
            $shopping_cart = [
                $product_id . '_' . $product_detail_id => [
                    "product_id" => $product->product_id,
                    "product_detail_id" => $product_detail_id,
                    "product_name" => $product->product_name,
                    "quantity" => 1,
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
        } else {
            if (isset($shopping_cart[$product_id . '_' . $product_detail_id])) {
                $shopping_cart[$product_id . '_' . $product_detail_id]['quantity']++;
            } else {
                $shopping_cart[$product_id . '_' . $product_detail_id] = [
                    "product_id" => $product->product_id,
                    "product_detail_id" => $product_detail_id,
                    "product_name" => $product->product_name,
                    "quantity" => 1,
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

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function plus_quantity($product_id, $product_detail_id)
    {
        $shopping_cart = session()->get('shopping_cart');
        if (isset($shopping_cart[$product_id . '_' . $product_detail_id])) {
            $shopping_cart[$product_id . '_' . $product_detail_id]['quantity']++;
            session()->put('shopping_cart', $shopping_cart);
            return redirect()->back();
            //lmao
        }
    }

    public function minus_quantity($product_id, $product_detail_id)
    {
        $shopping_cart = session()->get('shopping_cart');
        if (isset($shopping_cart[$product_id . '_' . $product_detail_id])) {
            $shopping_cart[$product_id . '_' . $product_detail_id]['quantity']--;
            session()->put('shopping_cart', $shopping_cart);
            return redirect()->back();
        }
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
}
//     public function remove_from_cart(Request $request)
//     {
//         if ($request->product_id) {
//             $shopping_cart = session()->get('shopping_cart');
//             if (isset($shopping_cart[$request->product_id])) {
//                 unset($shopping_cart[$request->product_id]);
//                 session()->put('shopping_cart', $shopping_cart);
//             }
//             session()->flash('success', 'Sản phảm đã được xóa khỏi giỏ hàng.');
//         }
//     }
// }
