@extends('layouts.app')

@section('header')
    <h1 class="text-2xl font-bold">Familiares</h1>
@endsection

@section('content')
<div class="container mx-auto p-4">
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="mb-4">
        <a href="{{ route('familiares.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded">Agregar Familiar</a>
    </div>
    
    <div class="overflow-hidden bg-white shadow sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Edad</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo Sangre</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Teléfono</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($familiares as $familiar)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $familiar->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $familiar->nombre }} {{ $familiar->apellido }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($familiar->fecha_nacimiento)->age }} años</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $familiar->tipoSangre->Valor1 ?? 'No especificado' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $familiar->telefono }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $familiar->estado ? $familiar->estado->Valor1 : 'No especificado' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap flex space-x-2">
                            <a href="{{ route('familiares.show', $familiar) }}" class="btn btn-info">
                                <i class="fa-solid fa-eye"></i> Ver
                            </a>
                            <a href="{{ route('familiares.edit', $familiar) }}" class="btn btn-warning">
                                <i class="fa-solid fa-wand-magic-sparkles"></i> Editar
                            </a>
                            <a href="{{ route('familiares.medicamentos', $familiar) }}" class="btn btn-info">
                                <i class="fa-solid fa-capsules"></i> Medicamentos
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection