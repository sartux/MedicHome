<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Familiar extends Model
{
    use HasFactory;
    
    protected $table = 'familiares';

    protected $fillable = [
        'nucleo_familiar_id',
        'nombre', 
        'apellido', 
        'fecha_nacimiento', 
        'CATA_genero',
        'CATA_tipo_sangre',
        'correo', 
        'telefono',
        'contacto_nombre1',
        'contacto_telefono1',
        'contacto_nombre2',
        'contacto_telefono2',
        'CATA_Estado'
    ];

    // Método para obtener el núcleo familiar
    public function nucleoFamiliar()
    {
        return $this->belongsTo(NucleoFamiliar::class, 'nucleo_familiar_id');
    }

    // Métodos de relación existentes
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
        return $this->belongsTo(ValorCatalogo::class, 'CATA_Estado', 'Codigo');
    }
    
    // Nuevas relaciones
    public function genero()
    {
        return $this->belongsTo(ValorCatalogo::class, 'CATA_genero', 'Codigo');
    }
        
    public function tipoSangre()
    {
        return $this->belongsTo(ValorCatalogo::class, 'CATA_tipo_sangre', 'Codigo');
    }
    
    public function enfermedades()
    {
        return $this->belongsToMany(Enfermedad::class, 'familiar_enfermedad')
                    ->withPivot('notas')
                    ->withTimestamps();
    }
    
    public function alergias()
    {
        return $this->belongsToMany(Alergia::class, 'familiar_alergia')
                    ->withPivot('notas')
                    ->withTimestamps();
    }
    
    // Método para calcular la edad
    public function getEdadAttribute()
    {
        return Carbon::parse($this->fecha_nacimiento)->age;
    }
    
    // Método para obtener nombre completo
    public function getNombreCompletoAttribute()
    {
        return "{$this->nombre} {$this->apellido}";
    }
}