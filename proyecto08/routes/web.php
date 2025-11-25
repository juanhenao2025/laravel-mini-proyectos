<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;

Route::get('/', function () {
    return redirect()->route('recipes.index');
});

Route::get('/recipes', [RecipeController::class, 'index'])->name('recipes.index');
Route::post('/recipes', [RecipeController::class, 'store'])->name('recipes.store');
Route::delete('/recipes/{id}', [RecipeController::class, 'destroy'])->name('recipes.destroy');