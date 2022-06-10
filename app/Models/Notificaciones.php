<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Notificaciones extends Model
{
    use HasFactory;

    protected $table = "notificaciones";
    protected $primaryKey = "id";
    protected $fillable = [
        'id_cliente',
        'id_contrato',
        'borrado',
];


    /**
     * Obtiene todas las notificaciones activas
     */
    public function obtenerTodasNotificaciones(){
        return DB::table($this->table)->select('id_cliente' , 'id_contrato' , 'borrado')->distinct()->get();

    }

    public function obtenerNotificaciones(){
        return DB::table($this->table)->select('id_cliente' , 'id_contrato' , 'borrado')->where('borrado' , 0)->distinct()->get();
    }


    /**
     * Obtiene las notificaciones del cliente pasado por parámetro(su id)
     */
    public function obtenerNotificacionesPorCliente($id){

        return DB::table('notificaciones AS n')
        ->join('clients AS cl' , 'cl.id' , '=' , 'n.id_cliente')
        ->join('contratos_vallas AS c' , 'c.id_contrato' , '=' , 'n.id_contrato')
        ->join('vallas AS v' ,'v.id' , '=' , 'c.id_valla')
        ->join('contratos AS co' , 'co.id' ,'=' , 'n.id_contrato')
        ->select('cl.nombre AS nombre','cl.email AS email', 'v.alias AS nombre_valla','v.latitud AS latitud','v.longitud AS longitud', 'v.direccion AS direccion','co.id AS nombre_contrato' ,'co.f_fin AS fecha_fin')->where('cl.id' , $id)
        ->distinct()
        ->get();
    }

    
}
