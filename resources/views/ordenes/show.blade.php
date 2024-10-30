@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('ordenes.create') }}" class="btn btn-primary mb-4">Agregar Orden medica</a>
    <h1>Detalles del Historial de ordenes medicas</h1>

    @foreach($ordenes as $orden)
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Familiar: {{ $familiar->nombre }}</h5>
            {{-- <p class="card-text"><strong>Medicamento:</strong> {{ $orden->medicamento->nombre }}</p>
            <p class="card-text"><strong>Descripción del Tratamiento:</strong> {{ $orden->descripcion_tratamiento }}</p>
            <p class="card-text"><strong>Dosis:</strong> {{ $orden->dosis }}</p>
            <p class="card-text"><strong>Fecha de Inicio:</strong> {{ $orden->fecha_inicio }}</p>
            <p class="card-text"><strong>Fecha Final:</strong> {{ $orden->fecha_final }}</p>
            <p class="card-text"><strong>Estado:</strong> {{ $orden->estado->nombre ?? 'Sin estado' }}</p> --}}
        </div>
    </div>
    @endforeach

    <a href="{{ route('familiares.index') }}" class="btn btn-primary">Volver Familiares</a>
</div>
@endsection
