@extends('layouts.app')

@section('header')
    <h1 class="text-2xl font-bold text-white">Nueva Orden Médica</h1>
@endsection

@section('content')
<div class="container mx-auto p-4">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-lg font-semibold text-gray-800 mb-6">
            <i class="fas fa-file-medical text-green-600 mr-2"></i>Crear Orden Médica
        </h2>
        
        <form action="{{ route('ordenes_medicas.store') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Familiar -->
                <div class="mb-4">
                    <label for="Familiar_id" class="block text-gray-700 font-medium mb-2">Familiar</label>
                    <select name="Familiar_id" id="Familiar_id" class="border rounded-md w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500" required>
                        <option value="">Seleccione un familiar</option>
                        @foreach($familiares as $familiar)
                            <option value="{{ $familiar->id }}" {{ request('familiar_id') == $familiar->id ? 'selected' : '' }}>
                                {{ $familiar->nombre }} {{ $familiar->apellido }}
                            </option>
                        @endforeach
                    </select>
                    @error('Familiar_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Especialidad -->
                <div class="mb-4">
                    <label for="CATA_Especialidad" class="block text-gray-700 font-medium mb-2">Especialidad</label>
                    <select name="CATA_Especialidad" id="CATA_Especialidad" class="border rounded-md w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500" required>
                        <option value="">Seleccione una especialidad</option>
                        @foreach($especialidades as $especialidad)
                            <option value="{{ $especialidad->Codigo }}" {{ old('CATA_Especialidad') == $especialidad->Codigo ? 'selected' : '' }}>
                                {{ $especialidad->Valor1 }}
                            </option>
                        @endforeach
                    </select>
                    @error('CATA_Especialidad') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                
                <!-- Procedimiento -->
                <div class="mb-4">
                    <label for="Procedimiento" class="block text-gray-700 font-medium mb-2">Procedimiento</label>
                    <input type="text" name="Procedimiento" id="Procedimiento" value="{{ old('Procedimiento') }}" 
                           class="border rounded-md w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500"
                           placeholder="Ej: Consulta, Examen, Terapia, etc." required>
                    @error('Procedimiento') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                
                <!-- Fecha de la Receta -->
                <div class="mb-4">
                    <label for="Fecha_Resetada" class="block text-gray-700 font-medium mb-2">Fecha de la Receta</label>
                    <input type="date" name="Fecha_Resetada" id="Fecha_Resetada" value="{{ old('Fecha_Resetada', date('Y-m-d')) }}" 
                           class="border rounded-md w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500" required>
                    @error('Fecha_Resetada') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                
                <!-- Médico que Receta -->
                <div class="mb-4">
                    <label for="Medico_Reseta" class="block text-gray-700 font-medium mb-2">Médico que Receta</label>
                    <input type="text" name="Medico_Reseta" id="Medico_Reseta" value="{{ old('Medico_Reseta') }}" 
                           class="border rounded-md w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500"
                           placeholder="Nombre completo del médico" required>
                    @error('Medico_Reseta') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                
                <!-- Centro Médico -->
                <div class="mb-4">
                    <label for="Centro_Medico" class="block text-gray-700 font-medium mb-2">Centro Médico</label>
                    <input type="text" name="Centro_Medico" id="Centro_Medico" value="{{ old('Centro_Medico') }}" 
                           class="border rounded-md w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500"
                           placeholder="Ej: Hospital, Clínica, Centro de salud" required>
                    @error('Centro_Medico') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                
                <!-- Ciudad -->
                <div class="mb-4">
                    <label for="Ciudad" class="block text-gray-700 font-medium mb-2">Ciudad</label>
                    <input type="text" name="Ciudad" id="Ciudad" value="{{ old('Ciudad') }}" 
                           class="border rounded-md w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500"
                           placeholder="Ciudad donde se emitió la orden" required>
                    @error('Ciudad') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                
                <!-- Estado -->
                <div class="mb-4">
                    <label for="CATA_Estado" class="block text-gray-700 font-medium mb-2">Estado</label>
                    <select name="CATA_Estado" id="CATA_Estado" class="border rounded-md w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500" required>
                        <option value="">Seleccione el estado</option>
                        @foreach($estados as $estado)
                            <option value="{{ $estado->Codigo }}" {{ old('CATA_Estado') == $estado->Codigo ? 'selected' : '' }}>
                                {{ $estado->Valor1 }}
                            </option>
                        @endforeach
                    </select>
                    @error('CATA_Estado') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
            
            <!-- Pre-requisitos -->
            <div class="mb-4">
                <label for="Pre_requisitos" class="block text-gray-700 font-medium mb-2">Pre-requisitos (opcional)</label>
                <textarea name="Pre_requisitos" id="Pre_requisitos" rows="3" 
                          class="border rounded-md w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500"
                          placeholder="Pre-requisitos para el procedimiento">{{ old('Pre_requisitos') }}</textarea>
                @error('Pre_requisitos') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            
            <!-- Observaciones -->
            <div class="mb-4">
                <label for="Observaciones" class="block text-gray-700 font-medium mb-2">Observaciones</label>
                <textarea name="Observaciones" id="Observaciones" rows="3" 
                          class="border rounded-md w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500"
                          placeholder="Observaciones importantes sobre la orden médica" required>{{ old('Observaciones') }}</textarea>
                @error('Observaciones') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            
            <!-- Botones -->
            <div class="flex justify-end mt-6">
                <a href="{{ route('ordenes_medicas.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded mr-2">
                    Cancelar
                </a>
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded">
                    <i class="fas fa-save mr-2"></i> Guardar Orden
                </button>
            </div>
        </form>
    </div>
</div>
@endsection