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
        $ordenes = OrdenMedica::with(['familiar', 'especialidad', 'estado'])->get();
        return view('ordenes_medicas.index', compact('ordenes'));
    }

    public function create()
    {
        $familiares = Familiar::all();
        $especialidades = ValorCatalogo::where('catalogos_Codigo', '=', 5)->get(); // 5 es código de especialidades
        $estados = ValorCatalogo::where('catalogos_Codigo', '=', 4)->get(); // 4 es código de estados
        
        return view('ordenes_medicas.create', compact('familiares', 'especialidades', 'estados'));
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
            'Pre_requisitos' => 'nullable|string|max:400',
            'Observaciones' => 'required|string|max:400',
            'CATA_Estado' => 'required|exists:valor_catalogos,Codigo',
        ]);

        $orden = OrdenMedica::create($request->all());
        
        return redirect()->route('ordenes_medicas.show', $orden->id)
            ->with('success', 'Orden médica creada correctamente.');
    }

    public function show(OrdenMedica $ordenesMedica)
    {
        $ordenesMedica->load(['familiar', 'especialidad', 'estado', 'citasMedicas']);
        
        return view('ordenes_medicas.show', compact('ordenesMedica'));
    }

    public function edit(OrdenMedica $ordenesMedica)
    {
        $familiares = Familiar::all();
        $especialidades = ValorCatalogo::where('catalogos_Codigo', '=', 5)->get(); // 5 es código de especialidades
        $estados = ValorCatalogo::where('catalogos_Codigo', '=', 4)->get(); // 4 es código de estados
        
        return view('ordenes_medicas.edit', compact('ordenesMedica', 'familiares', 'especialidades', 'estados'));
    }

    public function update(Request $request, OrdenMedica $ordenesMedica)
    {
        $request->validate([
            'Familiar_id' => 'required|exists:familiares,id',
            'CATA_Especialidad' => 'required|exists:valor_catalogos,Codigo',
            'Procedimiento' => 'required|string|max:300',
            'Fecha_Resetada' => 'required|date',
            'Medico_Reseta' => 'required|string|max:60',
            'Centro_Medico' => 'required|string|max:60',
            'Ciudad' => 'required|string|max:50',
            'Pre_requisitos' => 'nullable|string|max:400',
            'Observaciones' => 'required|string|max:400',
            'CATA_Estado' => 'required|exists:valor_catalogos,Codigo',
        ]);

        $ordenesMedica->update($request->all());
        
        return redirect()->route('ordenes_medicas.show', $ordenesMedica->id)
            ->with('success', 'Orden médica actualizada correctamente.');
    }

    public function destroy(OrdenMedica $ordenesMedica)
    {
        // Verificar si hay citas asociadas antes de eliminar
        if ($ordenesMedica->citasMedicas()->count() > 0) {
            return back()->with('error', 'No se puede eliminar esta orden médica porque tiene citas asociadas.');
        }
        
        $ordenesMedica->delete();
        
        return redirect()->route('ordenes_medicas.index')
            ->with('success', 'Orden médica eliminada correctamente.');
    }
    
    public function indexByFamiliar(Familiar $familiar)
    {
        // Determinar el filtro por estado
        $estado = request('estado', 'todos');
        
        // Query base
        $query = OrdenMedica::where('Familiar_id', $familiar->id);
        
        // Aplicar filtros de estado
        if ($estado === 'activos') {
            $query->where('CATA_Estado', 41); // Activo
        } elseif ($estado === 'inactivos') {
            $query->where('CATA_Estado', '!=', 41); // No activo
        }
        
        // Cargar las relaciones y ordenar
        $ordenes = $query->with(['especialidad', 'estado', 'citasMedicas' => function($q) {
            $q->orderBy('Fecha_Hora_Cita', 'asc');
        }])
        ->orderBy('Fecha_Resetada', 'desc')
        ->get();
        
        return view('ordenes_medicas.by_familiar', compact('familiar', 'ordenes'));
    }
}