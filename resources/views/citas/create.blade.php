@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Asignar Cita para la Orden ID: {{ $orden->id }}</h2>

    <form action="{{ route('citas.store') }}" method="POST">
        @csrf
        <input type="hidden" name="orden_medica_id" value="{{ $orden->id }}">
        
        <div class="mb-3">
            <label for="fecha_hora" class="form-label">Fecha y Hora</label>
            <input type="datetime-local" name="fecha_hora" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label for="observaciones" class="form-label">Observaciones</label>
            <textarea name="observaciones" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Asignar Cita</button>
    </form>
</div>
@endsection
