<!-- resources/views/medicamentos/edit.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Medicamento</h1>

    <form action="{{ route('medicamentos.update', $medicamento->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="Nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="Nombre" value="{{ $medicamento->Nombre }}" required>
        </div>
        <div class="mb-3">
            <label for="Composicion" class="form-label">Composición</label>
            <input type="text" class="form-control" name="Composicion" value="{{ $medicamento->Composicion }}" required>
        </div>
        <div class="mb-3">
            <label for="CATA_presentacion" class="form-label">Presentación</label>
            <input type="number" class="form-control" name="CATA_presentacion" value="{{ $medicamento->CATA_presentacion }}" required>
        </div>
        <div class="mb-3">
            <label for="CATA_Uso" class="form-label">Uso</label>
            <input type="number" class="form-control" name="CATA_Uso" value="{{ $medicamento->CATA_Uso }}" required>
        </div>
        <div class="mb-3">
            <label for="Observaciones" class="form-label">Observaciones</label>
            <textarea class="form-control" name="Observaciones" rows="3">{{ $medicamento->Observaciones }}</textarea>
        </div>
        <div class="mb-3">
            <label for="CATA_Estado" class="form-label">Estado</label>
            <input type="number" class="form-control" name="CATA_Estado" value="{{ $medicamento->CATA_Estado }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
