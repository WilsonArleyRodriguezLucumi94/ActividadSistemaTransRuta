<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;


class MosqueraJhojanVehiculosController extends Controller
{
    public function MosqueraJhojanConsultarVehiculos()
    {
        $vehiculos = Vehiculo::orderBy('id')->get();

        return view('MosqueraVehiculo.index', compact('vehiculos'));
    }
}