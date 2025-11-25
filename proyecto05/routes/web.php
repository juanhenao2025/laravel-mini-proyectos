<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Aquí definimos las rutas principales de la aplicación.
| Usamos arquitectura MVC: las rutas llaman al controlador,
| el controlador maneja la lógica y devuelve la vista.
|
*/

// Ruta raíz: redirige al listado de reservas
Route::get('/', function () {
    return redirect()->route('reservations.index');
});

// Mostrar todas las reservas
Route::get('/reservations', [ReservationController::class, 'index'])
    ->name('reservations.index');

// Guardar una nueva reserva
Route::post('/reservations', [ReservationController::class, 'store'])
    ->name('reservations.store');

// Confirmar una reserva existente
Route::post('/reservations/{id}/confirm', [ReservationController::class, 'confirm'])
    ->name('reservations.confirm');