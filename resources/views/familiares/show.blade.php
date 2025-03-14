@extends('layouts.app')

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
                    <i class="fas fa-pills mr-1"></i> Medicamentos
                </a>
                <a href="{{ route('familiares.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white py-1 px-3 rounded-md text-sm flex items-center transition-colors">
                    <i class="fas fa-arrow-left mr-1"></i> Volver
                </a>
            </div>
        </div>
        
        <!-- Contenido principal -->
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
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
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 border-b border-gray-200 pb-2 mb-3 flex items-center">
                            <i class="fas fa-phone-alt text-green-600 mr-2"></i> Contactos de Emergencia
                        </h3>
                        
                        @if($familiar->contacto_nombre1 || $familiar->contacto_telefono1 || $familiar->contacto_nombre2 || $familiar->contacto_telefono2)
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @if($familiar->contacto_nombre1 || $familiar->contacto_telefono1)
                                    <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                                        <h4 class="font-medium text-gray-800 mb-2">Contacto Primario</h4>
                                        <p class="text-gray-700">{{ $familiar->contacto_nombre1 ?? 'Sin nombre' }}</p>
                                        @if($familiar->contacto_telefono1)
                                            <a href="tel:{{ $familiar->contacto_telefono1 }}" class="text-blue-600 hover:underline flex items-center mt-1">
                                                <i class="fas fa-phone-alt mr-1"></i>
                                                {{ $familiar->contacto_telefono1 }}
                                            </a>
                                        @endif
                                    </div>
                                @endif
                                
                                @if($familiar->contacto_nombre2 || $familiar->contacto_telefono2)
                                    <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                                        <h4 class="font-medium text-gray-800 mb-2">Contacto Secundario</h4>
                                        <p class="text-gray-700">{{ $familiar->contacto_nombre2 ?? 'Sin nombre' }}</p>
                                        @if($familiar->contacto_telefono2)
                                            <a href="tel:{{ $familiar->contacto_telefono2 }}" class="text-blue-600 hover:underline flex items-center mt-1">
                                                <i class="fas fa-phone-alt mr-1"></i>
                                                {{ $familiar->contacto_telefono2 }}
                                            </a>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="text-center py-6 bg-gray-50 border border-gray-200 rounded-lg">
                                <i class="fas fa-user-slash text-gray-400 text-3xl mb-2"></i>
                                <p class="text-gray-500 italic">No hay contactos de emergencia registrados</p>
                            </div>
                        @endif
                    </div>
                </div>
                
                <!-- Columna derecha: Condiciones médicas -->
                <div>
                    <!-- Enfermedades -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 border-b border-gray-200 pb-2 mb-3 flex items-center">
                            <i class="fas fa-viruses text-green-600 mr-2"></i> Enfermedades Base
                        </h3>
                        
                        @if($familiar->enfermedades->count() > 0)
                            <div class="space-y-3">
                                @foreach($familiar->enfermedades as $enfermedad)
                                    <div class="border-l-4 border-orange-500 pl-4 py-1">
                                        <div class="font-medium text-gray-800">{{ $enfermedad->nombre }}</div>
                                        @if($enfermedad->pivot->notas)
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
                        
                        @if($familiar->alergias->count() > 0)
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                @foreach($familiar->alergias as $alergia)
                                    <div class="bg-red-50 border border-red-200 rounded-lg p-3">
                                        <div class="font-medium text-red-800">{{ $alergia->nombre }}</div>
                                        @if($alergia->pivot->notas)
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
            </div>
        </div>
    </div>
</div>
@endsection