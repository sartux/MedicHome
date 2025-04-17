@extends('layouts.app')

@section('header')
    <h1 class="text-2xl font-bold text-white">Panel de Control - Medicamentos Activos</h1>
@endsection

@section('content')
    <div class="container mx-auto p-4">
        <!-- Selector de familiares con estilo mejorado -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6" x-data="{ expanded: true }">
            <div class="flex justify-between items-center cursor-pointer" @click="expanded = !expanded">
                <h2 class="text-xl font-semibold text-gray-800">
                    <i class="fas fa-user-friends text-green-600 mr-2"></i>Filtrar por Familiar
                </h2>
                <button class="text-gray-500 hover:text-green-600 focus:outline-none transition-colors">
                    <i class="fas" :class="expanded ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                </button>
            </div>

            <div x-show="expanded" x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 transform -translate-y-2"
                x-transition:enter-end="opacity-100 transform translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform translate-y-0"
                x-transition:leave-end="opacity-0 transform -translate-y-2" class="mt-4">
                <label for="familiarSelect" class="block text-sm font-medium text-gray-700 mb-2">Seleccionar
                    Familiar</label>
                <div class="relative">
                    <select id="familiarSelect"
                        class="block w-full pl-3 pr-10 py-3 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md shadow-sm">
                        <option value="">-- Seleccionar un familiar --</option>
                        @foreach ($familiares as $familiar)
                            <option value="{{ $familiar->id }}">{{ $familiar->nombre }} {{ $familiar->apellido }}</option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                        <i class="fas fa-chevron-down text-gray-400"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contenedor de la tabla de medicamentos -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden" x-data="{ expanded: true }">
            <div class="px-6 py-4 border-b border-gray-200 bg-green-50 flex justify-between items-center cursor-pointer"
                @click="expanded = !expanded">
                <h3 class="text-lg font-semibold text-gray-800">
                    <i class="fas fa-pills text-green-600 mr-2"></i>Medicamentos Activos
                </h3>
                <button class="text-gray-500 hover:text-green-600 focus:outline-none transition-colors">
                    <i class="fas" :class="expanded ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                </button>
            </div>

            <div x-show="expanded" x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr class="bg-green-600">
                                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                    <i class="fas fa-user mr-1"></i> Familiar
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                    <i class="fas fa-stethoscope mr-1"></i> Especialidad
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                    <i class="fas fa-clipboard-list mr-1"></i> Uso
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                    <i class="fas fa-capsules mr-1"></i> Medicamento
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                    <i class="fas fa-calendar-alt mr-1"></i> Fecha Final
                                </th>
                            </tr>
                        </thead>
                        <tbody id="medicamentosTableBody" class="bg-white divide-y divide-gray-200">
                            @forelse($medicamentos as $medicamento)
                                <tr class="hover:bg-green-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div
                                                class="flex-shrink-0 h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                                                <i class="fas fa-user text-green-600"></i>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $medicamento->familiar->nombre }}
                                                    {{ $medicamento->familiar->apellido }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            {{ $medicamento->medicamento->especialidad->Valor1 ?? 'Sin especialidad' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $medicamento->medicamento->uso->Valor1 ?? 'Sin uso' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $medicamento->medicamento->Nombre }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        @if ($medicamento->fecha_final)
                                            <span
                                                class="text-orange-600">{{ \Carbon\Carbon::parse($medicamento->fecha_final)->format('d/m/Y') }}</span>
                                        @else
                                            <span class="text-green-600 font-medium">Tratamiento continuo</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-gray-500 italic">
                                        <div class="flex flex-col items-center justify-center">
                                            <i class="fas fa-info-circle text-gray-400 text-4xl mb-2"></i>
                                            <p>No hay medicamentos en curso actualmente.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Dashboard Stats Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            <!-- Próximas Citas -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden" x-data="{ expanded: true }">
                <div class="px-6 py-4 border-b border-gray-200 bg-blue-50 flex justify-between items-center cursor-pointer"
                    @click="expanded = !expanded">
                    <h3 class="text-lg font-semibold text-gray-800">
                        <i class="fas fa-calendar-check text-blue-600 mr-2"></i>Próximas Citas
                    </h3>
                    <button class="text-gray-500 hover:text-blue-600 focus:outline-none transition-colors">
                        <i class="fas" :class="expanded ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                    </button>
                </div>

                <div x-show="expanded" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="p-6">

                    <div class="space-y-3 max-h-64 overflow-y-auto">
                        @php
                            // Simulamos datos de próximas citas - reemplaza esto con datos reales
                            $proximasCitas = [];
                            // Aquí deberías consultar tus citas reales
                        @endphp

                        @if (count($proximasCitas) > 0)
                            @foreach ($proximasCitas as $cita)
                                <div class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-blue-50">
                                    <div
                                        class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                        <i class="fas fa-calendar text-blue-600"></i>
                                    </div>
                                    <div class="ml-3 flex-1">
                                        <div class="flex justify-between">
                                            <p class="text-sm font-medium text-gray-900">
                                                {{ $cita->familiar_nombre ?? 'Nombre Familiar' }}</p>
                                            <p class="text-xs text-gray-500">{{ $cita->fecha ?? '2025-03-15' }}</p>
                                        </div>
                                        <p class="text-xs text-gray-600">{{ $cita->especialidad ?? 'Especialidad' }} -
                                            {{ $cita->doctor ?? 'Dr. Ejemplo' }}</p>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center py-6 bg-gray-50 border border-gray-200 rounded-lg">
                                <i class="fas fa-calendar-check text-gray-400 text-3xl mb-2"></i>
                                <p class="text-gray-500 italic">No hay citas programadas próximamente</p>
                            </div>
                        @endif

                        <div class="mt-4 text-center">
                            <a href="#"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md transition-colors">
                                <i class="fas fa-calendar-plus mr-2"></i>Agendar Nueva Cita
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Citas Pendientes por Asignar -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden" x-data="{ expanded: true }">
                <div class="px-6 py-4 border-b border-gray-200 bg-orange-50 flex justify-between items-center cursor-pointer"
                    @click="expanded = !expanded">
                    <h3 class="text-lg font-semibold text-gray-800">
                        <i class="fas fa-exclamation-circle text-orange-600 mr-2"></i>Citas Pendientes por Asignar
                    </h3>
                    <button class="text-gray-500 hover:text-orange-600 focus:outline-none transition-colors">
                        <i class="fas" :class="expanded ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                    </button>
                </div>

                <div x-show="expanded" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="p-6">

                    <div class="space-y-3 max-h-64 overflow-y-auto">
                        @php
                            // Simulamos datos de citas pendientes - reemplaza esto con datos reales
                            $citasPendientes = [];
                            // Aquí deberías consultar tus citas pendientes reales
                        @endphp

                        @if (count($citasPendientes) > 0)
                            @foreach ($citasPendientes as $citaPendiente)
                                <div class="flex items-center p-3 rounded-lg border border-orange-200 hover:bg-orange-50">
                                    <div
                                        class="flex-shrink-0 h-10 w-10 rounded-full bg-orange-100 flex items-center justify-center">
                                        <i class="fas fa-file-medical text-orange-600"></i>
                                    </div>
                                    <div class="ml-3 flex-1">
                                        <div class="flex justify-between">
                                            <p class="text-sm font-medium text-gray-900">
                                                {{ $citaPendiente->familiar_nombre ?? 'Nombre Familiar' }}</p>
                                            <p class="text-xs text-orange-600 font-medium">Pendiente</p>
                                        </div>
                                        <p class="text-xs text-gray-600">
                                            {{ $citaPendiente->especialidad ?? 'Especialidad' }} -
                                            {{ $citaPendiente->procedimiento ?? 'Procedimiento' }}</p>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center py-6 bg-gray-50 border border-gray-200 rounded-lg">
                                <i class="fas fa-check-circle text-green-500 text-3xl mb-2"></i>
                                <p class="text-gray-500 italic">No hay citas pendientes por asignar</p>
                            </div>
                        @endif

                        <div class="mt-4 text-center">
                            <a href="#"
                                class="inline-flex items-center px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white font-medium rounded-md transition-colors">
                                <i class="fas fa-calendar-plus mr-2"></i>Gestionar Órdenes Médicas
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stat Card: Acciones Rápidas -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden col-span-1 md:col-span-2" x-data="{ expanded: true }">
                <div class="px-6 py-4 border-b border-gray-200 bg-green-50 flex justify-between items-center cursor-pointer"
                    @click="expanded = !expanded">
                    <h3 class="text-lg font-semibold text-gray-800">
                        <i class="fas fa-bolt text-green-600 mr-2"></i>Acciones Rápidas
                    </h3>
                    <button class="text-gray-500 hover:text-green-600 focus:outline-none transition-colors">
                        <i class="fas" :class="expanded ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                    </button>
                </div>

                <div x-show="expanded" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
                        <a href="{{ route('familiares.create') }}"
                            class="block py-3 px-4 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg text-center transition duration-150 ease-in-out">
                            <i class="fas fa-user-plus mr-2"></i>Agregar Familiar
                        </a>

                        <a href="{{ route('medicamentos.create') }}"
                            class="block py-3 px-4 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg text-center transition duration-150 ease-in-out">
                            <i class="fas fa-pills mr-2"></i>Nuevo Medicamento
                        </a>

                        <a href="{{ route('historial_medicamentos.create') }}"
                            class="block py-3 px-4 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-lg text-center transition duration-150 ease-in-out">
                            <i class="fas fa-clipboard-list mr-2"></i>Asignar Tratamiento
                        </a>

                        <a href="{{ route('ordenes_medicas.create') }}"
                            class="block py-3 px-4 bg-orange-600 hover:bg-orange-700 text-white font-medium rounded-lg text-center transition duration-150 ease-in-out">
                            <i class="fas fa-file-medical mr-2"></i>Nueva Orden Médica
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Agregar sección para SuperAdmin -->
@if(Auth::user()->isSuperAdmin() && isset($nucleoInfo))
<div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
    <div class="bg-blue-600 px-6 py-3">
        <h3 class="text-lg font-semibold text-white">
            <i class="fas fa-home mr-2"></i> Estadísticas de Núcleos Familiares
        </h3>
    </div>
    
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-blue-50 p-4 rounded-lg text-center">
                <div class="text-3xl font-bold text-blue-700 mb-2">{{ $nucleoInfo['total'] }}</div>
                <div class="text-gray-700">Núcleos Totales</div>
            </div>
            
            <div class="bg-green-50 p-4 rounded-lg text-center">
                <div class="text-3xl font-bold text-green-700 mb-2">{{ $nucleoInfo['activos'] }}</div>
                <div class="text-gray-700">Núcleos Activos</div>
            </div>
            
            <div class="bg-red-50 p-4 rounded-lg text-center">
                <div class="text-3xl font-bold text-red-700 mb-2">{{ $nucleoInfo['inactivos'] }}</div>
                <div class="text-gray-700">Núcleos Inactivos</div>
            </div>
        </div>
        
        <div class="mt-4 text-center">
            <a href="{{ route('nucleo_familiares.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md transition-colors">
                <i class="fas fa-list mr-2"></i>Ver todos los núcleos
            </a>
        </div>
    </div>
</div>
@endif

    <script>
        // Script mejorado para filtrar medicamentos
        document.addEventListener('DOMContentLoaded', function() {
            const familiarSelect = document.getElementById('familiarSelect');
            if (familiarSelect) {
                familiarSelect.addEventListener('change', function() {
                    const familiarId = this.value;
                    const tableBody = document.getElementById('medicamentosTableBody');

                    if (!tableBody) return;

                    // Mostrar indicador de carga
                    tableBody.innerHTML = `
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center">
                            <div class="flex justify-center">
                                <i class="fas fa-spinner fa-spin text-green-600 text-2xl"></i>
                            </div>
                        </td>
                    </tr>
                `;

                    if (familiarId) {
                        fetch(`/api/medicamentos/${familiarId}`)
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Error en la respuesta de la red');
                                }
                                return response.json();
                            })
                            .then(data => {
                                if (!data.medicamentos || data.medicamentos.length === 0) {
                                    tableBody.innerHTML = `
                                    <tr>
                                        <td colspan="5" class="px-6 py-8 text-center text-gray-500 italic">
                                            <div class="flex flex-col items-center justify-center">
                                                <i class="fas fa-pills text-gray-400 text-4xl mb-2"></i>
                                                <p>Este familiar no tiene medicamentos activos.</p>
                                            </div>
                                        </td>
                                    </tr>
                                `;
                                    return;
                                }

                                let tableContent = '';
                                data.medicamentos.forEach(med => {
                                    const fechaFinal = med.fecha_final ?
                                        `<span class="text-orange-600">${new Date(med.fecha_final).toLocaleDateString()}</span>` :
                                        `<span class="text-green-600 font-medium">Tratamiento continuo</span>`;

                                    tableContent += `
                                    <tr class="hover:bg-green-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                                                    <i class="fas fa-user text-green-600"></i>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">${med.familiar.nombre} ${med.familiar.apellido}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                ${med.medicamento.especialidad?.Valor1 || 'Sin especialidad'}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            ${med.medicamento.uso?.Valor1 || 'Sin uso'}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            ${med.medicamento.Nombre}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            ${fechaFinal}
                                        </td>
                                    </tr>
                                `;
                                });
                                tableBody.innerHTML = tableContent;
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                tableBody.innerHTML = `
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-red-500">
                                        <i class="fas fa-exclamation-triangle mr-2"></i>
                                        Error al cargar los datos. Por favor, inténtelo de nuevo.
                                    </td>
                                </tr>
                            `;
                            });
                    } else {
                        // Volver a cargar todos los medicamentos
                        location.reload();
                    }
                });
            }
        });
    </script>
@endsection
