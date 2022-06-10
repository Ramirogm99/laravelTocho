<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Material extends Model
{
    use HasFactory;

    protected $table = "materiales";
    protected $primaryKey = "id";
    protected $fillable = [
        'tipo',
        'disponible',
        'color',
        'borrado',

    ];
    /**
     *  Obtiene todos los materiales(activos) 
     */
    public function obtenerMateriales()
    {
        return DB::table('materiales')->where('borrado', 0)->select()->get();

    }

    /**
     * Obtiene un material por su id
     */
    public function obtenerMaterial($id)
    {
        return DB::table('materiales')->where('id', $id)->first();
    }

    /**
     * Lo mismo que antes pero alguien se despistó: !!REFACTORIZAR
     */
    public function obtenerMaterialPorId($id)
    {
        return DB::table('materiales')->where('id', $id)->first();
    }


}
