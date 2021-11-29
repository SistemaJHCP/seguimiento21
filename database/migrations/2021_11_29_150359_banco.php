<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Banco extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banco', function (Blueprint $table) {
            $table->id();
            $table->string("banco_rif", 50);
            $table->string("banco_nombre", 100);
            $table->boolean('banco_estado')->default(1);

            $table->timestamps();
        });

        Schema::create('banco_proveedor', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('banco_id');
            $table->unsignedBigInteger('proveedor_id');
            $table->integer('tipodecuenta');
            $table->string('numero', 20);
            $table->boolean('estado')->default(1);

            $table->foreign('banco_id')->references('id')->on('banco');
            $table->foreign('proveedor_id')->references('id')->on('proveedor');
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
        Schema::dropIfExists('banco_proveedor');
        Schema::dropIfExists('banco');
    }
}
