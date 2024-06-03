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

    public function add_product_detail()
    {
        if (!Auth::check())
        {
            return view('admin');
        }
        $products = Product::orderBy('products.product_id', "ASC")->get(['product_id', 'name']);
        return view('admin.product.product_detail.add_detail', compact('products'));
    }

    public function saveProduct_Detail(Request $request)
    {
        if (!Auth::check())
        {
            return view('admin');
        }

        $product_id = $request->product_id;
        $size = $request->size;
        $quantity = $request->quantity;
        $image = time().$request->image->getClientOriginalName();
        $request->image->move(public_path('image'), $image);
        $description = $request->description;
        DB::table('product_detail')->insert([
            'product_id' => $product_id,
            'size' => $size,
            'quantity' => $quantity,
            'image' => $image,
            'description' => $description
        ]);
        return redirect('/admin/product')->with('notification', 'Thêm Chi Tiết Sản Phẩm Mới Thành Công!');
    }
}
