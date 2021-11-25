<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Proveedor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::create('suministro', function (Blueprint $table) {
            $table->id();
            $table->string("suministro_codigo", 25);
            $table->string("suministro_nombre", 100);
            $table->boolean('suministro_estado')->default(1);
            $table->timestamps();
        });


        Schema::create('proveedor', function (Blueprint $table) {
            $table->id();
            $table->string("proveedor_codigo", 25);
            $table->string("proveedor_tipo", 25)->nullable();
            $table->string("proveedor_rif", 50)->nullable();
            $table->string("proveedor_nombre", 100)->nullable();
            $table->string("proveedor_telefono", 50)->nullable();
            $table->string("proveedor_direccion", 250)->nullable();
            $table->string("proveedor_correo", 100)->nullable();
            $table->string("proveedor_contacto", 100)->nullable();
            $table->boolean('proveedor_estado')->default(1);
            $table->unsignedBigInteger('suministro_id')->nullable();

            $table->foreign('suministro_id')->references('id')->on('suministro');

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
        Schema::dropIfExists('proveedor');
        Schema::dropIfExists('suministro');
    }
}
