<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'admin'], 'prefix' => config('app.admin_url')], function () {
    /**
     * Return request routes.
     */
    Route::prefix('rma/return-requests')->group(function () {
        /**
         * First route. 
         */
        Route::get('', function () {
            return 'Admin RMA Return Requests List';
        })->name('admin.rma.return-requests.index');
    });
});