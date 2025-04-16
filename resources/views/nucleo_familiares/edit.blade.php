<!-- Archivo: resources/views/nucleo_familiares/edit.blade.php -->

@extends('layouts.app')

@section('header')
    <h1 class="text-2xl font-bold text-white">Editar Núcleo Familiar</h1>
@endsection

@section('content')
<div class="container mx-auto p-4">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-lg font-semibold text-gray-800 mb-6">
            <i class="fas fa-home text-green-600 mr-2"></i>Editar Núcleo Familiar
        </h2>
        
        <form action="{{ route('nucleo_familiares.update', $nucleoFamiliar->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Código -->
                <div class="mb-4">
                    <label for="codigo" class="block text-gray-700 font-medium mb-2">Código</label>
                    <input type="text" name="codigo" id="codigo" value="{{ old('codigo', $nucleoFamiliar->codigo) }}" 
                           class="border rounded-md w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500"
                           placeholder="Ej: AR01" required>
                    @error('codigo') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                
                <!-- Nombre -->
                <div class="mb-4">
                    <label for="nombre" class="block text-gray-700 font-medium mb-2">Nombre</label>
                    <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $nucleoFamiliar->nombre) }}" 
                           class="border rounded-md w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500"
                           placeholder="Nombre del núcleo familiar" required>
                    @error('nombre') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                
                <!-- Cantidad de Familiares -->
                <div class="mb-4">
                    <label for="cant_familiares" class="block text-gray-700 font-medium mb-2">Cantidad de Familiares</label>
                    <input type="number" name="cant_familiares" id="cant_familiares" value="{{ old('cant_familiares', $nucleoFamiliar->cant_familiares) }}" min="1" 
                           class="border rounded-md w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500" required>
                    <p class="text-sm text-gray-500 mt-1">Actualmente registrados: {{ $nucleoFamiliar->totalFamiliares() }}</p>
                    @error('cant_familiares') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                
                <!-- Fecha de Creación -->
                <div class="mb-4">
                    <label for="fecha_crea" class="block text-gray-700 font-medium mb-2">Fecha de Creación</label>
                    <input type="date" name="fecha_crea" id="fecha_crea" value="{{ old('fecha_crea', $nucleoFamiliar->fecha_crea->format('Y-m-d')) }}" 
                           class="border rounded-md w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500" required>
                    @error('fecha_crea') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                
                <!-- Fecha de Cierre -->
                <div class="mb-4">
                    <label for="fecha_cierre" class="block text-gray-700 font-medium mb-2">Fecha de Cierre</label>
                    <input type="date" name="fecha_cierre" id="fecha_cierre" value="{{ old('fecha_cierre', $nucleoFamiliar->fecha_cierre ? $nucleoFamiliar->fecha_cierre->format('Y-m-d') : '') }}" 
                           class="border rounded-md w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                    <p class="text-sm text-gray-500 mt-1">Dejar en blanco si el núcleo sigue activo</p>
                    @error('fecha_cierre') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                
                <!-- Estado -->
                <div class="mb-4">
                    <label for="CATA_Estado" class="block text-gray-700 font-medium mb-2">Estado</label>
                    <select name="CATA_Estado" id="CATA_Estado" class="border rounded-md w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500" required>
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
            
            <!-- Información del Administrador (solo se muestra, no se puede editar) -->
            @if($adminUser)
            <div class="mt-8 mb-6 border-t border-gray-200 pt-4">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Información del Administrador</h3>
                
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="mb-2"><strong>Nombre:</strong> {{ $adminUser->name }}</p>
                    <p class="mb-2"><strong>Correo:</strong> {{ $adminUser->email }}</p>
                    <p class="mb-2"><strong>Fecha de registro:</strong> {{ $adminUser->created_at->format('d/m/Y') }}</p>
                </div>
            </div>
            @endif
            
            <!-- Botones -->
            <div class="flex justify-end mt-6">
                <a href="{{ route('nucleo_familiares.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded mr-2">
                    Cancelar
                </a>
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded">
                    <i class="fas fa-save mr-2"></i> Actualizar Núcleo Familiar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection