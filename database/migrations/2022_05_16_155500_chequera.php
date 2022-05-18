<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Chequera extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chequera', function (Blueprint $table) {
            $table->id();
            $table->string('chequera_codigo', 25)->nullable();
            $table->date('chequera_fecha');
            $table->integer('chequera_cantidadcheque');
            $table->chequera_correlativo('chequera_codigo', 25);
            $table->boolean('chequera_estado')->default(1);
            $table->timestamps();
        });

        Schema::create('cheque', function (Blueprint $table) {
            $table->id();
            $table->string('cheque_codigo', 25)->nullable();
            $table->decimal('cheque_monto', $precision = 20, $scale = 2);
            $table->string('cheque_destinatario', 100);
            $table->date('cheque_fecha');
            $table->boolean('cheque_estado')->default(1);

            $table->unsignedBigInteger('chequera_id ')->nullable();
            $table->foreign('chequera_id')->references('id')->on('chequera');
            
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
        Schema::dropIfExists('cheque');
        Schema::dropIfExists('chequera');
    }
}
