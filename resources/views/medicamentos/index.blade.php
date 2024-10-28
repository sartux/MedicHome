<!-- resources/views/medicamentos/index.blade.php -->

@extends('layouts.app')

@section('header')
    <h1 class="text-2xl font-bold">Medicamentos</h1>
@endsection

@section('content')
<div class="container mx-auto p-4">
    <a href="{{ route('medicamentos.create') }}" class="btn btn-primary mb-4">Agregar Medicamento</a>
    
    @if (session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-hidden bg-white shadow sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Composición</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($medicamentos as $medicamento)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $medicamento->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $medicamento->Nombre }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $medicamento->Composicion }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $medicamento->estado ? $medicamento->estado->Valor1 : 'No especificado' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ route('medicamentos.edit', $medicamento->id) }}" class="btn btn-warning">
                                <i class="fa-solid fa-wand-magic-sparkles"></i> Editar
                            </a>
                            <form action="{{ route('medicamentos.destroy', $medicamento->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa-solid fa-trash"></i> Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
