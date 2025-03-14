<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enfermedad extends Model
{
    use HasFactory;
    
    protected $table = 'enfermedades';
    
    protected $fillable = [
        'nombre',
        'descripcion',
        'CATA_Estado'
    ];
    
    // Relación con Familiares
    public function familiares()
    {
        return $this->belongsToMany(Familiar::class, 'familiar_enfermedad')
                    ->withPivot('notas')
                    ->withTimestamps();
    }
    
    // Relación con estado (catálogo)
    public function estado()
    {
        return $this->belongsTo(ValorCatalogo::class, 'CATA_Estado', 'Codigo');
    }
}