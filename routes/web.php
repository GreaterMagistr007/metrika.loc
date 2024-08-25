<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CabinetController;

Route::any('/', function() {
    return view('welcome');
})->name('site.index');

Route::middleware('auth')->group(function () {
    Route::get('/cabinet', [CabinetController::class, 'getIndexPage'])->name('cabinet.getIndexPage');
});

require __DIR__.'/auth.php';
