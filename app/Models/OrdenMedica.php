<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenMedica extends Model
{
    use HasFactory;
    
    protected $table = 'ordenes_medicas';

    protected $fillable = [
        'Familiar_id', 
        'CATA_Especialidad', 
        'Procedimiento',
        'Fecha_Resetada', 
        'Medico_Reseta', 
        'Centro_Medico',
        'Ciudad',
        'Pre_requisitos', 
        'Observaciones', 
        'CATA_Estado'
    ];

    public function familiar()
    {
        return $this->belongsTo(Familiar::class, 'Familiar_id');
    }

    public function citasMedicas()
    {
        return $this->hasMany(CitaMedica::class, 'OrdenMedica_id');
    }

    public function documentos()
    {
        return $this->hasMany(Documento::class, 'OrdenMedica_id');
    }
    
    public function especialidad()
    {
        return $this->belongsTo(ValorCatalogo::class, 'CATA_Especialidad', 'Codigo');
    }
    
    public function estado()
    {
        return $this->belongsTo(ValorCatalogo::class, 'CATA_Estado', 'Codigo');
    }
}