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
