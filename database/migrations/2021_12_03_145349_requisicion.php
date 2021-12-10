<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Requisicion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisicion', function (Blueprint $table) {
            $table->id();
            $table->string('requisicion_codigo', 25)->default(NULL);
            $table->string('requisicion_tipo', 25);
            $table->date('requisicion_fecha');
            $table->date('requisicion_fechae');
            $table->longText('requisicion_motivo');
            $table->longText('requisicion_direccion');
            $table->longText('requisicion_observaciones')->nullable()->default(NULL);
            $table->string('requisicion_estado', 25)->default("No Vista");
            $table->bigInteger('requisicion_comentario')->nullable()->default(NULL);
            $table->bigInteger('requisicion_solicitud')->nullable()->default(NULL);
            $table->unsignedBigInteger('usuario_id');
            $table->bigInteger('usuario_view_id')->nullable()->default(NULL);
            $table->unsignedBigInteger('obra_id');
            $table->bigInteger('proveedor_id')->nullable()->default(NULL);
            $table->bigInteger('aprobador_id')->nullable()->default(NULL);


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
        Schema::dropIfExists('requisicion');
    }
}
