<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('permisos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_permiso', 60);
            $table->boolean('usuario')->default(1);
            $table->boolean('crear_usuario')->default(1);
            $table->boolean('modificar_usuario')->default(1);
            $table->boolean('ver_botones_usuario')->default(1);
            $table->boolean('desactivar_usuario')->default(1);
            $table->boolean('reactivar_usuario')->default(1);
            $table->boolean('cliente')->default(1);
            $table->boolean('crear_cliente')->default(1);
            $table->boolean('modificar_cliente')->default(1);
            $table->boolean('ver_botones_cliente')->default(1);
            $table->boolean('desactivar_cliente')->default(1);
            $table->boolean('reactivar_cliente')->default(1);
            $table->boolean('ptc')->default(1);
            $table->boolean('crear_ptc')->default(1);
            $table->boolean('modificar_ptc')->default(1);
            $table->boolean('ver_botones_ptc')->default(1);
            $table->boolean('desactivar_ptc')->default(1);
            $table->boolean('reactivar_ptc')->default(1);
            $table->boolean('obra')->default(1);
            $table->boolean('crear_obra')->default(1);
            $table->boolean('modificar_obra')->default(1);
            $table->boolean('ver_botones_obra')->default(1);
            $table->boolean('desactivar_obra')->default(1);
            $table->boolean('reactivar_obra')->default(1);
            $table->boolean('materiales')->default(1);
            $table->boolean('crear_materiales')->default(1);
            $table->boolean('modificar_materiales')->default(1);
            $table->boolean('ver_botones_materiales')->default(1);
            $table->boolean('desactivar_materiales')->default(1);
            $table->boolean('reactivar_materiales')->default(1);
            $table->boolean('proveedores')->default(1);
            $table->boolean('crear_proveedores')->default(1);
            $table->boolean('modificar_proveedores')->default(1);
            $table->boolean('ver_botones_proveedores')->default(1);
            $table->boolean('desactivar_proveedores')->default(1);
            $table->boolean('reactivar_proveedores')->default(1);
            $table->boolean('tipo')->default(1);
            $table->boolean('crear_tipo')->default(1);
            $table->boolean('modificar_tipo')->default(1);
            $table->boolean('ver_botones_tipo')->default(1);
            $table->boolean('desactivar_tipo')->default(1);
            $table->boolean('reactivar_tipo')->default(1);
            $table->boolean('personal')->default(1);
            $table->boolean('crear_personal')->default(1);
            $table->boolean('modificar_personal')->default(1);
            $table->boolean('ver_botones_personal')->default(1);
            $table->boolean('desactivar_personal')->default(1);
            $table->boolean('reactivar_personal')->default(1);
            $table->boolean('suministros')->default(1);
            $table->boolean('crear_suministros')->default(1);
            $table->boolean('modificar_suministros')->default(1);
            $table->boolean('ver_botones_suministros')->default(1);
            $table->boolean('desactivar_suministros')->default(1);
            $table->boolean('reactivar_suministros')->default(1);
            $table->boolean('banco')->default(1);
            $table->boolean('crear_banco')->default(1);
            $table->boolean('modificar_banco')->default(1);
            $table->boolean('ver_botones_banco')->default(1);
            $table->boolean('desactivar_banco')->default(1);
            $table->boolean('reactivar_banco')->default(1);
            $table->boolean('requisicion')->default(1);
            $table->boolean('crear_requisicion')->default(1);
            $table->boolean('modificar_requisicion')->default(1);
            $table->boolean('ver_botones_requisicion')->default(1);
            $table->boolean('anular_requisicion')->default(1);
            // $table->boolean('reactivar_requisicion')->default(1);
            $table->boolean('solicitud')->default(1);
            $table->boolean('crear_solicitud')->default(1);
            $table->boolean('modificar_solicitud')->default(1);
            $table->boolean('ver_botones_solicitud')->default(1);
            $table->boolean('anular_solicitud')->default(1);
            $table->boolean('nomina_solicitud_opcion')->default(1);
            $table->boolean('material_solicitud_opcion')->default(1);
            $table->boolean('servicio_solicitud_opcion')->default(1);
            $table->boolean('viatico_solicitud_opcion')->default(1);
            $table->boolean('caja_chica_solicitud')->default(1);
            $table->boolean('nomina_solicitud')->default(1);
            $table->boolean('materiales_solicitud')->default(1);
            $table->boolean('servicio_solicitud')->default(1);
            $table->boolean('viatico_solicitud')->default(1);
            $table->boolean('solicitud_pago')->default(1);//inicia la consulta de presidencia
            $table->boolean('ver_solicitud_pago')->default(1);
            $table->boolean('aprobacion_solicitud_pago')->default(1);
            $table->boolean('servicio')->default(1);
            $table->boolean('crear_servicio')->default(1);
            $table->boolean('modificar_servicio')->default(1);
            $table->boolean('ver_botones_servicio')->default(1);
            $table->boolean('desactivar_servicio')->default(1);
            $table->boolean('reactivar_servicio')->default(1);
            $table->boolean('viatico')->default(1);
            $table->boolean('crear_viatico')->default(1);
            $table->boolean('modificar_viatico')->default(1);
            $table->boolean('ver_botones_viatico')->default(1);
            $table->boolean('desactivar_viatico')->default(1);
            $table->boolean('reactivar_viatico')->default(1);
            $table->boolean('compra_cuentas_x_pagar')->default(1);
            $table->boolean('crear_compra_cuentas_x_pagar')->default(1);
            $table->boolean('ver_compra_cuentas_x_pagar')->default(1);
            $table->boolean('ver_botones_compra_cuentas_x_pagar')->default(1);
            $table->boolean('anular_compra_cuentas_x_pagar')->default(1);
            $table->boolean('reactivar_compra_cuentas_x_pagar')->default(1);
            $table->boolean('conciliacion')->default(1);
            $table->boolean('crear_conciliacion')->default(1);
            $table->boolean('modificar_conciliacion')->default(1);
            $table->boolean('ver_botones_conciliacion')->default(1);
            $table->boolean('desactivar_conciliacion')->default(1);
            $table->boolean('reactivar_conciliacion')->default(1);
            $table->timestamps();
        });




        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('user_login', 60);
            $table->string('user_name', 60);
            $table->string('email', 100)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 70);
            $table->unsignedBigInteger('permiso_id')->nullable();
            $table->boolean('status')->default(1);

            $table->foreign('permiso_id')->references('id')->on('permisos');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
        Schema::dropIfExists('permisos');
    }
}
