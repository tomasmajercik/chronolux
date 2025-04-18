<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


Route::get('/', function () {
    return view('home');
});

Route::get('/cart', function () {
    return view('/cart/cart');
});

Route::get('/checkout', function () {
    return view('/cart/checkout');
});

Route::get('/payment', function () {
    return view('/cart/payment');
});

Route::get('/product-page', function () {
    return view('/product_page');
});

Route::get('/proceed', function () {
    return view('/cart/proceed');
});

Route::get('/product-detail', function () {
    return view('product_detail');
});

Route::get('/auth', function () {
    return view('auth');
});

Route::get('/profile', function () {
    return view('profile');
});

Route::get('/profile/orders', function () {
    return view('orders');
});

Route::get('/profile/settings', function () {
    return view('settings');
});

Route::get('/products/{category_name}', [ProductController::class, 'showByCategory'])->name('products.byCategory');

Route::get('/product-detail/{id}', [ProductController::class, 'showProductDetail'])->name('product.detail');