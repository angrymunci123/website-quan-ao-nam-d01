<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
<<<<<<< HEAD
    public function brand_management()
=======
    public function brand_management() 
>>>>>>> b06a2870b85a934339f3d1d1149f39bfdfdbf8dd
    {
        if (!Auth::check()) {
            return redirect('admin');
        }
        $brands = Brand::paginate(10);
<<<<<<< HEAD
        Paginator::useBootstrap();
        return view('admin.brand.list', compact('brands'))->with('i', (request()->input('page', 1) -1) *5);
    }

    public function add_brand()
=======
        Paginator::useBootstrap();  
        return view('admin.brand.list', compact('brands'))->with('i', (request()->input('page', 1) -1) *5);
    }

    public function add_brand() 
>>>>>>> b06a2870b85a934339f3d1d1149f39bfdfdbf8dd
    {
        if (!Auth::check()) {
            return redirect('admin');
        }
        return view('admin.brand.add_brand');
    }

<<<<<<< HEAD
    public function save_brand(Request $request)
=======
    public function save_brand(Request $request) 
>>>>>>> b06a2870b85a934339f3d1d1149f39bfdfdbf8dd
    {
        if (!Auth::check()) {
            return redirect('admin');
        }
<<<<<<< HEAD
        if ($request->brand_name == NULL)
        {
            return back()->with('notification', 'Tên Hãng Sản Xuất Không Được Bỏ Trống');
        }
        $brand_name = $request->brand_name;
        DB::table('brands')->insert([
            'brand_name' => $brand_name
        ]);
        return redirect("/admin/brand")->with('notification', 'Tạo Hãng Sản Xuất Mới Thành Công!');
=======
        $brand_name = $request->name;
        DB::table('brands')->insert([
            'name' => $brand_name
        ]);
        return redirect("/admin/brand")->with('notification', 'Tạo Hãng Sản Xuất Mới Thành Công!');;
>>>>>>> b06a2870b85a934339f3d1d1149f39bfdfdbf8dd
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
<<<<<<< HEAD
        $brand_name = $request->brand_name;
        DB::table('brands')->where("brand_id", "=", "$brand_id")->update([
            'brand_name' => $brand_name
=======
        $name = $request->name;
        DB::table('brands')->where("brand_id", "=", "$brand_id")->update([
            'name' => $name
>>>>>>> b06a2870b85a934339f3d1d1149f39bfdfdbf8dd
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
