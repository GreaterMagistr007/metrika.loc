<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CabinetController;

Route::any('/', function() {
    return view('welcome');
})->name('site.index');

require 'cabinet.php';

require __DIR__.'/auth.php';
