@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('historial_medicamentos.create') }}" class="btn btn-primary mb-4">Agregar Medicamento</a>
    <h1>Detalles del Historial de Medicamento</h1>

    @foreach($historialMedicamentos as $historialMedicamento)
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Familiar: {{ $familiar->nombre }}</h5>
            <p class="card-text"><strong>Medicamento:</strong> {{ $historialMedicamento->medicamento->nombre }}</p>
            <p class="card-text"><strong>Descripción del Tratamiento:</strong> {{ $historialMedicamento->descripcion_tratamiento }}</p>
            <p class="card-text"><strong>Dosis:</strong> {{ $historialMedicamento->dosis }}</p>
            <p class="card-text"><strong>Fecha de Inicio:</strong> {{ $historialMedicamento->fecha_inicio }}</p>
            <p class="card-text"><strong>Fecha Final:</strong> {{ $historialMedicamento->fecha_final }}</p>
            <p class="card-text"><strong>Estado:</strong> {{ $historialMedicamento->estado->nombre ?? 'Sin estado' }}</p>
        </div>
    </div>
    @endforeach

    <a href="{{ route('familiares.index') }}" class="btn btn-primary">Volver Familiares</a>
</div>
@endsection
