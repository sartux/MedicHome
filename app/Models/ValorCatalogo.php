<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValorCatalogo extends Model
{
    use HasFactory;
    protected $tables = 'valor_catalogos';
    protected $fillable = ['catalogos_id', 'Valor1', 'Valor2', 'Valor3'];

    public function catalogo()
    {
        return $this->belongsTo(Catalogo::class);
    }
}
