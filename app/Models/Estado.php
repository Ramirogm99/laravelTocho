<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Estado extends Model
{
    use HasFactory;

    protected $table = "estados";
    protected $primaryKey = "id";
    protected $fillable = [
        'nombre',
        'color',
        'bloqueado',
        'borrado',

    ];
    /**
     *  Obtiene todos los estados de la base de datos
     */
    public function obtenerEstados()
    {
        return DB::table('estados')->select()->get();

    }

    /**
     * Query para obtener un estado por id
     */
    public function obtenerEstado($cod)
    {
        return DB::table($this->table)->where("id", $cod)->first();
    }

     /**
     * Obtener el estado de una valla pasada por parámetro(id)
     */
    public function obtenerEstadoValla($id_valla){
        return Estado::where('id', DB::table('vallas')->where('id', $id_valla)->first()->id_estado)->first();
    }
    

}
