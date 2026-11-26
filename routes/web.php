<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MosqueraJhojanVehiculosController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/mosquera_casso/vehiculos', [MosqueraJhojanVehiculosController::class, 'MosqueraJhojanConsultarVehiculos'])
    ->name('mosqueracasso.vehiculos.consultar');