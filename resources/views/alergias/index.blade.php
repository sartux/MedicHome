@extends('layouts.app')

@section('header')
    <h1 class="text-2xl font-bold text-white">Catálogo de Alergias</h1>
@endsection

@section('content')
<div class="container mx-auto p-4">
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4 flex items-center">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4 flex items-center">
            <i class="fas fa-exclamation-circle mr-2"></i> {{ session('error') }}
        </div>
    @endif
    
    <!-- Tarjeta de acciones -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">
                <i class="fas fa-allergies text-green-600 mr-2"></i>Alergias Catalogadas
            </h2>
            <a href="{{ route('alergias.create') }}" class="bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-md flex items-center transition duration-150">
                <i class="fas fa-plus-circle mr-2"></i> Agregar Alergia
            </a>
        </div>
    </div>
    
    <!-- Tabla de alergias -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr class="bg-green-600">
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Nombre</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Descripción</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Estado</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($alergias as $alergia)
                        <tr class="hover:bg-green-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $alergia->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">{{ $alergia->nombre }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $alergia->descripcion ?? 'Sin descripción' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($alergia->estado && $alergia->estado->Valor1 == 'Activo')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1"></i> Activo
                                    </span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        <i class="fas fa-times-circle mr-1"></i> Inactivo
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('alergias.edit', $alergia) }}" class="text-yellow-600 hover:text-yellow-800 bg-yellow-100 hover:bg-yellow-200 p-2 rounded-full transition-colors">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('alergias.destroy', $alergia) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 bg-red-100 hover:bg-red-200 p-2 rounded-full transition-colors" 
                                                onclick="return confirm('¿Está seguro de eliminar esta alergia?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection