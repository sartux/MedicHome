<?php

namespace App\Http\Controllers;

use App\Models\HistorialMedicamento;
use App\Models\Familiar;
use App\Models\Medicamento;
use App\Models\ValorCatalogo;
use Illuminate\Http\Request;

class HistorialMedicamentoController extends Controller
{
    public function index()
    {
        $historiales = HistorialMedicamento::with('familiar', 'medicamento', 'estado')->get();
        return view('historial_medicamentos.index', compact('historiales'));
    }

    public function create()
    {
        $familiares = Familiar::all();
        $medicamentos = Medicamento::all();
        $estados = ValorCatalogo::where('catalogos_Codigo', '=', 4)->get(); // 4 es código de estados

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

        $historial = HistorialMedicamento::create($request->all());
        
        // Redireccionar a la vista de medicamentos del familiar
        return redirect()->route('familiares.medicamentos', $request->Familiar_id)
            ->with('success', 'Medicamento agregado correctamente al historial.');
    }

    public function show(HistorialMedicamento $historialMedicamento)
    {
        $historialMedicamento->load(['familiar', 'medicamento', 'estado']);
        return view('historial_medicamentos.show', compact('historialMedicamento'));
    }

    public function edit(HistorialMedicamento $historialMedicamento)
    {
        $familiares = Familiar::all();
        $medicamentos = Medicamento::all();
        $estados = ValorCatalogo::where('catalogos_Codigo', '=', 4)->get(); // 4 es código de estados

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
        
        // Redireccionar a la vista de medicamentos del familiar
        return redirect()->route('familiares.medicamentos', $historialMedicamento->Familiar_id)
            ->with('success', 'Historial de medicamento actualizado correctamente.');
    }

    public function destroy(HistorialMedicamento $historialMedicamento)
    {
        // Guardar el ID del familiar antes de eliminar para redireccionar
        $familiarId = $historialMedicamento->Familiar_id;
        
        $historialMedicamento->delete();
        
        return redirect()->route('familiares.medicamentos', $familiarId)
            ->with('success', 'Medicamento eliminado del historial.');
    }
}