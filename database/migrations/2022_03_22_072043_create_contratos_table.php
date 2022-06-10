<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratos', function (Blueprint $table) {
            $table->id();
            $table->timestamp('f_inicio')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('f_fin')->default(DB::raw('CURRENT_TIMESTAMP'))->nullable()->default(null);
            // $table->bigInteger('vallas');
            // $table->bigInteger('n_dias');
            // Está en sage
            $table->string('codpost');
            $table->boolean('baja')->default(false);
            $table->timestamps();
            $table->unsignedBigInteger('id_cliente');
            $table->foreign('id_cliente')->references('id')->on('clients')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contratos');
    }
}
