@extends('layouts.app')

@section('header')
    <h1 class="text-2xl font-bold">Editar Medicamento</h1>
@endsection

@section('content')
<div class="container mx-auto p-4">
    <div class="bg-white p-6 rounded shadow-md">
    <h1>Editar Medicamento</h1>

    <form action="{{ route('medicamentos.update', $medicamento->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="Nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="Nombre" value="{{ $medicamento->Nombre }}" required>
        </div>
        <div class="mb-4">
            <label for="Composicion" class="form-label">Composición</label>
            <input type="text" class="form-control" name="Composicion" value="{{ $medicamento->Composicion }}" required>
        </div>

        <!-- Presentacion del medicamento (select dropdown) -->
        <div class="mb-4">
            <label for="CATA_presentacion" class="block text-gray-700">Presentación del medicamento</label>
            <select name="CATA_presentacion" id="CATA_presentacion" class="border rounded w-full py-2 px-3" required>
                <option value="">Seleccione la presentacion del medicamento</option>
                @foreach($presentaciones as $presentacion)
                    <option value="{{ $presentacion->id }}" 
                        option value="{{ $presentacion->Codigo }}" {{ old('CATA_presentacion', $medicamento->CATA_presentacion) == $presentacion->Codigo ? 'selected' : '' }}>
                        {{ $presentacion->Valor1 }}
                    </option>
                @endforeach
            </select>
            @error('CATA_presentacion') 
                <p class="text-red-500">{{ $message }}</p>
            @enderror
        </div>
        

        <!-- Uso (select dropdown) -->
        <div class="mb-4">
            <label for="CATA_Uso" class="block text-gray-700">Uso</label>
            <select name="CATA_Uso" id="CATA_Uso" class="border rounded w-full py-2 px-3" required>
                <option value="">Seleccione el uso del medicamento</option>
                @foreach($usos as $uso)
                    <option value="{{ $uso->id }}" 
                        option value="{{ $uso->Codigo }}" {{ old('CATA_uso', $medicamento->CATA_Uso) == $uso->Codigo ? 'selected' : '' }}>
                        {{ $uso->Valor1 }}
                    </option>
                @endforeach
            </select>
            @error('CATA_Uso') 
                <p class="text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Observaciones del medicamento -->
        <div class="mb-4">
            <label for="Observaciones" class="form-label">Observaciones</label>
            <textarea class="form-control" name="Observaciones" rows="3">{{ $medicamento->Observaciones }}</textarea>

        <!-- Estado (select dropdown) -->
        <div class="mb-4">
            <label for="CATA_Estado" class="block text-gray-700">Estado</label>
            <select name="CATA_Estado" id="CATA_Estado" class="border rounded w-full py-2 px-3" required>
                <option value="">Seleccione el estado</option>
                @foreach($estados as $estado)
                    <option value="{{ $estado->id }}" 
                        option value="{{ $estado->Codigo }}" {{ old('CATA_Estado', $medicamento->CATA_Estado) == $estado->Codigo ? 'selected' : '' }}>
                        {{ $estado->Valor1 }}
                    </option>
                @endforeach
            </select>
            @error('CATA_Estado') 
                <p class="text-red-500">{{ $message }}</p> 
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
