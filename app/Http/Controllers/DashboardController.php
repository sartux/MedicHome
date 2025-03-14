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
        // Consulta los medicamentos del historial cuya fecha_final sea null o no esté vencida
        $medicamentos = HistorialMedicamento::where(function ($query) {
            $query->whereNull('fecha_final')
                  ->orWhere('fecha_final', '>=', now());
        })->with(['medicamento.especialidad', 'familiar', 'medicamento.uso']) // Relación con medicamento, familiar y estado
        ->get();

        // Obtener todos los familiares para el dropdown
        $familiares = Familiar::all();

        // Retorna los medicamentos y familiares a la vista
        return view('dashboard', compact('medicamentos', 'familiares'));
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