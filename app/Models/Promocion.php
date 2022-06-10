<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Promocion extends Model
{
    use HasFactory;

    protected $table = "promociones";
    protected $primaryKey = "id";
    protected $fillable = [
        'nombre',
        'f_fin',
        'f_inicio',
        'nombre',
        'color',
        'borrado',

    ];
    /**
     *  Obtiene todas las promociones(activas) 
     */
    public function obtenerPromociones()
    {
        return DB::table('promociones')->where('borrado', 0)->select()->get();

    }

    /**
     * Obtiene una promocion por su id
     */
    public function obtenerPromocion($id)
    {
        return DB::table('promociones')->where('id', $id)->first();
    }

    public function checkPromocion($id_valla, $id_promocion){
        return DB::table('promocion_valla')->where('id_valla', $id_valla)->where('id_promocion', $id_promocion)->first();

    }

    /**
     * Obtiene los contratos que tienen la promocion activa
     */
    public function obtenerContratosConPromocion($id_promocion){
        

        return DB::table('promocion_valla as pv')
        ->select('p.id as promo_id','c.id as contrato_id', 'cl.d_social as nombre_cliente', 'v.alias as alias', 'v.norte as foto')
        ->leftjoin('promociones as p', 'p.id', '=', 'pv.id_promocion')
        ->leftjoin('vallas as v', 'pv.id_valla', '=', 'v.id')
        ->leftjoin('contratos_vallas as cv', 'cv.id_valla', '=', 'v.id')
        ->leftjoin('contratos as c', 'c.id', '=', 'cv.id_contrato')
        ->leftjoin('clients as cl', 'c.id_cliente', '=', 'cl.id')
        ->where('p.id', $id_promocion)
        ->get();

        
    }
    

}

