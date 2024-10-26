<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialMedicamento extends Model
{
    use HasFactory;

    // Especifica el nombre de la tabla si no sigue la convención
    protected $table = 'historial_medicamentos';

    // Los campos que se pueden llenar
    protected $fillable = [
        'Familiar_id', 
        'medicamento_id', 
        'descripcion_tratamiento', 
        'dosis', 
        'fecha_inicio', 
        'fecha_final', 
        'CATA_Estado'
    ];

    // // Relación con la tabla familiares
    public function familiar()
{
    return $this->belongsTo(Familiar::class, 'Familiar_id');
}

    // Relación con la tabla medicamentos
    public function medicamento()
    {
        return $this->belongsTo(Medicamento::class);
    }

    // Relación con la tabla valor_catalogos para el estado (uso)
    public function estado()
    {
        return $this->belongsTo(ValorCatalogo::class, 'CATA_Estado', 'Codigo');
    }
    
}
