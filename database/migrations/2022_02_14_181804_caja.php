<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Caja extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caja', function (Blueprint $table) {
            $table->id();
            $table->string('caja_nombre', 100);
            $table->decimal('caja_monto', $precision = 20, $scale = 2)->nullable()->default(NULL);
            $table->text('caja_observaciones');
            $table->tinyInteger('caja_estado')->defalut(1);

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
        Schema::dropIfExists('caja');
    }
}
