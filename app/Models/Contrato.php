<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Contrato extends Model
{
    use HasFactory;

    protected $table = "contratos";
    protected $primaryKey = "id";
    protected $fillable = [
        'f_inicio',
        'f_fin',
        'id_cliente',
        'created_at',
        'baja',
        'precio_valla',
        'importe',
    ];

    /**
     * Query para obtener todos los contratos activos
     */
    public function obtenerContratos()
    {
        return DB::table('contratos')
        ->join('clients', 'contratos.id_cliente', '=', 'clients.id')
        ->select('contratos.*', 'clients.id as id_cliente', 'clients.d_social as d_social')->where('baja', 0)->get();
        //creo que seria asi
        // return Contrato::all();
    }
    

    /**
     * Query para obtener un contrato por id
     */
    public function obtenerContrato($cod)
    {
        return DB::table("contratos")->where("id", $cod)->first();
    }

    /**
     * Obtener todos los contratos del cliente pasado por id
     */
    public function obtenerContratosCliente($cliente){
        return Contrato::all()->where('id_cliente', $cliente);
    }

    /**
     * Obtener los contratos una valla en las fechas pasadas por parámetros a partir de la valla también pasada en parámetros
     */
    public function obtenerContratosValla($id_valla, $f_inicio, $f_fin)
    {
        return DB::table('contratos as c')->select('c.*', 'cl.nombre')->distinct()
            ->join('contratos_vallas as cv', 'c.id', '=', 'cv.id_contrato')
            ->join('clients as cl', 'c.id_cliente', '=', 'cl.id')
            ->join('vallas as v', 'v.id', '=', 'cv.id_valla')
            ->where(function ($query) use ($f_inicio, $f_fin) {
                $query->where('c.f_inicio', '<=', $f_inicio)
                    ->where('c.f_fin', '>=', $f_inicio)
                    ->orWhere('c.f_inicio', '<=', $f_fin)
                    ->where('c.f_fin', '>=', $f_fin);
            })
            ->where('c.baja', '!=', 1)
            ->where('v.id', $id_valla)
            ->get();
    }

    /**
     * Obtener los contratos de todas las vallas en las fechas pasadas por parámetros
     */
    public function obtenerContratosVallas($f_inicio, $f_fin)
    {
        return DB::table('contratos as c')->select('c.*', 'cl.nombre')->distinct()
            ->join('contratos_vallas as cv', 'c.id', '=', 'cv.id_contrato')
            ->join('clients as cl', 'c.id_cliente', '=', 'cl.id')
            ->where('c.f_inicio', '<=', $f_inicio)
            ->where('c.f_fin', '>=', $f_inicio)
            ->where('c.baja', '!=', 1)
            ->orWhere('c.f_inicio', '<=', $f_fin)
            ->where('c.f_fin', '>=', $f_fin)
            ->where('c.baja', '!=', 1)
            ->get();
    }

    /**
     * Obtener los contratos de baja en las fechas pasadas por parámetros
     * No hay diferencia con el anterior, debería refactorizarse
     */
    public function obtenerContratosBajaFiltro($f_inicio, $f_fin)
    {
        return DB::table('contratos as c')->select('c.*', 'cl.nombre')->distinct()
            ->join('contratos_vallas as cv', 'c.id', '=', 'cv.id_contrato')
            ->join('clients as cl', 'c.id_cliente', '=', 'cl.id')
            ->where('c.f_inicio', '<=', $f_inicio)
            ->where('c.f_fin', '>=', $f_inicio)
            ->where('c.baja', '=', 1)
            ->orWhere('c.f_inicio', '<=', $f_fin)
            ->where('c.f_fin', '>=', $f_fin)
            ->where('c.baja', '=', 1)
            ->get();
    }

    /**
     * Obtener todos los contratos de baja 
     */
    public function obtenerContratosBaja()
    {
        return DB::table('contratos as c')->select('c.*', 'cl.nombre')->distinct()
            ->join('contratos_vallas as cv', 'c.id', '=', 'cv.id_contrato')
            ->join('clients as cl', 'c.id_cliente', '=', 'cl.id')
            ->where('c.baja', '=', 1)
            ->get();
    }

    /**
     * Obtiene el precio del contrato mensual por el precio de cada una de sus vallas
     */
    public function obtenerPrecioContrato($id)
    {
        return DB::table('contratos_vallas')->where('id_contrato', '=', $id)->sum('precio') + DB::table('contratos_vallas')->where('id_contrato', '=', $id)->sum('precio_produccion');
    }


    /**
     * Obtiene los ids de las vallas que se encuentran en el contrato cuyo id es pasado por parámetro
     */
    public function obtenerVallasContrato($id)
    {
        return DB::table('contratos_vallas')->where('id_contrato', '=', $id)->get();

    }

    // Obtener nombre de cliente de un contrato

    
    

}
