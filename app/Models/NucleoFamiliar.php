// Archivo: app/Models/NucleoFamiliar.php

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NucleoFamiliar extends Model
{
    use HasFactory;
    
    protected $table = 'nucleo_familiares';
    
    protected $fillable = [
        'codigo', 
        'nombre', 
        'cant_familiares',
        'fecha_crea',
        'fecha_cierre',
        'CATA_Estado'
    ];
    
    protected $casts = [
        'fecha_crea' => 'date',
        'fecha_cierre' => 'date',
    ];
    
    // Relación con estado (catálogo)
    public function estado()
    {
        return $this->belongsTo(ValorCatalogo::class, 'CATA_Estado', 'Codigo');
    }
    
    // Relación con usuarios administradores del núcleo
    public function usuarios()
    {
        return $this->hasMany(User::class);
    }
    
    // Relación con familiares pertenecientes al núcleo
    public function familiares()
    {
        return $this->hasMany(Familiar::class);
    }
    
    // Método para verificar si el núcleo está activo
    public function isActivo()
    {
        return $this->CATA_Estado == 41; // 41 es el código para "Activo"
    }
    
    // Método para obtener el número actual de familiares
    public function totalFamiliares()
    {
        return $this->familiares()->count();
    }
    
    // Método para verificar si se puede agregar más familiares
    public function puedeAgregarFamiliar()
    {
        return $this->isActivo() && $this->totalFamiliares() < $this->cant_familiares;
    }
}