<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialMedicamento extends Model
{
    use HasFactory;

    protected $table = 'historial_medicamentos';
    protected $fillable = [
        'Familiar_id',
        'medicamento_id',
        'descripcion_tratamiento',
        'dosis',
        'fecha_inicio',
        'fecha_final',
        'CATA_Estado'
    ];

    // Relación con Familiar
    public function familiar()
    {
        return $this->belongsTo(Familiar::class, 'Familiar_id');
    }

    // Relación con Medicamento
    public function medicamento()
    {
        return $this->belongsTo(Medicamento::class, 'medicamento_id');
    }

    // Relación con ValorCatalogo para el estado
    public function estado()
    {
        return $this->belongsTo(ValorCatalogo::class, 'CATA_Estado', 'Codigo');
    }
}
