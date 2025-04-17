<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'nucleo_familiar_id',
        'is_admin',
        'is_superadmin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_admin' => 'boolean',
        'is_superadmin' => 'boolean',
    ];
    
    /**
     * Relación con el núcleo familiar
     */
    public function nucleoFamiliar()
    {
        return $this->belongsTo(NucleoFamiliar::class, 'nucleo_familiar_id');
    }
    
    /**
     * Verifica si el usuario puede acceder (núcleo activo)
     */
    public function puedeAcceder()
    {
        // Los superadmins siempre pueden acceder
        if ($this->is_superadmin) {
            return true;
        }
        
        // Si no tiene núcleo familiar, no puede acceder
        if (!$this->nucleo_familiar_id) {
            return false;
        }
        
        // Solo puede acceder si su núcleo familiar está activo
        return $this->nucleoFamiliar && $this->nucleoFamiliar->isActivo();
    }
}