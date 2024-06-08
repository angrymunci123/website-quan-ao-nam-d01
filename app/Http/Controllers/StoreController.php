<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Models\Product_Detail;

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
    public function shop()
    {
        $product_details = Product_Detail::with('product')->get();

        return view("customer.shop", compact('product_details'));
    }
    public function shopping_cart()
    {
        return view("customer.shopping-cart");
    }
    public function product_detail()
    {
        return view("customer.product-details");
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
    public function login_customer()
    {
        return view("customer.login_cus");
    }
}
