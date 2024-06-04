<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AuthController;
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
    return view('welcome');
});

// Route::get('/mainpage', function () {
//     return view('customer.index');
// });


//Admin
Route::get('/admin', [AdminController::class, "loginAdmin"]);
Route::post('/admin/login_process', [AdminController::class, "loginProcess"])->name("loginProcess");;
Route::get('/admin/dashboard', [AdminController::class, "view_dashboard"]);

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
Route::get('/admin/news', [AdminController::class, "news"]);

//Product
Route::get('/admin/product', [ProductController::class, "product_management"]);
Route::get('/admin/product/add_product', [ProductController::class, "add_product"]);
Route::post('/admin/product/save_product', [ProductController::class, "save_product"]);
Route::get('/admin/product/view_product/product_id={product_id}', [ProductController::class, "view_product"]);
Route::get('/admin/product/update_product_detail/product_id=', [ProductController::class, "update_product_detail"]);
Route::get('/admin/product/update_product/product_id=', [ProductController::class, "update_product"]);
Route::get('/admin/product/view_product_detail/product_id=', [ProductController::class, "view_product_detail"]);
Route::get('/admin/product/product_detail/add_product_detail/product_id={product_id}', [ProductController::class, "add_product_detail"]);
Route::post('/admin/product/product_detail/save_product_detail', [ProductController::class, "save_product_detail"]);


//Order
Route::get('/admin/order', [OrderController::class, "or_lists"]);

//Customer
Route::get('/mainpage', [StoreController::class, "mainpage"]);
Route::get('/mainpage/contact', [StoreController::class, "contact"]);
Route::get('/mainpage/blog', [StoreController::class, "blog"]);
Route::get('/mainpage/shop', [StoreController::class, "shop"]);
Route::get('/mainpage/about', [StoreController::class, "about"]);
Route::get('/mainpage/shopping-cart', [StoreController::class, "shopping_cart"]);
Route::get('/mainpage/shop-details', [StoreController::class, "shop_detail"]);
Route::get('/mainpage/checkout', [StoreController::class, "checkout"]);
Route::get('/mainpage/blog-details', [StoreController::class, "blog_detail"]);
Route::get('/mainpage/product-detail', [StoreController::class, "product_detail"]);
Route::get('/login', [StoreController::class, "login_customer"]);
