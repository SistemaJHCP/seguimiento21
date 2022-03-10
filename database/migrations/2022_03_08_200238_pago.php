<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pago extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pago', function (Blueprint $table) {
            $table->id();
            $table->date('pago_fecha');
            $table->string('pago_formapago', 25);
            $table->string('pago_numerocomprobante', 25)->nullable()->default(NULL);
            $table->decimal('pago_monto', $precision = 20, $scale = 2)->nullable();
            // $table->string('pago_descripcion', 25);
            $table->text('pago_descripcion');
            $table->boolean('pago_estado')->default(1);
            $table->biginteger('orden_compra_id')->nullable();
            $table->biginteger('solicitud_id');
            $table->biginteger('cuenta_id')->nullable();
            $table->biginteger('cheque_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pago');
    }
}
