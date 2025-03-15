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
<div class="mb-6">
    <div class="flex justify-between items-center border-b border-gray-200 pb-2 mb-3">
        <h3 class="text-lg font-semibold text-gray-800 flex items-center">
            <i class="fas fa-pills text-green-600 mr-2"></i> Medicamentos Activos
        </h3>
        <a href="{{ route('historial_medicamentos.create') }}?familiar_id={{ $familiar->id }}" class="text-sm text-blue-600 hover:text-blue-800 flex items-center">
            <i class="fas fa-plus-circle mr-1"></i> Agregar
        </a>
    </div>
    
    @if(isset($medicamentosActivos) && $medicamentosActivos->count() > 0)
        <div class="space-y-3">
            @foreach($medicamentosActivos as $medicamento)
                <div class="border border-gray-200 rounded-lg p-3 hover:bg-gray-50">
                    <div class="flex justify-between">
                        <div class="font-medium text-gray-800">{{ $medicamento->medicamento->Nombre }}</div>
                        <div>
                            <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded">
                                Activo
                            </span>
                        </div>
                    </div>
                    <div class="text-sm text-gray-600 mt-1">
                        <strong>Dosis:</strong> {{ $medicamento->dosis }}
                    </div>
                    <div class="text-sm text-gray-600">
                        <strong>Inicio:</strong> {{ \Carbon\Carbon::parse($medicamento->fecha_inicio)->format('d/m/Y') }}
                        @if($medicamento->fecha_final)
                            <span class="mx-1">-</span>
                            <strong>Fin:</strong> {{ \Carbon\Carbon::parse($medicamento->fecha_final)->format('d/m/Y') }}
                        @else
                            <span class="text-blue-600 ml-1">(Tratamiento continuo)</span>
                        @endif
                    </div>
                    <div class="flex justify-end mt-2">
                        <a href="{{ route('historial_medicamentos.edit', $medicamento->id) }}" class="text-yellow-600 hover:text-yellow-800 bg-yellow-100 hover:bg-yellow-200 p-1 rounded transition-colors mr-1">
                            <i class="fas fa-edit"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-6 bg-gray-50 border border-gray-200 rounded-lg">
            <i class="fas fa-pills text-gray-400 text-3xl mb-2"></i>
            <p class="text-gray-500 italic">No hay medicamentos activos</p>
            <a href="{{ route('historial_medicamentos.create') }}?familiar_id={{ $familiar->id }}" class="mt-2 inline-block text-blue-600 hover:text-blue-800">
                <i class="fas fa-plus-circle mr-1"></i> Agregar medicamento
            </a>
        </div>
    @endif
</div>
                    
                    <!-- Órdenes Médicas Activas -->
                    <div>
                        <div class="flex justify-between items-center border-b border-gray-200 pb-2 mb-3">
                            <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                                <i class="fas fa-file-medical text-green-600 mr-2"></i> Órdenes Médicas Activas
                            </h3>
                            <a href="{{ route('ordenes_medicas.create') }}?familiar_id={{ $familiar->id }}" class="text-sm text-blue-600 hover:text-blue-800 flex items-center">
                                <i class="fas fa-plus-circle mr-1"></i> Agregar
                            </a>
                        </div>
                        
                        @if($ordenesActivas && $ordenesActivas->count() > 0)
                            <div class="space-y-4">
                                @foreach($ordenesActivas as $orden)
                                    <div class="border border-gray-200 rounded-lg hover:bg-gray-50">
                                        <div class="p-3">
                                            <div class="flex justify-between items-start">
                                                <div>
                                                    <div class="font-medium text-gray-800">
                                                        {{ $orden->Procedimiento }}
                                                        <span class="ml-2 px-2 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded-full">
                                                            {{ $orden->especialidad->Valor1 ?? 'Sin especialidad' }}
                                                        </span>
                                                    </div>
                                                    <div class="text-sm text-gray-600 mt-1">
                                                        <strong>Fecha:</strong> {{ \Carbon\Carbon::parse($orden->Fecha_Resetada)->format('d/m/Y') }}
                                                        <span class="mx-1">•</span>
                                                        <strong>Médico:</strong> {{ $orden->Medico_Reseta }}
                                                    </div>
                                                    <div class="text-sm text-gray-600">
                                                        <strong>Centro:</strong> {{ $orden->Centro_Medico }}, {{ $orden->Ciudad }}
                                                    </div>
                                                </div>
                                                <div class="flex">
                                                    <a href="{{ route('ordenes_medicas.show', $orden->id) }}" class="text-blue-600 hover:text-blue-800 bg-blue-100 hover:bg-blue-200 p-1 rounded transition-colors mr-1">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('citas_medicas.create') }}?orden_id={{ $orden->id }}" class="text-green-600 hover:text-green-800 bg-green-100 hover:bg-green-200 p-1 rounded transition-colors">
                                                        <i class="fas fa-calendar-plus"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        @if($orden->citasMedicas && $orden->citasMedicas->count() > 0)
                                            <div class="border-t border-gray-200 p-3 bg-gray-50">
                                                <h4 class="text-sm font-medium text-gray-700 mb-2">Próximas Citas:</h4>
                                                <div class="space-y-2">
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
                                                                <span>{{ $fechaCita->format('d/m/Y h:i A') }}</span>
                                                            </div>
                                                            <a href="{{ route('citas_medicas.edit', $cita->id) }}" class="text-gray-600 hover:text-gray-800">
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                            <div class="mt-3 text-right">
                                <a href="{{ route('ordenes_medicas.indexByFamiliar', $familiar) }}" class="text-sm text-gray-600 hover:text-gray-800">
                                    Ver historial completo <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        @else
                            <div class="text-center py-6 bg-gray-50 border border-gray-200 rounded-lg">
                                <i class="fas fa-file-medical text-gray-400 text-3xl mb-2"></i>
                                <p class="text-gray-500 italic">No hay órdenes médicas activas</p>
                                <a href="{{ route('ordenes_medicas.create') }}?familiar_id={{ $familiar->id }}" class="mt-2 inline-block text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-plus-circle mr-1"></i> Crear orden médica
                                </a>
                            </div>
                        @endif
                        @if(isset($diagnostico))
<div class="container mx-auto p-4 mb-4">
    <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded" role="alert">
        <h3 class="font-bold">Diagnóstico (sólo desarrollo)</h3>
        <p class="mt-2"><strong>ID Familiar:</strong> {{ $diagnostico['id_familiar'] }}</p>
        <p><strong>Medicamentos encontrados en consulta:</strong> {{ $diagnostico['total_medicamentos_query'] }}</p>
        <p><strong>Medicamentos en resultado:</strong> {{ $diagnostico['total_medicamentos_resultado'] }}</p>
        <p><strong>Órdenes encontradas en consulta:</strong> {{ $diagnostico['total_ordenes_query'] }}</p>
        <p><strong>Órdenes en resultado:</strong> {{ $diagnostico['total_ordenes_resultado'] }}</p>
        <p><strong>Código de estado activo:</strong> {{ $diagnostico['estado_codigo_activo'] }}</p>
    </div>
</div>
@endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection