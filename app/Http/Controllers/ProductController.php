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
    public function product_management()
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        if ($user->role === 'Khách Hàng') {
            return redirect('/ktcstore'); 
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
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        if ($user->role === 'Khách Hàng') {
            return redirect('/ktcstore'); 
        }

        $brands = Brand::all();
        $categories = Category::all();
        return view('admin.product.add_product')->with("brands", $brands)->with("categories", $categories);
    }

    public function save_product(Request $request)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        if ($user->role === 'Khách Hàng') {
            return redirect('/ktcstore'); 
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
        return redirect('/admin/product')->with('success', 'Thêm Sản Phẩm Mới Thành Công!');
    }

    public function check_product_id_exist($product_id)
    {
        $check_product_id = Product::where('product_id', $product_id)->exists();
            
        if (!$check_product_id) {
            return false;
        }
        
        return true;
    }

    public function check_product_exist($product_id, $product_detail_id)
    {
        $check_product_id = Product::where('product_id', $product_id)->exists();
        $check_product_detail_id = Product_Detail::where('product_detail_id', $product_detail_id)
            ->where('product_id', $product_id)
            ->exists();
            
        if (!$check_product_id || !$check_product_detail_id) {
            return false;
        }
        
        return true;
    }

    public function edit_product($product_id)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        if (!$this->check_product_id_exist($product_id)) {
            return redirect('/admin');  
        }

        $user = Auth::user();
        if ($user->role === 'Khách Hàng') {
            return redirect('/ktcstore'); 
        }

        $brands = Brand::all();
        $categories = Category::all();
        $products = Product::find($product_id);
        return view('admin.product.update_product', compact('products'))->with("brands", $brands)->with("categories", $categories);
    }

    public function update_product(Request $request, $product_id)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        if ($user->role === 'Khách Hàng') {
            return redirect('/ktcstore'); 
        }

        if (!$this->check_product_id_exist($product_id)) {
            return redirect('/admin');  
        }

        $brand = $request->brand_id;
        $category = $request->category_id;
        $product_name = $request->product_name;
        $description = $request->description;
        DB::table('products')->where("product_id", "=", "$product_id")->update([
            'brand_id' => $brand,
            'category_id' => $category,
            'product_name' => $product_name,
            'description' => $description,
            'updated_at' => now()
        ]);
        return redirect('/admin/product')->with('success', 'Sửa Sản Phẩm Thành Công!');
    }

    public function delete_product($product_id)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        if ($user->role === 'Khách Hàng') {
            return redirect('/ktcstore'); 
        }

        // 1. Check product detail có tồn tại hay không
        DB::beginTransaction();
        $product_detail_exist = Product_Detail::where('product_id', $product_id)->exists();

        if ($product_detail_exist) {
            DB::rollback();
            return back()->with('fail', 'Không thể xóa sản phẩm vì có chi tiết sản phẩm đang tồn tại!');
        }

        // 2. Nếu không có product detail tồn tại, tiến hành xóa product
        $product = Product::findOrFail($product_id);
        $product->delete();

        DB::commit();

        return back()->with('fail', 'Xóa Sản Phẩm Thành Công!');
    }


    public function view_product(Request $request)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        if ($user->role === 'Khách Hàng') {
            return redirect('/ktcstore'); 
        }
        
        $product_id = $request->product_id;

        if (!$this->check_product_id_exist($product_id)) {
            return redirect('/admin');  
        }

        $product_name = DB::table('products')->where('product_id', '=', $product_id)->get('product_name');
        $product_details = DB::table('products')->join('product_detail', 'products.product_id', '=', 'product_detail.product_id')
        ->where('products.product_id', '=', $product_id)
        ->paginate(5);
        Paginator::useBootstrap();
        return view('admin.product.product_detail.product_detail_list', compact(['product_id', 'product_details', 'product_name']))->with('i', (request()->input('page', 1) - 1) * 5);;
    }

    public function add_product_detail(Request $request)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        if ($user->role === 'Khách Hàng') {
            return redirect('/ktcstore'); 
        }

        $product_id = $request->product_id;
        $products = Product::where('product_id', "=", $product_id)->get();
        return view('admin.product.product_detail.add_detail', compact('products'));
    }

    public function save_product_detail(Request $request)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        if ($user->role === 'Khách Hàng') {
            return redirect('/ktcstore'); 
        }

        $product_id = $request->product_id;
        $price = $request->price;
        $sale_price = $request->sale_price;
        $size = $request->size;
        $color = $request->color;
        $quantity = $request->quantity;
        $material = $request->material;
        $image = time() . $request->image->getClientOriginalName();
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
            'created_at' => now(),
            'updated_at' => NULL
        ]);
        return redirect('/admin/product/product_detail/product_id=' . $product_id)
        ->with('success', 'Thêm Chi Tiết Sản Phẩm Mới Thành Công!');
    }

    public function view_product_detail($product_id, $product_detail_id)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        if ($user->role === 'Khách Hàng') {
            return redirect('/ktcstore'); 
        }
      
        if (!$this->check_product_exist($product_id, $product_detail_id)) {
            return redirect('/admin');  
        }

        $view_prd_details = Product::join('product_detail', 'products.product_id', '=', 'product_detail.product_id')
        ->where('product_detail.product_detail_id', "=", $product_detail_id)
        ->get();
        return view("admin.product.product_detail.view_detail", compact('view_prd_details'));
    }

    public function edit_product_detail(Request $request)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        if ($user->role === 'Khách Hàng') {
            return redirect('/ktcstore'); 
        }
        

        $product_id = $request->product_id;
        $product_detail_id = $request->product_detail_id;

        if (!$this->check_product_exist($product_id, $product_detail_id)) {
            return redirect('/admin/product');  
        }

        $inner_join = Product_Detail::where("product_detail.product_detail_id", "=", $product_detail_id)
        ->join('products', 'product_detail.product_id', '=', 'products.product_id')->get();
        return view("admin.product.product_detail.update_detail", compact('inner_join'));
    }

    public function update_product_detail(Request $request)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        if ($user->role === 'Khách Hàng') {
            return redirect('/ktcstore'); 
        }

        $product_id = $request->product_id;
        $product_detail_id = $request->product_detail_id;

        if (!$this->check_product_exist($product_id, $product_detail_id)) {
            return redirect('/admin/product');  
        }

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
            'updated_at' => now()
        ]);

        return redirect('/admin/product/product_detail/product_id='.$product_id.'&product_detail_id='.$product_detail_id)
        ->with('success', 'Sửa Chi Tiết Sản Phẩm Thành Công!');
    }

    public function delete_product_detail($product_id, $product_detail_id)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        if ($user->role === 'Khách Hàng') {
            return redirect('/ktcstore'); 
        }

        if (!$this->check_product_exist($product_id, $product_detail_id)) {
            return redirect('/admin/product');  
        }

        $product_detail = Product_Detail::findOrFail($product_detail_id);
        $product_detail->delete();
        return redirect('/admin/product/product_detail/product_id='.$product_id)->with('success', 'Xóa Chi Tiết Sản Phẩm Thành Công!');
    }

    public function search_product(Request $request)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        if ($user->role === 'Khách Hàng') {
            return redirect('/ktcstore'); 
        }

        $search_text = $request->keywords;

        if ($search_text) {
            $search_products = Product::where('product_name', 'LIKE', "%$search_text%")
                ->join("brands", "products.brand_id", "=", "brands.brand_id")
                ->join("category", "products.category_id", "=", "category.category_id")
                ->orderBy("products.product_id", "desc")
                ->paginate(5);
            Paginator::useBootstrap();

            if ($search_products->isEmpty()) {
                return view('admin.product.search_product', compact('search_products'));
            } 
            
            else 
            {
                return view('admin.product.search_product', compact('search_products'))->with('keywords', $search_text)->with('i', (request()->input('page', 1) - 1) * 5);
            }

        } 
        
        else 
        {
            return back();
        }
    }
}
