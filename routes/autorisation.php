<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CabinetController;

Route::get('/register', [CabinetController::class, 'getRegisterPage'])
    ->name('cabinet.getRegisterPage');

Route::post('/register', [CabinetController::class, 'postRegisterPage'])
    ->name('cabinet.postRegisterPage');

Route::get('/login', [CabinetController::class, 'getLoginPage'])
    ->name('cabinet.getLoginPage');

Route::any('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');
