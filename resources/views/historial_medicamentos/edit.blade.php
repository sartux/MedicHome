@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Historial de Medicamento</h1>
        <form action="{{ route('historial_medicamentos.update', $historialMedicamento->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="Familiar_id">Familiar</label>
            <select name="Familiar_id" class="form-control">
                @foreach ($familiares as $familiar)
                <option value="{{ $familiar->id }}" {{ $historialMedicamento->Familiar_id == $familiar->id ? 'selected' : '' }}>
                    {{ $familiar->nombre }} {{ $familiar->apellido }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="medicamento_id">Medicamento</label>
            <select name="medicamento_id" class="form-control">
                @foreach ($medicamentos as $medicamento)
                <option value="{{ $medicamento->id }}" {{ $historialMedicamento->medicamento_id == $medicamento->id ? 'selected' : '' }}>
                    {{ $medicamento->Nombre }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="descripcion_tratamiento">Descripción del Tratamiento</label>
            <input type="text" name="descripcion_tratamiento" class="form-control" value="{{ $historialMedicamento->descripcion_tratamiento }}" required>
        </div>
        <div class="form-group">
            <label for="dosis">Dosis</label>
            <input type="text" name="dosis" class="form-control" value="{{ $historialMedicamento->dosis }}" required>
        </div>
        <div class="form-group">
            <label for="fecha_inicio">Fecha de Inicio</label>
            <input type="date" name="fecha_inicio" class="form-control" value="{{ $historialMedicamento->fecha_inicio }}" required>
        </div>
        <div class="form-group">
            <label for="fecha_final">Fecha Final</label>
            <input type="date" name="fecha_final" class="form-control" value="{{ $historialMedicamento->fecha_final }}">
        </div>
        <div class="form-group">
            <label for="CATA_Estado">Estado</label>
            <select name="CATA_Estado" class="form-control">
                @foreach ($estados as $estado)
                <option value="{{ $estado->Codigo }}" {{ $historialMedicamento->CATA_Estado == $estado->Codigo ? 'selected' : '' }}>
                    {{ $estado->Valor1 }}
                </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
