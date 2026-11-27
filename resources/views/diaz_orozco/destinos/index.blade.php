<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destinos - Díaz Orozco</title>
</head>
<body>
    <main>
        <h1>Consulta de destinos</h1>

        <form method="GET" action="{{ route('diaz_orozco.destinos.consultar') }}">
            <label for="buscar">Buscar por ciudad</label>
            <input
                id="buscar"
                name="buscar"
                type="search"
                value="{{ $busqueda }}"
                maxlength="100"
            >
            <button type="submit">Buscar</button>
        </form>

        @if ($errors->any())
            <div role="alert">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        @if ($destinos->isEmpty())
            <p>No se encontraron destinos registrados.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Ciudad</th>
                        <th>Descripción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($destinos as $destino)
                        <tr>
                            <td>{{ $destino->ciudad }}</td>
                            <td>{{ $destino->descripcion ?? 'Sin descripción' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </main>
</body>
</html>
