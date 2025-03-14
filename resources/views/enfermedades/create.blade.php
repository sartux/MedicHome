@extends('layouts.app')

@section('header')
    <h1 class="text-2xl font-bold">Agregar Enfermedad Base</h1>
@endsection

@section('content')
<div class="container mx-auto p-4">
    <div class="bg-white p-6 rounded shadow-md">
        <form action="{{ route('enfermedades.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="nombre" class="block text-gray-700">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="border rounded w-full py-2 px-3" value="{{ old('nombre') }}" required>
                @error('nombre') <p class="text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="descripcion" class="block text-gray-700">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="border rounded w-full py-2 px-3" rows="3">{{ old('descripcion') }}</textarea>
                @error('descripcion') <p class="text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="CATA_Estado" class="block text-gray-700">Estado</label>
                <select name="CATA_Estado" id="CATA_Estado" class="border rounded w-full py-2 px-3" required>
                    <option value="">Seleccione el estado</option>
                    <!-- Aquí normalmente se cargarían los estados del catálogo -->
                    <option value="41" {{ old('CATA_Estado') == 41 ? 'selected' : '' }}>Activo</option>
                    <option value="42" {{ old('CATA_Estado') == 42 ? 'selected' : '' }}>Inactivo</option>
                </select>
                @error('CATA_Estado') <p class="text-red-500">{{ $message }}</p> @enderror
            </div>
            
            <div class="mb-4">
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Guardar</button>
                <a href="{{ route('enfermedades.index') }}" class="bg-gray-500 text-white py-2 px-4 rounded ml-2">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection