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
