@extends('layouts.app')

@section('header')
    <h1 class="text-2xl font-bold">Listado de Medicamentos por Familiar</h1>
@endsection

@section('content')
<div class="container mx-auto p-4">
    <!-- Selector de familiares -->
    <div class="mb-4">
        <label for="familiarSelect" class="block text-sm font-medium text-gray-700">Seleccionar Familiar</label>
        <select id="familiarSelect" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
            <option value="">-- Seleccionar un familiar --</option>
            @foreach($familiares as $familiar)
                <option value="{{ $familiar->id }}">{{ $familiar->nombre }} {{ $familiar->apellido }}</option>
            @endforeach
        </select>
    </div>

    <!-- Contenedor de la tabla de medicamentos -->
    <div class="scrollable-container">
        <table class="table-auto w-full bg-white">
            <thead>
                <tr>
                    <th>Nombre y Apellido</th>
                    <th>Especialidad</th>
                    <th>Uso</th>
                    <th>Medicamento</th>
                    <th>Fecha Final</th>
                </tr>
            </thead>
            <tbody id="medicamentosTableBody">
                @forelse($medicamentos as $medicamento)
                    <tr>
                        <td>{{ $medicamento->familiar->nombre }} {{ $medicamento->familiar->apellido }}</td>
                        <td>{{ $medicamento->medicamento->especialidad->Valor1 ?? 'Sin especialidad' }}</td>
                        <td>{{ $medicamento->medicamento->uso->Valor1 ?? 'Sin uso' }}</td>
                        <td>{{ $medicamento->medicamento->Nombre }}</td>
                        <td>{{ $medicamento->fecha_final ? $medicamento->fecha_final : 'Sin fecha final' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">No hay medicamentos en curso.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
    // Escucha el cambio del select para filtrar medicamentos
    document.getElementById('familiarSelect').addEventListener('change', function () {
        const familiarId = this.value;
        if (familiarId) {
            fetchMedicamentos(familiarId);
        } else {
            // Limpia la tabla si no se selecciona un familiar
            document.getElementById('medicamentosTableBody').innerHTML = '';
        }
    });

    // Función para hacer la solicitud y actualizar la tabla
    function fetchMedicamentos(familiarId) {
        fetch(`/api/medicamentos/${familiarId}`)
            .then(response => response.json())
            .then(data => {
                let tableBody = '';
                data.medicamentos.forEach(medicamento => {
                    tableBody += `
                        <tr>
                            <td>${medicamento.familiar.nombre} ${medicamento.familiar.apellido}</td>
                            <td>${medicamento.medicamento.especialidad?.Valor1 ?? 'Sin especialidad'}</td>
                            <td>${medicamento.medicamento.uso?.Valor1 ?? 'Sin uso'}</td>
                            <td>${medicamento.medicamento.Nombre}</td>
                            <td>${medicamento.fecha_final ? new Date(medicamento.fecha_final).toLocaleDateString() : 'Sin fecha final'}</td>
                        </tr>
                    `;
                });
                document.getElementById('medicamentosTableBody').innerHTML = tableBody;
            })
            .catch(error => console.error('Error:', error));
    }
</script>
@endsection
