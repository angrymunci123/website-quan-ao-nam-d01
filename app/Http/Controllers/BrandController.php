<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    public function brand_management() 
    {
        if (!Auth::check()) {
            return redirect('admin');
        }
        $brands = Brand::paginate(10);
        Paginator::useBootstrap();  
        return view('admin.brand.list', compact('brands'))->with('i', (request()->input('page', 1) -1) *5);
    }

    public function add_brand() 
    {
        if (!Auth::check()) {
            return redirect('admin');
        }
        return view('admin.brand.add_brand');
    }

    public function save_brand(Request $request) 
    {
        if (!Auth::check()) {
            return redirect('admin');
        }
        $brand_name = $request->name;
        DB::table('brands')->insert([
            'name' => $brand_name
        ]);
        return redirect("/admin/brand")->with('notification', 'Tạo Hãng Sản Xuất Mới Thành Công!');;
    }

    public function edit_brand($brand_id) {
        if (!Auth::check())
        {
            return view('admin');
        }
        $brands = Brand::find($brand_id);
        return view('admin.brand.edit_brand', compact('brands'));
    }

    public function update_brand(Request $request, $brand_id) {
        if (!Auth::check())
        {
            return view('admin');
        }
        $name = $request->name;
        DB::table('brands')->where("brand_id", "=", "$brand_id")->update([
            'name' => $name
        ]);
        return redirect('/admin/brand')->with('notification', 'Sửa Hãng Sản Xuất Thành Công!');
    }

    public function delete_brand($brand_id) {
        if (!Auth::check())
        {
            return view('admin');
        }
        $brand = Brand::findOrFail($brand_id);
        $brand->delete();
        return redirect('/admin/brand')->with('notification', 'Xóa Hãng Sản Xuất Thành Công!');
    }
}