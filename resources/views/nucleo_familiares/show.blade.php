@extends('layouts.app')

@section('header')
    <h1 class="text-2xl font-bold text-white">Detalles del Núcleo Familiar</h1>
@endsection

@section('content')
<div class="container mx-auto p-4">
    <!-- Información del núcleo familiar -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
        <div class="bg-indigo-600 px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <div class="flex-shrink-0 h-12 w-12 rounded-full bg-white flex items-center justify-center">
                        <i class="fas fa-users-cog text-indigo-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-xl font-bold text-white">{{ $nucleoFamiliar->nombre }} ({{ $nucleoFamiliar->codigo }})</h2>
                        <p class="text-indigo-100">
                            <i class="fas fa-calendar-alt mr-1"></i> Creado: {{ $nucleoFamiliar->fecha_crea->format('d/m/Y') }}
                            @if($nucleoFamiliar->fecha_cierre)
                                <span class="ml-3"><i class="fas fa-calendar-times mr-1"></i> Cierre: {{ $nucleoFamiliar->fecha_cierre->format('d/m/Y') }}</span>
                            @endif
                        </p>
                    </div>
                </div>
                <div>
                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full 
                          {{ $nucleoFamiliar->isActivo() ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $nucleoFamiliar->estado->Valor1 }}
                    </span>
                </div>
            </div>
        </div>
        
        <!-- Barra de acciones -->
        <div class="bg-gray-100 border-b border-gray-200 px-6 py-3">
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('nucleo_familiares.edit', $nucleoFamiliar) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-3 rounded-md text-sm flex items-center transition-colors">
                    <i class="fas fa-edit mr-1"></i> Editar
                </a>
                <a href="{{ route('nucleo_familiares.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white py-1 px-3 rounded-md text-sm flex items-center transition-colors">
                    <i class="fas fa-arrow-left mr-1"></i> Volver
                </a>
            </div>
        </div>
        
        <!-- Detalles del núcleo -->
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Información básica -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 border-b border-gray-200 pb-2 mb-3">
                        <i class="fas fa-info-circle text-indigo-600 mr-2"></i> Información General
                    </h3>
                    
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600 font-medium">Código:</span>
                            <span class="text-gray-800">{{ $nucleoFamiliar->codigo }}</span>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600 font-medium">Nombre:</span>
                            <span class="text-gray-800">{{ $nucleoFamiliar->nombre }}</span>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600 font-medium">Familiares:</span>
                            <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                {{ $nucleoFamiliar->familiares->count() }} / {{ $nucleoFamiliar->cant_familiares }}
                            </span>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600 font-medium">Fecha de Creación:</span>
                            <span class="text-gray-800">{{ $nucleoFamiliar->fecha_crea->format('d/m/Y') }}</span>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600 font-medium">Fecha de Cierre:</span>
                            <span class="text-gray-800">
                                @if($nucleoFamiliar->fecha_cierre)
                                    {{ $nucleoFamiliar->fecha_cierre->format('d/m/Y') }}
                                @else
                                    <span class="text-gray-400 italic">No establecida</span>
                                @endif
                            </span>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600 font-medium">Estado:</span>
                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                  {{ $nucleoFamiliar->isActivo() ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $nucleoFamiliar->estado->Valor1 }}
                            </span>
                        </div>
                    </div>
                </div>
                
                <!-- Estadísticas y datos adicionales -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 border-b border-gray-200 pb-2 mb-3">
                        <i class="fas fa-chart-pie text-indigo-600 mr-2"></i> Estadísticas
                    </h3>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-indigo-50 p-4 rounded-lg text-center">
                            <p class="text-sm text-indigo-600 mb-1">Administradores</p>
                            <p class="text-2xl font-bold text-indigo-800">
                                {{ $nucleoFamiliar->usuarios->where('is_admin', true)->count() }}
                            </p>
                        </div>
                        
                        <div class="bg-green-50 p-4 rounded-lg text-center">
                            <p class="text-sm text-green-600 mb-1">Familiares</p>
                            <p class="text-2xl font-bold text-green-800">
                                {{ $nucleoFamiliar->familiares->count() }}
                            </p>
                        </div>
                        
                        <div class="bg-blue-50 p-4 rounded-lg text-center">
                            <p class="text-sm text-blue-600 mb-1">Capacidad Utilizada</p>
                            <p class="text-2xl font-bold text-blue-800">
                                {{ $nucleoFamiliar->familiares->count() > 0 
                                    ? round(($nucleoFamiliar->familiares->count() / $nucleoFamiliar->cant_familiares) * 100) 
                                    : 0 }}%
                            </p>
                        </div>
                        
                        <div class="bg-purple-50 p-4 rounded-lg text-center">
                            <p class="text-sm text-purple-600 mb-1">Plazas Disponibles</p>
                            <p class="text-2xl font-bold text-purple-800">
                                {{ max(0, $nucleoFamiliar->cant_familiares - $nucleoFamiliar->familiares->count()) }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Lista de administradores -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
        <div class="bg-indigo-600 px-6 py-3">
            <h3 class="text-lg font-semibold text-white">
                <i class="fas fa-user-shield mr-2"></i> Administradores
            </h3>
        </div>
        
        <div class="p-6">
            @if($nucleoFamiliar->usuarios->where('is_admin', true)->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($nucleoFamiliar->usuarios->where('is_admin', true) as $admin)
                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 flex items-center">
                            <div class="flex-shrink-0 h-12 w-12 rounded-full bg-indigo-100 flex items-center justify-center">
                                <i class="fas fa-user-tie text-indigo-600"></i>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-gray-800 font-medium">{{ $admin->name }}</h4>
                                <p class="text-gray-500 text-sm">{{ $admin->email }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-6 bg-gray-50 border border-gray-200 rounded-lg">
                    <i class="fas fa-exclamation-circle text-gray-400 text-3xl mb-2"></i>
                    <p class="text-gray-500 italic">No hay administradores asignados a este núcleo</p>
                </div>
            @endif
        </div>
    </div>
    
    <!-- Lista de familiares -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="bg-green-600 px-6 py-3">
            <h3 class="text-lg font-semibold text-white">
                <i class="fas fa-users mr-2"></i> Familiares
            </h3>
        </div>
        
        <div class="p-6">
            @if($nucleoFamiliar->familiares->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Edad</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($nucleoFamiliar->familiares as $familiar)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $familiar->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                                                <i class="fas fa-user text-green-600"></i>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $familiar->nombre }} {{ $familiar->apellido }}</div>
                                                <div class="text-xs text-gray-500">{{ $familiar->correo }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $familiar->edad }} años</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($familiar->estado && $familiar->estado->Valor1 == 'Activo')
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
                                            <a href="{{ route('familiares.show', $familiar) }}" class="text-blue-600 hover:text-blue-800 bg-blue-100 hover:bg-blue-200 p-2 rounded-full transition-colors">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-6 bg-gray-50 border border-gray-200 rounded-lg">
                    <i class="fas fa-users text-gray-400 text-3xl mb-2"></i>
                    <p class="text-gray-500 italic">No hay familiares registrados en este núcleo</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection