<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.include.main');
})->name('home');

//Route::get('/login', [HomeController::class,'index']);
//Route::get('/register', [HomeController::class,'index']);

Auth::routes();
Route::group(['prefix'=>'/admin','middleware'=>['auth']],function(){
    Route::get('/dashboard', [AdminController::class,'admin'])->name('admin');
});
