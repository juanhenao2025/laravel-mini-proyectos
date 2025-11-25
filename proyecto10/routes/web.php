<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SurveyController;

Route::get('/', function () {
    return redirect()->route('surveys.index');
});

Route::get('/surveys', [SurveyController::class, 'index'])->name('surveys.index');
Route::post('/surveys', [SurveyController::class, 'store'])->name('surveys.store');