<!-- Archivo: resources/views/nucleo_familiares/create.blade.php -->

@extends('layouts.app')

@section('header')
    <h1 class="text-2xl font-bold text-white">Crear Núcleo Familiar</h1>
@endsection

@section('content')
<div class="container mx-auto p-4">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-lg font-semibold text-gray-800 mb-6">
            <i class="fas fa-home text-green-600 mr-2"></i>Nuevo Núcleo Familiar
        </h2>
        
        <form action="{{ route('nucleo_familiares.store') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Código -->
                <div class="mb-4">
                    <label for="codigo" class="block text-gray-700 font-medium mb-2">Código</label>
                    <input type="text" name="codigo" id="codigo" value="{{ old('codigo') }}" 
                           class="border rounded-md w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500"
                           placeholder="Ej: AR01" required>
                    @error('codigo') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                
                <!-- Nombre -->
                <div class="mb-4">
                    <label for="nombre" class="block text-gray-700 font-medium mb-2">Nombre</label>
                    <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" 
                           class="border rounded-md w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500"
                           placeholder="Nombre del núcleo familiar" required>
                    @error('nombre') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                
                <!-- Cantidad de Familiares -->
                <div class="mb-4">
                    <label for="cant_familiares" class="block text-gray-700 font-medium mb-2">Cantidad de Familiares</label>
                    <input type="number" name="cant_familiares" id="cant_familiares" value="{{ old('cant_familiares', 1) }}" min="1" 
                           class="border rounded-md w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500" required>
                    @error('cant_familiares') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                
                <!-- Fecha de Creación -->
                <div class="mb-4">
                    <label for="fecha_crea" class="block text-gray-700 font-medium mb-2">Fecha de Creación</label>
                    <input type="date" name="fecha_crea" id="fecha_crea" value="{{ old('fecha_crea', date('Y-m-d')) }}" 
                           class="border rounded-md w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500" required>
                    @error('fecha_crea') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
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
            
            <!-- Usuario Administrador del Núcleo -->
            <div class="mt-8 mb-6 border-t border-gray-200 pt-4">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Datos del Administrador del Núcleo</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nombre del Admin -->
                    <div class="mb-4">
                        <label for="admin_name" class="block text-gray-700 font-medium mb-2">Nombre</label>
                        <input type="text" name="admin_name" id="admin_name" value="{{ old('admin_name') }}" 
                               class="border rounded-md w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500"
                               placeholder="Nombre del administrador" required>
                        @error('admin_name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                    
                    <!-- Email del Admin -->
                    <div class="mb-4">
                        <label for="admin_email" class="block text-gray-700 font-medium mb-2">Correo Electrónico</label>
                        <input type="email" name="admin_email" id="admin_email" value="{{ old('admin_email') }}" 
                               class="border rounded-md w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500"
                               placeholder="correo@ejemplo.com" required>
                        @error('admin_email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                    
                    <!-- Password del Admin -->
                    <div class="mb-4">
                        <label for="admin_password" class="block text-gray-700 font-medium mb-2">Contraseña</label>
                        <input type="password" name="admin_password" id="admin_password" 
                               class="border rounded-md w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500"
                               placeholder="Mínimo 8 caracteres" required>
                        @error('admin_password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>
            
            <!-- Botones -->
            <div class="flex justify-end mt-6">
                <a href="{{ route('nucleo_familiares.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded mr-2">
                    Cancelar
                </a>
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded">
                    <i class="fas fa-save mr-2"></i> Guardar Núcleo Familiar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection