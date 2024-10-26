<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;
// Especifica el nombre de la tabla si no sigue la convención
protected $table = 'documentos';
    protected $fillable = ['Familiar_id', 'OrdenMedica_id', 'CATA_Especialidad', 'Fecha_documento', 'CATA_Estado'];

    public function familiar()
    {
        return $this->belongsTo(Familiar::class);
    }

    public function ordenMedica()
    {
        return $this->belongsTo(OrdenMedica::class);
    }
}
