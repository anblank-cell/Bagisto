<?php

use Illuminate\Support\Facades\Route;
use Webkul\RMA\Http\Controllers\Admin\ReturnRequestController;

Route::group([
    'middleware' => ['web', 'admin'],
    'prefix'     => config('app.admin_url'),
], function () {
    Route::prefix('rma/return-requests')->group(function () {
        Route::get('', [ReturnRequestController::class, 'index'])
            ->name('admin.rma.return-requests.index');

        Route::get('{id}', [ReturnRequestController::class, 'show'])
            ->name('admin.rma.return-requests.show');

        Route::delete('{id}', [ReturnRequestController::class, 'destroy'])
            ->name('admin.rma.return-requests.delete');

        Route::post('mass-delete', [ReturnRequestController::class, 'massDestroy'])
            ->name('admin.rma.return-requests.mass-delete');
    });
});
