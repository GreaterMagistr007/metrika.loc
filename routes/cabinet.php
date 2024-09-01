<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CabinetController;

Route::middleware(\App\Http\Middleware\CabinetAuth::class)->group(function () {
    Route::get('/cabinet', [CabinetController::class, 'getIndexPage'])
        ->name('cabinet.getIndexPage');
});
