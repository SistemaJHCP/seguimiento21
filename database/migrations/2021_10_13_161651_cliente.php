<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Cliente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente', function (Blueprint $table) {
            $table->id();
            $table->string('cliente_codigo', 25);
            $table->string('cliente_rif',50);
            $table->string('cliente_nombre', 100);
            $table->string('cliente_telefono', 50);
            $table->string('cliente_direccion', 250);
            $table->string('cliente_correo', 100)->nullable();
            $table->tinyInteger('cliente_estado');

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
        Schema::dropIfExists('cliente');
    }
}
