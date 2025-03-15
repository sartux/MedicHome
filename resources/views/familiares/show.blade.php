@extends('layouts.app')
@php
    // Depuración temporal
    dump($familiar->toArray());
    dump($familiar->enfermedades->toArray());
    dump($familiar->alergias->toArray());
@endphp
@section('header')
    <h1 class="text-2xl font-bold text-white">Perfil del Familiar</h1>
@endsection

@section('content')
<div class="container mx-auto p-4">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <!-- Cabecera de perfil -->
        <div class="bg-green-600 px-6 py-4 flex items-center">
            <div class="flex-shrink-0 h-20 w-20 rounded-full bg-white flex items-center justify-center border-4 border-white">
                <i class="fas fa-user-circle text-green-600 text-4xl"></i>
            </div>
            <div class="ml-6">
                <h2 class="text-2xl font-bold text-white">{{ $familiar->nombre }} {{ $familiar->apellido }}</h2>
                <p class="text-green-100">
                    <i class="fas fa-birthday-cake mr-2"></i> {{ \Carbon\Carbon::parse($familiar->fecha_nacimiento)->format('d/m/Y') }} 
                    ({{ $familiar->edad }} años)
                </p>
            </div>
        </div>
        
        <!-- Acciones rápidas -->
        <div class="bg-gray-100 border-b border-gray-200 px-6 py-3">
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('familiares.edit', $familiar) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-3 rounded-md text-sm flex items-center transition-colors">
                    <i class="fas fa-edit mr-1"></i> Editar
                </a>
                <a href="{{ route('familiares.medicamentos', $familiar) }}" class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-3 rounded-md text-sm flex items-center transition-colors">
                    <i class="fas fa-pills mr-1"></i> Historial de Medicamentos
                </a>
                <a href="{{ route('ordenes_medicas.indexByFamiliar', $familiar) }}" class="bg-purple-500 hover:bg-purple-600 text-white py-1 px-3 rounded-md text-sm flex items-center transition-colors">
                    <i class="fas fa-file-medical mr-1"></i> Historial de Órdenes
                </a>
                <a href="{{ route('familiares.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white py-1 px-3 rounded-md text-sm flex items-center transition-colors">
                    <i class="fas fa-arrow-left mr-1"></i> Volver
                </a>
            </div>
        </div>
        
        <!-- Contenido principal -->
        <div class="p-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Columna izquierda: Información personal -->
                <div>
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 border-b border-gray-200 pb-2 mb-3 flex items-center">
                            <i class="fas fa-info-circle text-green-600 mr-2"></i> Información Personal
                        </h3>
                        
                        <div class="space-y-3">
                            <div class="flex items-start">
                                <div class="w-1/3 text-gray-600 font-medium">Género:</div>
                                <div class="w-2/3 text-gray-900">{{ $familiar->genero->Valor1 ?? 'No especificado' }}</div>
                            </div>
                            <div class="flex items-start">
                                <div class="w-1/3 text-gray-600 font-medium">Tipo de Sangre:</div>
                                <div class="w-2/3 text-gray-900">
                                    @if($familiar->tipoSangre)
                                        <span class="px-2 py-1 bg-red-100 text-red-800 text-xs font-semibold rounded">
                                            {{ $familiar->tipoSangre->Valor1 }}
                                        </span>
                                    @else
                                        <span class="text-gray-400 italic">No especificado</span>
                                    @endif
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="w-1/3 text-gray-600 font-medium">Correo:</div>
                                <div class="w-2/3 text-gray-900">
                                    <a href="mailto:{{ $familiar->correo }}" class="text-blue-600 hover:underline">
                                        {{ $familiar->correo }}
                                    </a>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="w-1/3 text-gray-600 font-medium">Teléfono:</div>
                                <div class="w-2/3 text-gray-900">
                                    <a href="tel:{{ $familiar->telefono }}" class="text-blue-600 hover:underline">
                                        {{ $familiar->telefono }}
                                    </a>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="w-1/3 text-gray-600 font-medium">Estado:</div>
                                <div class="w-2/3 text-gray-900">
                                    @if($familiar->estado && $familiar->estado->Valor1 == 'Activo')
                                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded">
                                            <i class="fas fa-check-circle mr-1"></i> Activo
                                        </span>
                                    @else
                                        <span class="px-2 py-1 bg-red-100 text-red-800 text-xs font-semibold rounded">
                                            <i class="fas fa-times-circle mr-1"></i> Inactivo
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Contactos de emergencia -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 border-b border-gray-200 pb-2 mb-3 flex items-center">
                            <i class="fas fa-phone-alt text-green-600 mr-2"></i> Contactos de Emergencia
                        </h3>
                        
                        @if($familiar->contacto_nombre1 || $familiar->contacto_telefono1 || $familiar->contacto_nombre2 || $familiar->contacto_telefono2)
                        <!-- Contenido de los contactos -->
                    @else
                        <div class="text-center py-6 bg-gray-50 border border-gray-200 rounded-lg">
                            <i class="fas fa-user-slash text-gray-400 text-3xl mb-2"></i>
                            <p class="text-gray-500 italic">No hay contactos de emergencia registrados</p>
                        </div>
                    @endif
                    </div>
                    
                    <!-- Enfermedades -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 border-b border-gray-200 pb-2 mb-3 flex items-center">
                            <i class="fas fa-viruses text-green-600 mr-2"></i> Enfermedades Base
                        </h3>
                        
                        @if($familiar->enfermedades && $familiar->enfermedades->count() > 0)
                            <div class="space-y-3">
                                @foreach($familiar->enfermedades as $enfermedad)
                                    <div class="border-l-4 border-orange-500 pl-4 py-1">
                                        <div class="font-medium text-gray-800">{{ $enfermedad->nombre }}</div>
                                        @if(isset($enfermedad->pivot) && $enfermedad->pivot->notas)
                                            <div class="text-sm text-gray-600 mt-1">{{ $enfermedad->pivot->notas }}</div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-6 bg-gray-50 border border-gray-200 rounded-lg">
                                <i class="fas fa-check-circle text-green-500 text-3xl mb-2"></i>
                                <p class="text-gray-500 italic">No hay enfermedades base registradas</p>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Alergias -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 border-b border-gray-200 pb-2 mb-3 flex items-center">
                            <i class="fas fa-allergies text-green-600 mr-2"></i> Alergias
                        </h3>
                        
                        @if($familiar->alergias && $familiar->alergias->count() > 0)
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                @foreach($familiar->alergias as $alergia)
                                    <div class="bg-red-50 border border-red-200 rounded-lg p-3">
                                        <div class="font-medium text-red-800">{{ $alergia->nombre }}</div>
                                        @if(isset($alergia->pivot) && $alergia->pivot->notas)
                                            <div class="text-sm text-red-700 mt-1">{{ $alergia->pivot->notas }}</div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-6 bg-gray-50 border border-gray-200 rounded-lg">
                                <i class="fas fa-check-circle text-green-500 text-3xl mb-2"></i>
                                <p class="text-gray-500 italic">No hay alergias registradas</p>
                            </div>
                        @endif
                    </div>
                </div>
                
                <!-- Columna derecha: Medicamentos activos y órdenes médicas -->
                <div>
                <!-- Medicamentos Activos -->
