<?php

namespace App\Http\Controllers;

use App\Models\Medicamento;
use Illuminate\Http\Request;

class MedicamentoController extends Controller
{
    public function index()
    {
        $medicamentos = Medicamento::all();
        return view('medicamentos.index', compact('medicamentos'));
    }

    public function create()
    {
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
        return view('medicamentos.edit', compact('medicamento'));
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

        $medicamento->update($request->all());
        return redirect()->route('medicamentos.index')->with('success', 'Medicamento actualizado exitosamente.');
    }

    public function destroy(Medicamento $medicamento)
    {
        $medicamento->delete();
        return redirect()->route('medicamentos.index')->with('success', 'Medicamento eliminado exitosamente.');
    }
}
