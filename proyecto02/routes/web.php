<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TipController;

Route::get('/', [TipController::class, 'index'])->name('tip.index');
Route::post('/calculate', [TipController::class, 'calculate'])->name('tip.calculate');
