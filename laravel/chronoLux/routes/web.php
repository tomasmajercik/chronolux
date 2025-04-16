<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

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
    return view('/cart/product_page');
});

Route::get('/proceed', function () {
    return view('/cart/proceed');
});