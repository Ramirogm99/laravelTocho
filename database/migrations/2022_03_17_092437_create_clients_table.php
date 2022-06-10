<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique()->nullable(false);
            $table->string('d_social')->unique();
            $table->string('direccion');
            $table->string('direccion_2');
            $table->string('CIF');
            $table->string('localidad');
            $table->string('representante');
            $table->integer('telefono');
            $table->boolean('borrado')->default(false);
            // para posterior
            $table->string('email')->unique();
            $table->string('provincia');
            $table->char('codpost', 5);
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
        Schema::dropIfExists('clients');
    }
}
