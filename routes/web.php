<?php

use App\Http\Controllers\DiazOrozcoDestinosController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/diaz_orozco/destinos', [DiazOrozcoDestinosController::class, 'diazOrozcoConsultarDestinos'])
    ->name('diaz_orozco.destinos.consultar');
