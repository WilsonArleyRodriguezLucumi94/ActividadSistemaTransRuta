<?php

namespace Tests\Feature;

use App\Models\Destino;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DiazOrozcoDestinosTest extends TestCase
{
    use RefreshDatabase;

    public function test_consulta_todos_los_destinos(): void
    {
        Destino::create([
            'ciudad' => 'Cali',
            'descripcion' => 'Capital del Valle del Cauca',
        ]);

        Destino::create([
            'ciudad' => 'Popayán',
            'descripcion' => 'Capital del Cauca',
        ]);

        $this->get(route('diaz_orozco.destinos.consultar'))
            ->assertOk()
            ->assertSee('Cali')
            ->assertSee('Popayán');
    }

    public function test_busca_destinos_por_nombre_de_ciudad(): void
    {
        Destino::create([
            'ciudad' => 'Cali',
            'descripcion' => 'Capital del Valle del Cauca',
        ]);

        Destino::create([
            'ciudad' => 'Medellín',
            'descripcion' => 'Capital de Antioquia',
        ]);

        $this->get(route('diaz_orozco.destinos.consultar', ['buscar' => 'cali']))
            ->assertOk()
            ->assertSee('Cali')
            ->assertDontSee('Medellín');
    }
}
