// Archivo: app/Http/Controllers/NucleoFamiliarController.php

<?php

namespace App\Http\Controllers;

use App\Models\NucleoFamiliar;
use App\Models\User;
use App\Models\ValorCatalogo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class NucleoFamiliarController extends Controller
{
    public function __construct()
    {
        // Aplicar middleware para verificar si es superadmin
        $this->middleware(function ($request, $next) {
            if (!auth()->user()->isSuperAdmin()) {
                return redirect()->route('dashboard')
                    ->with('error', 'Acceso no autorizado.');
            }
            return $next($request);
        });
    }
    
    public function index()
    {
        $nucleos = NucleoFamiliar::with('estado')->get();
        return view('nucleo_familiares.index', compact('nucleos'));
    }
    
    public function create()
    {
        $estados = ValorCatalogo::where('catalogos_Codigo', 4)->get(); // 4 es el código para estados
        return view('nucleo_familiares.create', compact('estados'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|string|max:10|unique:nucleo_familiares',
            'nombre' => 'required|string|max:50',
            'cant_familiares' => 'required|integer|min:1',
            'fecha_crea' => 'required|date',
            'CATA_Estado' => 'required|exists:valor_catalogos,Codigo',
            
            // Datos para el usuario administrador del núcleo
            'admin_name' => 'required|string|max:255',
            'admin_email' => 'required|string|email|max:255|unique:users,email',
            'admin_password' => 'required|string|min:8',
        ]);
        
        // Crear transacción para asegurar consistencia
        DB::beginTransaction();
        
        try {
            // Crear el núcleo familiar
            $nucleo = NucleoFamiliar::create([
                'codigo' => $request->codigo,
                'nombre' => $request->nombre,
                'cant_familiares' => $request->cant_familiares,
                'fecha_crea' => $request->fecha_crea,
                'CATA_Estado' => $request->CATA_Estado,
            ]);
            
            // Crear el usuario administrador del núcleo
            $user = User::create([
                'name' => $request->admin_name,
                'email' => $request->admin_email,
                'password' => Hash::make($request->admin_password),
                'nucleo_familiar_id' => $nucleo->id,
                'is_nucleo_admin' => true,
                'is_super_admin' => false,
            ]);
            
            DB::commit();
            
            return redirect()->route('nucleo_familiares.index')
                ->with('success', 'Núcleo familiar creado con éxito');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al crear el núcleo familiar: ' . $e->getMessage());
        }
    }
    
    public function edit(NucleoFamiliar $nucleoFamiliar)
    {
        $estados = ValorCatalogo::where('catalogos_Codigo', 4)->get(); // 4 es el código para estados
        $adminUser = User::where('nucleo_familiar_id', $nucleoFamiliar->id)
                        ->where('is_nucleo_admin', true)
                        ->first();
        
        return view('nucleo_familiares.edit', compact('nucleoFamiliar', 'estados', 'adminUser'));
    }
    
    public function update(Request $request, NucleoFamiliar $nucleoFamiliar)
    {
        $request->validate([
            'codigo' => 'required|string|max:10|unique:nucleo_familiares,codigo,' . $nucleoFamiliar->id,
            'nombre' => 'required|string|max:50',
            'cant_familiares' => 'required|integer|min:1',
            'fecha_crea' => 'required|date',
            'fecha_cierre' => 'nullable|date',
            'CATA_Estado' => 'required|exists:valor_catalogos,Codigo',
        ]);
        
        $nucleoFamiliar->update($request->all());
        
        return redirect()->route('nucleo_familiares.index')
            ->with('success', 'Núcleo familiar actualizado con éxito');
    }
    
    public function destroy(NucleoFamiliar $nucleoFamiliar)
    {
        // Verificar si hay familiares asociados
        if ($nucleoFamiliar->familiares()->count() > 0) {
            return back()->with('error', 'No se puede eliminar este núcleo porque tiene familiares asociados');
        }
        
        // Verificar si hay usuarios asociados
        if ($nucleoFamiliar->usuarios()->count() > 0) {
            return back()->with('error', 'No se puede eliminar este núcleo porque tiene usuarios asociados');
        }
        
        $nucleoFamiliar->delete();
        
        return redirect()->route('nucleo_familiares.index')
            ->with('success', 'Núcleo familiar eliminado con éxito');
    }
}