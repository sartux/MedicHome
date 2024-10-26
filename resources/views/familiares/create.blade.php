@extends('layouts.app')

@section('header')
    <h1 class="text-2xl font-bold">Agregar Familiar</h1>
@endsection

@section('content')
<div class="container mx-auto p-4">
    <div class="bg-white p-6 rounded shadow-md">
        <form action="{{ route('familiares.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="nombre" class="block text-gray-700">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="border rounded w-full py-2 px-3" value="{{ old('nombre') }}" required>
                @error('nombre') <p class="text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="apellido" class="block text-gray-700">Apellido</label>
                <input type="text" name="apellido" id="apellido" class="border rounded w-full py-2 px-3" value="{{ old('apellido') }}" required>
                @error('apellido') <p class="text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="fecha_nacimiento" class="block text-gray-700">Fecha de Nacimiento</label>
                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="border rounded w-full py-2 px-3" value="{{ old('fecha_nacimiento') }}" required>
                @error('fecha_nacimiento') <p class="text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="CATA_genero" class="block text-gray-700">Género</label>
                <select name="CATA_genero" id="CATA_genero" class="border rounded w-full py-2 px-3" required>
                    <option value="">Seleccione el género</option>
                    @foreach($generos as $genero)
                        <option value="{{ $genero->id }}" {{ old('CATA_genero') == $genero->id ? 'selected' : '' }}>
                            {{ $genero->Valor1 }}
                        </option>
                    @endforeach
                </select>
                @error('CATA_genero') <p class="text-red-500">{{ $message }}</p> @enderror
            </div>



            <div class="mb-4">
                <label for="correo" class="block text-gray-700">Correo</label>
                <input type="email" name="correo" id="correo" class="border rounded w-full py-2 px-3" value="{{ old('correo') }}" required>
                @error('correo') <p class="text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="telefono" class="block text-gray-700">Teléfono</label>
                <input type="text" name="telefono" id="telefono" class="border rounded w-full py-2 px-3" value="{{ old('telefono') }}" required>
                @error('telefono') <p class="text-red-500">{{ $message }}</p> @enderror
            </div>
            <div class="mb-4">
                <label for="CATA_Estado" class="block text-gray-700">Estado</label>
                <select name="CATA_Estado" id="CATA_Estado" class="border rounded w-full py-2 px-3" required>
                    <option value="">Seleccione el estado</option>
                    @foreach($estados as $estado)
                        <option value="{{ $estado->id }}" {{ old('CATA_Estado') == $estado->id ? 'selected' : '' }}>
                            {{ $estado->Valor1 }}
                        </option>
                    @endforeach
                </select>
                @error('CATA_Estado') <p class="text-red-500">{{ $message }}</p> @enderror
            </div>
            <div class="mb-4">
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Guardar</button>
            </div>
        </form>
    </div>
</div>
@endsection
