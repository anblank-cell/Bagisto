<?php

use Illuminate\Support\Facades\Route;
use Webkul\Marketplace\Http\Controllers\Seller\DashboardController;
use Webkul\Marketplace\Http\Controllers\Seller\ProductController;
use Webkul\Marketplace\Http\Controllers\Seller\OrderController;
use Webkul\Marketplace\Http\Controllers\Seller\TransactionController;
use Webkul\Marketplace\Http\Controllers\Seller\ProfileController;
use Webkul\Marketplace\Http\Controllers\Seller\SubSellerController;
use Webkul\Marketplace\Http\Controllers\Seller\RegisterController;

Route::group([
    'middleware' => ['web', 'locale', 'theme', 'currency'],
    'prefix'     => 'marketplace/seller',
], function () {

    // Registration
    Route::get('register', [RegisterController::class, 'index'])->name('marketplace.seller.register');
    Route::post('register', [RegisterController::class, 'store'])->name('marketplace.seller.register.store');

    // Authenticated seller routes
    Route::group(['middleware' => ['customer', 'marketplace.seller']], function () {

        // Dashboard
        Route::get('dashboard', [DashboardController::class, 'index'])->name('marketplace.seller.dashboard');

        // Profile
        Route::get('profile', [ProfileController::class, 'index'])->name('marketplace.seller.profile');
        Route::put('profile', [ProfileController::class, 'update'])->name('marketplace.seller.profile.update');

        // Products
        Route::prefix('products')->group(function () {
            Route::get('', [ProductController::class, 'index'])->name('marketplace.seller.products.index');
            Route::get('create', [ProductController::class, 'create'])->name('marketplace.seller.products.create');
            Route::post('', [ProductController::class, 'store'])->name('marketplace.seller.products.store');
            Route::get('{id}/edit', [ProductController::class, 'edit'])->name('marketplace.seller.products.edit');
            Route::put('{id}', [ProductController::class, 'update'])->name('marketplace.seller.products.update');
            Route::delete('{id}', [ProductController::class, 'destroy'])->name('marketplace.seller.products.delete');
            Route::post('import', [ProductController::class, 'import'])->name('marketplace.seller.products.import');
            Route::get('assign', [ProductController::class, 'assignIndex'])->name('marketplace.seller.products.assign');
            Route::post('assign', [ProductController::class, 'assignStore'])->name('marketplace.seller.products.assign.store');
        });

        // Orders
        Route::prefix('orders')->group(function () {
            Route::get('', [OrderController::class, 'index'])->name('marketplace.seller.orders.index');
            Route::get('{id}', [OrderController::class, 'show'])->name('marketplace.seller.orders.show');
            Route::post('{id}/cancel', [OrderController::class, 'cancel'])->name('marketplace.seller.orders.cancel');
            Route::post('{id}/invoice', [OrderController::class, 'createInvoice'])->name('marketplace.seller.orders.invoice');
            Route::post('{id}/shipment', [OrderController::class, 'createShipment'])->name('marketplace.seller.orders.shipment');
        });

        // Transactions
        Route::get('transactions', [TransactionController::class, 'index'])->name('marketplace.seller.transactions.index');

        // Sub-sellers
        Route::prefix('sub-sellers')->group(function () {
            Route::get('', [SubSellerController::class, 'index'])->name('marketplace.seller.sub-sellers.index');
            Route::post('', [SubSellerController::class, 'store'])->name('marketplace.seller.sub-sellers.store');
            Route::put('{id}', [SubSellerController::class, 'update'])->name('marketplace.seller.sub-sellers.update');
            Route::delete('{id}', [SubSellerController::class, 'destroy'])->name('marketplace.seller.sub-sellers.delete');
        });
    });
});
