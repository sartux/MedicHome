@extends('layouts.app')

@section('header')
    <h1 class="text-2xl font-bold text-white">Editar Núcleo Familiar</h1>
@endsection

@section('content')
<div class="container mx-auto p-4">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-lg font-semibold text-gray-800 mb-6">
            <i class="fas fa-users-cog text-indigo-600 mr-2"></i>Editar Núcleo Familiar: {{ $nucleoFamiliar->nombre }}
        </h2>
        
        <form action="{{ route('nucleo_familiares.update', $nucleoFamiliar) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Código -->
                <div class="mb-4">
                    <label for="codigo" class="block text-gray-700 font-medium mb-2">Código</label>
                    <input type="text" name="codigo" id="codigo" value="{{ old('codigo', $nucleoFamiliar->codigo) }}" 
                           class="border rounded-md w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                           placeholder="Ej: AR01" required>
                    @error('codigo') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Nombre -->
                <div class="mb-4">
                    <label for="nombre" class="block text-gray-700 font-medium mb-2">Nombre</label>
                    <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $nucleoFamiliar->nombre) }}" 
                           class="border rounded-md w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                           placeholder="Nombre del núcleo familiar" required>
                    @error('nombre') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                
                <!-- Cantidad de Familiares -->
                <div class="mb-4">
                    <label for="cant_familiares" class="block text-gray-700 font-medium mb-2">Cantidad de Familiares</label>
                    <input type="number" name="cant_familiares" id="cant_familiares" value="{{ old('cant_familiares', $nucleoFamiliar->cant_familiares) }}" 
                           class="border rounded-md w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                           min="1" required>
                    <p class="text-sm text-gray-500 mt-1">Nota: El número no puede ser menor que el número actual de familiares ({{ $nucleoFamiliar->familiares->count() }}).</p>
                    @error('cant_familiares') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                
                <!-- Fecha de Creación -->
                <div class="mb-4">
                    <label for="fecha_crea" class="block text-gray-700 font-medium mb-2">Fecha de Creación</label>
                    <input type="date" name="fecha_crea" id="fecha_crea" value="{{ old('fecha_crea', $nucleoFamiliar->fecha_crea->format('Y-m-d')) }}" 
                           class="border rounded-md w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                    @error('fecha_crea') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                
                <!-- Fecha de Cierre (opcional) -->
                <div class="mb-4">
                    <label for="fecha_cierre" class="block text-gray-700 font-medium mb-2">Fecha de Cierre (opcional)</label>
                    <input type="date" name="fecha_cierre" id="fecha_cierre" value="{{ old('fecha_cierre', $nucleoFamiliar->fecha_cierre ? $nucleoFamiliar->fecha_cierre->format('Y-m-d') : null) }}" 
                           class="border rounded-md w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @error('fecha_cierre') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                
                <!-- Estado -->
                <div class="mb-4">
                    <label for="CATA_Estado" class="block text-gray-700 font-medium mb-2">Estado</label>
                    <select name="CATA_Estado" id="CATA_Estado" class="border rounded-md w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                        <option value="">Seleccione el estado</option>
                        @foreach($estados as $estado)
                            <option value="{{ $estado->Codigo }}" {{ old('CATA_Estado', $nucleoFamiliar->CATA_Estado) == $estado->Codigo ? 'selected' : '' }}>
                                {{ $estado->Valor1 }}
                            </option>
                        @endforeach
                    </select>
                    @error('CATA_Estado') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
            
            <!-- Botones -->
            <div class="flex justify-end mt-6">
                <a href="{{ route('nucleo_familiares.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded mr-2">
                    Cancelar
                </a>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded">
                    <i class="fas fa-save mr-2"></i> Actualizar Núcleo Familiar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection