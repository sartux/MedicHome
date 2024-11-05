<?php

namespace App\Http\Controllers;

use App\Models\CitaMedica;
use App\Models\OrdenMedica;
use App\Models\Familiar;
use Illuminate\Http\Request;

class CitasMedicasController extends Controller
{
    // Mostrar citas para un familiar específico
    public function index(Familiar $familiar)
    {
        $citas = CitaMedica::where('familiar_id', $familiar->id)->with('ordenMedica')->get();
        return view('citas.index', compact('citas', 'familiar'));
    }

    // Método para crear una nueva cita
    public function create(OrdenMedica $orden)
    {
        return view('citas.create', compact('orden'));
    }
    

    // Método para almacenar la cita
    public function store(Request $request)
    {
        $request->validate([
            'fecha_hora' => 'required|date',
            'orden_medica_id' => 'required|exists:orden_medicas,id',
            'observaciones' => 'nullable|string|max:400',
        ]);
    
        CitaMedica::create($request->all());
    
        return redirect()->route('ordenes.index')->with('success', 'Cita médica asignada exitosamente.');
    }
    

    // Otros métodos como edit, update, destroy si es necesario
}
