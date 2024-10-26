<?php

namespace App\Http\Controllers;

use App\Models\Familiar;
use App\Models\HistorialMedicamento;
use Illuminate\Http\Request;

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

    // Nuevo método para obtener medicamentos por familiar
    public function getMedicamentosByFamiliar($familiarId)
    {
        // Consulta los medicamentos para el familiar seleccionado
        $medicamentos = HistorialMedicamento::where('Familiar_id', $familiarId)
            ->with(['medicamento.especialidad', 'familiar', 'medicamento.uso']) // Carga las relaciones necesarias
            ->get();

        return response()->json(['medicamentos' => $medicamentos]);
    }
}
