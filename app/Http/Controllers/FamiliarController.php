<?php

namespace App\Http\Controllers;

use App\Models\Familiar;
use Illuminate\Http\Request;
use App\Models\ValorCatalogo;
use Illuminate\Support\Facades\Config; // Para acceder a las variables de entorno


class FamiliarController extends Controller
{
    public function index()
    {
        // Cargar los familiares con la relación del género y estado
        $familiares = Familiar::with('estado')->get();  
        return view('familiares.index', compact('familiares'));
    }


    
    public function create()
    {
        // Cargar los valores de géneros y estados
        $generos = ValorCatalogo::where('catalogos_id', env('CATALOGOS_ID_GENERO'))->get();
        $estados = ValorCatalogo::where('catalogos_id', env('CATALOGOS_ID_ESTADO'))->get();
        return view('familiares.create', compact('generos','estados'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:40',
            'apellido' => 'required|max:40',
            'fecha_nacimiento' => 'required|date',
            'CATA_genero' => 'required|integer',
            'correo' => 'required|max:40|email',
            'telefono' => 'required|max:11',
            'CATA_Estado' => 'required|integer',
        ]);

        Familiar::create($request->all());
        return redirect()->route('familiares.index')->with('success', 'Familiar creado exitosamente.');
    }

    public function edit(Familiar $familiare)
{
    $estados = ValorCatalogo::where('catalogos_id', env('CATALOGOS_ID_ESTADO'))->get(); 
    return view('familiares.edit', compact('familiare', 'estados'));
}


public function update(Request $request, Familiar $familiare)
{
    $request->validate([
        'correo' => 'required|email|max:255',
        'telefono' => 'required|string|max:20',
        'CATA_Estado' => 'required|exists:valor_catalogos,id',
        // 'CATA_Estado' => 'required|exists:estados,id',
    ]);

    // Actualizar solo los campos editables
    $familiare->update([
        'correo' => $request->correo,
        'telefono' => $request->telefono,
        'CATA_Estado' => $request->CATA_Estado,
    ]);

    return redirect()->route('familiares.index')->with('success', 'Familiar actualizado correctamente');
}

public function medicamentos(Familiar $familiar)
{
    // Asumiendo que tienes una relación `historialMedicamentos` en el modelo Familiar
    $historialMedicamentos = $familiar->historialMedicamentos;

    return view('historial_medicamentos.index', compact('familiar', 'historialMedicamentos'));
}

}
