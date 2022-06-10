<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
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
        'username',
        'avatar',
        'equipo_id',
        'auth_level',
        'react_token',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'borrado',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Obtiene todos los usuarios de la base de datos
     */
    public function obtenerUsuarios()
    {
        return DB::table('users')->select()->where('borrado', 0)->get();

        // User::all(); Esto sería lo que debería hacer una persona y no lo que estamos haciendo nosotros, ojalá Ruben no nos mate
    }

    /**
     * Query para obtener un usuario por id
     */
    public function obtenerUsuario($cod)
    {
        return DB::table("users")->where("id", $cod)->first();
    }
}
