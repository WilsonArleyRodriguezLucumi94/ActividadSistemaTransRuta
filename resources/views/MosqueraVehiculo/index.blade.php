<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehículos Registrados</title>
    @vite(['resources/css/estilos.css'])
</head>
<body>
    <div class="contenedor">
        <div class="encabezado-vista">
            <h1>Vehículos Registrados</h1>
            <span class="total-registros">{{ $vehiculos->count() }} registros</span>
        </div>

        <table class="tabla-vehiculos">
            <thead>
                <tr>
                    <th>Placa</th>
                    <th>Tipo</th>
                    <th>Capacidad</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($vehiculos as $vehiculo)
                    <tr>
                        <td class="placa">{{ $vehiculo->placa }}</td>
                        <td>{{ $vehiculo->tipo }}</td>
                        <td>{{ $vehiculo->capacidad }} pasajeros</td>
                        <td>
                            <span class="badge {{ $vehiculo->estado === 'disponible' ? 'badge-disponible' : 'badge-mantenimiento' }}">
                                {{ $vehiculo->estado }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="sin-datos">No hay vehículos registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>