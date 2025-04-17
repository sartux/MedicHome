@extends('layouts.app')

@section('header')
    <h1 class="text-2xl font-bold text-white">Crear Núcleo Familiar</h1>
@endsection

@section('content')
<div class="container mx-auto p-4">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-lg font-semibold text-gray-800 mb-6">
            <i class="fas fa-users-cog text-indigo-600 mr-2"></i>Nuevo Núcleo Familiar
        </h2>
        
        <form action="{{ route('nucleo_familiares.store') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Código -->
                <div class="mb-4">
                    <label for="codigo" class="block text-gray-700 font-medium mb-2">Código</label>
                    <input type="text" name="codigo" id="codigo" value="{{ old('codigo') }}" 
                           class="border rounded-md w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                           placeholder="Ej: AR01" required>
                    @error('codigo') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Nombre -->
                <div class="mb-4">
                    <label for="nombre" class="block text-gray-700 font-medium mb-2">Nombre</label>
                    <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" 
                           class="border rounded-md w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                           placeholder="Nombre del núcleo familiar" required>
                    @error('nombre') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                
                <!-- Cantidad de Familiares -->
                <div class="mb-4">
                    <label for="cant_familiares" class="block text-gray-700 font-medium mb-2">Cantidad de Familiares</label>
                    <input type="number" name="cant_familiares" id="cant_familiares" value="{{ old('cant_familiares', 1) }}" 
                           class="border rounded-md w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                           min="1" required>
                    @error('cant_familiares') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                
                <!-- Fecha de Creación -->
                <div class="mb-4">
                    <label for="fecha_crea" class="block text-gray-700 font-medium mb-2">Fecha de Creación</label>
                    <input type="date" name="fecha_crea" id="fecha_crea" value="{{ old('fecha_crea', date('Y-m-d')) }}" 
                           class="border rounded-md w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                    @error('fecha_crea') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                
                <!-- Fecha de Cierre (opcional) -->
                <div class="mb-4">
                    <label for="fecha_cierre" class="block text-gray-700 font-medium mb-2">Fecha de Cierre (opcional)</label>
                    <input type="date" name="fecha_cierre" id="fecha_cierre" value="{{ old('fecha_cierre') }}" 
                           class="border rounded-md w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @error('fecha_cierre') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                
                <!-- Estado -->
                <div class="mb-4">
                    <label for="CATA_Estado" class="block text-gray-700 font-medium mb-2">Estado</label>
                    <select name="CATA_Estado" id="CATA_Estado" class="border rounded-md w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                        <option value="">Seleccione el estado</option>
                        @foreach($estados as $estado)
                            <option value="{{ $estado->Codigo }}" {{ old('CATA_Estado', 41) == $estado->Codigo ? 'selected' : '' }}>
                                {{ $estado->Valor1 }}
                            </option>
                        @endforeach
                    </select>
                    @error('CATA_Estado') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
            
            <div class="mt-6 border-t border-gray-200 pt-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Información del Administrador</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nombre del Administrador -->
                    <div class="mb-4">
                        <label for="admin_name" class="block text-gray-700 font-medium mb-2">Nombre del Administrador</label>
                        <input type="text" name="admin_name" id="admin_name" value="{{ old('admin_name') }}" 
                               class="border rounded-md w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                               required>
                        @error('admin_name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                    
                    <!-- Email del Administrador -->
                    <div class="mb-4">
                        <label for="admin_email" class="block text-gray-700 font-medium mb-2">Email del Administrador</label>
                        <input type="email" name="admin_email" id="admin_email" value="{{ old('admin_email') }}" 
                               class="border rounded-md w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                               required>
                        @error('admin_email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                    
                    <!-- Contraseña del Administrador -->
                    <div class="mb-4">
                        <label for="admin_password" class="block text-gray-700 font-medium mb-2">Contraseña del Administrador</label>
                        <input type="password" name="admin_password" id="admin_password" 
                               class="border rounded-md w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                               required>
                        @error('admin_password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>
            
            <!-- Botones -->
            <div class="flex justify-end mt-6">
                <a href="{{ route('nucleo_familiares.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded mr-2">
                    Cancelar
                </a>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded">
                    <i class="fas fa-save mr-2"></i> Guardar Núcleo Familiar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection