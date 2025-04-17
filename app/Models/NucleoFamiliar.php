<?php

namespace App\Http\Controllers;

use App\Models\NucleoFamiliar;
use App\Models\User;
use App\Models\ValorCatalogo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class NucleoFamiliarController extends Controller
{
    /**
     * Constructor - Solo superadmin puede acceder
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!auth()->user()->is_superadmin) {
                return redirect()->route('dashboard')
                    ->with('error', 'No tienes permiso para acceder a esta sección');
            }
            return $next($request);
        });
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nucleosFamiliares = NucleoFamiliar::with('estado')->get();
        return view('nucleo_familiares.index', compact('nucleosFamiliares'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $estados = ValorCatalogo::where('catalogos_Codigo', 4)->get(); // 4 es el código para estados
        return view('nucleo_familiares.create', compact('estados'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'codigo' => 'required|string|max:10|unique:nucleo_familiars',
            'nombre' => 'required|string|max:100',
            'cant_familiares' => 'required|integer|min:1',
            'fecha_crea' => 'required|date',
            'fecha_cierre' => 'nullable|date|after_or_equal:fecha_crea',
            'CATA_Estado' => 'required|exists:valor_catalogos,Codigo',
            'admin_name' => 'required|string|max:255',
            'admin_email' => 'required|email|unique:users,email',
            'admin_password' => 'required|string|min:8',
        ]);
        
        DB::beginTransaction();
        
        try {
            // Crear el núcleo familiar
            $nucleoFamiliar = NucleoFamiliar::create([
                'codigo' => $validated['codigo'],
                'nombre' => $validated['nombre'],
                'cant_familiares' => $validated['cant_familiares'],
                'fecha_crea' => $validated['fecha_crea'],
                'fecha_cierre' => $validated['fecha_cierre'],
                'CATA_Estado' => $validated['CATA_Estado'],
            ]);
            
            // Crear el usuario administrador del núcleo
            User::create([
                'name' => $validated['admin_name'],
                'email' => $validated['admin_email'],
                'password' => Hash::make($validated['admin_password']),
                'nucleo_familiar_id' => $nucleoFamiliar->id,
                'is_admin' => true,
                'is_superadmin' => false,
            ]);
            
            DB::commit();
            
            return redirect()->route('nucleo_familiares.index')
                ->with('success', 'Núcleo familiar creado con éxito');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Error al crear el núcleo familiar: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(NucleoFamiliar $nucleoFamiliar)
    {
        $nucleoFamiliar->load(['estado', 'usuarios', 'familiares']);
        return view('nucleo_familiares.show', compact('nucleoFamiliar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NucleoFamiliar $nucleoFamiliar)
    {
        $estados = ValorCatalogo::where('catalogos_Codigo', 4)->get(); // 4 es el código para estados
        return view('nucleo_familiares.edit', compact('nucleoFamiliar', 'estados'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, NucleoFamiliar $nucleoFamiliar)
    {
        $validated = $request->validate([
            'codigo' => 'required|string|max:10|unique:nucleo_familiars,codigo,' . $nucleoFamiliar->id,
            'nombre' => 'required|string|max:100',
            'cant_familiares' => 'required|integer|min:1',
            'fecha_crea' => 'required|date',
            'fecha_cierre' => 'nullable|date|after_or_equal:fecha_crea',
            'CATA_Estado' => 'required|exists:valor_catalogos,Codigo',
        ]);
        
        $nucleoFamiliar->update($validated);
        
        return redirect()->route('nucleo_familiares.index')
            ->with('success', 'Núcleo familiar actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NucleoFamiliar $nucleoFamiliar)
    {
        // Verificar si tiene familiares o usuarios asociados
        if ($nucleoFamiliar->familiares()->count() > 0 || $nucleoFamiliar->usuarios()->count() > 0) {
            return back()->with('error', 'No se puede eliminar este núcleo familiar porque tiene usuarios o familiares asociados');
        }
        
        $nucleoFamiliar->delete();
        
        return redirect()->route('nucleo_familiares.index')
            ->with('success', 'Núcleo familiar eliminado con éxito');
    }
}