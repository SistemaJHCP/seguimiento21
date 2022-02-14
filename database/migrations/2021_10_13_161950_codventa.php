<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Codventa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codventa', function (Blueprint $table) {
            $table->id();
            $table->string('codventa_codigo', 25);
            $table->string('codventa_nombre', 100);
            $table->string('codventa_codigo2', 25);
            $table->string('codventa_telefono', 50)->nullable();
            $table->string('codventa_direccion', 250);
            $table->string('codventa_correo', 100)->nullable();
            $table->tinyInteger('codventa_estado');
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
        Schema::dropIfExists('codventa');
    }
}
