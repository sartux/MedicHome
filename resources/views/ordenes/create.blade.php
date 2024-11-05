@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Nueva Orden Médica</h1>
    <form action="{{ route('ordenes.store') }}" method="POST">
        @csrf

        <!-- Selección de Familiar -->
        <div class="form-group">
            <label for="Familiar_id">Familiar</label>
            <select name="Familiar_id" id="Familiar_id" class="form-control" required>
                <option value="">Seleccione un familiar</option>
                @foreach($familiares as $familiar)
                    <option value="{{ $familiar->id }}">{{ $familiar->nombre }}</option>
                @endforeach
            </select>
        </div>

        <!-- Selección de Especialidad -->
        <div class="form-group">
            <label for="CATA_Especialidad">Especialidad</label>
            <select name="CATA_Especialidad" id="CATA_Especialidad" class="form-control" required>
                <option value="">Seleccione una especialidad</option>
                @foreach($especialidades as $especialidad)
                    <option value="{{ $especialidad->Codigo }}">{{ $especialidad->Valor1 }}</option>
                @endforeach
            </select>
        </div>

        <!-- Procedimiento -->
        <div class="form-group">
            <label for="Procedimiento">Procedimiento</label>
            <input type="text" name="Procedimiento" id="Procedimiento" class="form-control" maxlength="300" required>
        </div>

        <!-- Fecha de Reseta -->
        <div class="form-group">
            <label for="Fecha_Resetada">Fecha Resetada</label>
            <input type="date" name="Fecha_Resetada" id="Fecha_Resetada" class="form-control" required>
        </div>

        <!-- Médico que Reseta -->
        <div class="form-group">
            <label for="Medico_Reseta">Médico que Reseta</label>
            <input type="text" name="Medico_Reseta" id="Medico_Reseta" class="form-control" maxlength="60" required>
        </div>

        <!-- Centro Médico -->
        <div class="form-group">
            <label for="Centro_Medico">Centro Médico</label>
            <input type="text" name="Centro_Medico" id="Centro_Medico" class="form-control" maxlength="60" required>
        </div>

        <!-- Ciudad -->
        <div class="form-group">
            <label for="Ciudad">Ciudad</label>
            <input type="text" name="Ciudad" id="Ciudad" class="form-control" maxlength="50" required>
        </div>

        <!-- Observaciones -->
        <div class="form-group">
            <label for="Observaciones">Observaciones</label>
            <textarea name="Observaciones" id="Observaciones" class="form-control" maxlength="400"></textarea>
        </div>

        <!-- Pre-Requisitos -->
        <div class="form-group">
            <label for="Pre_requisitos">Pre-Requisitos</label>
            <textarea name="Pre_requisitos" id="Pre_requisitos" class="form-control" maxlength="400"></textarea>
        </div>

        <!-- Selección de Estado -->
        <div class="form-group">
            <label for="CATA_Estado">Estado</label>
            <select name="CATA_Estado" id="CATA_Estado" class="form-control" required>
                <option value="">Seleccione un estado</option>
                @foreach($estados as $estado)
                    <option value="{{ $estado->Codigo }}">{{ $estado->Valor1 }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Crear Orden Médica</button>
    </form>
</div>
@endsection
