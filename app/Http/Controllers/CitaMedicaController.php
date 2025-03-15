<?php

namespace App\Http\Controllers;

use App\Models\CitaMedica;
use App\Models\OrdenMedica;
use Illuminate\Http\Request;

class CitaMedicaController extends Controller
{
    public function index()
    {
        $citas = CitaMedica::with('ordenMedica.familiar', 'ordenMedica.especialidad')->get();
        return view('citas_medicas.index', compact('citas'));
    }

    public function create(Request $request)
    {
        $ordenId = $request->orden_id;
        $orden = null;
        
        if ($ordenId) {
            $orden = OrdenMedica::with('familiar', 'especialidad')->findOrFail($ordenId);
        } else {
            // Si no se especificó una orden, mostrar todas para seleccionar
            $ordenes = OrdenMedica::with('familiar', 'especialidad')->where('CATA_Estado', 41)->get();
            return view('citas_medicas.create', compact('ordenes'));
        }
        
        return view('citas_medicas.create', compact('orden'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'OrdenMedica_id' => 'required|exists:ordenes_medicas,id',
            'Fecha_Hora_Cita' => 'required|date_format:Y-m-d\TH:i',
        ]);

        $cita = new CitaMedica();
        $cita->OrdenMedica_id = $request->OrdenMedica_id;
        $cita->Fecha_Hora_Cita = $request->Fecha_Hora_Cita;
        $cita->save();
        
        return redirect()->route('ordenes_medicas.show', $request->OrdenMedica_id)
            ->with('success', 'Cita médica agendada correctamente.');
    }

    public function edit(CitaMedica $citasMedica)
    {
        $citasMedica->load('ordenMedica.familiar', 'ordenMedica.especialidad');
        
        return view('citas_medicas.edit', compact('citasMedica'));
    }

    public function update(Request $request, CitaMedica $citasMedica)
    {
        $request->validate([
            'Fecha_Hora_Cita' => 'required|date_format:Y-m-d\TH:i',
        ]);

        $citasMedica->Fecha_Hora_Cita = $request->Fecha_Hora_Cita;
        $citasMedica->save();
        
        return redirect()->route('ordenes_medicas.show', $citasMedica->OrdenMedica_id)
            ->with('success', 'Cita médica actualizada correctamente.');
    }

    public function destroy(CitaMedica $citasMedica)
    {
        $ordenId = $citasMedica->OrdenMedica_id;
        $citasMedica->delete();
        
        return redirect()->route('ordenes_medicas.show', $ordenId)
            ->with('success', 'Cita médica eliminada correctamente.');
    }
}