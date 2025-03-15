@extends('layouts.app')

@section('header')
    <h1 class="text-2xl font-bold text-white">Agregar Medicamento</h1>
@endsection

@section('content')
<div class="container mx-auto p-4">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-lg font-semibold text-gray-800 mb-6">
            <i class="fas fa-pills text-green-600 mr-2"></i>Nuevo Tratamiento
        </h2>
        
        <form action="{{ route('historial_medicamentos.store') }}" method="POST">
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

                <!-- Medicamento -->
                <div class="mb-4">
                    <label for="medicamento_id" class="block text-gray-700 font-medium mb-2">Medicamento</label>
                    <select name="medicamento_id" id="medicamento_id" class="border rounded-md w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500" required>
                        <option value="">Seleccione un medicamento</option>
                        @foreach($medicamentos as $medicamento)
                            <option value="{{ $medicamento->id }}">
                                {{ $medicamento->Nombre }} ({{ $medicamento->Composicion }})
                            </option>
                        @endforeach
                    </select>
                    @error('medicamento_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                
                <!-- Dosis -->
                <div class="mb-4">
                    <label for="dosis" class="block text-gray-700 font-medium mb-2">Dosis</label>
                    <input type="text" name="dosis" id="dosis" value="{{ old('dosis') }}" 
                           class="border rounded-md w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500"
                           placeholder="Ej: 1 tableta cada 8 horas" required>
                    @error('dosis') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                
                <!-- Estado -->
                <div class="mb-4">
                    <label for="CATA_Estado" class="block text-gray-700 font-medium mb-2">Estado</label>
                    <select name="CATA_Estado" id="CATA_Estado" class="border rounded-md w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500" required>
                        <option value="">Seleccione el estado</option>
                        @foreach($estados as $estado)
                            <option value="{{ $estado->Codigo }}">{{ $estado->Valor1 }}</option>
                        @endforeach
                    </select>
                    @error('CATA_Estado') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                
                <!-- Fecha inicio -->
                <div class="mb-4">
                    <label for="fecha_inicio" class="block text-gray-700 font-medium mb-2">Fecha de Inicio</label>
                    <input type="date" name="fecha_inicio" id="fecha_inicio" value="{{ old('fecha_inicio', date('Y-m-d')) }}" 
                           class="border rounded-md w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500" required>
                    @error('fecha_inicio') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                
                <!-- Fecha final -->
                <div class="mb-4">
                    <label for="fecha_final" class="block text-gray-700 font-medium mb-2">Fecha Final (opcional)</label>
                    <input type="date" name="fecha_final" id="fecha_final" value="{{ old('fecha_final') }}" 
                           class="border rounded-md w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                    <p class="text-sm text-gray-500 mt-1">Dejar en blanco si el tratamiento es continuo</p>
                    @error('fecha_final') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
            
            <!-- Descripción del tratamiento -->
            <div class="mb-4">
                <label for="descripcion_tratamiento" class="block text-gray-700 font-medium mb-2">Descripción del Tratamiento</label>
                <textarea name="descripcion_tratamiento" id="descripcion_tratamiento" rows="4" 
                          class="border rounded-md w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500"
                          placeholder="Detalles del tratamiento, instrucciones especiales, etc." required>{{ old('descripcion_tratamiento') }}</textarea>
                @error('descripcion_tratamiento') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            
            <!-- Botones -->
            <div class="flex justify-end mt-6">
                <a href="{{ url()->previous() }}" class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded mr-2">
                    Cancelar
                </a>
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded">
                    <i class="fas fa-save mr-2"></i> Guardar Medicamento
                </button>
            </div>
        </form>
    </div>
</div>
@endsection