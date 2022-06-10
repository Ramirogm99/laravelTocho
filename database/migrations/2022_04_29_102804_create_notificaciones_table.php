<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notificaciones', function (Blueprint $table) {
            //
            $table->id();
            $table->unsignedBigInteger('id_contrato');
            $table->unsignedBigInteger('id_cliente');
            $table->boolean('borrado');
            $table->foreign('id_cliente')->references('id')->on('clients');
            $table->foreign('id_contrato')->references('id')->on('contratos');
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
        Schema::dropIfExists('notificaciones', function (Blueprint $table) {
            //
        });
    }
}
