<?php

namespace App\Http\Controllers;

use App\Models\Medicamento;
use App\Models\ValorCatalogo;
use Illuminate\Http\Request;

class MedicamentoController extends Controller
{
    public function index()
    {
        // $medicamentos = Medicamento::all();
        $medicamentos = Medicamento::with('estado')->get();
        return view('medicamentos.index', compact('medicamentos'));
    }

    public function create()
    {
        $estados = ValorCatalogo::where('catalogos_Codigo', env('CATALOGOS_CODIGO_ESTADO'))->get();
        return view('medicamentos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Nombre' => 'required|max:40',
            'Composicion' => 'required|max:80',
            'CATA_presentacion' => 'required|integer',
            'CATA_Uso' => 'required|integer',
            'Observaciones' => 'nullable|max:400',
            'CATA_Estado' => 'required|integer',
        ]);

        Medicamento::create($request->all());
        return redirect()->route('medicamentos.index')->with('success', 'Medicamento creado exitosamente.');
    }

    public function edit(Medicamento $medicamento)
    {
        $estados = ValorCatalogo::where('catalogos_Codigo', env('CATALOGOS_CODIGO_ESTADO'))->get(); 
        $usos = ValorCatalogo::where('catalogos_Codigo', env('CATALOGOS_CODIGO_USO'))->get(); 
        $presentaciones = ValorCatalogo::where('catalogos_Codigo', env('CATALOGOS_CODIGO_PRESETACION'))->get(); 
        return view('medicamentos.edit', compact('medicamento','estados','usos','presentaciones'  ));
    }

    public function update(Request $request, Medicamento $medicamento)
{
    $request->validate([
        'Nombre' => 'required|max:40',
        'Composicion' => 'required|max:80',
        'CATA_presentacion' => 'required|integer',
        'CATA_Uso' => 'required|integer',
        'Observaciones' => 'nullable|max:400',
        'CATA_Estado' => 'required|integer',
    ]);

    // Obtener el Codigo correspondiente al id seleccionado en cada campo relacionado
    $estado = ValorCatalogo::findOrFail($request->CATA_Estado);
    $uso = ValorCatalogo::findOrFail($request->CATA_Uso);
    $presentacion = ValorCatalogo::findOrFail($request->CATA_presentacion);

    // Actualiza el medicamento con los valores correctos de 'Codigo' de cada relación
    $medicamento->update([
        'Nombre' => $request->Nombre,
        'Composicion' => $request->Composicion, 
        'CATA_presentacion' => $presentacion->Codigo,
        'CATA_Uso' => $uso->Codigo,
        'Observaciones' => $request->Observaciones,
        'CATA_Estado' => $estado->Codigo,
    ]);

    return redirect()->route('medicamentos.index')->with('success', 'Medicamento actualizado exitosamente.');
}

    public function destroy(Medicamento $medicamento)
    {
        $medicamento->delete();
        return redirect()->route('medicamentos.index')->with('success', 'Medicamento eliminado exitosamente.');
    }
}
