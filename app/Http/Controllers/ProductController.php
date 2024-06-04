<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Product_Detail;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class ProductController extends Controller
{
    public function product_management() {
        if (!Auth::check()) {
            return redirect('admin');
        }
        $inner_join = Product::join("brands", "products.brand_id", "=", "brands.brand_id")
            ->join("category", "products.category_id", "=", "category.category_id")
            ->orderBy("products.product_id", "desc")
            ->paginate(5);
        Paginator::useBootstrap();
        return view('admin.product.product_list', compact('inner_join'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function add_product()
    {
        if (!Auth::check())
        {
            return view('admin');
        }
        $brands = Brand::all();
        $categories = Category::all();
        return view('admin.product.add_product')->with("brands", $brands)->with("categories", $categories);
    }

    public function save_product(Request $request)
    {
        if (!Auth::check())
        {
            return view('admin');
        }

        $brand = $request->brand_id;
        $category = $request->category_id;
        $product_name = $request->name;
        $description = $request->description;
        DB::table('products')->insert([
            'brand_id' => $brand,
            'category_id' => $category,
            'product_name' => $product_name,
            'description' => $description,
            'created_at' => now(),
            'updated_at' => NULL
        ]);
        return redirect('/admin/product')->with('notification', 'Thêm Sản Phẩm Mới Thành Công!');
    }

    public function view_product(Request $request)
    {
        if (!Auth::check())
        {
            return view('admin');
        }
        $product_id = $request->product_id;
        $product_name = DB::table('products')->where('product_id', '=', $product_id)->get('product_name');
        $product_details = DB::table('products')->join('product_detail', 'products.product_id', '=', 'product_detail.product_id')
        ->where('products.product_id', '=', $product_id)
        ->paginate(5);
        Paginator::useBootstrap();
        return view('admin.product.product_detail.product_detail_list', compact(['product_id', 'product_details', 'product_name']))->with('i', (request()->input('page', 1) - 1) * 5);;
    }

    public function add_product_detail(Request $request)    
    {
        if (!Auth::check())
        {
            return view('admin');
        }
        $product_id = $request->product_id; 
        $products = Product::where('product_id', "=", $product_id)->get();
        return view('admin.product.product_detail.add_detail', compact('products'));
    }

    public function save_product_detail(Request $request)
    {
        if (!Auth::check())
        {
            return view('admin');
        }

        $product_id = $request->product_id;
        $price = $request->price;
        $sale_price = $request->sale_price;
        $size = $request->size;
        $color = $request->color;
        $quantity = $request->quantity;
        $material = $request->material;
        $image = time().$request->image->getClientOriginalName();
        $request->image->move(public_path('image'), $image);
        DB::table('product_detail')->insert([
            'product_id' => $product_id,
            'price' => $price,
            'sale_price' => $sale_price,
            'size' => $size,
            'color' => $color,
            'material' => $material,
            'quantity' => $quantity,
            'image' => $image,
        ]);
        return redirect('/admin/product/product_detail/product_id=' . $product_id)
        ->with('notification', 'Thêm Chi Tiết Sản Phẩm Mới Thành Công!');
    }

    public function view_product_detail($product_id, $product_detail_id)
    {
        if (!Auth::check())
        {
            return view('admin');
        }
        $view_prd_details = Product::join('product_detail', 'products.product_id', '=', 'product_detail.product_id')
        ->where('product_detail.product_detail_id', "=", $product_detail_id)
        ->get();  
        return view("admin.product.product_detail.view_detail", compact('view_prd_details'));
    }

    public function edit_product_detail(Request $request)
    {
        if (!Auth::check())
        {
            return view('admin');
        }
        $product_id = $request->product_id;
        $inner_join = Product::where("products.product_id", "=", $product_id)
        ->join('product_detail', 'products.product_id', '=', 'product_detail.product_id')->get();  
        return view("admin.product.product_detail.update_detail", compact('inner_join'));
    }

    public function update_product_detail(Request $request, $product_detail_id)
    {
        if (!Auth::check())
        {
            return view('admin');
        }

        $product_id = $request->product_id;
        $price = $request->price;
        $sale_price = $request->sale_price;
        $size = $request->size;
        $color = $request->color;
        $quantity = $request->quantity;
        $material = $request->material;
        $image = time().$request->image->getClientOriginalName();
        $request->image->move(public_path('image'), $image);
        DB::table('product_detail')->where("product_detail_id", "=", "$product_detail_id")
        ->update([
            'product_id' => $product_id,
            'price' => $price,
            'sale_price' => $sale_price,
            'size' => $size,
            'color' => $color,
            'material' => $material,
            'quantity' => $quantity,
            'image' => $image,
        ]);

        return redirect('/admin/product/product_detail/product_id='.$product_id.'/product_detail_id='.$product_detail_id)
        ->with('notification', 'Thêm Chi Tiết Sản Phẩm Mới Thành Công!');
    }

    public function delete_product_detail($product_id, $product_detail_id)
    {
        if (!Auth::check())
        {
            return view('adminAuth.login');
        }
        $product_detail = Product_Detail::findOrFail($product_detail_id);
        $product_detail->delete();
        return redirect('/admin/product/product_detail/product_id='.$product_id)->with('notification', 'Xóa Biến Thể Sản Phẩm Thành Công!');
    }

    public function update_product()
    {
        return view("admin.product.update_product");
    }
}
