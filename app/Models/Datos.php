<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datos extends Model
{
    use HasFactory;

    protected $table = "datos";
    protected $fillable = [
        'nombre_fiscal',
        'nombre_comercial',
        'direccion',
        'poblacion',
        'provincia',
        'codpost',
        'telefono',
        'fax',
        'movil',
        'email1',
        'email2',
        'logo',
    ];

    /**
     * Query para obtener todos los datos
     */
    public function obtenerDatos()
    {
        return Datos::all();
    }
}
