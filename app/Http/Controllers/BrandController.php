<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    public function brand_management()
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        if ($user->role === 'Khách Hàng') {
            return redirect('/ktcstore'); 
        }

        $brands = Brand::paginate(5);
        Paginator::useBootstrap();
        return view('admin.brand.list', compact('brands'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function add_brand()
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        if ($user->role === 'Khách Hàng') {
            return redirect('/ktcstore'); 
        }

        return view('admin.brand.add_brand');
    }

    public function save_brand(Request $request)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        if ($user->role === 'Khách Hàng') {
            return redirect('/ktcstore'); 
        }

        $brand_name = $request->brand_name;
        DB::table('brands')->insert([
            'brand_name' => $brand_name
        ]);
        return redirect("/admin/brand")->with('success', 'Tạo Hãng Sản Xuất Mới Thành Công!');;
    }

    public function check_brand_exist($brand_id)
    {
        $check_brand_id = Brand::where('brand_id', $brand_id)->exists();
            
        if (!$check_brand_id) {
            return false;
        }
        
        return true;
    }

    public function edit_brand($brand_id)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        if ($user->role === 'Khách Hàng') {
            return redirect('/ktcstore'); 
        }

        if (!$this->check_brand_exist($brand_id)) {
            return redirect('/admin');  
        }

        $brands = Brand::find($brand_id);
        return view('admin.brand.edit_brand', compact('brands'));
    }

    public function update_brand(Request $request, $brand_id)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        if ($user->role === 'Khách Hàng') {
            return redirect('/ktcstore'); 
        }

        if (!$this->check_brand_exist($brand_id)) {
            return redirect('/admin');  
        }

        $name = $request->brand_name;
        DB::table('brands')->where("brand_id", "=", "$brand_id")->update([
            'brand_name' => $name
        ]);
        return redirect('/admin/brand')->with('success', 'Sửa Hãng Sản Xuất Thành Công!');
    }

    public function delete_brand($brand_id)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        if ($user->role === 'Khách Hàng') {
            return redirect('/ktcstore'); 
        }

        if (!$this->check_brand_exist($brand_id)) {
            return redirect('/admin');  
        }

        // 1. Check product mang brand_id tương ứng có tồn tại hay không
        DB::beginTransaction();
        $product_exist = Product::where('brand_id', $brand_id)->exists();

        if ($product_exist) {
            DB::rollback();
            return back()->with('fail', 'Không thể xóa hãng sản xuất vì có sản phẩm mang mã hãng sản xuất đang tồn tại!');
        }

        // 2. Nếu không có product mang brand_id tương ứng tồn tại, tiến hành xóa brand
        $brand = Brand::findOrFail($brand_id);
        $brand->delete();

        DB::commit();

        return back()->with('success', 'Xóa Hãng Sản Xuất Thành Công!');
    }
}
