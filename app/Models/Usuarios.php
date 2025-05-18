<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable; // Extiende de Authenticatable

class Usuarios extends Authenticatable  // Extiende de Authenticatable (esto ya implementa la interfaz)
{
    use HasFactory, Notifiable;

    // Campos que pueden ser llenados masivamente (como en los @NotEmpty de Spring)
    protected $fillable = [
        'nombre', 
        'email', 
        'password',
        'telefono', 
        'suscripcion', // mensual o anual
        'role', // Role de usuario (user o admin)
    ];

    // Campos que no deben ser visibles (como la contraseña)
    protected $hidden = [
        'password',
    ];

    // Para asegurar que las fechas se manejan correctamente
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Valor predeterminado para el rol
    protected $attributes = [
        'role' => 'user', // Asignar role 'user' por defecto
    ];

    // Hashear la contraseña antes de guardar
    public static function boot()
    {
        parent::boot();

        static::creating(function ($usuario) {
            if ($usuario->password) {
                $usuario->password = bcrypt($usuario->password); // Hashea la contraseña antes de guardarla
            }
        });
    }
}
