@extends('layouts.app')

@section('header')
    <h1 class="text-2xl font-bold text-white">Órdenes Médicas</h1>
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
                <i class="fas fa-file-medical text-green-600 mr-2"></i>Listado de Órdenes Médicas
            </h2>
            <a href="{{ route('ordenes_medicas.create') }}" class="bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-md flex items-center transition duration-150">
                <i class="fas fa-plus-circle mr-2"></i> Nueva Orden Médica
            </a>
        </div>
    </div>
    
    <!-- Tabla de órdenes médicas -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        @if($ordenes->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr class="bg-green-600">
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Familiar</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Especialidad</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Fecha</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Médico</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Citas</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Estado</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($ordenes as $orden)
                            <tr class="hover:bg-green-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $orden->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                                            <i class="fas fa-user text-green-600"></i>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $orden->familiar->nombre }} {{ $orden->familiar->apellido }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        {{ $orden->especialidad->Valor1 ?? 'Sin especialidad' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($orden->Fecha_Resetada)->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $orden->Medico_Reseta }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                        {{ $orden->citasMedicas->count() }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($orden->estado && $orden->estado->Valor1 == 'Activo')
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
                                        <a href="{{ route('ordenes_medicas.show', $orden->id) }}" class="text-blue-600 hover:text-blue-800 bg-blue-100 hover:bg-blue-200 p-2 rounded-full transition-colors">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('ordenes_medicas.edit', $orden->id) }}" class="text-yellow-600 hover:text-yellow-800 bg-yellow-100 hover:bg-yellow-200 p-2 rounded-full transition-colors">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('ordenes_medicas.destroy', $orden->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 bg-red-100 hover:bg-red-200 p-2 rounded-full transition-colors" 
                                                    onclick="return confirm('¿Está seguro de eliminar esta orden médica?')">
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
        @else
            <div class="text-center py-8">
                <div class="flex flex-col items-center justify-center">
                    <i class="fas fa-file-medical text-gray-300 text-5xl mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-500 mb-1">No hay órdenes médicas registradas</h3>
                    <p class="text-gray-400 mb-4">Comience creando una nueva orden médica</p>
                    <a href="{{ route('ordenes_medicas.create') }}" 
                       class="bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded inline-flex items-center">
                        <i class="fas fa-plus-circle mr-2"></i> Nueva Orden Médica
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection