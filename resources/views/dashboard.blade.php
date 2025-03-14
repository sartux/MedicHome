@extends('layouts.app')

@section('header')
    <h1 class="text-2xl font-bold text-white">Panel de Control - Medicamentos Activos</h1>
@endsection

@section('content')
<div class="container mx-auto p-4">
    <!-- Selector de familiares con estilo mejorado -->
    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">
            <i class="fas fa-user-friends text-green-600 mr-2"></i>Filtrar por Familiar
        </h2>
        <div class="mb-4">
            <label for="familiarSelect" class="block text-sm font-medium text-gray-700 mb-2">Seleccionar Familiar</label>
            <div class="relative">
                <select id="familiarSelect" class="block w-full pl-3 pr-10 py-3 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md shadow-sm">
                    <option value="">-- Seleccionar un familiar --</option>
                    @foreach($familiares as $familiar)
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
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-green-50">
            <h3 class="text-lg font-semibold text-gray-800">
                <i class="fas fa-pills text-green-600 mr-2"></i>Medicamentos Activos
            </h3>
        </div>
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
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                                        <i class="fas fa-user text-green-600"></i>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $medicamento->familiar->nombre }} {{ $medicamento->familiar->apellido }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
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
                                @if($medicamento->fecha_final)
                                    <span class="text-orange-600">{{ \Carbon\Carbon::parse($medicamento->fecha_final)->format('d/m/Y') }}</span>
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

<script>
    // Script mejorado para filtrar medicamentos
    document.getElementById('familiarSelect').addEventListener('change', function () {
        const familiarId = this.value;
        const tableBody = document.getElementById('medicamentosTableBody');
        
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
                .then(response => response.json())
                .then(data => {
                    if (data.medicamentos.length === 0) {
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
                        const fechaFinal = med.fecha_final 
                            ? `<span class="text-orange-600">${new Date(med.fecha_final).toLocaleDateString()}</span>` 
                            : `<span class="text-green-600 font-medium">Tratamiento continuo</span>`;
                            
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
</script>
@endsection