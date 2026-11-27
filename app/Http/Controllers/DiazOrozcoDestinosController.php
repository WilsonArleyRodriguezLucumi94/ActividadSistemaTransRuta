<?php

namespace App\Http\Controllers;

use App\Models\Destino;
use Illuminate\Http\Request;

class DiazOrozcoDestinosController extends Controller
{
    public function diazOrozcoConsultarDestinos(Request $request)
    {
        $datos = $request->validate([
            'buscar' => ['nullable', 'string', 'max:100'],
        ]);

        $busqueda = trim((string) ($datos['buscar'] ?? ''));

        $destinos = Destino::query()
            ->when($busqueda !== '', function ($consulta) use ($busqueda) {
                $consulta->whereRaw(
                    'LOWER(ciudad) LIKE ?',
                    ['%'.mb_strtolower($busqueda).'%']
                );
            })
            ->orderBy('ciudad')
            ->get();

        return view('diaz_orozco.destinos.index', [
            'destinos' => $destinos,
            'busqueda' => $busqueda,
        ]);
    }
}
