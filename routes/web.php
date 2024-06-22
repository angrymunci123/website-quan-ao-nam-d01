<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\StoreController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/ktcstore');
});

// Route::get('/mainpage', function () {
//     return view('customer.index');
// });

//Login (Chung cho cả Admin và Khách Hàng)
Route::get('/login', [AuthController::class, "login_form"]);
Route::post('/login_process', [AuthController::class, "loginProcess"])->name("loginProcess");
Route::get('/register', [AuthController::class, "register"]);
Route::post('/register_process', [AuthController::class, "registerProcess"])->name("registerProcess");
Route::get('/admin/logout', [AuthController::class, "logout_admin"])->name('logout_admin');
Route::post('/ktcstore/logout', [AuthController::class, "logout_customer"])->name('logout_customer');

//Admin
Route::get('/admin', [AdminController::class, "view_dashboard"]);

//Brand
Route::get('/admin/brand', [BrandController::class, "brand_management"]);

Route::get('/admin/brand/add_brand', [BrandController::class, "add_brand"]);
Route::post('/admin/brand/save_brand', [BrandController::class, "save_brand"]);

Route::get('/admin/brand/edit_brand/brand_id={brand_id}', [BrandController::class, "edit_brand"]);
Route::post('/admin/brand/update_brand/brand_id={brand_id}', [BrandController::class, "update_brand"]);

Route::post('/admin/brand/delete_brand/brand_id={brand_id}', [BrandController::class, "delete_brand"]);

//Category
Route::get('/admin/category', [CategoryController::class, "category_management"]);

Route::get('/admin/category/add_category', [CategoryController::class, "add_category"]);
Route::post('/admin/category/save_category', [CategoryController::class, "save_category"]);

Route::get('/admin/category/edit_category/category_id={category_id}', [CategoryController::class, "edit_category"]);
Route::post('/admin/category/update_category/category_id={category_id}', [CategoryController::class, "update_category"]);

Route::post('/admin/category/delete_category/category_id={category_id}', [CategoryController::class, "delete_category"]);

//User list
Route::get('/admin/user', [AdminController::class, "user_list"]);

//News
Route::get('/admin/news', [NewsController::class, "news"]);
Route::get('/admin/news/view_news/news_id={news_id}', [NewsController::class, "view_news"]);
Route::get('/admin/news/create_news', [NewsController::class, "create_news"]);
Route::post('/admin/news/save_news', [NewsController::class, "save_news"]);
Route::get('/admin/news/edit_news/news_id={news_id}', [NewsController::class, "edit_news"]);
Route::post('/admin/news/update_news/news_id={news_id}', [NewsController::class, "update_news"]);
Route::post('/admin/news/delete_news/news_id={news_id}', [NewsController::class, "delete_news"]);

//Product
Route::get('/admin/product', [ProductController::class, "product_management"]);
Route::get('/admin/product/add_product', [ProductController::class, "add_product"]);
Route::post('/admin/product/save_product', [ProductController::class, "save_product"]);
Route::get('/admin/product/edit_product/product_id={product_id}', [ProductController::class, "edit_product"]);
Route::get('/admin/product/product_detail/product_id={product_id}', [ProductController::class, "view_product"]);
Route::post('/admin/product/update_product/product_id={product_id}', [ProductController::class, "update_product"]);
Route::post('/admin/product/delete_product/product_id={product_id}', [ProductController::class, "delete_product"]);
Route::post('/admin/product/search_product', [ProductController::class, "search_product"]);

//Product Detail
Route::get('/admin/product/product_detail/add_product_detail/product_id={product_id}', [ProductController::class, "add_product_detail"]);
Route::post('/admin/product/product_detail/save_product_detail', [ProductController::class, "save_product_detail"]);
Route::get('/admin/product/product_detail/view_detail/product_id={product_id}&product_detail_id={product_detail_id}', [ProductController::class, "view_product_detail"]);
Route::get('/admin/product/product_detail/edit_detail/product_id={product_id}&product_detail_id={product_detail_id}', [ProductController::class, "edit_product_detail"]);
Route::post('/admin/product/product_detail/update_detail/product_id={product_id}&product_detail_id={product_detail_id}', [ProductController::class, "update_product_detail"]);
Route::post('/admin/product/product_detail/delete_detail/product_id={product_id}&product_detail_id={product_detail_id}', [ProductController::class, "delete_product_detail"]);

//Order
Route::get('/admin/order', [OrderController::class, "order_list"]);
Route::get('/admin/order/order_detail/order_id{order_id}', [OrderController::class, "order_detail"]);
Route::get('/admin/order/confirm/order_id={order_id}', [OrderController::class, "confirm_order"]);
Route::get('/admin/order/update_status/order_id={order_id}', [OrderController::class, "update_status"]);
Route::get('/admin/order/cancel/order_id={order_id}', [OrderController::class, "cancel_order"]);

//Customer
Route::get('/ktcstore', [StoreController::class, "mainpage"]);
Route::get('/ktcstore/product/{product_name}', [StoreController::class, "product_detail"]);
Route::get('/ktcstore/contact', [StoreController::class, "contact"]);
Route::get('/ktcstore/blog', [StoreController::class, "blog"]);
Route::get('/ktcstore/shop', [StoreController::class, "shop"]);
Route::get('/ktcstore/about', [StoreController::class, "about"]);
Route::get('/ktcstore/shop/filter_price/{price_range}', [StoreController::class, "filter_price"])->name('filter.price');
Route::get('/ktcstore/shop/filter_brand/{brand_name}', [StoreController::class, "filter_brand"])->name('filter.brand');
Route::get('/ktcstore/shop/filter_category/{category_name}', [StoreController::class, "filter_category"])->name('filter.category');
Route::get('/ktcstore/shop/filter_color/{color}', [StoreController::class, "filter_color"])->name('filter.color');
Route::get('/ktcstore/shop/filter_size/{size}', [StoreController::class, "filter_size"])->name('filter.size');
Route::get('/ktcstore/search_product', [StoreController::class, "search_product"])->name("search_product");

//Customer - Shopping Cart, Checkout
Route::get('/ktcstore/shopping-cart', [StoreController::class, "shopping_cart"]);
Route::get('/ktcstore/add_to_cart/product_id={product_id}&product_detail_id={product_detail_id}', [StoreController::class, 'add_to_cart'])->name('add_to_cart');
Route::get('/ktcstore/shopping-cart/remove_from_cart', [StoreController::class, 'remove_from_cart'])->name('remove_from_cart');
Route::get('/ktcstore/shopping-cart/plus_cart/product_id={product_id}&product_detail_id={product_detail_id}', [StoreController::class, 'plus_quantity'])->name('plus_cart');
Route::get('/ktcstore/shopping-cart/minus_cart/product_id={product_id}&product_detail_id={product_detail_id}', [StoreController::class, 'minus_quantity'])->name('minus_cart');
Route::get('/ktcstore/checkout', [StoreController::class, "checkout"]);
Route::post('/ktcstore/purchase', [StoreController::class, "purchase"]);

//Customer - Order
Route::get('/ktcstore/order_history', [CustomerController::class, "order_history"]);
Route::get('/ktcstore/order_detail/order_id={order_id}', [CustomerController::class, "order_detail"]);
Route::post('/ktcstore/order_history/cancel_order/order_id={order_id}', [CustomerController::class, "cancel_order"]);
Route::get('/ktcstore/blog-details', [StoreController::class, "blog_detail"]);




