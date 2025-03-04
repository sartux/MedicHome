@extends('layouts.app')

@section('header')
    <h1 class="text-2xl font-bold">Enfermedades Base</h1>
@endsection

@section('content')
<div class="container mx-auto p-4">
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
            {{ session('error') }}
        </div>
    @endif
    
    <div class="mb-4">
        <a href="{{ route('enfermedades.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded">Agregar Enfermedad</a>
    </div>
    
    <div class="overflow-hidden bg-white shadow sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descripción</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($enfermedades as $enfermedad)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $enfermedad->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $enfermedad->nombre }}</td>
                        <td class="px-6 py-4">{{ $enfermedad->descripcion ?? 'Sin descripción' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $enfermedad->estado->Valor1 ?? 'No especificado' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap flex space-x-2">
                            <a href="{{ route('enfermedades.edit', $enfermedad) }}" class="bg-yellow-500 text-white py-1 px-3 rounded">
                                Editar
                            </a>
                            <form action="{{ route('enfermedades.destroy', $enfermedad) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white py-1 px-3 rounded" 
                                        onclick="return confirm('¿Está seguro de eliminar esta enfermedad?')">
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