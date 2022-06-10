<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordenes', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion')->nullable(false);
            $table->string('equipo')->nullable(false);
            $table->boolean('completado')->default(false);
            $table->string('adjunto')->nullable(true);
            $table->boolean('borrado')->default(false);
            $table->unsignedBigInteger('encargado')->nullable(true);
            $table->foreign('encargado')->references('id')->on('users')
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
        Schema::dropIfExists('ordenes');
    }
}
