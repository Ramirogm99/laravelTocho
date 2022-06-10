<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateVallasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
        $a = DB::select("Show events where Db='". env('DB_DATABASE')."' and name='finaliza'");
        $b = DB::select("Show events where Db='". env('DB_DATABASE')."' and name='liberaVallas'");
        $c = DB::select("Show events where Db='". env('DB_DATABASE')."' and name='iniciaContrato'");
        $d = DB::select("Show events where Db='". env('DB_DATABASE')."' and name='marcaReserva'");

        Schema::create('vallas', function (Blueprint $table) {
            $table->id();
            $table->string('alias');
            $table->string('direccion');
            $table->string('localidad');
            $table->decimal('latitud', 10, 7);
            $table->decimal('longitud', 10, 7);
            $table->decimal('tamano', 5, 2);
            $table->string('norte');
            $table->string('sur');
            $table->string('este');
            $table->string('oeste');
            $table->unsignedBigInteger('id_estado')->nullable(true);
            $table->foreign('id_estado')->references('id')->on('estados')
                ->onUpdate('cascade')->onDelete('restrict');
            $table->boolean('borrado')->default(false);
            $table->string('incidencias')->nullable();
            $table->timestamps();
            
        });
        if(empty($a)){
            DB::insert("Create EVENT `finaliza` ON SCHEDULE EVERY 1 MINUTE STARTS '". date('Y-m-d H:i:s') ."' ON COMPLETION NOT PRESERVE ENABLE DO update contratos set baja=1 where f_fin < CURRENT_TIMESTAMP");
            
        }
        if(empty($b)){
            DB::insert("Create event `liberaVallas` ON SCHEDULE EVERY 1 MINUTE STARTS '". date('Y-m-d H:i:s') ."' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE vallas set id_estado=null
            where id not in (SELECT v.id FROM contratos_vallas cv 
            join vallas v on  cv.id_valla = v.id
            join contratos c on cv.id_contrato = c.id
            where c.baja = 0)");
        }
        if(empty($c)){
            DB::insert("Create event `iniciaContrato` ON SCHEDULE EVERY 1 MINUTE STARTS '". date('Y-m-d H:i:s') ."' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE vallas set id_estado=1
            where id in (SELECT v.id FROM contratos_vallas cv 
            join vallas v on  cv.id_valla = v.id
            join contratos c on cv.id_contrato = c.id
            where c.baja = 0 and c.f_inicio< sysdate())");
        }
        if(empty($d)){
            DB::insert("Create event `marcaReserva` ON SCHEDULE EVERY 1 MINUTE STARTS '". date('Y-m-d H:i:s') ."' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE vallas set id_estado=2
            where id in (SELECT v.id FROM contratos_vallas cv 
            join vallas v on  cv.id_valla = v.id
            join contratos c on cv.id_contrato = c.id
            where c.baja = 1 and c.f_fin < sysdate())");
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vallas');
        
    }
}
