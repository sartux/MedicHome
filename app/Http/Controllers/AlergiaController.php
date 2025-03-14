<?php

namespace App\Http\Controllers;

use App\Models\Alergia;
use Illuminate\Http\Request;

class AlergiaController extends Controller
{
    public function index()
    {
        $alergias = Alergia::with('estado')->get();
        return view('alergias.index', compact('alergias'));
    }

    public function create()
    {
        return view('alergias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'CATA_Estado' => 'required|integer|exists:valor_catalogos,Codigo',
        ]);

        Alergia::create($request->all());
        return redirect()->route('alergias.index')->with('success', 'Alergia creada con éxito');
    }

    public function edit(Alergia $alergia)
    {
        return view('alergias.edit', compact('alergia'));
    }

    public function update(Request $request, Alergia $alergia)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'CATA_Estado' => 'required|integer|exists:valor_catalogos,Codigo',
        ]);

        $alergia->update($request->all());
        return redirect()->route('alergias.index')->with('success', 'Alergia actualizada con éxito');
    }

    public function destroy(Alergia $alergia)
    {
        // Verificar si hay relaciones antes de eliminar
        if ($alergia->familiares()->count() > 0) {
            return redirect()->route('alergias.index')
                ->with('error', 'No se puede eliminar la alergia porque está asociada a familiares');
        }

        $alergia->delete();
        return redirect()->route('alergias.index')->with('success', 'Alergia eliminada con éxito');
    }
}