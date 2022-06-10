<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ContratosVallas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Tabla M N de contratos y vallas
        Schema::create('contratos_vallas', function (Blueprint $table) {
            $table->id();
            $table->double('precio')->default(0);
            $table->double('precio_produccion')->nullable(true)->default(null);
            $table->unsignedBigInteger('id_contrato')->nullable(false);
            $table->foreign('id_contrato')->references('id')->on('contratos')
                ->onUpdate('cascade')->onDelete('restrict');
            $table->unsignedBigInteger('id_valla')->nullable(false);
            $table->foreign('id_valla')->references('id')->on('vallas')
                ->onUpdate('cascade')->onDelete('restrict');
            $table->unsignedBigInteger('id_material');
            $table->foreign('id_material')->references('id')->on('materiales')
                ->onUpdate('cascade')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contratos_vallas');
    }
}
