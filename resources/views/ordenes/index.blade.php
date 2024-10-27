@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Órdenes Médicas</h1>
    <a href="{{ route('ordenes.create') }}" class="btn btn-primary">Agregar Orden Médica</a>

    <table class="table">
        <thead>
            <tr>
                <th>Familiar</th>
                <th>Especialidad</th>
                <th>Procedimiento</th>
                <th>Fecha Resetada</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ordenes as $orden)
                <tr>
                    <td>{{ $orden->familiar->nombre }} {{ $orden->familiar->apellido }}</td>
                    <td>{{ $orden->especialidad->Valor1 }}</td>
                    <td>{{ $orden->Procedimiento }}</td>
                    <td>{{ $orden->Fecha_Resetada }}</td>
                    <td>
                        <a href="{{ route('ordenes.edit', $orden) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('ordenes.destroy', $orden) }}" method="POST" style="display:inline;">
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
