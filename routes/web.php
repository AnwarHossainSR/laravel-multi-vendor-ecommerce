<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\BannerController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\CouponController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\ProductControllert;
use App\Http\Controllers\admin\ShippingController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\frontend\CheckoutController;
use App\Http\Controllers\frontend\IndexController;
use App\Http\Controllers\frontend\user\CustomerController;
use App\Http\Controllers\frontend\WishlistController;
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

Route::group(['middleware'=>'auth'],function(){
    // Cart section
    Route::prefix('cart')->group(function () {
        Route::get('',[CartController::class,'cart'])->name('cart');
        Route::post('/store',[CartController::class,'singleAddToCart'])->name('cart.store');
        Route::post('/cart-delete',[CartController::class,'cartRemove'])->name('cart.remove');
        Route::post('/cart-update',[CartController::class,'cartUpdate'])->name('cart.update');
        Route::get('/cat-destroy',[CartController::class,'cartDestroy'])->name('cart.destroy');
        //COupon
        Route::post('/coupon/add', [CartController::class,'couponAdd'])->name('coupon.add');
    });
    //Wishlist
    Route::prefix('wishlist')->group(function () {
        Route::get('',[WishlistController::class,'wishList'])->name('wishlist');
        Route::post('/store',[WishlistController::class,'singleAddToWishlist'])->name('wishlist.store');
        Route::post('/delete',[WishlistController::class,'wishlistRemove'])->name('wishlist.remove');
        Route::post('/update',[WishlistController::class,'wishlistUpdate'])->name('wishlist.update');
        Route::get('/destroy',[WishlistController::class,'wishlistDestroy'])->name('wishlist.destroy');
    });
    //checkout
    Route::prefix('checkout')->group(function () {
        Route::get('',[CheckoutController::class,'checkout'])->name('checkout');
        Route::post('/shipping',[CheckoutController::class,'checkoutShipping'])->name('checkout.shipping');
        Route::post('/payment',[CheckoutController::class,'checkoutPayment'])->name('checkout.payment');
        Route::post('/create-order',[CheckoutController::class,'checkoutOrder'])->name('checkout.order');
        Route::post('/order-store',[CheckoutController::class,'orderStore'])->name('checkout.store');
    });
    /* Route::prefix('order')->group(function () {
        Route::get('',[OrderController::class,'order'])->name('order')->middleware('user');

    }); */
});

//End frontend

//Backend
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
    //coupon
    Route::resource('coupon', CouponController::class);
    Route::post('coupon_status', [CouponController::class,'couponStatus'])->name('coupon.status');
    //shipping
    Route::resource('shipping', ShippingController::class);
    Route::post('shipping_status', [ShippingController::class,'shippingStatus'])->name('shipping.status');
    //orders
    Route::resource('orders', OrderController::class);
});



//seller

Route::group(['prefix'=>'/seller','middleware'=>['auth','seller']],function(){
    Route::get('/dashboard', function () {
        return 'Seller user';
    })->name('seller');
});

//customer

Route::group(['prefix'=>'/user','middleware'=>['auth','user']],function(){
    Route::get('/dashboard', [CustomerController::class,'userDashboard'])->name('customer');
    //order
    Route::get('/order',[CustomerController::class,'orderIndex'])->name('user.order');
    Route::get('/order/show/{id}',[CustomerController::class,'orderShow'])->name('user.order.show');
    Route::delete('/order/delete/{id}',[CustomerController::class,'userOrderDelete'])->name('user.order.delete');
    //address
    Route::get('/address',[CustomerController::class,'userAddress'])->name('user.address');
    Route::post('/address/billing',[CustomerController::class,'userBillingAddress'])->name('user.address.billing');
    Route::post('/address/shipping',[CustomerController::class,'userShippingAddress'])->name('user.address.shipping');
    //account
    Route::get('/account',[CustomerController::class,'userAccount'])->name('user.account');
    Route::post('/account/update',[CustomerController::class,'userAccountUpdate'])->name('user.account.update');
});
