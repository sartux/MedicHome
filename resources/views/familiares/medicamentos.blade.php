@extends('layouts.app')

@section('header')
    <h1 class="text-2xl font-bold text-white">Historial de Medicamentos</h1>
@endsection

@section('content')
<div class="container mx-auto p-4">
    <!-- Encabezado con información del familiar -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
        <div class="bg-green-600 px-6 py-4">
            <div class="flex items-center">
                <div class="flex-shrink-0 h-12 w-12 rounded-full bg-white flex items-center justify-center">
                    <i class="fas fa-user text-green-600 text-2xl"></i>
                </div>
                <div class="ml-4">
                    <h2 class="text-xl font-bold text-white">{{ $familiar->nombre }} {{ $familiar->apellido }}</h2>
                    <p class="text-green-100">
                        <i class="fas fa-birthday-cake mr-1"></i> {{ \Carbon\Carbon::parse($familiar->fecha_nacimiento)->age }} años
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Acciones -->
    <div class="bg-white p-4 rounded-lg shadow-md mb-6">
        <div class="flex flex-wrap justify-between items-center">
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">
                    <i class="fas fa-pills text-green-600 mr-2"></i>Medicamentos Asignados
                </h3>
                <p class="text-gray-600">Administre los medicamentos y tratamientos de {{ $familiar->nombre }}</p>
            </div>
            <div class="mt-3 md:mt-0">
                <a href="{{ route('historial_medicamentos.create') }}?familiar_id={{ $familiar->id }}" 
                   class="bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded inline-flex items-center">
                    <i class="fas fa-plus-circle mr-2"></i> Agregar Medicamento
                </a>
                <a href="{{ route('familiares.show', $familiar) }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded inline-flex items-center ml-2">
                    <i class="fas fa-arrow-left mr-2"></i> Volver al Perfil
                </a>
            </div>
        </div>
    </div>

    <!-- Filtro de estado -->
    <div class="bg-white p-4 rounded-lg shadow-md mb-6">
        <div class="flex items-center">
            <h4 class="text-gray-700 font-medium mr-4">Filtrar por estado:</h4>
            <div class="flex space-x-2">
                <a href="?estado=todos" class="px-4 py-2 rounded {{ !request('estado') || request('estado') == 'todos' ? 'bg-green-600 text-white' : 'bg-gray-200 text-gray-800' }}">
                    Todos
                </a>
                <a href="?estado=activos" class="px-4 py-2 rounded {{ request('estado') == 'activos' ? 'bg-green-600 text-white' : 'bg-gray-200 text-gray-800' }}">
                    Activos
                </a>
                <a href="?estado=inactivos" class="px-4 py-2 rounded {{ request('estado') == 'inactivos' ? 'bg-green-600 text-white' : 'bg-gray-200 text-gray-800' }}">
                    Inactivos
                </a>
            </div>
        </div>
    </div>

    <!-- Tabla de medicamentos -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        @if($historialMedicamentos->count() > 0)
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr class="bg-green-600">
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Medicamento</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Dosis</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Inicio</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Fin</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Estado</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($historialMedicamentos as $historial)
                        @php
                            $isActive = $historial->estado && $historial->estado->Valor1 == 'Activo';
                            $isCurrent = !$historial->fecha_final || \Carbon\Carbon::parse($historial->fecha_final)->isFuture();
                            $rowClass = $isActive && $isCurrent ? 'bg-white' : 'bg-gray-50';
                        @endphp
                        <tr class="hover:bg-green-50 {{ $rowClass }}">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                        <i class="fas fa-capsules text-blue-600"></i>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $historial->medicamento->Nombre }}</div>
                                        <div class="text-xs text-gray-500">{{ $historial->medicamento->Composicion }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $historial->dosis }}</div>
                                <div class="text-xs text-gray-500">{{ Str::limit($historial->descripcion_tratamiento, 50) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($historial->fecha_inicio)->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @if($historial->fecha_final)
                                    {{ \Carbon\Carbon::parse($historial->fecha_final)->format('d/m/Y') }}
                                @else
                                    <span class="text-blue-600 font-medium">Tratamiento continuo</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($isActive && $isCurrent)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1"></i> Activo
                                    </span>
                                @elseif($isActive && !$isCurrent)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-clock mr-1"></i> Finalizado
                                    </span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        <i class="fas fa-times-circle mr-1"></i> Inactivo
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('historial_medicamentos.edit', $historial->id) }}" class="text-yellow-600 hover:text-yellow-800 bg-yellow-100 hover:bg-yellow-200 p-2 rounded-full transition-colors">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('historial_medicamentos.destroy', $historial->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 bg-red-100 hover:bg-red-200 p-2 rounded-full transition-colors" 
                                                onclick="return confirm('¿Está seguro de eliminar este historial de medicamento?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="text-center py-8">
                <div class="flex flex-col items-center justify-center">
                    <i class="fas fa-pills text-gray-300 text-5xl mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-500 mb-1">No hay medicamentos registrados</h3>
                    <p class="text-gray-400 mb-4">Este familiar no tiene medicamentos asignados actualmente</p>
                    <a href="{{ route('historial_medicamentos.create') }}?familiar_id={{ $familiar->id }}" 
                       class="bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded inline-flex items-center">
                        <i class="fas fa-plus-circle mr-2"></i> Agregar Primer Medicamento
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection