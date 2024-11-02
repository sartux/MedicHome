@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('ordenes.create') }}" class="btn btn-primary mb-4">Agregar Orden médica</a>
    <h1>Detalles del Historial de órdenes médicas</h1>
    @foreach($ordenes as $orden)
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Familiar: {{ $familiar->nombre }}</h5>
            <!-- Otros detalles de la orden médica aquí -->
        </div>
    </div>
    @endforeach
    <a href="{{ route('familiares.index') }}" class="btn btn-primary">Volver a Familiares</a>
</div>
@endsection
