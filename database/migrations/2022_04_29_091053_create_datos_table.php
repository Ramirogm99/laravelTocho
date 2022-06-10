<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_fiscal')->unique();
            $table->string('d_social')->unique();
            $table->string('CIF');
            $table->string('representante');
            $table->string('direccion');
            $table->string('localidad');
            $table->string('provincia');
            $table->char('codpost', 5);
            $table->integer('telefono');
            $table->integer('fax');
            $table->integer('movil');
            $table->string('email1');
            $table->string('email2');
            // Hay que modificar este campo, creo que no es del todo correcto, no se que tipo de dato es
            $table->string('logo');
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
        Schema::dropIfExists('datos');
    }
}
