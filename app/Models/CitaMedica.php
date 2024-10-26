<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CitaMedica extends Model
{
    use HasFactory;
    
// Especifica el nombre de la tabla si no sigue la convención
protected $table = 'citas_medicas';

    protected $fillable = ['OrdenMedica_id', 'Fecha_Hora_Cita'];

    public function ordenMedica()
    {
        return $this->belongsTo(OrdenMedica::class);
    }
}
