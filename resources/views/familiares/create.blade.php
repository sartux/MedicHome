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
                <label for="CATA_tipo_sangre" class="block text-gray-700">Tipo de Sangre</label>
                <select name="CATA_tipo_sangre" id="CATA_tipo_sangre" class="border rounded w-full py-2 px-3">
                    <option value="">Seleccione el tipo de sangre</option>
                    @foreach($tipos_sangre as $tipo)
                        <option value="{{ $tipo->id }}" {{ old('CATA_tipo_sangre') == $tipo->id ? 'selected' : '' }}>
                            {{ $tipo->Valor1 }}
                        </option>
                    @endforeach
                </select>
                @error('CATA_tipo_sangre') <p class="text-red-500">{{ $message }}</p> @enderror
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
                <label for="contacto_nombre1" class="block text-gray-700">Nombre de Contacto 1</label>
                <input type="text" name="contacto_nombre1" id="contacto_nombre1" class="border rounded w-full py-2 px-3" value="{{ old('contacto_nombre1') }}">
                @error('contacto_nombre1') <p class="text-red-500">{{ $message }}</p> @enderror
            </div>
            
            <div class="mb-4">
                <label for="contacto_telefono1" class="block text-gray-700">Teléfono de Contacto 1</label>
                <input type="text" name="contacto_telefono1" id="contacto_telefono1" class="border rounded w-full py-2 px-3" value="{{ old('contacto_telefono1') }}">
                @error('contacto_telefono1') <p class="text-red-500">{{ $message }}</p> @enderror
            </div>
            
            <div class="mb-4">
                <label for="contacto_nombre2" class="block text-gray-700">Nombre de Contacto 2</label>
                <input type="text" name="contacto_nombre2" id="contacto_nombre2" class="border rounded w-full py-2 px-3" value="{{ old('contacto_nombre2') }}">
                @error('contacto_nombre2') <p class="text-red-500">{{ $message }}</p> @enderror
            </div>
            
            <div class="mb-4">
                <label for="contacto_telefono2" class="block text-gray-700">Teléfono de Contacto 2</label>
                <input type="text" name="contacto_telefono2" id="contacto_telefono2" class="border rounded w-full py-2 px-3" value="{{ old('contacto_telefono2') }}">
                @error('contacto_telefono2') <p class="text-red-500">{{ $message }}</p> @enderror
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700">Enfermedades Base</label>
                <div class="mt-2 ml-4">
                    @foreach($enfermedades as $enfermedad)
                        <div class="mb-2">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="enfermedades[]" value="{{ $enfermedad->id }}" class="form-checkbox"
                                    {{ (is_array(old('enfermedades')) && in_array($enfermedad->id, old('enfermedades'))) ? 'checked' : '' }}>
                                <span class="ml-2">{{ $enfermedad->nombre }}</span>
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700">Alergias</label>
                <div class="mt-2 ml-4">
                    @foreach($alergias as $alergia)
                        <div class="mb-2">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="alergias[]" value="{{ $alergia->id }}" class="form-checkbox"
                                    {{ (is_array(old('alergias')) && in_array($alergia->id, old('alergias'))) ? 'checked' : '' }}>
                                <span class="ml-2">{{ $alergia->nombre }}</span>
                            </label>
                        </div>
                    @endforeach
                </div>
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
                <a href="{{ route('familiares.index') }}" class="bg-gray-500 text-white py-2 px-4 rounded ml-2">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection