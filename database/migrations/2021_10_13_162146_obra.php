<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Obra extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obra', function (Blueprint $table) {
            $table->id();
            $table->string('obra_codigo', 25)->nullable();
            $table->string('obra_nombre', 100);
            $table->decimal('obra_monto', $precision = 20, $scale = 2)->nullable();
            $table->decimal('obra_montogasto', $precision = 20, $scale = 2)->nullable();
            $table->decimal('obra_ganancia', $precision = 20, $scale = 2)->nullable();
            $table->date('obra_fechainicio')->nullable();
            $table->date('obra_fechafin')->nullable();
            $table->string('obra_residente', 100)->nullable();
            $table->string('obra_coordinador', 100)->nullable();
            $table->longText('obra_observaciones')->nullable();
            $table->tinyInteger('obra_estado')->defalut(1);
            //---Tablas relacionales---
            $table->unsignedBigInteger('cliente_id')->nullable();;
            $table->foreign('cliente_id')->references('id')->on('cliente');
            $table->unsignedBigInteger('tipo_id')->nullable();;
            $table->foreign('tipo_id')->references('id')->on('tipo');
            $table->bigInteger('codventa_id')->nullable();;
            $table->timestamps();
        });

        //-------- Tabla relacional entre obra y personal ---------
        Schema::create('obra_personal', function (Blueprint $table) {
            $table->id();
            $table->string('op_cargo', 100);
            $table->unsignedBigInteger('obra_id');
            $table->unsignedBigInteger('personal_id');
            $table->foreign('obra_id')->references('id')->on('obra');
            $table->foreign('personal_id')->references('id')->on('personal');
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
        Schema::dropIfExists('obra_personal');
        Schema::dropIfExists('obra');
    }
}
