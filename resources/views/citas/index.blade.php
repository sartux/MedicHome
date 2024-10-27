@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Citas Médicas de la Orden: {{ $orden->id }}</h1>
    <a href="{{ route('citas.create', $orden) }}" class="btn btn-primary">Agregar Cita Médica</a>

    <table class="table">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Lugar</th>
                <th>Observaciones</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($citas as $cita)
                <tr>
                    <td>{{ $cita->Fecha_Cita }}</td>
                    <td>{{ $cita->Hora_Cita }}</td>
                    <td>{{ $cita->Lugar }}</td>
                    <td>{{ $cita->Observaciones }}</td>
                    <td>
                        <a href="{{ route('citas.edit', $cita) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('citas.destroy', $cita) }}" method="POST" style="display:inline;">
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
