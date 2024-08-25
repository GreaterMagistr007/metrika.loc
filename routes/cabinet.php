<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CabinetController;

Route::middleware('auth')->group(function () {
    Route::get('/cabinet', [CabinetController::class, 'getIndexPage'])
        ->name('cabinet.getIndexPage');
});
