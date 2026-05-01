<?php

use Illuminate\Support\Facades\Route;
use Webkul\Marketplace\Http\Controllers\Shop\MarketplaceController;
use Webkul\Marketplace\Http\Controllers\Shop\SellerController;

Route::group([
    'middleware' => ['web', 'locale', 'theme', 'currency'],
    'prefix'     => 'marketplace',
], function () {
    Route::get('', [MarketplaceController::class, 'index'])->name('marketplace.index');
    Route::get('sellers', [SellerController::class, 'index'])->name('marketplace.sellers.index');
    Route::get('sellers/{slug}', [SellerController::class, 'show'])->name('marketplace.sellers.show');
    Route::get('sellers/{slug}/products', [SellerController::class, 'products'])->name('marketplace.sellers.products');
    Route::post('sellers/{slug}/review', [SellerController::class, 'storeReview'])->name('marketplace.sellers.review.store');
});
