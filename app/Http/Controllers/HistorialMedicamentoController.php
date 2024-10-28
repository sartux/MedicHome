<?php

namespace App\Http\Controllers;

use App\Models\HistorialMedicamento;
use App\Models\Familiar;
use App\Models\Medicamento;
use App\Models\ValorCatalogo;
use Illuminate\Http\Request;

class HistorialMedicamentoController extends Controller
{
    // public function index()
    // {
    //     $historiales = HistorialMedicamento::with('familiar', 'medicamento', 'estado')->get();
    //     return view('historial_medicamentos.index', compact('historiales'));
    // }

    public function index()
{
    $familiar = Familiar::findOrFail(request()->familiar_id); // Recibe el ID del familiar desde la URL
    $historiales = HistorialMedicamento::with('medicamento', 'estado')
                   ->where('Familiar_id', $familiar->id)
                   ->get();

    return view('historial_medicamentos.index', compact('historiales', 'familiar'));
}

    public function create()
    {
        $familiares = Familiar::all();
        $medicamentos = Medicamento::all();
        $estados = ValorCatalogo::where('catalogos_Codigo', '=', 'CATALOGOS_CODIGO_ESTADO')->get(); // Reemplaza 'CATALOGOS_CODIGO_ESTADO' con el código real

        return view('historial_medicamentos.create', compact('familiares', 'medicamentos', 'estados'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Familiar_id' => 'required|exists:familiares,id',
            'medicamento_id' => 'required|exists:medicamentos,id',
            'descripcion_tratamiento' => 'required|string|max:400',
            'dosis' => 'required|string|max:100',
            'fecha_inicio' => 'required|date',
            'fecha_final' => 'nullable|date|after_or_equal:fecha_inicio',
            'CATA_Estado' => 'required|exists:valor_catalogos,Codigo',
        ]);

        HistorialMedicamento::create($request->all());
        return redirect()->route('historial_medicamentos.index')->with('success', 'Historial de medicamento creado correctamente.');
    }

    public function edit(HistorialMedicamento $historialMedicamento)
    {
        $familiares = Familiar::all();
        $medicamentos = Medicamento::all();
        $estados = ValorCatalogo::where('catalogos_Codigo', '=', 'CATALOGOS_CODIGO_ESTADO')->get(); // Reemplaza 'CATALOGOS_CODIGO_ESTADO' con el código real

        return view('historial_medicamentos.edit', compact('historialMedicamento', 'familiares', 'medicamentos', 'estados'));
    }

    public function update(Request $request, HistorialMedicamento $historialMedicamento)
    {
        $request->validate([
            'Familiar_id' => 'required|exists:familiares,id',
            'medicamento_id' => 'required|exists:medicamentos,id',
            'descripcion_tratamiento' => 'required|string|max:400',
            'dosis' => 'required|string|max:100',
            'fecha_inicio' => 'required|date',
            'fecha_final' => 'nullable|date|after_or_equal:fecha_inicio',
            'CATA_Estado' => 'required|exists:valor_catalogos,Codigo',
        ]);

        $historialMedicamento->update($request->all());
        return redirect()->route('historial_medicamentos.index')->with('success', 'Historial de medicamento actualizado correctamente.');
    }

    public function destroy(HistorialMedicamento $historialMedicamento)
    {
        $historialMedicamento->delete();
        return redirect()->route('historial_medicamentos.index')->with('success', 'Historial de medicamento eliminado.');
    }
    public function show(HistorialMedicamento $historialMedicamento)
{
    return view('historial_medicamentos.show', compact('historialMedicamento'));
}

}
