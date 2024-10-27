@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Historial de Medicamentos de {{ $familiar->nombre }} {{ $familiar->apellido }}</h1>
    
    <a href="{{ route('familiares.index') }}" class="btn btn-secondary mb-3">Volver a Familiares</a>
    <a href="{{ route('historial_medicamentos.create', $familiar->id) }}" class="btn btn-primary mb-3">Agregar Nuevo Historial</a>

    <div class="overflow-hidden bg-white shadow sm:rounded-lg">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Medicamento</th>
                    <th>Descripción del Tratamiento</th>
                    <th>Dosis</th>
                    <th>Fecha de Inicio</th>
                    <th>Fecha Final</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($historialMedicamentos as $medicamento)
                    <tr>
                        <td>{{ $medicamento->medicamento->nombre }}</td>
                        <td>{{ $medicamento->descripcion_tratamiento }}</td>
                        <td>{{ $medicamento->dosis }}</td>
                        <td>{{ $medicamento->fecha_inicio }}</td>
                        <td>{{ $medicamento->fecha_final }}</td>
                        <td>{{ $medicamento->estado->nombre ?? 'Sin estado' }}</td>
                        <td>
                            <a href="{{ route('historial_medicamentos.edit', $medicamento->id) }}" class="btn btn-warning">
                                Editar
                            </a>
                            <form action="{{ route('historial_medicamentos.destroy', $medicamento->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este historial?');">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
