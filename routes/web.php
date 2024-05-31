<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
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
Route::get('/admin/brand', [AdminController::class, "brand_management"]);

Route::get('/admin/brand/add_brand', [AdminController::class, "add_brand"]);
Route::post('/admin/brand/save_brand', [AdminController::class, "save_brand"]);

Route::get('/admin/brand/edit_brand/brand_id={brand_id}', [AdminController::class, "edit_brand"]);
Route::post('/admin/brand/update_brand/brand_id={brand_id}', [AdminController::class, "update_brand"]);

Route::post('/admin/brand/delete_brand/brand_id={brand_id}', [AdminController::class, "delete_brand"]);

//Category
Route::get('/admin/category', [AdminController::class, "category_management"]);

Route::get('/admin/category/add_category', [AdminController::class, "add_category"]);
Route::post('/admin/category/save_category', [AdminController::class, "save_category"]);

Route::get('/admin/category/edit_category/category_id={category_id}', [AdminController::class, "edit_category"]);
Route::post('/admin/category/update_category/category_id={category_id}', [AdminController::class, "update_category"]);

Route::post('/admin/category/delete_category/category_id={category_id}', [AdminController::class, "delete_category"]);

//User list
Route::get('/admin/user', [AdminController::class, "user_list"]);

//Product
Route::get('/admin/product', [AdminController::class, "product_management"]);


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
Route::get('/mainpage/shop-detail', [StoreController::class, "shop-detail"]);
