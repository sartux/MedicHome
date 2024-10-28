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
                @foreach($historiales as $medicamento)
                    <tr>
                        <td>{{ $medicamento->medicamento ? $medicamento->medicamento->Nombre : 'No especificado' }}</td>
                        <td>{{ $medicamento->descripcion_tratamiento }}</td>
                        <td>{{ $medicamento->dosis }}</td>
                        <td>{{ $medicamento->fecha_inicio }}</td>
                        <td>{{ $medicamento->fecha_final }}</td>
                        <td>{{ $medicamento->estado ? $medicamento->estado->Valor1 : 'No especificado' }}</td>
                        <td>
                            <a href="{{ route('historial_medicamentos.edit', $medicamento->id) }}" class="btn btn-warning">
                                Editar
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
