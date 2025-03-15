@extends('layouts.app')

@section('header')
    <h1 class="text-2xl font-bold text-white">Órdenes Médicas del Familiar</h1>
@endsection

@section('content')
<div class="container mx-auto p-4">
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4 flex items-center">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
        </div>
    @endif
    
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
                    <i class="fas fa-file-medical text-green-600 mr-2"></i>Órdenes Médicas
                </h3>
                <p class="text-gray-600">Gestione las órdenes médicas de {{ $familiar->nombre }}</p>
            </div>
            <div class="mt-3 md:mt-0">
                <a href="{{ route('ordenes_medicas.create') }}?familiar_id={{ $familiar->id }}" 
                   class="bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded inline-flex items-center">
                    <i class="fas fa-plus-circle mr-2"></i> Nueva Orden Médica
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
    
    <!-- Listado de órdenes médicas -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        @if($ordenes->count() > 0)
            <div class="grid grid-cols-1 divide-y divide-gray-200">
                @foreach($ordenes as $orden)
                    <div class="p-4 hover:bg-gray-50">
                        <div class="flex flex-wrap md:flex-nowrap md:justify-between">
                            <!-- Información principal de la orden -->
                            <div class="w-full md:w-2/3 mb-4 md:mb-0 md:pr-4">
                                <div class="flex justify-between mb-2">
                                    <h3 class="text-lg font-semibold text-gray-800">{{ $orden->Procedimiento }}</h3>
                                    @if($orden->estado && $orden->estado->Valor1 == 'Activo')
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            <i class="fas fa-check-circle mr-1"></i> Activo
                                        </span>
                                    @else
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            <i class="fas fa-times-circle mr-1"></i> Inactivo
                                        </span>
                                    @endif
                                </div>
                                <div class="text-sm text-gray-600 mb-2">
                                    <span class="inline-block px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs mb-2">
                                        {{ $orden->especialidad->Valor1 ?? 'Sin especialidad' }}
                                    </span>
                                </div>
                                <div class="text-sm text-gray-600 mb-1">
                                    <i class="fas fa-calendar-alt mr-1"></i> <strong>Fecha orden:</strong> {{ \Carbon\Carbon::parse($orden->Fecha_Resetada)->format('d/m/Y') }}
                                </div>
                                <div class="text-sm text-gray-600 mb-1">
                                    <i class="fas fa-user-md mr-1"></i> <strong>Médico:</strong> {{ $orden->Medico_Reseta }}
                                </div>
                                <div class="text-sm text-gray-600 mb-1">
                                    <i class="fas fa-hospital mr-1"></i> <strong>Centro médico:</strong> {{ $orden->Centro_Medico }}, {{ $orden->Ciudad }}
                                </div>
                                
                                <div class="flex space-x-2 mt-3">
                                    <a href="{{ route('ordenes_medicas.show', $orden->id) }}" class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-eye mr-1"></i> Ver detalles
                                    </a>
                                    <a href="{{ route('ordenes_medicas.edit', $orden->id) }}" class="inline-flex items-center text-sm text-yellow-600 hover:text-yellow-800">
                                        <i class="fas fa-edit mr-1"></i> Editar
                                    </a>
                                    <a href="{{ route('citas_medicas.create') }}?orden_id={{ $orden->id }}" class="inline-flex items-center text-sm text-green-600 hover:text-green-800">
                                        <i class="fas fa-calendar-plus mr-1"></i> Agendar cita
                                    </a>
                                </div>
                            </div>
                            
                            <!-- Citas agendadas -->
                            <div class="w-full md:w-1/3 bg-gray-50 p-3 rounded-lg">
                                <h4 class="text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-calendar-alt text-green-600 mr-1"></i> Citas agendadas:
                                </h4>
                                
                                @if($orden->citasMedicas && $orden->citasMedicas->count() > 0)
                                    <div class="space-y-2 max-h-48 overflow-y-auto">
                                        @php
                                            $now = \Carbon\Carbon::now();
                                            $citasOrdenadas = $orden->citasMedicas->sortBy('Fecha_Hora_Cita');
                                        @endphp
                                        
                                        @foreach($citasOrdenadas as $cita)
                                            @php
                                                $fechaCita = \Carbon\Carbon::parse($cita->Fecha_Hora_Cita);
                                                $diff = $now->diffInDays($fechaCita, false);
                                                
                                                // Verde: próxima cita (menos de 7 días)
                                                // Amarillo: próximas citas (entre 7 y 30 días)
                                                // Rojo: citas vencidas (ya pasaron)
                                                $bgColor = 'bg-red-100 text-red-800';
                                                $icon = 'fa-calendar-times';
                                                
                                                if ($diff >= 0) {
                                                    if ($diff < 7) {
                                                        $bgColor = 'bg-green-100 text-green-800';
                                                        $icon = 'fa-calendar-check';
                                                    } else {
                                                        $bgColor = 'bg-yellow-100 text-yellow-800';
                                                        $icon = 'fa-calendar-day';
                                                    }
                                                }
                                            @endphp
                                            
                                            <div class="flex items-center justify-between px-3 py-2 rounded-md {{ $bgColor }}">
                                                <div class="flex items-center">
                                                    <i class="fas {{ $icon }} mr-2"></i>
                                                    <span class="text-xs font-medium">{{ $fechaCita->format('d/m/Y h:i A') }}</span>
                                                </div>
                                                <a href="{{ route('citas_medicas.edit', $cita->id) }}" class="text-gray-600 hover:text-gray-800 text-xs">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="bg-gray-100 text-gray-500 py-3 px-2 rounded text-center text-sm">
                                        <i class="fas fa-calendar-times text-gray-400 mb-1 text-lg"></i>
                                        <p>No hay citas agendadas</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-8">
                <div class="flex flex-col items-center justify-center">
                    <i class="fas fa-file-medical text-gray-300 text-5xl mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-500 mb-1">No hay órdenes médicas registradas</h3>
                    <p class="text-gray-400 mb-4">Este familiar no tiene órdenes médicas creadas actualmente</p>
                    <a href="{{ route('ordenes_medicas.create') }}?familiar_id={{ $familiar->id }}" 
                       class="bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded inline-flex items-center">
                        <i class="fas fa-plus-circle mr-2"></i> Crear Primera Orden Médica
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection