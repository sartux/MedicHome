<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenMedica extends Model
{
    use HasFactory;
// Especifica el nombre de la tabla si no sigue la convención
protected $table = 'ordenes_medicas';

    protected $fillable = ['Familiar_id', 'CATA_Especialidad', 'Fecha_Resetada', 'Medico_Reseta', 'Pre_requisitos', 'Observaciones', 'CATA_Estado'];

    public function familiar()
    {
        return $this->belongsTo(Familiar::class);
    }

    public function citasMedicas()
    {
        return $this->hasMany(CitaMedica::class);
    }

    public function documentos()
    {
        return $this->hasMany(Documento::class);
    }
}
