<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Valla extends Model
{
    use HasFactory;

    protected $table = "vallas";
    protected $primaryKey = "id";
    protected $fillable = [
        'alias',
        'direccion',
        'localidad',
        'tamano',
        'incidencias',
        'latitud',
        'longitud',
        'norte',
        'sur',
        'este',
        'oeste',
        'borrado',
        'id_estado',

    ];
    /**
     *  Obtiene todas las vallas activas de la base de datos
     */
    public function obtenerVallas()
    {
        return DB::table('vallas')->select()->where('borrado', 0)->get();
        // Valla::all();
    }

    /**
     * Query para obtener una valla por id
     */
    public function obtenerValla($cod)
    {
        return DB::table($this->table)->where("id", $cod)->first();
    }

    /**
     * Query para obtener las vallas de un contrato pasado por parametro(su id)
     */
    public function obtenerVallasDeContrato($contrato_id)
    {
        return DB::table("contratos_vallas")->where("id_contrato", $contrato_id)->get();
    }


    /**
     * Devuelve los datos de las vallas del contrato(no solo el id) pasado por parámetro(por id).
     * Usado para evitar problemas con el envío de correos
     */
    public function obtenerVallasDeContratoGrande($contrato_id){
        return DB::table('contratos_vallas')
            ->join('vallas' ,'vallas.id' , '=' ,'contratos_vallas.id_valla')
            ->where('contratos_valla.id_contrato' ,$contrato_id)
            ->select('vallas.direccion AS direccion','vallas.latitud','vallas.longitud' , 'vallas.alias AS alias')
            ->get();
    }
    /**
     * Query para obtener vallas sin contrato. Sin uso actual
     */
    public function obtenerVallasLibres()
    {
        return DB::table($this->table)->select('vallas.id', 'alias', 'direccion')
            ->whereNotIn('vallas.id', function ($query) {
                $query->select('id_valla')->from('contratos_vallas');
            })
            ->get();
    }
    /**
     * Query para obtener vallas disponibles en un periodo marcado por las fechas de inicio y fin pasadas por parámetro
     * Para dejar constancia de la lógica:
     *      Una valla se encuentra ocupada en un periodo si uno de los dos límites del periodo se encuentra entre las fechas de inicio y fin 
     *      de alguno de los contratos de la valla, además también estará ocupada si hay un contrato que inicie o termine dentro del periodo.
     *      A partir del listado de vallas ocupadas obtenemos por descarte las vallas que se encuentran libres en el periodo
     */
    public function obtenerVallasLiberadas($f_inicio, $f_fin)
    {
        return DB::table('vallas')->select('id', 'alias', 'direccion', 'norte')
            ->whereNotIn('id', function ($query) use ($f_inicio, $f_fin) {
                $query->select('id_valla')->distinct()->from('contratos_vallas')
                    ->whereIn('id_contrato', function ($query) use ($f_inicio, $f_fin) {
                        $query->selectRaw("id FROM contratos where baja != 1 and ('$f_inicio' between f_inicio and f_fin or '$f_fin' between f_inicio and f_fin or f_inicio between '$f_inicio' and '$f_fin')");

                    });
            })->get();
    }

    /**
     * Inserta los datos de las vallas del contrato en la tabla auxiliar de la relación 
     */
    public function insertarRelacionContratoVallas($id_contrato, $id_valla, $precio, $precio_material, $material = 1)
    {
        return DB::insert('insert into contratos_vallas (id_contrato, id_valla, precio, precio_produccion, id_material) values (?, ?, ?, ?, ?)', [$id_contrato, $id_valla, $precio, $precio_material, $material]);
    }

    /**
     * Obtiene todas las vallas que se encuentran contratadas, incluyendo duplicadas en caso de que se encuentren en mas de un contrato
     */
    public function obtenerVallasContratadas()
    {
        return DB::table('contratos_vallas')
            ->join('contratos', 'contratos.id', '=', 'contratos_vallas.id_contrato')
            ->join('vallas', 'vallas.id', '=', 'contratos_vallas.id_valla')
            ->join('clients', 'clients.id', '=', 'contratos.id_cliente')
            ->select('vallas.alias', 'clients.nombre', 'contratos.id', 'contratos.f_inicio', 'contratos.f_fin')
            ->where('contratos.baja', '!=', 1)
            ->get();
    }

    /**
     * Selecciona las vallas que estan cercanas a su finalizacion a partir de una fecha (en la que terminaría el contrato) y un plazo pasados por parámetro
     * Aclaraciones:
     *          -El plazo no abarca un intervalo, si no que delimita el intervalo en el que se considera que una valla va a finalizar pronto
     *          -La diferencia se calcula únicamente en días, truncando horas
     *          -No se controla que la valla tenga otro contrato posterior justo al terminar
     */
    public function obtenerVallasProxFinalización($f_fin, $plazo)
    {
        return DB::select("SELECT distinct vallas.*, contratos.id as id_contrato, DATEDIFF(contratos.f_fin, '$f_fin') as dias, clients.id as id_cliente ,clients.nombre as cliente  , clients.email as email from vallas
        join contratos_vallas on contratos_vallas.id_valla = vallas.id
        join contratos on contratos_vallas.id_contrato = contratos.id
        join clients on contratos.id_cliente = clients.id
        where DATEDIFF(contratos.f_fin, '$f_fin')<$plazo
        and DATEDIFF(contratos.f_fin, '$f_fin')>0
        and contratos.baja = 0 
        order by contratos.f_fin ASC;");
    }


    /**
     * Obtiene el precio de una valla en el contrato a través de los ids de ambos pasados por parámetros
     */
    public function obtenerPrecioValla($id, $id_valla)
    {
        return DB::table('contratos_vallas')->where('id_contrato', '=', $id)->where('id_valla', '=', $id_valla)->sum('precio');
    }

    public function obtenerPrecioMaterialValla($id, $id_valla){
        return DB::table('contratos_vallas')->where('id_contrato', '=', $id)->where('id_valla', '=', $id_valla)->sum('precio_produccion');
    }

    public function obtenerPrecioTotalValla($id, $id_valla){
        return $this->obtenerPrecioValla($id, $id_valla) + $this->btenerPrecioMaterialValla($id, $id_valla);
    }


    /**
     * Obtiene el material de una valla en el contrato a través de los ids de ambos pasados por parámetros
     */
    public function obtenerMaterialValla($id, $id_valla)
    {
        return DB::table('contratos_vallas')
            ->join('materiales', 'contratos_vallas.id_material', '=', 'materiales.id')
            ->where('id_contrato', '=', $id)->where('id_valla', '=', $id_valla)->select('tipo')->first();
    }

    /**
     * Se obtienen todas las vallas a mostrar en el mapa
     * Este código es una de las mayores muestras de pereza, dejo constancia para el que quiera saber que ha fallado, ha sido esto
     */
    public function obtenerMapa(){
        return Valla::all();
    }

    /**
     * Se obtienen todas las vallas contratadas a mostrar en el mapa
     */
    public function obtenerMapaContratadas(){
        return DB::table('contratos_vallas')
        ->select('vallas.alias', 'vallas.latitud', 'vallas.longitud', 'vallas.norte', 'clients.nombre', 'contratos.id', 'contratos.f_inicio', 'contratos.f_fin', 'materiales.color', 'materiales.tipo')
        ->join('contratos', 'contratos.id', '=', 'contratos_vallas.id_contrato')
        ->join('materiales', 'contratos_vallas.id_material', '=', 'materiales.id')
        ->join('vallas', 'vallas.id', '=', 'contratos_vallas.id_valla')
        ->join('clients', 'clients.id', '=', 'contratos.id_cliente')
        ->where('contratos.baja', '!=', 1)
        ->get();
     }

    /**
     * Obtiene las vallas que tienen promociones asignadas
     * @return \Illuminate\Database\Eloquent\Collection
     */

     public function obtenerVallasPromociones(){
        return DB::table('promociones')
        ->select('vallas.alias', 'vallas.latitud', 'vallas.longitud', 'vallas.norte','promociones.nombre', 'promociones.id')
        ->join('promocion_valla', 'promocion_valla.id_promocion', '=', 'promociones.id')
        ->join('vallas', 'vallas.id', '=', 'promocion_valla.id_valla')
        ->get();

     }


     /**
     * Se obtienen las vallas que forman parte del contrato pasado por parámetro (por id) a mostrar en el mapa
     */
     public function obtenerMapaContratoPorId($id){
        return DB::table('contratos_vallas')
        ->select('vallas.alias', 'vallas.latitud', 'vallas.longitud', 'vallas.norte', 'clients.nombre', 'contratos.id', 'contratos.f_inicio', 'contratos.f_fin', 'materiales.color', 'materiales.tipo')
        ->join('contratos', 'contratos.id', '=', 'contratos_vallas.id_contrato')
        ->join('materiales', 'contratos_vallas.id_material', '=', 'materiales.id')
        ->join('vallas', 'vallas.id', '=', 'contratos_vallas.id_valla')
        ->join('clients', 'clients.id', '=', 'contratos.id_cliente')
        ->where('contratos.baja', '!=', 1)
        ->where('contratos.id', $id)
        ->get();
     }

     /**
      * Se obtienen las vallas que forman parte de la promocion pasado por parámetro (por id) a mostrar en el mapa
      */
      
     public function obtenerMapaPromocionPorId($id){
        return DB::table('promociones')
        ->select('vallas.alias', 'vallas.latitud', 'vallas.longitud', 'vallas.norte', 'promociones.nombre', 'promociones.id', 'promociones.color')
        ->join('promocion_valla', 'promocion_valla.id_promocion', '=', 'promociones.id')
        ->join('vallas', 'vallas.id', '=', 'promocion_valla.id_valla')
        ->where('promociones.id', $id)
        ->get();
     }

     /**
      * Se comprueba el estado de todas vallas, modificándolo en caso de ser necesario 
      *     - Libre: La valla no tiene ningún contrato activo o en reserva
      *     - Ocupada : La valla está actualmente ocupada
      *     - Reserva : La valla no está actualmente ocupada pero tiene al menos un contrato en reserva
      *     Esta función se debería ejecutar tras cada operación de inserción, actualización o borrado sobre los contratos
      */
    public function checkEstados(){
        $vallas = Valla::all();
        $vallas_libres = $this->obtenerVallasLiberadas(date('Y-m-d H:i:s'), date('Y-m-d H:i:s', strtotime("+1 minute")));
        $vallas_reserva = $this->obtenerVallasLiberadas(date('Y-m-d H:i:s'), date('Y-m-d H:i:s', strtotime("+25 years")));
     
        $id_libre = array();
        $id_reserva= array();
        foreach($vallas_libres as $valla){
            $id_libre[] = $valla->id;
        }

        foreach($vallas_reserva as $valla){
            $id_reserva[] = $valla->id;
        }

        foreach($vallas as $valla){
            if(!in_array($valla->id, $id_libre)){
                $valla->id_estado = 1;
                $valla->save();
            }elseif(!in_array($valla->id, $id_reserva)){
                $valla->id_estado = 2;
                $valla->save();
            }
            else{
                $valla->id_estado = null;
                $valla->save();
            }

        }
        
    }

    public function obtenerVallasOrden($id){
        return DB::select("select vallas.* , vallas_orden.completado from vallas join vallas_orden on vallas.id = vallas_orden.id_valla join ordenes on ordenes.id = vallas_orden.id_orden where ordenes.id = $id");

    }

}
