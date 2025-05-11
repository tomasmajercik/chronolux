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
use App\Http\Controllers\AdminProductController;



Route::get('/', [HomeController::class, 'index']);

Route::get('/cart', function () {
    return view('/cart/cart');
})->middleware(['not_admin']);

Route::get('/product-page', function () {
    return view('/product_page');
});

Route::get('/auth', function () {
    return view('auth');
})->middleware(['guest']);

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
Route::middleware(['auth', 'not_admin'])->group(function() {
    Route::post('/profile/settings/update-email', [ProfileController::class, 'updateEmail'])->name('profile.update-email');
    Route::post('/profile/settings/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');
});

//Cart Routes
Route::get('/cart/proceed', function () {
    return view('cart.proceed');
})->middleware(['not_admin', 'cameFromPage'])->name('cart.proceed');

Route::post('/cart/add', [CartController::class, 'add'])->middleware(['not_admin'])->name('cart.add');
Route::get('/cart', [CartController::class, 'show'])->middleware(['not_admin'])->name('cart.show');
Route::put('/cart/update/{order_item_id}', [CartController::class, 'update'])->middleware(['not_admin'])->name('cart.update');
Route::delete('/cart/remove/{order_item_id}', [CartController::class, 'remove'])->middleware(['not_admin'])->name('cart.remove');

Route::get('/cart/checkout', [CartController::class, 'checkout'])->middleware(['not_admin', 'cameFromPage'])->name('cart.checkout');
Route::post('/cart/start-checkout', [CartController::class, 'startCheckout'])->name('cart.startCheckout');

Route::get('/cart/payment', [CartController::class, 'payment'])->middleware(['not_admin', 'cameFromPage'])->name('cart.payment');
Route::get('/cart/start-payment', [CartController::class, 'startPayment'])->name('cart.startPayment');

Route::get('/cart/start-proceed', [CartController::class, 'startProceed'])->name('cart.startProceed');

Route::post('/cart/shipping', [CartController::class, 'add_shipping_info'])->middleware(['not_admin'])->name('cart.shipping');
Route::post('/cart/pay_now', [CartController::class, 'pay_now'])->middleware(['not_admin'])->name('payment.store');

//**** Authentication Routes ****//
Route::get('/login', function () {
    return view('auth');
})->middleware(['guest'])->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])->middleware(['guest']);

Route::get('/register', function () {
    return view('auth');
})->middleware(['guest'])->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])->middleware(['guest'])->name('register');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->middleware(['guest'])->name('login');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware(['guest'])->name('logout');


//****        Admin routes          ****//
Route::middleware(['auth', 'is_admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'adminStats'])
        ->name('admin.dashboard');

    Route::get('/add-product', [ProductController::class, 'create'])->name('admin.addProduct');

    Route::get('/edit-product', [AdminProductController::class, 'index'])->name('admin.editProduct');

    Route::post('/products', [ProductController::class, 'store'])->name('admin.products.store');

    Route::delete('/admin/products/{id}', [ProductController::class, 'destroy'])->name('admin.products.destroy');

    Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('admin.product.edit');
    Route::put('/product/{id}', [ProductController::class, 'update'])->name('admin.product.update');
});






Route::get('/products/{category_name?}', [ProductController::class, 'showByCategory'])->name('products.byCategory');
Route::get('/product-detail/{id}', [ProductController::class, 'showProductDetail'])->name('product.detail');

require __DIR__.'/auth.php';