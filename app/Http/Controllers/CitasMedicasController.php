<?php

namespace App\Http\Controllers;

use App\Models\CitaMedica;
use App\Models\OrdenMedica;
use Illuminate\Http\Request;

class CitasMedicasController extends Controller
{
    public function index(OrdenMedica $orden)
    {
        $citas = CitaMedica::where('OrdenMedica_id', $orden->id)->get();
        return view('citas.index', compact('citas', 'orden'));
    }

    public function create(OrdenMedica $orden)
    {
        return view('citas.create', compact('orden'));
    }

    public function store(Request $request, OrdenMedica $orden)
    {
        $request->validate([
            'Fecha_Cita' => 'required|date',
            'Hora_Cita' => 'required',
            'Lugar' => 'required|string|max:100',
            'Observaciones' => 'nullable|string|max:400',
        ]);

        $orden->citas()->create($request->all());
        return redirect()->route('citas.index', $orden)->with('success', 'Cita médica creada exitosamente.');
    }

    public function edit(CitaMedica $cita)
    {
        return view('citas.edit', compact('cita'));
    }

    public function update(Request $request, CitaMedica $cita)
    {
        $request->validate([
            'Fecha_Cita' => 'required|date',
            'Hora_Cita' => 'required',
            'Lugar' => 'required|string|max:100',
            'Observaciones' => 'nullable|string|max:400',
        ]);

        $cita->update($request->all());
        return redirect()->route('citas.index', $cita->orden)->with('success', 'Cita médica actualizada exitosamente.');
    }

    public function destroy(CitaMedica $cita)
    {
        $cita->delete();
        return redirect()->route('citas.index', $cita->orden)->with('success', 'Cita médica eliminada exitosamente.');
    }
}
