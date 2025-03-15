<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CitaMedica extends Model
{
    use HasFactory;
    
    protected $table = 'citas_medicas';

    protected $fillable = [
        'OrdenMedica_id', 
        'Fecha_Hora_Cita'
    ];
    
    protected $casts = [
        'Fecha_Hora_Cita' => 'datetime'
    ];

    public function ordenMedica()
    {
        return $this->belongsTo(OrdenMedica::class, 'OrdenMedica_id');
    }
}