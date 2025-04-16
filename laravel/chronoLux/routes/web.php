<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('home');
});

Route::get('/product-page', function () {
    return view('product_page');
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