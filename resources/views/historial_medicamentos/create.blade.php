@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Agregar Historial de Medicamento</h1>
    <form action="{{ route('historial_medicamentos.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="Familiar_id">Familiar</label>
            <select name="Familiar_id" class="form-control">
                @foreach ($familiares as $familiar)
                <option value="{{ $familiar->id }}">{{ $familiar->nombre }} {{ $familiar->apellido }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="medicamento_id">Medicamento</label>
            <select name="medicamento_id" class="form-control">
                @foreach ($medicamentos as $medicamento)
                <option value="{{ $medicamento->id }}">{{ $medicamento->Nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="descripcion_tratamiento">Descripción del Tratamiento</label>
            <input type="text" name="descripcion_tratamiento" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="dosis">Dosis</label>
            <input type="text" name="dosis" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="fecha_inicio">Fecha de Inicio</label>
            <input type="date" name="fecha_inicio" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="fecha_final">Fecha Final</label>
            <input type="date" name="fecha_final" class="form-control">
        </div>
        <div class="form-group">
            <label for="CATA_Estado">Estado</label>
            <select name="CATA_Estado" class="form-control">
                @foreach ($estados as $estado)
                <option value="{{ $estado->Codigo }}">{{ $estado->Valor1 }}</option>
                @endforeach
            </select>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection
