<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MosqueraJohanVehiculosController;

Route::get('/', function () {
    return view('welcome');
});

// ---- Vehículos ----
Route::get('/vehiculos',              [MosqueraJohanVehiculosController::class, 'index'])->name('vehiculos.index');
Route::get('/vehiculos/buscar',       [MosqueraJohanVehiculosController::class, 'buscar'])->name('vehiculos.buscar');
Route::get('/vehiculos/{vehiculo}',   [MosqueraJohanVehiculosController::class, 'show'])->name('vehiculos.show');
