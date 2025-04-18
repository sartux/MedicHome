<?php

namespace App\Http\Controllers;

use App\Models\Familiar;
use App\Models\Enfermedad;
use App\Models\Alergia;
use App\Models\ValorCatalogo;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FamiliarController extends Controller
{
// Añadir restricción para que sólo se muestren familiares del núcleo del usuario
public function index()
{
    // Si es superadmin, puede ver todos los familiares
    if (auth()->user()->is_superadmin) {
        $familiares = Familiar::with(['estado', 'tipoSangre'])->get();
    } else {
        // Si no, solo ve los de su núcleo familiar
        $nucleoId = auth()->user()->nucleo_familiar_id;
        $familiares = Familiar::with(['estado', 'tipoSangre'])
            ->where('nucleo_familiar_id', $nucleoId)
            ->get();
    }
    
    return view('familiares.index', compact('familiares'));
}

   
public function create()
{
    // Si no es superadmin y el núcleo ya alcanzó su límite, no permitir crear más familiares
    if (!auth()->user()->is_superadmin) {
        $nucleoFamiliar = auth()->user()->nucleoFamiliar;
        
        if ($nucleoFamiliar && $nucleoFamiliar->limiteFamiliaresAlcanzado()) {
            return redirect()->route('familiares.index')
                ->with('error', 'No es posible crear más familiares. Se ha alcanzado el límite para este núcleo familiar.');
        }
    }
    
    // Obtener los catálogos necesarios
    $generos = ValorCatalogo::where('catalogos_Codigo', env('CATALOGOS_ID_GENERO'))->get();
    $estados = ValorCatalogo::where('catalogos_Codigo', env('CATALOGOS_ID_ESTADO'))->get();
    $tipos_sangre = ValorCatalogo::where('catalogos_Codigo', env('CATALOGOS_ID_TIPO_SANGRE'))->get();
           
    // Obtener enfermedades y alergias activas
    $enfermedades = Enfermedad::where('CATA_Estado', 41)->get();
    $alergias = Alergia::where('CATA_Estado', 41)->get();
    
    // Obtener la lista de núcleos familiares (para superadmin)
    $nucleosFamiliares = null;
    if (auth()->user()->is_superadmin) {
        $nucleosFamiliares = \App\Models\NucleoFamiliar::where('CATA_Estado', 41)->get();
    }
    
    return view('familiares.create', compact('generos', 'estados', 'tipos_sangre', 'enfermedades', 'alergias', 'nucleosFamiliares'));
}

public function store(Request $request)
{
    $validated = $request->validate([
        'nombre' => 'required|max:40',
        'apellido' => 'required|max:40',
        'fecha_nacimiento' => 'required|date',
        'CATA_genero' => 'required|integer',
        'CATA_tipo_sangre' => 'nullable|integer',
        'correo' => 'required|max:40|email',
        'telefono' => 'required|max:11',
        'contacto_nombre1' => 'nullable|max:100',
        'contacto_telefono1' => 'nullable|max:20',
        'contacto_nombre2' => 'nullable|max:100',
        'contacto_telefono2' => 'nullable|max:20',
        'CATA_Estado' => 'required|integer',
        'nucleo_familiar_id' => auth()->user()->is_superadmin ? 'required|exists:nucleo_familiars,id' : '',
    ]);

    // Si no es superadmin, usar el núcleo familiar del usuario
    if (!auth()->user()->is_superadmin) {
        $validated['nucleo_familiar_id'] = auth()->user()->nucleo_familiar_id;
    }
    
    // Verificar si se ha alcanzado el límite de familiares
    if (!auth()->user()->is_superadmin) {
        $nucleoFamiliar = \App\Models\NucleoFamiliar::find($validated['nucleo_familiar_id']);
        if ($nucleoFamiliar && $nucleoFamiliar->limiteFamiliaresAlcanzado()) {
            return redirect()->route('familiares.index')
                ->with('error', 'No es posible crear más familiares. Se ha alcanzado el límite para este núcleo familiar.');
        }
    }

    $familiar = Familiar::create($validated);
    
    // Añadir enfermedades si se han seleccionado
    if ($request->has('enfermedades')) {
        $familiar->enfermedades()->attach($request->enfermedades);
    }
    
    // Añadir alergias si se han seleccionado
    if ($request->has('alergias')) {
        $familiar->alergias()->attach($request->alergias);
    }

    return redirect()->route('familiares.index')
        ->with('success', 'Familiar creado exitosamente.');
}
    public function edit($id)
    {
        $familiare = Familiar::with(['estado', 'genero', 'tipoSangre'])->findOrFail($id);
        
        // Modificar estas consultas para usar valores fijos si las variables de entorno no están definidas
        $estados = ValorCatalogo::where('catalogos_Codigo', 4)->get(); // 4 es el código para estados
        $tipos_sangre = ValorCatalogo::where('catalogos_Codigo', 6)->get(); // 6 es el código para tipos de sangre
        
        $enfermedades = Enfermedad::where('CATA_Estado', 41)->get();
        $alergias = Alergia::where('CATA_Estado', 41)->get();
        
        $enfermedadesSeleccionadas = $familiare->enfermedades->pluck('id')->toArray();
        $alergiasSeleccionadas = $familiare->alergias->pluck('id')->toArray();
        
        // Añadir esto para depuración
        // dd([
        //     'estados' => $estados->toArray(),
        //     'tipos_sangre' => $tipos_sangre->toArray(),
        //     'CATA_Estado' => $familiare->CATA_Estado,
        //     'CATA_tipo_sangre' => $familiare->CATA_tipo_sangre
        // ]);
        
        return view('familiares.edit', compact(
            'familiare', 
            'estados', 
            'tipos_sangre', 
            'enfermedades', 
            'alergias', 
            'enfermedadesSeleccionadas', 
            'alergiasSeleccionadas'
        ));
    }

    public function update(Request $request, $id)
    {
        $familiare = Familiar::findOrFail($id);
        
        $validated = $request->validate([
            'correo' => 'required|email|max:255',
            'telefono' => 'required|string|max:20',
            'CATA_tipo_sangre' => 'nullable|integer|exists:valor_catalogos,Codigo,catalogos_Codigo,' . 6, // Cambio aquí
            'contacto_nombre1' => 'nullable|max:100',
            'contacto_telefono1' => 'nullable|max:20',
            'contacto_nombre2' => 'nullable|max:100',
            'contacto_telefono2' => 'nullable|max:20',
            'CATA_Estado' => 'required|exists:valor_catalogos,codigo',
        ]);
        
        $familiare->update($validated);
        
        // Actualizar enfermedades si se ha enviado el campo
        if ($request->has('enfermedades')) {
            $familiare->enfermedades()->sync($request->enfermedades);
        }
        
        // Actualizar alergias si se ha enviado el campo
        if ($request->has('alergias')) {
            $familiare->alergias()->sync($request->alergias);
        }
        
        return redirect()->route('familiares.index')
            ->with('success', 'Familiar actualizado correctamente');
    }
    
    public function show(Familiar $familiar)
    {
        // Cargar las relaciones básicas del familiar
        $familiar->load(['estado', 'genero', 'tipoSangre', 'enfermedades', 'alergias']);
        
        // Cargar medicamentos activos
        $medicamentosActivosQuery = \App\Models\HistorialMedicamento::where('Familiar_id', $familiar->id)
            ->where('CATA_Estado', 41) // Activo
            ->where(function ($query) {
                // Sin fecha final o fecha final mayor o igual a hoy
                $query->whereNull('fecha_final')
                      ->orWhere('fecha_final', '>=', now()->format('Y-m-d'));
            });
        
        // Contar medicamentos antes de ejecutar la consulta
        $totalMedicamentos = $medicamentosActivosQuery->count();
        
        // Ejecutar consulta de medicamentos
        $medicamentosActivos = $medicamentosActivosQuery
            ->with(['medicamento', 'estado'])
            ->orderBy('fecha_inicio', 'desc')
            ->get();
        
        // Cargar órdenes médicas activas con sus citas
        $ordenesActivasQuery = \App\Models\OrdenMedica::where('Familiar_id', $familiar->id)
            ->where('CATA_Estado', 41); // Activo
        
        // Contar órdenes antes de ejecutar la consulta
        $totalOrdenes = $ordenesActivasQuery->count();
        
        // Ejecutar consulta de órdenes
        $ordenesActivas = $ordenesActivasQuery
            ->with(['especialidad', 'estado', 'citasMedicas' => function($query) {
                $query->orderBy('Fecha_Hora_Cita', 'asc');
            }])
            ->orderBy('Fecha_Resetada', 'desc')
            ->get();
        
        // Diagnóstico para depuración
        $diagnostico = [
            'id_familiar' => $familiar->id,
            'total_medicamentos_query' => $totalMedicamentos,
            'total_medicamentos_resultado' => $medicamentosActivos->count(),
            'total_ordenes_query' => $totalOrdenes,
            'total_ordenes_resultado' => $ordenesActivas->count(),
            'estado_codigo_activo' => 41,
        ];
        
        return view('familiares.show', compact('familiar', 'medicamentosActivos', 'ordenesActivas', 'diagnostico'));
    }
    
    // Métodos para gestionar enfermedades
    public function agregarEnfermedad(Request $request, Familiar $familiar)
    {
        $request->validate([
            'enfermedad_id' => 'required|exists:enfermedades,id',
            'notas' => 'nullable|string|max:500',
        ]);
        
        $familiar->enfermedades()->attach(
            $request->enfermedad_id, 
            ['notas' => $request->notas]
        );
        
        return back()->with('success', 'Enfermedad añadida con éxito');
    }
    
    public function eliminarEnfermedad(Familiar $familiar, Enfermedad $enfermedad)
    {
        $familiar->enfermedades()->detach($enfermedad->id);
        
        return back()->with('success', 'Enfermedad eliminada con éxito');
    }
    
    // Métodos para gestionar alergias
    public function agregarAlergia(Request $request, Familiar $familiar)
    {
        $request->validate([
            'alergia_id' => 'required|exists:alergias,id',
            'notas' => 'nullable|string|max:500',
        ]);
        
        $familiar->alergias()->attach(
            $request->alergia_id, 
            ['notas' => $request->notas]
        );
        
        return back()->with('success', 'Alergia añadida con éxito');
    }
    
    public function eliminarAlergia(Familiar $familiar, Alergia $alergia)
    {
        $familiar->alergias()->detach($alergia->id);
        
        return back()->with('success', 'Alergia eliminada con éxito');
    }

    public function medicamentos(Familiar $familiar)
    {
        // Determinar el filtro por estado
        $estado = request('estado', 'todos');
        
        // Query base
        $query = \App\Models\HistorialMedicamento::where('Familiar_id', $familiar->id)
            ->with(['medicamento', 'estado']);
        
        // Aplicar filtros de estado
        if ($estado === 'activos') {
            $query->where('CATA_Estado', 41) // Activo
                ->where(function ($q) {
                    $q->whereNull('fecha_final')
                      ->orWhere('fecha_final', '>=', now()->format('Y-m-d'));
                });
        } elseif ($estado === 'inactivos') {
            $query->where(function ($q) {
                $q->where('CATA_Estado', '!=', 41) // No activo
                  ->orWhere(function ($q2) {
                      $q2->where('CATA_Estado', 41)
                         ->where('fecha_final', '<', now()->format('Y-m-d'));
                  });
            });
        }
        
        // Ordenar por fecha de inicio (más recientes primero)
        $historialMedicamentos = $query->orderBy('fecha_inicio', 'desc')->get();
        
        return view('familiares.medicamentos', compact('familiar', 'historialMedicamentos'));
    }
}