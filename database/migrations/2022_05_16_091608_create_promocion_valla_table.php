<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromocionVallaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promocion_valla', function (Blueprint $table) {
            $table->id();
            
           

            $table->unsignedBigInteger('id_valla')->nullable(false);
            $table->foreign('id_valla')->references('id')->on('vallas')
                ->onUpdate('cascade')->onDelete('restrict');
            $table->unsignedBigInteger('id_promocion')->nullable(false);
            $table->foreign('id_promocion')->references('id')->on('promociones')
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
        Schema::dropIfExists('promocion_valla');
    }
}
