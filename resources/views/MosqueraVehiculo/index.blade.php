@extends('layouts.app')

@section('title', 'Vehículos – TransRuta')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="fw-bold mb-0">
        <i class="bi bi-truck me-2 text-primary"></i>Vehículos
    </h2>
</div>

{{-- ===================== FORMULARIO DE BÚSQUEDA ===================== --}}
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <form action="{{ route('vehiculos.buscar') }}" method="GET" class="row g-2 align-items-end">
            <div class="col-12 col-md-8">
                <label for="placa" class="form-label fw-semibold">
                    <i class="bi bi-search me-1"></i>Buscar por número de placa
                </label>
                <input
                    type="text"
                    id="placa"
                    name="placa"
                    class="form-control @error('placa') is-invalid @enderror"
                    placeholder="Ej. ABC123"
                    value="{{ old('placa', $placa ?? '') }}"
                    autofocus
                >
                @error('placa')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-6 col-md-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-search me-1"></i>Buscar
                </button>
            </div>
            <div class="col-6 col-md-2">
                <a href="{{ route('vehiculos.index') }}" class="btn btn-outline-secondary w-100">
                    <i class="bi bi-x-circle me-1"></i>Limpiar
                </a>
            </div>
        </form>
    </div>
</div>

{{-- ===================== RESULTADOS ===================== --}}
@if(isset($placa))
    <div class="alert alert-info d-flex align-items-center gap-2 mb-3">
        <i class="bi bi-info-circle-fill fs-5"></i>
        <span>
            Resultados para la placa <strong>{{ $placa }}</strong>:
            <strong>{{ $vehiculos->count() }}</strong>
            {{ $vehiculos->count() === 1 ? 'vehículo encontrado' : 'vehículos encontrados' }}.
        </span>
    </div>
@endif

@if($vehiculos->isEmpty())
    <div class="card shadow-sm">
        <div class="card-body text-center py-5 text-muted">
            <i class="bi bi-exclamation-circle fs-1 d-block mb-2"></i>
            <p class="mb-0">
                @if(isset($placa))
                    No se encontró ningún vehículo con la placa <strong>{{ $placa }}</strong>.
                @else
                    No hay vehículos registrados.
                @endif
            </p>
        </div>
    </div>
@else
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><i class="bi bi-card-text me-1"></i>Placa</th>
                            <th><i class="bi bi-bus-front me-1"></i>Tipo</th>
                            <th><i class="bi bi-people me-1"></i>Capacidad</th>
                            <th><i class="bi bi-circle-fill me-1"></i>Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vehiculos as $index => $v)
                            <tr>
                                <td class="text-muted">{{ $index + 1 }}</td>
                                <td class="fw-semibold font-monospace">{{ $v->placa }}</td>
                                <td>{{ $v->tipo }}</td>
                                <td>{{ $v->capacidad }} pasajeros</td>
                                <td>
                                    @php
                                        $badgeClass = match(strtolower($v->estado)) {
                                            'disponible'    => 'bg-success',
                                            'mantenimiento' => 'bg-warning text-dark',
                                            default         => 'bg-danger',
                                        };
                                    @endphp
                                    <span class="badge {{ $badgeClass }} text-capitalize">
                                        {{ $v->estado }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('vehiculos.show', $v) }}"
                                       class="btn btn-sm btn-outline-primary"
                                       title="Ver detalle">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-muted small text-end">
            Total: {{ $vehiculos->count() }} vehículo(s)
        </div>
    </div>
@endif
@endsection
