<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;


Route::get('/', [HomeController::class, 'index']);

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
})->name('profile')->middleware('auth');


Route::get('/profile/orders', function () {
    return view('orders');
})->middleware('auth');

Route::get('/profile/settings', function () {
    return view('settings');
})->middleware('auth');

Route::get('/products/{category_name}', [ProductController::class, 'showByCategory'])->name('products.byCategory');

//Cart Routes
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

// Authentication Routes
Route::get('/login', function () {
    return view('auth');
})->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store']);

Route::get('/register', function () {
    return view('auth');
})->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
//--//

Route::get('/products/{category_name?}', [ProductController::class, 'showByCategory'])->name('products.byCategory');
Route::get('/product-detail/{id}', [ProductController::class, 'showProductDetail'])->name('product.detail');

require __DIR__.'/auth.php';