@extends('layouts.app')

@section('header')
    <h1 class="text-2xl font-bold text-white">Detalles de Orden Médica</h1>
@endsection

@section('content')
<div class="container mx-auto p-4">
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4 flex items-center">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
        </div>
    @endif
    
    <!-- Información de la orden médica -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
        <div class="bg-green-600 px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <div class="flex-shrink-0 h-12 w-12 rounded-full bg-white flex items-center justify-center">
                        <i class="fas fa-file-medical text-green-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-xl font-bold text-white">Orden Médica #{{ $ordenesMedica->id }}</h2>
                        <p class="text-green-100">
                            <i class="fas fa-calendar-alt mr-1"></i> {{ \Carbon\Carbon::parse($ordenesMedica->Fecha_Resetada)->format('d/m/Y') }}
                            - <i class="fas fa-stethoscope mr-1"></i> {{ $ordenesMedica->especialidad->Valor1 ?? 'Sin especialidad' }}
                        </p>
                    </div>
                </div>
                <div>
                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full 
                          {{ $ordenesMedica->estado->Valor1 == 'Activo' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $ordenesMedica->estado->Valor1 }}
                    </span>
                </div>
            </div>
        </div>
        
        <!-- Barra de acciones -->
        <div class="bg-gray-100 border-b border-gray-200 px-6 py-3">
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('ordenes_medicas.edit', $ordenesMedica) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-3 rounded-md text-sm flex items-center transition-colors">
                    <i class="fas fa-edit mr-1"></i> Editar
                </a>
                <a href="{{ route('citas_medicas.create') }}?orden_id={{ $ordenesMedica->id }}" class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-3 rounded-md text-sm flex items-center transition-colors">
                    <i class="fas fa-calendar-plus mr-1"></i> Agendar Cita
                </a>
                <a href="{{ route('ordenes_medicas.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white py-1 px-3 rounded-md text-sm flex items-center transition-colors">
                    <i class="fas fa-arrow-left mr-1"></i> Volver
                </a>
            </div>
        </div>
        
        <!-- Detalles de la orden -->
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Columna izquierda -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 border-b border-gray-200 pb-2 mb-3">
                        <i class="fas fa-info-circle text-green-600 mr-2"></i> Información General
                    </h3>
                    
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Familiar:</p>
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-8 w-8 rounded-full bg-green-100 flex items-center justify-center">
                                    <i class="fas fa-user text-green-600"></i>
                                </div>
                                <p class="ml-2 text-gray-800 font-medium">
                                    {{ $ordenesMedica->familiar->nombre }} {{ $ordenesMedica->familiar->apellido }}
                                </p>
                            </div>
                        </div>
                        
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Especialidad:</p>
                            <p class="text-gray-800 font-medium">
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ $ordenesMedica->especialidad->Valor1 ?? 'Sin especialidad' }}
                                </span>
                            </p>
                        </div>
                        
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Procedimiento:</p>
                            <p class="text-gray-800">{{ $ordenesMedica->Procedimiento }}</p>
                        </div>
                        
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Médico que receta:</p>
                            <p class="text-gray-800">{{ $ordenesMedica->Medico_Reseta }}</p>
                        </div>
                        
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Centro Médico:</p>
                            <p class="text-gray-800">{{ $ordenesMedica->Centro_Medico }}, {{ $ordenesMedica->Ciudad }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Columna derecha -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 border-b border-gray-200 pb-2 mb-3">
                        <i class="fas fa-notes-medical text-green-600 mr-2"></i> Detalles Adicionales
                    </h3>
                    
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Pre-requisitos:</p>
                            <p class="text-gray-800 bg-gray-50 p-3 rounded-md">
                                {{ $ordenesMedica->Pre_requisitos ?? 'No se especificaron pre-requisitos' }}
                            </p>
                        </div>
                        
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Observaciones:</p>
                            <p class="text-gray-800 bg-gray-50 p-3 rounded-md">
                                {{ $ordenesMedica->Observaciones }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Citas médicas asociadas -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="bg-green-600 px-6 py-3">
            <h3 class="text-lg font-semibold text-white">
                <i class="fas fa-calendar-alt mr-2"></i> Citas Agendadas
            </h3>
        </div>
        
        @if($ordenesMedica->citasMedicas->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha y Hora</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($ordenesMedica->citasMedicas as $cita)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $cita->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center">
                                            <i class="fas fa-calendar-day text-blue-600"></i>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ \Carbon\Carbon::parse($cita->Fecha_Hora_Cita)->format('d/m/Y') }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                {{ \Carbon\Carbon::parse($cita->Fecha_Hora_Cita)->format('h:i A') }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('citas_medicas.edit', $cita->id) }}" class="text-yellow-600 hover:text-yellow-800 bg-yellow-100 hover:bg-yellow-200 p-2 rounded-full transition-colors">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('citas_medicas.destroy', $cita->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 bg-red-100 hover:bg-red-200 p-2 rounded-full transition-colors" 
                                                    onclick="return confirm('¿Está seguro de eliminar esta cita médica?')">
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
                    <i class="fas fa-calendar-times text-gray-300 text-5xl mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-500 mb-1">No hay citas agendadas</h3>
                    <p class="text-gray-400 mb-4">Aún no se han agendado citas para esta orden médica</p>
                    <a href="{{ route('citas_medicas.create') }}?orden_id={{ $ordenesMedica->id }}" 
                       class="bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded inline-flex items-center">
                        <i class="fas fa-calendar-plus mr-2"></i> Agendar Primera Cita
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection