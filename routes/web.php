<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//Route::get('/dashboard/admin', [HomeController::class,'admin']);
Route::get('/', [HomeController::class,'index']);


Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix'=>'/admin','middleware'=>['auth']],function(){
    Route::get('/dashboard', [AdminController::class,'admin'])->name('admin');
});
