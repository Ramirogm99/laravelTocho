<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVallasOrdenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vallas_orden', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_valla')->nullable(true);
            $table->foreign('id_valla')->references('id')->on('vallas')
            ->onUpdate('cascade')->onDelete('restrict');
            $table->unsignedBigInteger('id_orden')->nullable(true);
            $table->foreign('id_orden')->references('id')->on('ordenes')
            ->onUpdate('cascade')->onDelete('restrict');
            $table->boolean('completado')->default(false);
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
        Schema::dropIfExists('vallas_orden');
    }
}
