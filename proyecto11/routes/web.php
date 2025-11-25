<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StopwatchController;

Route::get('/', function () {
    return redirect()->route('stopwatch.index');
});

Route::get('/stopwatch', [StopwatchController::class, 'index'])->name('stopwatch.index');
Route::post('/stopwatch', [StopwatchController::class, 'store'])->name('stopwatch.store');
Route::delete('/stopwatch/{id}', [StopwatchController::class, 'destroy'])->name('stopwatch.destroy');