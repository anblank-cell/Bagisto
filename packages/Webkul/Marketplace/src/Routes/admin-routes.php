<?php

use Illuminate\Support\Facades\Route;
use Webkul\Marketplace\Http\Controllers\Admin\SellerController;
use Webkul\Marketplace\Http\Controllers\Admin\ProductController;
use Webkul\Marketplace\Http\Controllers\Admin\OrderController;
use Webkul\Marketplace\Http\Controllers\Admin\TransactionController;
use Webkul\Marketplace\Http\Controllers\Admin\ReviewController;
use Webkul\Marketplace\Http\Controllers\Admin\FlagReasonController;

Route::group([
    'middleware' => ['web', 'admin'],
    'prefix'     => config('app.admin_url') . '/marketplace',
], function () {

    // Sellers
    Route::prefix('sellers')->group(function () {
        Route::get('', [SellerController::class, 'index'])->name('admin.marketplace.sellers.index');
        Route::get('{id}', [SellerController::class, 'show'])->name('admin.marketplace.sellers.show');
        Route::put('{id}', [SellerController::class, 'update'])->name('admin.marketplace.sellers.update');
        Route::delete('{id}', [SellerController::class, 'destroy'])->name('admin.marketplace.sellers.delete');
        Route::post('{id}/approve', [SellerController::class, 'approve'])->name('admin.marketplace.sellers.approve');
        Route::post('{id}/disapprove', [SellerController::class, 'disapprove'])->name('admin.marketplace.sellers.disapprove');
        Route::post('mass-delete', [SellerController::class, 'massDestroy'])->name('admin.marketplace.sellers.mass-delete');
        Route::post('mass-approve', [SellerController::class, 'massApprove'])->name('admin.marketplace.sellers.mass-approve');
    });

    // Products
    Route::prefix('products')->group(function () {
        Route::get('', [ProductController::class, 'index'])->name('admin.marketplace.products.index');
        Route::post('{id}/approve', [ProductController::class, 'approve'])->name('admin.marketplace.products.approve');
        Route::post('{id}/disapprove', [ProductController::class, 'disapprove'])->name('admin.marketplace.products.disapprove');
        Route::post('assign', [ProductController::class, 'assign'])->name('admin.marketplace.products.assign');
        Route::delete('{id}', [ProductController::class, 'destroy'])->name('admin.marketplace.products.delete');
        Route::post('mass-delete', [ProductController::class, 'massDestroy'])->name('admin.marketplace.products.mass-delete');
    });

    // Orders
    Route::prefix('orders')->group(function () {
        Route::get('', [OrderController::class, 'index'])->name('admin.marketplace.orders.index');
        Route::get('{id}', [OrderController::class, 'show'])->name('admin.marketplace.orders.show');
        Route::post('{id}/payout', [OrderController::class, 'payout'])->name('admin.marketplace.orders.payout');
    });

    // Transactions
    Route::prefix('transactions')->group(function () {
        Route::get('', [TransactionController::class, 'index'])->name('admin.marketplace.transactions.index');
        Route::post('', [TransactionController::class, 'store'])->name('admin.marketplace.transactions.store');
    });

    // Reviews
    Route::prefix('reviews')->group(function () {
        Route::get('', [ReviewController::class, 'index'])->name('admin.marketplace.reviews.index');
        Route::post('{id}/approve', [ReviewController::class, 'approve'])->name('admin.marketplace.reviews.approve');
        Route::post('{id}/disapprove', [ReviewController::class, 'disapprove'])->name('admin.marketplace.reviews.disapprove');
        Route::delete('{id}', [ReviewController::class, 'destroy'])->name('admin.marketplace.reviews.delete');
    });

    // Flag Reasons
    Route::prefix('flag-reasons')->group(function () {
        Route::get('', [FlagReasonController::class, 'index'])->name('admin.marketplace.flag-reasons.index');
        Route::post('', [FlagReasonController::class, 'store'])->name('admin.marketplace.flag-reasons.store');
        Route::put('{id}', [FlagReasonController::class, 'update'])->name('admin.marketplace.flag-reasons.update');
        Route::delete('{id}', [FlagReasonController::class, 'destroy'])->name('admin.marketplace.flag-reasons.delete');
    });
});
