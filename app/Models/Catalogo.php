<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalogo extends Model
{
    use HasFactory;

    // Especifica el nombre de la tabla si no sigue la convención
    protected $table = 'catalogos';

    protected $fillable = ['nombre'];

    public function valorCatalogos()
    {
        return $this->hasMany(ValorCatalogo::class);
    }
}
