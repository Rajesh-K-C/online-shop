<?php

use App\Http\Controllers\backend\ReportController;
use App\Http\Middleware\SettingMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\OrderController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\ContactController;

Route::middleware(SettingMiddleware::class)->group(function () {
    Auth::routes();

    // Open Routes
    Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/', [FrontendController::class, 'index'])->name('index');
    Route::get('category/{category}/product', [FrontendController::class, 'categoryProducts'])->name('category.product');
    Route::get('product/{slug}', [FrontendController::class, 'product'])->name('product');
    // Route::get('contact', [FrontendController::class, 'contact'])->name('contact');
    // Route::post('contact', [FrontendController::class, 'contactStore'])->name('contact');
    Route::post('contact', [ContactController::class, 'store'])->name('contact');
    Route::get('contact', [ContactController::class, 'create'])->name('contact');
    Route::get('products', [FrontendController::class, 'products'])->name('products');
    Route::post('search', [FrontendController::class, 'search'])->name('search');

    // Normal User Routes
    Route::group(['middleware' => ['auth', 'role:user']], function () {
        Route::get('/profile', [FrontendController::class, 'profile'])->name('profile');
        Route::put('user/{user}', action: [FrontendController::class, 'userUpdate'])->name('profile.update');
        Route::get('/shopping-cart', [FrontendController::class, 'cart'])->name('cart');
        Route::post('/add-to-cart', [FrontendController::class, 'addToCart'])->name('add-to-cart');
        Route::delete('/delete-cart/{cart}', [FrontendController::class, 'deleteCart'])->name('delete-cart');
        Route::post('/carts/update', [App\Http\Controllers\Frontend\CartController::class, 'updateCarts'])->name('carts.update');
        Route::post('/cart/update-quantity', [App\Http\Controllers\Frontend\CartController::class, 'updateQuantity'])->name('cart.update.quantity');
        Route::get('/order', [FrontendController::class, 'order'])->name('order');
        Route::post('/order', [OrderController::class, 'store'])->name('order.store');
        Route::get('/order/{order}', [App\Http\Controllers\OrderController::class, 'show'])->name('order.show');
        Route::get('/payment-failed', [App\Http\Controllers\OrderController::class, 'payment_failed'])->name('payment.failed');
        Route::get('/payment-success', [App\Http\Controllers\OrderController::class, 'payment_success'])->name('payment.success');
    });
});

// These Routes are accessible after login
Route::middleware('auth')->group(function () {
    // Add Prefix on route name and route url
    Route::prefix('backend')->name('backend.')->group(function () {

        // These Routes are only accessible by admin
        Route::group(['middleware' => ['role:admin']], function () {
            // User Routes
            Route::resource('user', App\Http\Controllers\Backend\UserController::class);
            //            Route::get('/user/search', [App\Http\Controllers\Backend\UserController::class, 'search'])->name('user.search');
            // Permission Routes
            Route::resource('permission', App\Http\Controllers\Backend\PermissionController::class);
            // Role Routes
            Route::resource('role', App\Http\Controllers\Backend\RoleController::class);

            // Setting Trash Routes
            Route::get('/setting/trash', [App\Http\Controllers\Backend\SettingController::class, 'trash'])->name('setting.trash');
            Route::get('/setting/{setting}/restore', [App\Http\Controllers\Backend\SettingController::class, 'restore'])->name('setting.restore');
            Route::delete('setting/{setting}/remove', [App\Http\Controllers\Backend\SettingController::class, 'remove'])->name('setting.remove');

            // Category Trash Routes
            Route::get('/category/trash', [App\Http\Controllers\Backend\CategoryController::class, 'trash'])->name('category.trash');
            Route::get('/category/{category}/restore', [App\Http\Controllers\Backend\CategoryController::class, 'restore'])->name('category.restore');
            Route::delete('/category/{category}/remove', [App\Http\Controllers\Backend\CategoryController::class, 'remove'])->name('category.remove');

            // Product Trash Routes
            Route::get('/product/trash', [App\Http\Controllers\Backend\ProductController::class, 'trash'])->name('product.trash');
            Route::get('/product/{product}/restore', [App\Http\Controllers\Backend\ProductController::class, 'restore'])->name('product.restore');
            Route::delete('/product/{product}/remove', [App\Http\Controllers\Backend\ProductController::class, 'remove'])->name('product.remove');

            Route::get('/dashboard', [ReportController::class, 'index'])->name('dashboard');
            Route::get('/report/orders', [ReportController::class, 'getOrderReport']);
        });

        // Setting Routes
        Route::group(['middleware' => ['permission:manage-setting']], function () {
            Route::resource('setting', App\Http\Controllers\Backend\SettingController::class);
        });
        // Category Routes
        Route::group(['middleware' => ['permission:manage-category']], function () {
            Route::resource('category', App\Http\Controllers\Backend\CategoryController::class);
        });
        // State, District, and City Routes
        Route::group(['middleware' => ['permission:manage-location']], function () {
            Route::resource('state', App\Http\Controllers\Backend\StateController::class);
            Route::resource('district', App\Http\Controllers\Backend\DistrictController::class);
            Route::resource('city', App\Http\Controllers\Backend\CityController::class);
        });
        // Product Routes
        Route::group(['middleware' => ['permission:manage-product']], function () {
            Route::resource('product', App\Http\Controllers\Backend\ProductController::class);
        });
        // Order Routes
        Route::group(['middleware' => ['permission:update-order-status']], function () {
            // Route::resource('order', App\Http\Controllers\Backend\ProductController::class);
            Route::get('/order', [OrderController::class, 'index'])->name('order.index');
            Route::get('/order/{order}', [App\Http\Controllers\OrderController::class, 'show'])->name('order.show');
            Route::get('/order/{order}/edit', [App\Http\Controllers\OrderController::class, 'edit'])->name('order.edit');
            Route::put('/order/{order}', [App\Http\Controllers\OrderController::class, 'update'])->name('order.update');
            Route::delete('/order/{order}', [App\Http\Controllers\OrderController::class, 'destroy'])->name('order.destroy');
        });
        // Message Routes
        Route::group(['middleware' => ['permission:manage-contact']], function () {
            Route::get('contact', [App\Http\Controllers\Backend\ContactController::class, 'index'])->name('contact.index');
            Route::get('contact/{contact}', [App\Http\Controllers\Backend\ContactController::class, 'show'])->name('contact.show');
            Route::delete('contact/{contact}', [App\Http\Controllers\Backend\ContactController::class, 'destroy'])->name('contact.destroy');
        });
    });
});
