<!-- resources/views/medicamentos/create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Agregar Medicamento</h1>

    <form action="{{ route('medicamentos.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="Nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="Nombre" required>
        </div>
        <div class="mb-3">
            <label for="Composicion" class="form-label">Composición</label>
            <input type="text" class="form-control" name="Composicion" required>
        </div>
        <div class="mb-3">
            <label for="CATA_presentacion" class="form-label">Presentación</label>
            <input type="number" class="form-control" name="CATA_presentacion" required>
        </div>
        <div class="mb-3">
            <label for="CATA_Uso" class="form-label">Uso</label>
            <input type="number" class="form-control" name="CATA_Uso" required>
        </div>
        <div class="mb-3">
            <label for="Observaciones" class="form-label">Observaciones</label>
            <textarea class="form-control" name="Observaciones" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="CATA_Estado" class="form-label">Estado</label>
            <input type="number" class="form-control" name="CATA_Estado" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection
