<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;

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

Route::get('/products/{category_name}', [ProductController::class, 'showByCategory'])->name('products.byCategory');


//**** Protected Routes ****//
Route::get('/profile', [ProfileController::class, 'show'])
    ->name('profile')
    ->middleware('auth');

Route::get('/profile/orders', function () {
    return view('orders');
})->middleware('auth');

Route::get('/profile/settings', function () {
    return view('settings');
})->middleware('auth');
//****                  ****//

//**** Edit name Routes ****//
Route::post('/profile/edit-name', [ProfileController::class, 'editName'])->middleware('auth')->name('profile.edit-name');
Route::post('/profile/update-name', [ProfileController::class, 'updateName'])->middleware('auth');
//****                ****//
//**** Edit address Routes ****//
Route::post('/profile/update-address', [ProfileController::class, 'updateAddress'])->middleware('auth')->name('profile.update-address');
Route::post('/profile/update-contact', [ProfileController::class, 'updateContact'])->middleware('auth')->name('profile.update-contact');


//**** Authentication Routes ****//
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
//****                       ****//


Route::get('/products/{category_name?}', [ProductController::class, 'showByCategory'])->name('products.byCategory');
Route::get('/product-detail/{id}', [ProductController::class, 'showProductDetail'])->name('product.detail');

require __DIR__.'/auth.php';