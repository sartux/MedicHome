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
        'is_nucleo_admin',
        'is_super_admin',
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
        'is_nucleo_admin' => 'boolean',
        'is_super_admin' => 'boolean',
    ];

    /**
     * Relación con el núcleo familiar al que pertenece el usuario
     */
    public function nucleoFamiliar()
    {
        return $this->belongsTo(NucleoFamiliar::class);
    }

    /**
     * Verifica si el usuario es superadministrador
     */
    public function isSuperAdmin()
    {
        return $this->is_super_admin;
    }

    /**
     * Verifica si el usuario es administrador de núcleo
     */
    public function isNucleoAdmin()
    {
        return $this->is_nucleo_admin;
    }

    /**
     * Verifica si el usuario puede acceder a un núcleo específico
     * 
     * @param int $nucleoId
     * @return bool
     */
    public function canAccessNucleo($nucleoId)
    {
        if ($this->isSuperAdmin()) {
            return true;
        }
        
        return $this->is_nucleo_admin && 
               $this->nucleo_familiar_id == $nucleoId && 
               $this->nucleoFamiliar && 
               $this->nucleoFamiliar->isActivo();
    }
}