<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SolicitudDetalle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitud_detalle', function (Blueprint $table) {
            $table->id();
            $table->decimal('sd_cantidad', $precision = 10, $scale = 2);
            $table->decimal('sd_preciounitario', $precision = 20, $scale = 2)->nullable()->default(NULL);
            $table->string('sd_caracteristicas', 200)->nullable()->default(NULL);
            $table->integer('solicitud_id')->nullable()->default(NULL);
            $table->integer('requisicion_id')->nullable()->default(NULL);
            $table->integer('caja_id')->nullable()->default(NULL);
            $table->integer('nomina_id')->nullable()->default(NULL);
            $table->integer('material_id')->nullable()->default(NULL);
            $table->integer('servicio_id')->nullable()->default(NULL);
            $table->integer('viatico_id')->nullable()->default(NULL);

            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('solicitud_detalle');
    }
}
