<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function category_management()
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        if ($user->role === 'Khách Hàng') {
            return redirect('/ktcstore'); 
        }

        $categories = Category::paginate(10);
        Paginator::useBootstrap();
        return view('admin.category.list', compact('categories'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function add_category()
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        if ($user->role === 'Khách Hàng') {
            return redirect('/ktcstore'); 
        }

        return view('admin.category.add_category');
    }

    public function save_category(Request $request)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        if ($user->role === 'Khách Hàng') {
            return redirect('/ktcstore'); 
        }

        $brand_name = $request->category_name;
        DB::table('category')->insert([
            'category_name' => $brand_name
        ]);
        return redirect("/admin/category")->with('success', 'Tạo Danh Mục Mới Thành Công!');;
    }

    public function edit_category($category_id)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        if ($user->role === 'Khách Hàng') {
            return redirect('/ktcstore'); 
        }

        $categories = Category::find($category_id);
        return view('admin.category.edit_category', compact('categories'));
    }

    public function update_category(Request $request, $category_id)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        if ($user->role === 'Khách Hàng') {
            return redirect('/ktcstore'); 
        }

        $name = $request->category_name;
        DB::table('category')->where("category_id", "=", "$category_id")->update([
            'category_name' => $name
        ]);
        return redirect('/admin/category')->with('success', 'Sửa Danh Mục Thành Công!');
    }

    public function delete_category($category_id)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        if ($user->role === 'Khách Hàng') {
            return redirect('/ktcstore'); 
        }

        // 1. Check product có tồn tại hay không
        DB::beginTransaction();
        $product_exist = Product::where('category_id', $category_id)->exists();

        if ($product_exist) {
            DB::rollback();
            return back()->with('notification', 'Không thể xóa danh mục vì có sản phẩm đang tồn tại!');
        }

        // 2. Nếu không có product tồn tại, tiến hành xóa category
        $categories = Category::findOrFail($category_id);
        $categories->delete();

        DB::commit();

        return back()->with('success', 'Xóa Danh Mục Thành Công!');
    }
}
