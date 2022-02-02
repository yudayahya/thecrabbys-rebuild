<?php

use App\Http\Controllers\Admin\Auth as adminAuth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Dashboard;
use App\Http\Controllers\Admin\Category;
use App\Http\Controllers\Admin\Error_page;
use App\Http\Controllers\Admin\ManageAdmin;
use App\Http\Controllers\Admin\Product;
use App\Http\Controllers\Admin\Profile;
use App\Http\Controllers\Admin\Variant;
use App\Http\Controllers\Frontend\Auth as memberAuth;
use App\Http\Controllers\Frontend\Member;

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


//Admin Route
//Admin Route Auth
Route::middleware(['revalidate'])->group(function () {
    Route::get('/admin', [adminAuth::class, 'index']);
    Route::get('/admin/auth', [adminAuth::class, 'index']);
    Route::post('/admin/auth', [adminAuth::class, 'sign_in'])->name('admin.login');
    Route::get('/admin/forgot', [adminAuth::class, 'forgot']);
    Route::get('/admin/recover', [adminAuth::class, 'recover']);
});
//End Admin Route Auth

Route::middleware(['auth:admin', 'cekleveladmin:owner,admin', 'revalidate'])->group(function () {
    Route::get('/admin/auth/sign_out', [adminAuth::class, 'sign_out'])->name('admin.logout');
    //Admin Route Dashboard
    Route::get('/admin/dashboard', [Dashboard::class, 'index']);
    //End Admin Route Dashboard

    //Admin Route Category
    Route::get('/admin/category', [Category::class, 'index']);
    Route::get('/admin/category/data', [Category::class, 'get_data']);
    Route::post('/admin/category', [Category::class, 'store']);
    Route::post('/admin/category/update', [Category::class, 'update']);
    Route::delete('/admin/category', [Category::class, 'destroy']);
    Route::post('/admin/category/varian', [Category::class, 'varian_ubah']);
    //End Admin Route Category

    //Admin Route Variant
    Route::get('/admin/variant', [Variant::class, 'index']);
    Route::get('/admin/variant/data', [Variant::class, 'get_data']);
    Route::post('/admin/variant', [Variant::class, 'store']);
    Route::post('/admin/variant/update', [Variant::class, 'update']);
    Route::delete('/admin/variant', [Variant::class, 'destroy']);
    //End Admin Route Variant

    //Admin Route Produk
    Route::get('/admin/product', [Product::class, 'index']);
    Route::get('/admin/product/data', [Product::class, 'get_data']);
    Route::post('/admin/product', [Product::class, 'store']);
    Route::post('/admin/product/update', [Product::class, 'update']);
    Route::delete('/admin/product', [Product::class, 'destroy']);
    Route::post('/admin/product/seller', [Product::class, 'seller_ubah']);
    Route::post('/admin/product/stock', [Product::class, 'stock_ubah']);
    Route::post('/admin/product/keterangan', [Product::class, 'keterangan_ubah']);
    Route::get('/admin/product/images', [Product::class, 'image_list']);
    Route::post('/admin/product/images_upload', [Product::class, 'image_upload']);
    Route::delete('/admin/product/images_delete', [Product::class, 'image_delete']);
    //End Admin Route Produk

    //Admin Route My Profile
    Route::get('/admin/my-profile', [Profile::class, 'index']);
    Route::post('/admin/my-profile', [Profile::class, 'update']);
    //End Admin Route My Profile
});

Route::middleware(['auth:admin', 'cekleveladmin:owner', 'revalidate'])->group(function () {
    //Admin Route Manage Admin
    Route::get('/admin/manage-admin', [ManageAdmin::class, 'index']);
    Route::get('/admin/manage-admin/data', [ManageAdmin::class, 'get_data']);
    Route::post('/admin/manage-admin', [ManageAdmin::class, 'store']);
    Route::post('/admin/manage-admin/update', [ManageAdmin::class, 'update']);
    Route::delete('/admin/manage-admin', [ManageAdmin::class, 'destroy']);
    //End Admin Route Manage Admin
});
//End Admin Route

//Frontend Route
Route::get('/', function () {
    return view('welcome');
});
Route::get('/auth', [memberAuth::class, 'index'])->name('login');
Route::post('/auth', [memberAuth::class, 'sign_in'])->name('member.login');

Route::middleware(['auth:user', 'ceklevel:normal,premium'])->group(function () {
    Route::get('/auth/sign_out', [memberAuth::class, 'sign_out'])->name('member.logout');
    Route::get('/member', [Member::class, 'index']);
});
//End Frontend Route
