@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Agregar Orden Médica</h1>
    <form action="{{ route('ordenes.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="Familiar_id" class="form-label">Familiar</label>
            <select class="form-select" name="Familiar_id" required>
                @foreach ($familiares as $familiar)
                    <option value="{{ $familiar->id }}">{{ $familiar->nombre }} {{ $familiar->apellido }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="CATA_Especialidad" class="form-label">Especialidad</label>
            <select class="form-select" name="CATA_Especialidad" required>
                @foreach ($especialidades as $especialidad)
                    <option value="{{ $especialidad->Codigo }}">{{ $especialidad->Valor1 }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="Procedimiento" class="form-label">Procedimiento</label>
            <input type="text" class="form-control" name="Procedimiento" required>
        </div>

        <div class="mb-3">
            <label for="Fecha_Resetada" class="form-label">Fecha Resetada</label>
            <input type="date" class="form-control" name="Fecha_Resetada" required>
        </div>

        <div class="mb-3">
            <label for="Medico_Reseta" class="form-label">Médico que Reseta</label>
            <input type="text" class="form-control" name="Medico_Reseta" required>
        </div>

        <div class="mb-3">
            <label for="Centro_Medico" class="form-label">Centro Médico</label>
            <input type="text" class="form-control" name="Centro_Medico" required>
        </div>

        <div class="mb-3">
            <label for="Ciudad" class="form-label">Ciudad</label>
            <input type="text" class="form-control" name="Ciudad" required>
        </div>

        <div class="mb-3">
            <label for="Observaciones" class="form-label">Observaciones</label>
            <input type="text" class="form-control" name="Observaciones">
        </div>

        <div class="mb-3">
            <label for="CATA_Estado" class="form-label">Estado</label>
            <select class="form-select" name="CATA_Estado" required>
                @foreach ($estados as $estado)
                    <option value="{{ $estado->Codigo }}">{{ $estado->Valor1 }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Agregar Orden Médica</button>
    </form>
</div>
@endsection
