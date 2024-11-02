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
        $estados = ValorCatalogo::where('catalogos_Codigo', env('CATALOGOS_CODIGO_ESTADO'))->get();
        return view('familiares.create', compact('estados'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:40',
            'apellido' => 'required|max:40',
            'fecha_nacimiento' => 'required|date',
            // 'CATA_genero' => 'required|integer',
            'correo' => 'required|max:40|email',
            'telefono' => 'required|max:11',
            'CATA_Estado' => 'required|integer',
        ]);

        Familiar::create($request->all());
        return redirect()->route('familiares.index')->with('success', 'Familiar creado exitosamente.');
    }

    public function edit(Familiar $familiare)
{
    // $familiares = Familiar::with('estado')->get();  
    $estados = ValorCatalogo::where('catalogos_Codigo', env('CATALOGOS_CODIGO_ESTADO'))->get(); 
    return view('familiares.edit', compact('familiare', 'estados'));
}


public function update(Request $request, Familiar $familiare)
{
    $request->validate([
        'correo' => 'required|email|max:255',
        'telefono' => 'required|string|max:20',
        'CATA_Estado' => 'required|exists:valor_catalogos,Codigo',  // valida el id en vez del Codigo
    ]);

    // Obtener el Codigo correspondiente al id seleccionado
    $estado = ValorCatalogo::findOrFail($request->CATA_Estado);

    // Actualizar solo los campos editables
    $familiare->update([
        'correo' => $request->correo,
        'telefono' => $request->telefono,
        'CATA_Estado' => $estado->Codigo,  // Almacena el Codigo en CATA_Estado
    ]);

    return redirect()->route('familiares.index')->with('success', 'Familiar actualizado correctamente');
}


// public function medicamentos(Familiar $familiar)
// {

//     $historialMedicamentos = $familiar->historialMedicamentos;

//     return view('historial_medicamentos.show', compact('familiar', 'historialMedicamentos'));
// }
public function medicamentos(Familiar $familiar)
{
    $historialMedicamentos = $familiar->historialMedicamentos;
    return view('historial_medicamentos.show', compact('familiar', 'historialMedicamentos'));
}
// public function ordenesMedicas(Familiar $familiar)
// {
//     $ordenes = $familiar->ordenes;
//     return view('historial_medicamentos.show', compact('familiar', 'historialMedicamentos'));
// }
public function ordenesMedicas(Familiar $familiar)
{
    $ordenes = $familiar->ordenesMedicas; // Asegúrate de tener la relación correcta en tu modelo Familiar
    return view('ordenes.show', compact('familiar', 'ordenes'));
}

}
