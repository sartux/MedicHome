<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenMedica extends Model
{
    use HasFactory;
// Especifica el nombre de la tabla si no sigue la convención
protected $table = 'ordenes_medicas';

protected $fillable = [
    'Familiar_id', 
    'CATA_Especialidad', 
    'Procedimiento', 
    'Fecha_Resetada', 
    'Medico_Reseta', 
    'Centro_Medico', // Asegúrate de que este campo esté aquí
    'Ciudad', 
    'Observaciones', 
    'Pre_requisitos', 
    'CATA_Estado'
];


public function familiar()
{
    return $this->belongsTo(Familiar::class, 'Familiar_id', 'id');
}


    public function citasMedicas()
    {
        return $this->hasMany(CitaMedica::class);
    }

    public function documentos()
    {
        return $this->hasMany(Documento::class);
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
