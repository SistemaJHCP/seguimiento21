<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name("inicio");

Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

Route::middleware('auth')->prefix('usuario')->group(function () {
    Route::get('/', [App\Http\Controllers\UsuarioController::class, 'index'])->name('usuario.index');
    Route::get('lista-de-usuarios', [App\Http\Controllers\UsuarioController::class, 'jq_listar_usuarios']);
    Route::post('cargar-un-usuario', [App\Http\Controllers\UsuarioController::class, 'store'])->name('usuario.cargarUsuario');
    Route::post('modificarUsuario/sef1scxg{id}3oscos425ddf23sdnp', [App\Http\Controllers\UsuarioController::class, 'jq_consultarUsuariosModificar']);
    Route::post('modificando/a', [App\Http\Controllers\UsuarioController::class, 'update'])->name('usuario.modificandoUsuario');
    Route::post("eliminarUsuario/8yg28yb2728{id}282", [App\Http\Controllers\UsuarioController::class, 'desactivate']);
    Route::get("inhabilitados", [App\Http\Controllers\UsuarioController::class, 'inhabilitado'])->name('usuario.inhabilitados');
    Route::get("lista-inhabilitados", [App\Http\Controllers\UsuarioController::class, 'jq_listaInhabilitado']);
    Route::post("reactivar/8y8gstudigf6r5drt8{id}2820u9hid", [App\Http\Controllers\UsuarioController::class, 'jq_reactivar']);
});

Route::middleware('auth')->prefix('cliente')->group(function () {
    Route::get('/', [App\Http\Controllers\ClienteController::class, 'index'])->name('cliente.index');
    Route::get("lista-de-clientes", [App\Http\Controllers\ClienteController::class, 'js_listaClientes']);
    Route::post("cargar-cliente", [App\Http\Controllers\ClienteController::class, 'store'])->name("cliente.crear");
    Route::get("consultar-cliente/pcs9pjsaklsa9s0uo08s97c8675s44sartfsu{id}giyu9as087tc6r5as4ctrfsgvhjcasoci", [App\Http\Controllers\ClienteController::class, 'show'])->name("cliente.consultar");
    Route::get("modificar/09786tyfhghi897t6r75e64srtdtyguipoknjbyuftdyrserz34xcuy4gh{id}o8i", [App\Http\Controllers\ClienteController::class, 'edit'])->name("cliente.modificar");
    Route::post("modificar-cliente/h8csscuhc89dct79guyscbjocsbictf67asce4axe543dcdracgvawd89awdtg789aw{id}dvyawd", [App\Http\Controllers\ClienteController::class, 'update'])->name("cliente.modificando");
    Route::post("deshabilitando/{id}", [App\Http\Controllers\ClienteController::class, 'jq_deshabilitar']);
    //Route::post("", [App\Http\Controllers\CodventasController::class, 'js_listaClientes'])->name();
});

Route::middleware('auth')->prefix('maestroPTC')->group(function () {
    Route::get("/", [App\Http\Controllers\CodventasController::class, 'index'])->name("maestro.index");
    Route::get("lista-ptc", [App\Http\Controllers\CodventasController::class, 'jq_listaPTC']);
    Route::post("cargarPTC", [App\Http\Controllers\CodventasController::class, 'store'])->name("maestro.crear");
    Route::get("consulta-de-ptc/98yutguio{id}231df98e7tefohfe97tef", [App\Http\Controllers\CodventasController::class, 'show'])->name("maestro.consultar");
    Route::get("modificar-de-ptc/97yu33d{id}09u8uyghedvfted7yuehdjediuy7tyegd", [App\Http\Controllers\CodventasController::class, 'edit'])->name("maestro.modificar");
    Route::post("modificando-ptc/97yu33d09u8uyghedvfted7yuehdjediuy{id}7tyegd", [App\Http\Controllers\CodventasController::class, 'update'])->name("maestro.modificando");
    Route::post("eliminar-ptc/8yg28yb2728{id}282", [App\Http\Controllers\CodventasController::class, 'jq_desactivar']);
});

Route::middleware('auth')->prefix('control-de-obras')->group(function () {
    Route::get("/",[App\Http\Controllers\ObraController::class, 'index'])->name('obra.index');
    Route::get("lista-de-obras",[App\Http\Controllers\ObraController::class, 'jq_lista']);
    Route::get("crear-obra",[App\Http\Controllers\ObraController::class, 'create'])->name('obra.crear');
    Route::get("consultar-coord/{id}",[App\Http\Controllers\ObraController::class, 'consultarCoord']);
    Route::post("cargando", [App\Http\Controllers\ObraController::class, 'store'])->name('obra.creando');
    Route::get("ver-obra/89ssgvd76ds7tdsgds8gsuddrdst789dsijbhsdvt{id}9s7dds8gsd", [App\Http\Controllers\ObraController::class, 'show'])->name('obra.ver');
    Route::get("modificar-obra/9s7dds8gsd891ssgvd7gs89dsijbhsdvt23{id}d3d4d321", [App\Http\Controllers\ObraController::class, 'edit'])->name('obra.modificar');
    Route::get("modificar-personal-3948/8330/{id}", [App\Http\Controllers\ObraController::class, 'consultarPersonal3456']);
    Route::post("modificando/09uyhc9ed8y7ygeuhijei8ye{id}7t6yegc", [App\Http\Controllers\ObraController::class, 'update'])->name('obra.modificando');
    Route::post("eliminando-personal-obra", [App\Http\Controllers\ObraController::class, 'eliminarPersonalRelacionadoObra']);
    Route::post("desactivar/i9u4rdddu9ih", [App\Http\Controllers\ObraController::class, 'desactivarObra']);
});

Auth::routes();


