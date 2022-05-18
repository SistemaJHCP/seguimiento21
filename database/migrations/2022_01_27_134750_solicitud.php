<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Solicitud extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitud', function (Blueprint $table) {
            $table->id();
            $table->string('solicitud_numerocontrol', 25)->nullable()->default(NULL);
            $table->string('solicitud_fecha', 30);
            $table->integer('solicitud_tipo');
            $table->integer('solicitud_tiposolicitud');
            $table->integer('solicitud_iva');
            $table->string('solicitud_factura', 10)->nullable()->default(NULL);
            $table->text('solicitud_motivo', 500);
            $table->text('solicitud_observaciones', 500)->nullable()->default(NULL);
            $table->integer('solicitud_formapago');
            $table->string('solicitud_aprobacion', 25)->default('Sin Respuesta');
            $table->text('solicitud_comentario')->nullable()->default(NULL);
            $table->text('solicitud_comentarior')->nullable()->default(NULL);
            $table->integer('solicitud_contador')->default(1);
            $table->integer('solicitud_estadopago')->default(1);
            $table->text('solicitud_comentariopago')->nullable()->default(NULL);
            $table->unsignedBigInteger('usuario_id');
            $table->unsignedBigInteger('obra_id');
            $table->integer('proveedor_id')->nullable()->default(NULL);
            $table->integer('banco_proveedor_id')->nullable();
            $table->integer('aprobador_id')->nullable()->default(NULL);
            $table->integer('cotizacion_id')->nullable()->default(NULL);
            $table->integer('requisicion_id')->nullable()->default(NULL);
            $table->enum('moneda', ['B/', '$'])->default('Bs');

            $table->foreign('usuario_id')->references('id')->on('users');
            $table->foreign('obra_id')->references('id')->on('obra');
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
        Schema::dropIfExists('solicitud');
    }
}
