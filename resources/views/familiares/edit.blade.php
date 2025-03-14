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
                <input type="text" name="nombre" id="nombre" class="border rounded w-full py-2 px-3 bg-gray-100 cursor-not-allowed" value="{{ $familiare->nombre }}" disabled>
                <input type="hidden" name="nombre" value="{{ $familiare->nombre }}">
            </div>

           <!-- Apellido (disabled) -->
           <div class="mb-4">
            <label for="apellido" class="block text-gray-700">Apellido</label>
            <input type="text" name="apellido" id="apellido" class="border rounded w-full py-2 px-3 bg-gray-100 cursor-not-allowed" value="{{ $familiare->apellido }}" disabled>
            <input type="hidden" name="apellido" value="{{ $familiare->apellido }}">
        </div>

        <!-- Fecha de Nacimiento (disabled) -->
        <div class="mb-4">
            <label for="fecha_nacimiento" class="block text-gray-700">Fecha de Nacimiento</label>
            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="border rounded w-full py-2 px-3 bg-gray-100 cursor-not-allowed" value="{{ $familiare->fecha_nacimiento }}" disabled>
            <input type="hidden" name="fecha_nacimiento" value="{{ $familiare->fecha_nacimiento }}">
            
            <!-- Mostrar la edad calculada -->
            <p class="mt-1 text-sm text-gray-600">Edad: {{ $familiare->edad }} años</p>
        </div>
        
        <!-- Tipo de Sangre (editable) -->
        <div class="mb-4">
            <label for="CATA_tipo_sangre" class="block text-gray-700">Tipo de Sangre</label>
            <select name="CATA_tipo_sangre" id="CATA_tipo_sangre" class="border rounded w-full py-2 px-3">
                <option value="">Seleccione el tipo de sangre</option>
                @foreach($tipos_sangre as $tipo)
                    <option value="{{ $tipo->Codigo }}" {{ old('CATA_tipo_sangre', $familiare->CATA_tipo_sangre) == $tipo->Codigo ? 'selected' : '' }}>
                        {{ $tipo->Valor1 }}
                    </option>
                @endforeach
            </select>
            @error('CATA_tipo_sangre') <p class="text-red-500">{{ $message }}</p> @enderror
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
        
        <!-- Contactos (editables) -->
        <div class="mb-4">
            <label for="contacto_nombre1" class="block text-gray-700">Nombre de Contacto 1</label>
            <input type="text" name="contacto_nombre1" id="contacto_nombre1" class="border rounded w-full py-2 px-3" value="{{ old('contacto_nombre1', $familiare->contacto_nombre1) }}">
            @error('contacto_nombre1') <p class="text-red-500">{{ $message }}</p> @enderror
        </div>
        
        <div class="mb-4">
            <label for="contacto_telefono1" class="block text-gray-700">Teléfono de Contacto 1</label>
            <input type="text" name="contacto_telefono1" id="contacto_telefono1" class="border rounded w-full py-2 px-3" value="{{ old('contacto_telefono1', $familiare->contacto_telefono1) }}">
            @error('contacto_telefono1') <p class="text-red-500">{{ $message }}</p> @enderror
        </div>
        
        <div class="mb-4">
            <label for="contacto_nombre2" class="block text-gray-700">Nombre de Contacto 2</label>
            <input type="text" name="contacto_nombre2" id="contacto_nombre2" class="border rounded w-full py-2 px-3" value="{{ old('contacto_nombre2', $familiare->contacto_nombre2) }}">
            @error('contacto_nombre2') <p class="text-red-500">{{ $message }}</p> @enderror
        </div>
        
        <div class="mb-4">
            <label for="contacto_telefono2" class="block text-gray-700">Teléfono de Contacto 2</label>
            <input type="text" name="contacto_telefono2" id="contacto_telefono2" class="border rounded w-full py-2 px-3" value="{{ old('contacto_telefono2', $familiare->contacto_telefono2) }}">
            @error('contacto_telefono2') <p class="text-red-500">{{ $message }}</p> @enderror
        </div>
        
        <!-- Enfermedades Base (editables) -->
        <div class="mb-4">
            <label class="block text-gray-700">Enfermedades Base</label>
            <div class="mt-2 ml-4">
                @foreach($enfermedades as $enfermedad)
                    <div class="mb-2">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="enfermedades[]" value="{{ $enfermedad->id }}" class="form-checkbox"
                                {{ (is_array(old('enfermedades', $enfermedadesSeleccionadas)) && in_array($enfermedad->id, old('enfermedades', $enfermedadesSeleccionadas))) ? 'checked' : '' }}>
                            <span class="ml-2">{{ $enfermedad->nombre }}</span>
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
        
        <!-- Alergias (editables) -->
        <div class="mb-4">
            <label class="block text-gray-700">Alergias</label>
            <div class="mt-2 ml-4">
                @foreach($alergias as $alergia)
                    <div class="mb-2">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="alergias[]" value="{{ $alergia->id }}" class="form-checkbox"
                                {{ (is_array(old('alergias', $alergiasSeleccionadas)) && in_array($alergia->id, old('alergias', $alergiasSeleccionadas))) ? 'checked' : '' }}>
                            <span class="ml-2">{{ $alergia->nombre }}</span>
                        </label>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Estado (select dropdown) -->
        <div class="mb-4">
            <label for="CATA_Estado" class="block text-gray-700">Estado</label>
            <select name="CATA_Estado" id="CATA_Estado" class="border rounded w-full py-2 px-3" required>
                <option value="">Seleccione el estado</option>
                @foreach($estados as $estado)
                    <option value="{{ $estado->id }}" {{ old('CATA_Estado', $familiare->CATA_Estado) == $estado->id ? 'selected' : '' }}>
                        {{ $estado->Valor1 }}
                    </option>
                @endforeach
            </select>
            @error('CATA_Estado') <p class="text-red-500">{{ $message }}</p> @enderror
        </div>

        <!-- Botones de acción -->
        <div class="mb-4">
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Actualizar</button>
            <a href="{{ route('familiares.index') }}" class="bg-gray-500 text-white py-2 px-4 rounded ml-2">Cancelar</a>
        </div>
    </form>
</div>
</div>
@endsection