<div class="mt-6 mb-8 bg-white rounded-lg shadow-md overflow-hidden">
    <div class="bg-green-50 px-6 py-4 border-b border-green-100">
        <h3 class="text-lg font-semibold text-gray-800 flex items-center">
            <i class="fas fa-pills text-green-600 mr-2"></i> Medicamentos Activos
        </h3>
    </div>
    
    <div class="p-6">
        @php
            $medicamentosActivos = $familiar->historialMedicamentos()
                ->where('CATA_Estado', 41)
                ->get();
            
            // Ordenar medicamentos: primero los que tienen fecha final, luego los continuos
            $medicamentosOrdenados = $medicamentosActivos->sortBy(function($med) {
                return $med->fecha_final === null ? 1 : 0;
            });
        @endphp
        
        @if($medicamentosOrdenados->count() > 0)
            <div class="grid grid-cols-1 gap-4">
                @foreach($medicamentosOrdenados as $medicamento)
                    <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                                    <i class="fas fa-capsules text-green-600"></i>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-lg font-medium text-gray-900">{{ $medicamento->medicamento->Nombre }}</h4>
                                    <p class="text-sm text-gray-600">{{ $medicamento->descripcion_tratamiento }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    {{ $medicamento->dosis }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="mt-3 pt-3 border-t border-gray-200 text-sm">
                            <div class="grid grid-cols-2 gap-2">
                                <div>
                                    <span class="text-gray-500">Inicio:</span> 
                                    <span class="font-medium">{{ \Carbon\Carbon::parse($medicamento->fecha_inicio)->format('d/m/Y') }}</span>
                                </div>
                                <div>
                                    @if($medicamento->fecha_final)
                                        @php
                                            $diasRestantes = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($medicamento->fecha_final), false);
                                            $fechaVencida = $diasRestantes < 0;
                                        @endphp
                                        
                                        <span class="text-gray-500">Finaliza:</span> 
                                        <span class="font-medium {{ $fechaVencida ? 'text-red-600' : '' }}">
                                            {{ \Carbon\Carbon::parse($medicamento->fecha_final)->format('d/m/Y') }}
                                        </span>
                                        
                                        @if($diasRestantes > 0)
                                            <span class="ml-2 px-2 py-1 text-xs rounded-full {{ $diasRestantes <= 5 ? 'bg-orange-100 text-orange-800' : 'bg-blue-100 text-blue-800' }}">
                                                {{ $diasRestantes }} días restantes
                                            </span>
                                        @elseif($diasRestantes == 0)
                                            <span class="ml-2 px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">
                                                Último día
                                            </span>
                                        @else
                                            <span class="ml-2 px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">
                                                Finalizado (hace {{ abs($diasRestantes) }} días)
                                            </span>
                                        @endif
                                    @else
                                        <span class="text-gray-500">Duración:</span> 
                                        <span class="font-medium text-blue-600">Tratamiento continuo</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-6 bg-gray-50 border border-gray-200 rounded-lg">
                <i class="fas fa-pills text-gray-400 text-3xl mb-2"></i>
                <p class="text-gray-500 italic">No hay medicamentos activos</p>
            </div>
        @endif
    </div>
</div>

<!-- Órdenes Médicas Activas -->
<div class="mt-8 bg-white rounded-lg shadow-md overflow-hidden">
    <div class="bg-blue-50 px-6 py-4 border-b border-blue-100">
        <h3 class="text-lg font-semibold text-gray-800 flex items-center">
            <i class="fas fa-file-medical text-blue-600 mr-2"></i> Órdenes Médicas Activas
        </h3>
    </div>
    
    <div class="p-6">
        @php
            $ordenesMedicas = $familiar->ordenesMedicas()
                ->where('CATA_Estado', 41)
                ->get();
        @endphp
        
        @if($ordenesMedicas->count() > 0)
            <div class="grid grid-cols-1 gap-4">
                @foreach($ordenesMedicas as $orden)
                    <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-4">
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="text-lg font-medium text-gray-900">
                                    {{ $orden->Procedimiento }}
                                </h4>
                                <p class="text-sm text-gray-600 mt-1">
                                    <span class="font-medium">Médico:</span> {{ $orden->Medico_Reseta }}
                                </p>
                                <p class="text-sm text-gray-600">
                                    <span class="font-medium">Centro Médico:</span> {{ $orden->Centro_Medico }}, {{ $orden->Ciudad }}
                                </p>
                            </div>
                            <div>
                                <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $orden->especialidad ? $orden->especialidad->Valor1 : 'Sin especialidad' }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="mt-3 pt-3 border-t border-gray-200 text-sm">
                            <div class="grid grid-cols-2 gap-2">
                                <div>
                                    <span class="text-gray-500">Fecha de orden:</span> 
                                    <span class="font-medium">{{ \Carbon\Carbon::parse($orden->Fecha_Resetada)->format('d/m/Y') }}</span>
                                </div>
                                <div>
                                    @if($orden->citasMedicas->count() > 0)
                                        <span class="text-gray-500">Próxima cita:</span>
                                        <span class="font-medium">
                                            {{ \Carbon\Carbon::parse($orden->citasMedicas->sortBy('Fecha_Hora_Cita')->first()->Fecha_Hora_Cita)->format('d/m/Y H:i') }}
                                        </span>
                                    @else
                                        <span class="text-gray-500">Estado:</span>
                                        <span class="font-medium text-orange-600">Sin cita programada</span>
                                    @endif
                                </div>
                            </div>
                            
                            @if($orden->Pre_requisitos)
                                <div class="mt-2 p-2 bg-yellow-50 rounded border border-yellow-200">
                                    <p class="text-sm text-yellow-800">
                                        <i class="fas fa-exclamation-circle mr-1"></i> <strong>Pre-requisitos:</strong> {{ $orden->Pre_requisitos }}
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-6 bg-gray-50 border border-gray-200 rounded-lg">
                <i class="fas fa-file-medical text-gray-400 text-3xl mb-2"></i>
                <p class="text-gray-500 italic">No hay órdenes médicas activas</p>
            </div>
        @endif
    </div>
            </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection