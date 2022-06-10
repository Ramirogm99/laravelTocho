<?php

namespace App\Models;

use Illuminate\Http\Request ;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Js;

class Cliente extends Model
{
    use HasFactory;

    protected $table = "clients";
    protected $primaryKey = "id";
    protected $fillable = [
        'nombre',
        'd_social',
        'direccion',
        'direccion_2',
        'codpost',
        'localidad',
        'provincia',
        'representante',
        'CIF',
        'telefono',
        'email',
        'borrado',
    ];

    /**
     * Query para obtener todos los clientes
     */
    public function obtenerClientes()
    {
        return DB::table('clients')->where('borrado', 0)->select()->get();
    }
    /**
     * Query para obtener los datos necesarios para el correo
     */
    public function obtenerClientesLite()
    {
        return DB::table('clients')->where('borrado', 0)->select('nombre', 'id', 'email')->get();
    }
    /**
     * Query para obtener un cliente por id
     */
    public function obtenerCliente($cod)
    {
        return DB::table("clients")->where("id", $cod)->first();
    }
    /**
     * Query para obtener un cliente por nombre
     */
    public function obtenerClientePorNombre($nombre){

        return DB::table('clients')->where('nombre' , $nombre)->get();
    }
}
