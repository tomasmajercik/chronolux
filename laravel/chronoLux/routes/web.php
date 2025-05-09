<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailItemController;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\AdminDashboardController;


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


//**** Protected Routes ****//a
Route::get('/profile', [ProfileController::class, 'show'])
    ->middleware(['auth', 'not_admin'])
    ->name('profile');


Route::get('/profile/orders', [OrderController::class, 'index'])->middleware(['auth', 'not_admin'])->name('profile.orders');
Route::get('/profile/orders/detail/{id}', [OrderDetailItemController::class, 'showOrderDetail'])->middleware(['auth', 'not_admin'])->name('profile.orders.detail');


Route::get('/profile/settings', function () {
    return view('settings', ['user' => Auth::user()]);
})->middleware(['auth', 'not_admin'])->name('profile.settings');
//****                  ****//

//**** Edit name Routes ****//
Route::post('/profile/edit-name', [ProfileController::class, 'editName'])->middleware(['auth', 'not_admin'])->name('profile.edit-name');
Route::post('/profile/update-name', [ProfileController::class, 'updateName'])->middleware(['auth', 'not_admin']);
//****                ****//
//**** Edit address Routes ****//
Route::post('/profile/update-address', [ProfileController::class, 'updateAddress'])->middleware(['auth', 'not_admin'])->name('profile.update-address');
Route::post('/profile/update-contact', [ProfileController::class, 'updateContact'])->middleware(['auth', 'not_admin'])->name('profile.update-contact');

//**** Settings Routes ****//
Route::middleware('auth')->group(function() {
    Route::post('/profile/settings/update-email', [ProfileController::class, 'updateEmail'])->name('profile.update-email');
    Route::post('/profile/settings/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');
});


//Cart Routes
Route::get('/cart/proceed', function () {
    return view('cart.proceed');
})->name('cart.proceed');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
Route::put('/cart/update/{order_item_id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{order_item_id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/cart/shipping', [CartController::class, 'add_shipping_info'])->name('cart.shipping');
Route::get('/cart/payment', [CartController::class, 'payment'])->name('cart.payment');
Route::post('/cart/pay_now', [CartController::class, 'pay_now'])->name('payment.store');

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


//****        Admin routes          ****//
Route::middleware(['auth', 'is_admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'adminStats'])
        ->name('admin.dashboard');

    Route::get('/add-product', [ProductController::class, 'create'])->name('admin.addProduct');

    Route::get('/edit-product', function () {
        return view('admin.editProduct', ['active' => 'editProduct']);
    })->name('admin.editProduct');

    Route::post('/products', [ProductController::class, 'store'])->name('admin.products.store');
});






Route::get('/products/{category_name?}', [ProductController::class, 'showByCategory'])->name('products.byCategory');
Route::get('/product-detail/{id}', [ProductController::class, 'showProductDetail'])->name('product.detail');

require __DIR__.'/auth.php';