<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\BannerController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\ProductControllert;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\frontend\IndexController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/',[IndexController::class,'home'])->name('home');

Route::get('/login', [HomeController::class,'index']);
Route::get('/register', [HomeController::class,'index']);

Auth::routes();

//Frontend routes

Route::get('/product-cat/{slug}',[IndexController::class,'productCategory'])->name('product-cat');
Route::get('product-detail/{slug}',[IndexController::class,'productDetail'])->name('product-detail');
Route::get('/product-brand/{slug}',[IndexController::class,'productBrand'])->name('product-brand');
Route::get('/product-lists',[IndexController::class,'productLists'])->name('product-lists');
Route::match(['get','post'],'/filter',[IndexController::class,'productFilter'])->name('shop.filter');


//End frontend
Route::group(['prefix'=>'/admin','middleware'=>['auth','admin']],function(){
    Route::get('/dashboard', [AdminController::class,'admin'])->name('admin');
    //Banners
    Route::resource('banner', BannerController::class);
    Route::post('banner_status', [BannerController::class,'bannerStatus'])->name('banner.status');
    //Categories
    Route::resource('category', CategoryController::class);
    Route::post('category_status', [CategoryController::class,'categoryStatus'])->name('category.status');
    Route::post('category/{id}/child', [CategoryController::class,'getChildByParent']);
    //Brands
    Route::resource('brand', BrandController::class);
    Route::post('brand_status', [BrandController::class,'brandStatus'])->name('brand.status');
    //Products
    Route::resource('product', ProductControllert::class);
    Route::post('product_status', [ProductControllert::class,'productStatus'])->name('product.status');
    Route::post('product_view', [ProductControllert::class,'productView'])->name('product.view');
    //users
    Route::resource('user', UserController::class);
    Route::post('user_status', [UserController::class,'userStatus'])->name('user.status');
});

//seller

Route::group(['prefix'=>'/seller','middleware'=>['auth','seller']],function(){
    Route::get('/dashboard', function () {
        return 'Seller user';
    })->name('seller');
});

//customer

Route::group(['prefix'=>'/user','middleware'=>['auth','user']],function(){
    Route::get('/dashboard', function () {
        return 'normal user';
    })->name('customer');
});
