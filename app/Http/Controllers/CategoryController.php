<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function category_management()
    {
        if (!Auth::check()) {
            return redirect('admin');
        }
        $categories = Category::paginate(10);
        Paginator::useBootstrap();
        return view('admin.category.list', compact('categories'))->with('i', (request()->input('page', 1) -1) *5);
    }

    public function add_category()
    {
        if (!Auth::check()) {
            return redirect('admin');
        }
        return view('admin.category.add_category');
    }

    public function save_category(Request $request)
    {
        if (!Auth::check()) {
            return redirect('admin');
        }
        $brand_name = $request->name;
        DB::table('category')->insert([
            'category_name' => $brand_name
        ]);
        return redirect("/admin/category")->with('notification', 'Tạo Danh Mục Mới Thành Công!');;
    }

    public function edit_category($category_id) {
        if (!Auth::check())
        {
            return view('admin');
        }
        $categories = Category::find($category_id);
        return view('admin.category.edit_category', compact('categories'));
    }

    public function update_category(Request $request, $category_id) {
        if (!Auth::check())
        {
            return view('admin');
        }
        $name = $request->name;
        DB::table('category')->where("category_id", "=", "$category_id")->update([
            'category_name' => $name
        ]);
        return redirect('/admin/category')->with('notification', 'Sửa Danh Mục Thành Công!');
    }

    public function delete_category($category_id) {
        if (!Auth::check())
        {
            return view('admin');
        }
        $categories = Category::findOrFail($category_id);
        $categories->delete();
        return redirect('/admin/category')->with('notification', 'Xóa Danh Mục Thành Công!');
    }
}
