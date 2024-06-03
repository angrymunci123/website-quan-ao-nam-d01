<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function mainpage(){
        return view("customer.index");
    }
    public function contact(){
        return view("customer.contact");
    }
    public function shop(){
        return view("customer.shop");
    }
    public function shopping_cart(){
        return view("customer.shopping-cart");
    }
    public function shop_detail(){
        return view("customer.shop-details");
    }
    public function checkout(){
        return view("customer.checkout");
    }
    public function blog(){
        return view("customer.blog");
    }
    public function blog_detail(){
        return view("customer.blog-details");
    }
    public function about(){
        return view("customer.about");
    }
    public function login_customer(){
        return view("customer.login_cus");
    }
}
