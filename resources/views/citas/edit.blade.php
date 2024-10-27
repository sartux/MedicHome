@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Cita Médica</h1>
    <form action="{{ route('citas.update', $cita) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="Fecha_Cita" class="form-label">Fecha</label>
            <input type="date" class="form-control" name="Fecha_Cita" value="{{ $cita->Fecha_Cita }}" required>
        </div>

        <div class="mb-3">
            <label for="Hora_Cita" class="form-label">Hora</label>
            <input type="time" class="form-control" name="Hora_Cita" value="{{ $cita->Hora_Cita }}" required>
        </div>

        <div class="mb-3">
            <label for="Lugar" class="form-label">Lugar</label>
            <input type="text" class="form-control" name="Lugar" value="{{ $cita->Lugar }}" required>
        </div>

        <div class="mb-3">
            <label for="Observaciones" class="form-label">Observaciones</label>
            <input type="text" class="form-control" name="Observaciones" value="{{ $cita->Observaciones }}">
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Cita Médica</button>
    </form>
</div>
@endsection
