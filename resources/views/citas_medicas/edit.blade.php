@extends('layouts.app')

@section('header')
    <h1 class="text-2xl font-bold text-white">Editar Cita Médica</h1>
@endsection

@section('content')
<div class="container mx-auto p-4">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-lg font-semibold text-gray-800 mb-6">
            <i class="fas fa-calendar-alt text-green-600 mr-2"></i>Modificar Cita Médica
        </h2>
        
        <form action="{{ route('citas_medicas.update', $citasMedica->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <!-- Información de la orden médica (no editable) -->
            <div class="mb-6 bg-blue-50 border border-blue-200 rounded-md p-4">
                <h3 class="text-md font-medium text-blue-800 mb-2">Información de la Orden Médica</h3>
                <p class="mb-1"><strong>Familiar:</strong> {{ $citasMedica->ordenMedica->familiar->nombre }} {{ $citasMedica->ordenMedica->familiar->apellido }}</p>
                <p class="mb-1"><strong>Especialidad:</strong> {{ $citasMedica->ordenMedica->especialidad->Valor1 }}</p>
                <p class="mb-1"><strong>Médico:</strong> {{ $citasMedica->ordenMedica->Medico_Reseta }}</p>
                <p><strong>Procedimiento:</strong> {{ $citasMedica->ordenMedica->Procedimiento }}</p>
                
                <input type="hidden" name="OrdenMedica_id" value="{{ $citasMedica->OrdenMedica_id }}">
            </div>
            
            <!-- Fecha y Hora de la cita -->
            <div class="mb-4">
                <label for="Fecha_Hora_Cita" class="block text-gray-700 font-medium mb-2">Fecha y Hora de la Cita</label>
                <input type="datetime-local" name="Fecha_Hora_Cita" id="Fecha_Hora_Cita" 
                       value="{{ old('Fecha_Hora_Cita', \Carbon\Carbon::parse($citasMedica->Fecha_Hora_Cita)->format('Y-m-d\TH:i')) }}" 
                       class="border rounded-md w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500" required>
                @error('Fecha_Hora_Cita') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            
            <!-- Botones -->
            <div class="flex justify-end mt-6">
                <a href="{{ route('ordenes_medicas.show', $citasMedica->ordenMedica->id) }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded mr-2">
                    Cancelar
                </a>
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded">
                    <i class="fas fa-save mr-2"></i> Actualizar Cita
                </button>
            </div>
        </form>
    </div>
</div>
@endsection