<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Cuenta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuenta', function (Blueprint $table) {
            $table->id();
            $table->string('cuenta_tipo', 25);
            $table->string('cuenta_numero', 20);
            $table->decimal('cuenta_montoinicial', $precision = 20, $scale = 2)->nullable();
            $table->boolean('cuenta_estado')->default(1);
            $table->unsignedBigInteger('banco_id')->nullable();

            $table->foreign('banco_id')->references('id')->on('banco');
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
        Schema::dropIfExists('cuenta');
    }
}
