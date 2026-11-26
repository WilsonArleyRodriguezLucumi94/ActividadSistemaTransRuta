<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use Illuminate\Http\Request;

class MosqueraJohanVehiculosController extends Controller
{
    /**
     * Muestra el formulario de búsqueda y lista todos los vehículos.
     */
    public function index()
    {
        $vehiculos = Vehiculo::orderBy('placa')->get();

        return view('MosqueraVehiculo.index', compact('vehiculos'));
    }

    /**
     * Busca vehículos por número de placa (búsqueda parcial, insensible a mayúsculas).
     */
    public function buscar(Request $request)
    {
        $request->validate([
            'placa' => 'required|string|min:1|max:20',
        ], [
            'placa.required' => 'Debe ingresar una placa para buscar.',
            'placa.min'      => 'La placa debe tener al menos 1 carácter.',
            'placa.max'      => 'La placa no puede exceder 20 caracteres.',
        ]);

        $placa = $request->input('placa');

        $vehiculos = Vehiculo::where('placa', 'LIKE', '%' . $placa . '%')
            ->orderBy('placa')
            ->get();

        return view('MosqueraVehiculo.index', compact('vehiculos', 'placa'));
    }

    /**
     * Muestra el detalle de un vehículo específico.
     */
    public function show(Vehiculo $vehiculo)
    {
        return view('MosqueraVehiculo.show', compact('vehiculo'));
    }
}
