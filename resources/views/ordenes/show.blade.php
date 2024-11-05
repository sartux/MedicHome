@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('ordenes.create') }}" class="btn btn-primary">Agregar Orden médica</a> 
    <a href="{{ route('familiares.index') }}" class="btn btn-primary">Volver a Familiares</a> 
    <h1>Órdenes médicas pendientes de cita</h1><br>

    @if($familiar)
        <h5 class="card-title">Familiar: {{ $familiar->nombre }}</h5>
        @foreach($ordenes as $orden)
        <div class="card mb-3">
            <div class="card-body">
                <p class="card-text"><strong>Especialidad:</strong> {{ $orden->especialidad->Valor1 ?? 'Sin especialidad' }}</p>
                <p class="card-text">Procedimiento: {{ $orden->Procedimiento }}</p>
                <p class="card-text">Fecha Resetada: {{ $orden->Fecha_Resetada }}</p>
                <p class="card-text">Centro Médico: {{ $orden->Centro_Medico }}</p>
                <p class="card-text">Médico que Reseta: {{ $orden->Medico_Reseta }}</p>
                <p class="card-text">Ciudad: {{ $orden->Ciudad }}</p>
                <p class="card-text">Observaciones: {{ $orden->Observaciones }}</p>
                <p class="card-text">Pre-Requisitos: {{ $orden->Pre_requisitos }}</p>
                <p class="card-text"><strong>Estado:</strong> {{ $orden->estado->Valor1 ?? 'Sin estado' }}</p>
                <br>
                {{-- <a href="#" class="btn btn-primary">Asignar Cita</a> --}}
                <a href="{{ route('ordenes.citas.create', $orden->id) }}" class="btn btn-primary">Asignar Cita</a>
            </div>
        </div>
        @endforeach
    @else
        <p>No hay órdenes médicas pendientes de cita para mostrar.</p>
    @endif
</div>
@endsection
