@extends('layouts.app')

@section('header')
    <h1 class="text-2xl font-bold">Familiares</h1>
@endsection

@section('content')
<div class="container mx-auto p-4">
    <a href="{{ route('familiares.create') }}" class="btn btn-primary mb-4">Agregar Familiar</a>
    <div class="overflow-hidden bg-white shadow sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Apellido</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha de Nacimiento</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Correo</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Teléfono</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($familiares as $familiar)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $familiar->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $familiar->nombre }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $familiar->apellido }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $familiar->fecha_nacimiento }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $familiar->correo }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $familiar->telefono }}</td>
                        <td>{{ $familiar->estado ? $familiar->estado->Valor1 : 'No especificado' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ route('familiares.edit', $familiar) }}" class="btn btn-warning">
                                <i class="fa-solid fa-wand-magic-sparkles"></i> Editar<!-- Icono de lápiz -->
                            </a>
                            <a href="{{ route('familiares.edit', $familiar) }}" class="btn btn-info">
                                <i class="fa-solid fa-capsules"></i> Medicamentos<!-- Icono de capsulas -->
                            </a>
                            <a href="{{ route('familiares.edit', $familiar) }}" class="btn btn-success">
                                <i class="fa-solid fa-stethoscope"></i> Citas<!-- Icono de capsulas -->
                            </a>
                        </td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
