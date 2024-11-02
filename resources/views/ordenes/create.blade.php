@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Agregar Orden Médica</h1>
    <form action="{{ route('ordenes.store') }}" method="POST">
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
            <label for="CATA_Especialidad">Especialidad</label>
            <select name="CATA_Especialidad" class="form-control">
                @foreach ($especialidades as $especialidad)
                <option value="{{ $especialidad->Codigo }}">{{ $especialidad->Valor1 }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="Procedimiento">Procedimiento</label>
            <input type="text" name="Procedimiento" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="Fecha_Resetada">Fecha Resetada</label>
            <input type="date" name="Fecha_Resetada" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="Medico_Reseta">Médico que Reseta</label>
            <input type="text" name="Medico_Reseta" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="Centro_Medico">Centro Médico</label>
            <input type="text" name="Centro_Medico" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="Ciudad">Ciudad</label>
            <input type="text" name="Ciudad" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="Observaciones">Observaciones</label>
            <input type="text" name="Observaciones" class="form-control">
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
        <button type="submit" class="btn btn-primary">Agregar Orden Médica</button>
    </form>
</div>
@endsection
