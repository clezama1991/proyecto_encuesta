<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVotacionesDetalleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votaciones_detalle', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('votaciones_id')->nullable()->unsigned();
            $table->foreign('votaciones_id')->references('id')->on('votaciones');
            $table->bigInteger('redes_sociales_id')->nullable()->unsigned();
            $table->foreign('redes_sociales_id')->references('id')->on('redes_sociales');
            $table->string('tiempo_prom'); 
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('votaciones_detalle');
    }
}
