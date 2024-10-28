<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    use HasFactory;
// Especifica el nombre de la tabla si no sigue la convención
protected $table = 'medicamentos';
    protected $fillable = ['Nombre', 'Composicion', 'CATA_presentacion', 'CATA_Uso', 'Observaciones', 'CATA_Estado'];

    public function historialMedicamentos()
    {
        return $this->hasMany(HistorialMedicamento::class);
    }
    public function especialidad()
    {
        return $this->belongsTo(ValorCatalogo::class, 'CATA_Especialidad', 'Codigo');
    }
    
    public function uso()
    {
        return $this->belongsTo(ValorCatalogo::class, 'CATA_Uso', 'Codigo');
    }

    public function estado()
    {
        return $this->belongsTo(ValorCatalogo::class, 'CATA_Estado','Codigo');
    }
}
