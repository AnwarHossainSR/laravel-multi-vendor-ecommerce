<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\BannerController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.include.main');
})->name('home');

Route::get('/login', [HomeController::class,'index']);
Route::get('/register', [HomeController::class,'index']);

Auth::routes();
Route::group(['prefix'=>'/admin','middleware'=>['auth']],function(){
    Route::get('/dashboard', [AdminController::class,'admin'])->name('admin');
    //Banners
    Route::resource('banner', BannerController::class);
    Route::post('banner_status', [BannerController::class,'bannerStatus'])->name('banner.status');
    //Categories
    Route::resource('category', CategoryController::class);
    Route::post('category_status', [CategoryController::class,'categoryStatus'])->name('category.status');
    //Brands
    Route::resource('brand', BrandController::class);
    Route::post('brand_status', [BrandController::class,'brandStatus'])->name('brand.status');
});
