<?php

use Illuminate\Support\Facades\Route;
use Webkul\RMA\Http\Controllers\Shop\ReturnRequestController;

Route::group([
    'middleware' => ['web', 'locale', 'theme', 'currency']
], function () {
    /**
     * Customer return request routes.
     */
    Route::prefix('rma/return-requests')->group(function () {
        /**
         * List customer return requests.
         */
        Route::get('', [ReturnRequestController::class, 'index'])
            ->name('shop.rma.return-requests.index');
    });
});