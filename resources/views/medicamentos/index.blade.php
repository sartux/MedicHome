<!-- resources/views/medicamentos/index.blade.php -->

@extends('layouts.app') <!-- Asegúrate de tener una plantilla de diseño -->

@section('content')
<div class="container">
    <h1>Medicamentos</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('medicamentos.create') }}" class="btn btn-primary">Agregar Medicamento</a>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Composición</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($medicamentos as $medicamento)
                <tr>
                    <td>{{ $medicamento->id }}</td>
                    <td>{{ $medicamento->Nombre }}</td>
                    <td>{{ $medicamento->Composicion }}</td>
                    <td>{{ $medicamento->CATA_Estado }}</td>
                    <td>
                        <a href="{{ route('medicamentos.edit', $medicamento->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('medicamentos.destroy', $medicamento->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
