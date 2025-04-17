@extends('layouts.app')

@section('header')
    <h1 class="text-2xl font-bold text-white">Gestión de Familiares</h1>
@endsection

@section('content')
<div class="container mx-auto p-4">
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
        </div>
    @endif
    
    <!-- Tarjeta de acciones -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">
                <i class="fas fa-users text-green-600 mr-2"></i>Listado de Familiares
            </h2>
            <a href="{{ route('familiares.create') }}" class="bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-md flex items-center transition duration-150">
                <i class="fas fa-user-plus mr-2"></i> Agregar Familiar
            </a>
        </div>
    </div>
    
    <!-- Tabla de familiares -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr class="bg-green-600">
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Nombre</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Edad</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Tipo Sangre</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Teléfono</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Estado</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($familiares as $familiar)
                        <tr class="hover:bg-green-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $familiar->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                                        <i class="fas fa-user text-green-600"></i>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $familiar->nombre }} {{ $familiar->apellido }}</div>
                                        <div class="text-xs text-gray-500">{{ $familiar->correo }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($familiar->fecha_nacimiento)->age }} años
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($familiar->tipoSangre)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        {{ $familiar->tipoSangre->Valor1 }}
                                    </span>
                                @else
                                    <span class="text-gray-400 text-xs">No especificado</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $familiar->telefono }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($familiar->estado && $familiar->estado->Valor1 == 'Activo')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1"></i> Activo
                                    </span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        <i class="fas fa-times-circle mr-1"></i> Inactivo
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('familiares.show', $familiar) }}" class="text-blue-600 hover:text-blue-800 bg-blue-100 hover:bg-blue-200 p-2 rounded-full transition-colors">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('familiares.edit', $familiar) }}" class="text-yellow-600 hover:text-yellow-800 bg-yellow-100 hover:bg-yellow-200 p-2 rounded-full transition-colors">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('familiares.medicamentos', $familiar) }}" class="text-green-600 hover:text-green-800 bg-green-100 hover:bg-green-200 p-2 rounded-full transition-colors">
                                        <i class="fas fa-pills"></i>
                                    </a>
                                    <a href="{{ route('ordenes_medicas.indexByFamiliar', $familiar) }}" class="text-purple-600 hover:text-purple-800 bg-purple-100 hover:bg-purple-200 p-2 rounded-full transition-colors">
                                        <i class="fas fa-file-medical"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection