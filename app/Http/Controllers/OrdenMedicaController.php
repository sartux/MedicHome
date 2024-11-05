<?php

namespace App\Http\Controllers;

use App\Models\OrdenMedica;
use App\Models\Familiar;
use App\Models\ValorCatalogo;
use Illuminate\Http\Request;

class OrdenMedicaController extends Controller
{
    public function index()
    {
        $ordenes = OrdenMedica::with('familiar', 'especialidad', 'estado')->get();
        return view('ordenes.index', compact('ordenes'));
    }


    public function create()
{
    $familiares = Familiar::all();
    
    // Usamos las constantes de .env para obtener los valores de especialidades y estados
    $especialidades = ValorCatalogo::where('catalogos_Codigo', env('CATALOGOS_CODIGO_ESPECIALIDAD'))->get();
    $estados = ValorCatalogo::where('catalogos_Codigo', env('CATALOGOS_CODIGO_ESTADO'))->get();
    
    return view('ordenes.create', compact('familiares', 'especialidades', 'estados'));
}

public function store(Request $request)
{
    $request->validate([
        'Familiar_id' => 'required|exists:familiares,id',
        'CATA_Especialidad' => 'required|exists:valor_catalogos,Codigo',
        'Procedimiento' => 'required|string|max:300',
        'Fecha_Resetada' => 'required|date',
        'Medico_Reseta' => 'required|string|max:60',
        'Centro_Medico' => 'required|string|max:60',
        'Ciudad' => 'required|string|max:50',
        'Observaciones' => 'nullable|string|max:400',
        'Pre_requisitos' => 'nullable|string|max:400',
        'CATA_Estado' => 'required|exists:valor_catalogos,Codigo',
    ]);

    // Revisar los datos recibidos
    // dd($request->all());

    OrdenMedica::create($request->all());

    return redirect()->route('ordenes.index')->with('success', 'Orden médica creada exitosamente.');
}


      public function edit(OrdenMedica $orden)
    {
        $familiares = Familiar::all();
        $especialidades = ValorCatalogo::where('catalogos_Codigo', 5)->get();
        $estados = ValorCatalogo::where('catalogos_Codigo', 4)->get();
        return view('ordenes.edit', compact('orden', 'familiares', 'especialidades', 'estados'));
    }

    public function update(Request $request, OrdenMedica $orden)
{
    $request->validate([
        'Familiar_id' => 'required|exists:familiares,id',
        'CATA_Especialidad' => 'required|exists:valor_catalogos,Codigo',
        'Procedimiento' => 'required|string|max:300',
        'Fecha_Resetada' => 'required|date',
        'Medico_Reseta' => 'required|string|max:60',
        'Centro_Medico' => 'required|string|max:60',
        'Ciudad' => 'required|string|max:50',
        'Observaciones' => 'nullable|string|max:400',
        'CATA_Estado' => 'required|exists:valor_catalogos,Codigo',
    ]);

    $orden->update($request->all());
    return redirect()->route('ordenes.index')->with('success', 'Orden médica actualizada exitosamente.');
}


    public function destroy(OrdenMedica $orden)
    {
        $orden->delete();
        return redirect()->route('ordenes.index')->with('success', 'Orden médica eliminada exitosamente.');
    }

    public function show(OrdenMedica $orden)
    {
        // Carga las órdenes médicas sin citas, en orden de fecha, e incluye las relaciones de familiar, especialidad y estado
        $ordenes = OrdenMedica::whereDoesntHave('citasMedicas')
            ->orderBy('Fecha_Resetada', 'asc')
            ->with(['familiar', 'especialidad', 'estado'])
            ->get();
    
        // Carga el primer familiar relacionado
        $familiar = $ordenes->first() ? $ordenes->first()->familiar : null;
    
        return view('ordenes.show', compact('ordenes', 'familiar'));
    }
    
    

    
}
