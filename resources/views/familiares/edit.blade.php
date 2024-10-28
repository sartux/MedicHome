@extends('layouts.app')

@section('header')
    <h1 class="text-2xl font-bold">Editar Familiar</h1>
@endsection

@section('content')
<div class="container mx-auto p-4">
    <div class="bg-white p-6 rounded shadow-md">
        <form action="{{ route('familiares.update', $familiare->id) }}" method="POST">
            @csrf
            @method('PUT')

        <!-- Nombre (disabled) -->
        <div class="mb-4">
            <label for="nombre" class="block text-gray-700">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="border rounded w-full py-2 px-3 bg-gray-400 cursor-not-allowed opacity-50" value="{{ $familiare->nombre }}" disabled required>
            <input type="hidden" name="nombre" value="{{ $familiare->nombre }}">
        </div>

            <!-- Apellido (disabled) -->
            <div class="mb-4">
                <label for="apellido" class="block text-gray-700">Apellido</label>
                <input type="text" name="apellido" id="apellido" class="border rounded w-full py-2 px-3 bg-gray-400 cursor-not-allowed opacity-50" value="{{ $familiare->apellido }}" disabled required>
                <input type="hidden" name="apellido" value="{{ $familiare->apellido }}">
            </div>

            <!-- Fecha de Nacimiento (disabled) -->
            <div class="mb-4">
                <label for="fecha_nacimiento" class="block text-gray-700">Fecha de Nacimiento</label>
                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="border rounded w-full py-2 px-3  bg-gray-400 cursor-not-allowed opacity-50" value="{{ $familiare->fecha_nacimiento }}" disabled required>
            </div>

            <!-- Correo (editable) -->
            <div class="mb-4">
                <label for="correo" class="block text-gray-700">Correo</label>
                <input type="email" name="correo" id="correo" class="border rounded w-full py-2 px-3" value="{{ old('correo', $familiare->correo) }}" required>
                @error('correo') <p class="text-red-500">{{ $message }}</p> @enderror
            </div>

            <!-- Teléfono (editable) -->
            <div class="mb-4">
                <label for="telefono" class="block text-gray-700">Teléfono</label>
                <input type="text" name="telefono" id="telefono" class="border rounded w-full py-2 px-3" value="{{ old('telefono', $familiare->telefono) }}" required>
                @error('telefono') <p class="text-red-500">{{ $message }}</p> @enderror
            </div>

            <!-- Estado (select dropdown) -->
            <div class="mb-4">
                <label for="CATA_Estado" class="block text-gray-700">Estado</label>
                <select name="CATA_Estado" id="CATA_Estado" class="border rounded w-full py-2 px-3" required>
                    <option value="">Seleccione el estado</option>
                    @foreach($estados as $estado)
                        <option value="{{ $estado->id }}" 
                            option value="{{ $estado->Codigo }}" {{ old('CATA_Estado', $familiare->CATA_Estado) == $estado->Codigo ? 'selected' : '' }}>
                            {{ $estado->Valor1 }}
                        </option>
                    @endforeach
                </select>
                @error('CATA_Estado') 
                    <p class="text-red-500">{{ $message }}</p> 
                @enderror
            </div>


            <!-- Botón de actualización -->
            <div class="mb-4">
                <button type="submit" class="bg-blue-500 text-black py-2 px-4 rounded">Actualizar</button>
            </div>
        </form>
    </div>
</div>
@endsection
