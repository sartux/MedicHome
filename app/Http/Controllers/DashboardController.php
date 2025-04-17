<?php

namespace App\Http\Controllers;

use App\Models\Familiar;
use App\Models\HistorialMedicamento;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $nucleoId = $user->nucleo_familiar_id;
        
        // Consulta los medicamentos activos
        $medicamentosQuery = HistorialMedicamento::where(function ($query) {
            $query->whereNull('fecha_final')
                  ->orWhere('fecha_final', '>=', now());
        });
        
        // Si no es superadmin, filtrar por núcleo familiar
        if (!$user->isSuperAdmin() && $nucleoId) {
            $medicamentosQuery->whereHas('familiar', function($q) use ($nucleoId) {
                $q->where('nucleo_familiar_id', $nucleoId);
            });
        }
        
        $medicamentos = $medicamentosQuery->with(['medicamento.especialidad', 'familiar', 'medicamento.uso'])->get();
        
        // Obtener familiares según el rol
        if ($user->isSuperAdmin()) {
            $familiares = Familiar::all();
        } else {
            $familiares = Familiar::where('nucleo_familiar_id', $nucleoId)->get();
        }
        
        // Si es superadmin, obtener información de todos los núcleos
        $nucleoInfo = null;
        if ($user->isSuperAdmin()) {
            $nucleoInfo = [
                'total' => \App\Models\NucleoFamiliar::count(),
                'activos' => \App\Models\NucleoFamiliar::where('CATA_Estado', 41)->count(),
                'inactivos' => \App\Models\NucleoFamiliar::where('CATA_Estado', 42)->count(),
            ];
        }
        
        return view('dashboard', compact('medicamentos', 'familiares', 'nucleoInfo'));
    }
    // Método para obtener medicamentos por familiar
    public function getMedicamentosByFamiliar($familiarId)
    {
        // Consulta los medicamentos para el familiar seleccionado
        $medicamentos = HistorialMedicamento::where('Familiar_id', $familiarId)
            ->where(function ($query) {
                $query->whereNull('fecha_final')
                    ->orWhere('fecha_final', '>=', now());
            })
            ->with(['medicamento.especialidad', 'familiar', 'medicamento.uso']) // Carga las relaciones necesarias
            ->get();

        return response()->json(['medicamentos' => $medicamentos]);
    }

    /**
     * Obtener estadísticas para el dashboard
     * 
     * Este método no se usa actualmente, pero podría implementarse para 
     * obtener más estadísticas o datos para el dashboard
     */
    public function getStats()
    {
        // Obtener el número total de familiares
        $totalFamiliares = Familiar::count();

        // Obtener el número total de medicamentos activos
        $totalMedicamentos = HistorialMedicamento::where(function ($query) {
            $query->whereNull('fecha_final')
                ->orWhere('fecha_final', '>=', now());
        })->count();

        // Obtener el número de tratamientos continuos
        $tratamientosContinuos = HistorialMedicamento::whereNull('fecha_final')->count();

        // Obtener el número de tratamientos que vencen en los próximos 30 días
        $proximosAVencer = HistorialMedicamento::whereNotNull('fecha_final')
            ->whereBetween('fecha_final', [now(), now()->addDays(30)])
            ->count();

        return response()->json([
            'total_familiares' => $totalFamiliares,
            'total_medicamentos' => $totalMedicamentos,
            'tratamientos_continuos' => $tratamientosContinuos,
            'proximos_a_vencer' => $proximosAVencer
        ]);
    }
}
