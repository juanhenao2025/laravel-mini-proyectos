<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasswordController;

Route::get('/', function () {
    return redirect()->route('passwords.index');
});

Route::get('/passwords', [PasswordController::class, 'index'])->name('passwords.index');
Route::post('/passwords', [PasswordController::class, 'store'])->name('passwords.store');