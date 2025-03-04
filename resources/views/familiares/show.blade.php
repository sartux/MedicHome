@extends('layouts.app')

@section('header')
    <h1 class="text-2xl font-bold">Detalles del Familiar</h1>
@endsection

@section('content')
<div class="container mx-auto p-4">
    <div class="bg-white p-6 rounded shadow-md">
        <!-- Información básica -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-4">Información Personal</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-gray-700"><span class="font-semibold">Nombre:</span> {{ $familiar->nombre }}</p>
                    <p class="text-gray-700"><span class="font-semibold">Apellido:</span> {{ $familiar->apellido }}</p>
                    <p class="text-gray-700"><span class="font-semibold">Fecha de Nacimiento:</span> {{ $familiar->fecha_nacimiento }}</p>
                    <p class="text-gray-700"><span class="font-semibold">Edad:</span> {{ $familiar->edad }} años</p>
                    <p class="text-gray-700"><span class="font-semibold">Género:</span> {{ $familiar->genero->Valor1 ?? 'No especificado' }}</p>
                </div>
                <div>
                    <p class="text-gray-700"><span class="font-semibold">Tipo de Sangre:</span> {{ $familiar->tipoSangre->Valor1 ?? 'No especificado' }}</p>
                    <p class="text-gray-700"><span class="font-semibold">Correo:</span> {{ $familiar->correo }}</p>
                    <p class="text-gray-700"><span class="font-semibold">Teléfono:</span> {{ $familiar->telefono }}</p>
                    <p class="text-gray-700"><span class="font-semibold">Estado:</span> {{ $familiar->estado->Valor1 ?? 'No especificado' }}</p>
                </div>
            </div>
        </div>
        
        <!-- Contactos de emergencia -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-4">Contactos de Emergencia</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @if($familiar->contacto_nombre1 || $familiar->contacto_telefono1)
                <div class="border p-4 rounded">
                    <h3 class="font-semibold">Contacto 1:</h3>
                    <p>{{ $familiar->contacto_nombre1 ?? 'No especificado' }}</p>
                    <p>{{ $familiar->contacto_telefono1 ?? 'No especificado' }}</p>
                </div>
                @endif
                
                @if($familiar->contacto_nombre2 || $familiar->contacto_telefono2)
                <div class="border p-4 rounded">
                    <h3 class="font-semibold">Contacto 2:</h3>
                    <p>{{ $familiar->contacto_nombre2 ?? 'No especificado' }}</p>
                    <p>{{ $familiar->contacto_telefono2 ?? 'No especificado' }}</p>
                </div>
                @endif
                
                @if(!$familiar->contacto_nombre1 && !$familiar->contacto_telefono1 && !$familiar->contacto_nombre2 && !$familiar->contacto_telefono2)
                <p class="text-gray-500 italic">No hay contactos de emergencia registrados</p>
                @endif
            </div>
        </div>
        
        <!-- Enfermedades -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-4">Enfermedades Base</h2>
            
            @if($familiar->enfermedades->count() > 0)
                <ul class="list-disc list-inside">
                    @foreach($familiar->enfermedades as $enfermedad)
                        <li class="mb-2">
                            <span class="font-medium">{{ $enfermedad->nombre }}</span>
                            @if($enfermedad->pivot->notas)
                                <p class="ml-6 text-gray-600 text-sm">{{ $enfermedad->pivot->notas }}</p>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500 italic">No hay enfermedades base registradas</p>
            @endif
        </div>
        
        <!-- Alergias -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-4">Alergias</h2>
            
            @if($familiar->alergias->count() > 0)
                <ul class="list-disc list-inside">
                    @foreach($familiar->alergias as $alergia)
                        <li class="mb-2">
                            <span class="font-medium">{{ $alergia->nombre }}</span>
                            @if($alergia->pivot->notas)
                                <p class="ml-6 text-gray-600 text-sm">{{ $alergia->pivot->notas }}</p>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500 italic">No hay alergias registradas</p>
            @endif
        </div>
        
        <!-- Botones de acción -->
        <div class="flex space-x-4">
            <a href="{{ route('familiares.edit', $familiar) }}" class="bg-blue-500 text-white py-2 px-4 rounded">Editar</a>
            <a href="{{ route('familiares.index') }}" class="bg-gray-500 text-white py-2 px-4 rounded">Volver</a>
            <a href="{{ route('familiares.medicamentos', $familiar) }}" class="bg-green-500 text-white py-2 px-4 rounded">Ver Medicamentos</a>
        </div>
    </div>
</div>
@endsection