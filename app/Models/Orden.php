<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Orden extends Model
{
    use HasFactory;

    protected $table = "ordenes";
    protected $primaryKey = "id";
    protected $fillable = [
        'descripcion',
        'equipo',
        'encargado',
        'adjunto',
        'completado',
       
    ];


    public function obtenerOrdenes()
    {
        return DB::table($this->table)->where('completado', 0)->where('borrado' , 0)->select()->get();

    }

    public function obtenerOrdenesCompletas()
    {
        return DB::table($this->table)->where('completado', 1)->where('borrado' , 0)->select()->get();

    }

    /**
     * Obtiene un material por su id
     */
    public function obtenerOrden($id)
    {
        return DB::table($this->table)->where('id', $id)->first();
    }


    
}
