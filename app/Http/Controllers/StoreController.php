<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Models\Product_Detail;
use App\Models\Product;

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
        $products = Product::join("product_detail", "products.product_id" ,"=", "product_detail.product_id")
        ->paginate(16);    
        Paginator::useBootstrap();
        return view("customer.shop", compact('products'))->with('i', (request()->input('page', 1) - 1) * 16);
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
}
