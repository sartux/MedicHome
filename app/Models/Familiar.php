<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Familiar extends Model
{
    use HasFactory;
// Especifica el nombre de la tabla si no sigue la convención
protected $table = 'familiares';

    protected $fillable = ['nombre', 'apellido', 'fecha_nacimiento', 'CATA_genero', 'correo', 'telefono', 'CATA_Estado'];


    public function historialMedicamentos()
    {
        return $this->hasMany(HistorialMedicamento::class);
    }

    public function documentos()
    {
        return $this->hasMany(Documento::class);
    }

    public function ordenesMedicas()
    {
        return $this->hasMany(OrdenMedica::class);
    }

        public function estado()
        {
            return $this->belongsTo(ValorCatalogo::class, 'CATA_Estado','Codigo');
        }
        
        
}
