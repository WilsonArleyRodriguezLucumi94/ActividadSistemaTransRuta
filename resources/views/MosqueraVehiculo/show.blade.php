@extends('layouts.app')

@section('title', 'Detalle Vehículo ' . $vehiculo->placa . ' – TransRuta')

@section('content')
<div class="d-flex align-items-center gap-2 mb-4">
    <a href="{{ route('vehiculos.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i>Volver
    </a>
    <h2 class="fw-bold mb-0">
        <i class="bi bi-truck me-2 text-primary"></i>Detalle del Vehículo
    </h2>
</div>

<div class="row g-4">
    {{-- Tarjeta de información principal --}}
    <div class="col-md-6">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-primary text-white fw-semibold">
                <i class="bi bi-info-circle me-1"></i>Información General
            </div>
            <div class="card-body">
                <dl class="row mb-0">
                    <dt class="col-5 text-muted">Placa</dt>
                    <dd class="col-7 fw-semibold font-monospace fs-5">{{ $vehiculo->placa }}</dd>

                    <dt class="col-5 text-muted">Tipo</dt>
                    <dd class="col-7">{{ $vehiculo->tipo }}</dd>

                    <dt class="col-5 text-muted">Capacidad</dt>
                    <dd class="col-7">{{ $vehiculo->capacidad }} pasajeros</dd>

                    <dt class="col-5 text-muted">Estado</dt>
                    <dd class="col-7">
                        @php
                            $badgeClass = match(strtolower($vehiculo->estado)) {
                                'disponible'    => 'bg-success',
                                'mantenimiento' => 'bg-warning text-dark',
                                default         => 'bg-danger',
                            };
                        @endphp
                        <span class="badge {{ $badgeClass }} text-capitalize px-3 py-2">
                            {{ $vehiculo->estado }}
                        </span>
                    </dd>

                    <dt class="col-5 text-muted">Registrado</dt>
                    <dd class="col-7">{{ $vehiculo->created_at->format('d/m/Y H:i') }}</dd>
                </dl>
            </div>
        </div>
    </div>

    {{-- Tarjeta de viajes asociados --}}
    <div class="col-md-6">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-primary text-white fw-semibold">
                <i class="bi bi-map me-1"></i>Viajes Asociados
                <span class="badge bg-white text-primary ms-2">{{ $vehiculo->viajes->count() }}</span>
            </div>
            <div class="card-body p-0">
                @if($vehiculo->viajes->isEmpty())
                    <div class="text-center py-5 text-muted">
                        <i class="bi bi-calendar-x fs-2 d-block mb-1"></i>
                        Sin viajes registrados.
                    </div>
                @else
                    <ul class="list-group list-group-flush">
                        @foreach($vehiculo->viajes as $viaje)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>
                                    <i class="bi bi-calendar2-week me-1 text-primary"></i>
                                    {{ $viaje->fecha_salida ?? $viaje->fecha ?? 'Sin fecha' }}
                                </span>
                                <span class="text-muted small">ID #{{ $viaje->id }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
