<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function loginAdmin()
    {
        if (Auth::check()) {
            return view('admin.dashboard.dashboard');
        }
        return view('admin.login');
    }

    public function loginProcess(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $check = Auth::attempt($credentials);
        if ($check) {
            $email_account = User::where('email', '=', $request->email)->first();
            $request->session()->put('user_id', $email_account->user_id);
            $request->session()->put('full_name', $email_account->full_name);
            $request->session()->put('password', $email_account->password);
            $request->session()->put('position', $email_account->position);
            return view('admin.dashboard.dashboard');
        }
        return redirect('admin')->with('fail', 'Invalid email address or password.');
    }


    public function logoutAdmin(Request $request)
    {
        Auth::logout();
        $request->session()->forget('user_id');
        $request->session()->forget('first_name');
        $request->session()->forget('last_name');
        $request->session()->forget('role');
        $request->session()->forget('password');
        return redirect('admin');
    }

    //Dashboard
    public function view_dashboard()
    {
        if (!Auth::check()) {
            return redirect('admin');
        }
        return view('admin.dashboard.dashboard');
    }

    //User
    public function user_list() 
    {
        if (!Auth::check()) {
            return redirect('admin');
        }
        return view('admin.user.user_list');
    }


    //Product
    public function product_management() 
    {
        if (!Auth::check()) {
            return redirect('admin');
        }
        return view('admin.product.product_list');
    }


    //Brand
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

    //Category



}
