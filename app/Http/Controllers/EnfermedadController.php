<?php

namespace App\Http\Controllers;

use App\Models\Enfermedad;
use Illuminate\Http\Request;

class EnfermedadController extends Controller
{
    public function index()
    {
        $enfermedades = Enfermedad::with('estado')->get();
        return view('enfermedades.index', compact('enfermedades'));
    }

    public function create()
    {
        return view('enfermedades.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'CATA_Estado' => 'required|integer|exists:valor_catalogos,Codigo',
        ]);

        Enfermedad::create($request->all());
        return redirect()->route('enfermedades.index')->with('success', 'Enfermedad creada con éxito');
    }

    public function edit(Enfermedad $enfermedad)
    {
        return view('enfermedades.edit', compact('enfermedad'));
    }

    public function update(Request $request, Enfermedad $enfermedad)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'CATA_Estado' => 'required|integer|exists:valor_catalogos,Codigo',
        ]);

        $enfermedad->update($request->all());
        return redirect()->route('enfermedades.index')->with('success', 'Enfermedad actualizada con éxito');
    }

    public function destroy(Enfermedad $enfermedad)
    {
        // Verificar si hay relaciones antes de eliminar
        if ($enfermedad->familiares()->count() > 0) {
            return redirect()->route('enfermedades.index')
                ->with('error', 'No se puede eliminar la enfermedad porque está asociada a familiares');
        }

        $enfermedad->delete();
        return redirect()->route('enfermedades.index')->with('success', 'Enfermedad eliminada con éxito');
    }
}