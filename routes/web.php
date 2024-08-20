<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();

// Open Routes
Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\Frontend\FrontendController::class, 'index'])->name('index');
Route::get('category/{category}/product', [App\Http\Controllers\Frontend\FrontendController::class, 'categoryProducts'])->name('category.product');
Route::get('product/{slug}', [App\Http\Controllers\Frontend\FrontendController::class, 'product'])->name('product');
Route::get('contact', [App\Http\Controllers\Frontend\FrontendController::class, 'contact'])->name('contact');
Route::post('contact', [App\Http\Controllers\Frontend\FrontendController::class, 'contactStore'])->name('contact');
Route::get('products', [App\Http\Controllers\Frontend\FrontendController::class, 'products'])->name('products');

// Normal User Routes
Route::group(['middleware' => ['role:user']], function () {
    Route::get('/dashboard', [App\Http\Controllers\Frontend\FrontendController::class, 'dashboard'])->name('dashboard');
    Route::get('/shopping-cart', [App\Http\Controllers\Frontend\FrontendController::class, 'cart'])->name('cart');
    Route::post('/add-to-cart', [App\Http\Controllers\Frontend\FrontendController::class, 'addToCart'])->name('add-to-cart');
    Route::delete('/delete-cart/{cart}', [App\Http\Controllers\Frontend\FrontendController::class, 'deleteCart'])->name('delete-cart');
    Route::post('/carts/update', [App\Http\Controllers\Frontend\CartController::class, 'updateCarts'])->name('carts.update');
    Route::post('/cart/update-quantity', [App\Http\Controllers\Frontend\CartController::class, 'updateQuantity'])->name('cart.update.quantity');
    Route::post('/order/create', [App\Http\Controllers\Frontend\OrderController::class, 'createOrder'])->name('order.create');
    Route::get('/order/success/{order}', [App\Http\Controllers\Frontend\OrderController::class, 'orderSuccess'])->name('order.success');
    Route::put('user/update/{user}', [App\Http\Controllers\Frontend\FrontendController::class, 'userUpdate'])->name('user.update');
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
            Route::resource('order', App\Http\Controllers\Backend\ProductController::class);
        });
        // Message Routes
        Route::group(['middleware' => ['permission:manage-contact']], function () {
            Route::get('contact', [App\Http\Controllers\Backend\ContactController::class, 'index'])->name('contact.index');
            Route::get('contact/{contact}', [App\Http\Controllers\Backend\ContactController::class, 'show'])->name('contact.show');
            Route::delete('contact/{contact}', [App\Http\Controllers\Backend\ContactController::class, 'destroy'])->name('contact.destroy');
        });
    });
});
