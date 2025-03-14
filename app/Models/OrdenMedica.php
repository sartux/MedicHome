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
        return $this->belongsTo(Familiar::class, 'Familiar_id');
    }

    // Actualiza para especificar la clave foránea correcta
    public function citasMedicas()
    {
        return $this->hasMany(CitaMedica::class, 'OrdenMedica_id');
    }

    public function documentos()
    {
        return $this->hasMany(Documento::class, 'OrdenMedica_id');
    }
    
    // Añadir la relación con la especialidad
    public function especialidad()
    {
        return $this->belongsTo(ValorCatalogo::class, 'CATA_Especialidad', 'Codigo');
    }
}