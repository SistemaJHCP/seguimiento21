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
    Route::post('/cambiar-password', [App\Http\Controllers\HomeController::class, 'cambiarClave'])->name('home.clave');
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
    Route::post("cambiar-contrasena", [App\Http\Controllers\UsuarioController::class, 'cambiarClave'])->name('usuario.cambiarClave');
});

Route::middleware('auth')->prefix('cliente')->group(function () {
    Route::get('/', [App\Http\Controllers\ClienteController::class, 'index'])->name('cliente.index');
    Route::get("lista-de-clientes", [App\Http\Controllers\ClienteController::class, 'js_listaClientes']);
    Route::post("rehabilitar/ihuu9jjpou0y9tt", [App\Http\Controllers\ClienteController::class, 'js_rehabilitar']);
    Route::get("lista-deshabilitado", [App\Http\Controllers\ClienteController::class, 'js_deshabilitados']);
    Route::post("cargar-cliente", [App\Http\Controllers\ClienteController::class, 'store'])->name("cliente.crear");
    Route::get("consultar-cliente/pcs9pjsaklsa9s0uo08s97c8675s44sartfsu{id}giyu9as087tc6r5as4ctrfsgvhjcasoci", [App\Http\Controllers\ClienteController::class, 'show'])->name("cliente.consultar");
    Route::get("modificar/09786tyfhghi897t6r75e64srtdtyguipoknjbyuftdyrserz34xcuy4gh{id}o8i", [App\Http\Controllers\ClienteController::class, 'edit'])->name("cliente.modificar");
    Route::post("modificar-cliente/h8csscuhc89dct79guyscbjocsbictf67asce4axe543dcdracgvawd89awdtg789aw{id}dvyawd", [App\Http\Controllers\ClienteController::class, 'update'])->name("cliente.modificando");
    Route::post("deshabilitando/{id}", [App\Http\Controllers\ClienteController::class, 'jq_deshabilitar']);
    Route::get("reactivar-cliente", [App\Http\Controllers\ClienteController::class, 'reactivar'])->name('cliente.reactivar');
    //Route::post("", [App\Http\Controllers\CodventasController::class, 'js_listaClientes'])->name();
});

Route::middleware('auth')->prefix('maestroPTC')->group(function () {
    Route::get("/", [App\Http\Controllers\CodventasController::class, 'index'])->name("maestro.index");
    Route::get("lista-ptc", [App\Http\Controllers\CodventasController::class, 'jq_listaPTC']);
    Route::get("lista-ptc-a-deshabilitar", [App\Http\Controllers\CodventasController::class, 'jq_listaPTCRehabilitar']);
    Route::post("cargarPTC", [App\Http\Controllers\CodventasController::class, 'store'])->name("maestro.crear");
    Route::get("consulta-de-ptc/98yutguio{id}231df98e7tefohfe97tef", [App\Http\Controllers\CodventasController::class, 'show'])->name("maestro.consultar");
    Route::get("modificar-de-ptc/97yu33d{id}09u8uyghedvfted7yuehdjediuy7tyegd", [App\Http\Controllers\CodventasController::class, 'edit'])->name("maestro.modificar");
    Route::post("modificando-ptc/97yu33d09u8uyghedvfted7yuehdjediuy{id}7tyegd", [App\Http\Controllers\CodventasController::class, 'update'])->name("maestro.modificando");
    Route::post("eliminar-ptc/8yg28yb2728{id}282", [App\Http\Controllers\CodventasController::class, 'jq_desactivar']);
    Route::get("reactivar-ptc", [App\Http\Controllers\CodventasController::class, 'reactivar'])->name("maestro.reactivar");
    Route::post("rehabilitar/987yguhsjyt7y8ud90", [App\Http\Controllers\CodventasController::class, 'reactivando']);
});

Route::middleware('auth')->prefix('tipo')->group(function () {
    Route::get("/",[App\Http\Controllers\TipoController::class, 'index'])->name('tipo.index');
    Route::get("lista-de-tipos-de-obras",[App\Http\Controllers\TipoController::class, 'jq_listaObras']);
    Route::post("crear-tipo",[App\Http\Controllers\TipoController::class, 'store'])->name('tipo.crear');
    Route::post("modificar-tipo/4567ygsvgy765srty3ush93ts5r",[App\Http\Controllers\TipoController::class, 'update'])->name('tipo.modificar');
    Route::get("busqueda-tipo/{id}",[App\Http\Controllers\TipoController::class, 'jq_busquedaTipo']);
    Route::get("deshabilitando/{id}",[App\Http\Controllers\TipoController::class, 'jq_deshabilitar']);

});

Route::middleware('auth')->prefix('personal')->group(function () {
    Route::get("/",[App\Http\Controllers\PersonalController::class, 'index'])->name('personal.index');
    Route::get("lista-de-personal",[App\Http\Controllers\PersonalController::class, 'jq_listaPersonal']);
    Route::post("cargar-personal",[App\Http\Controllers\PersonalController::class, 'store'])->name('personal.crear');
    Route::post("modificar-personal",[App\Http\Controllers\PersonalController::class, 'update'])->name('personal.modificar');
    Route::get("modificar/y89onjhehy89{id}",[App\Http\Controllers\PersonalController::class, 'jq_traerDatos']);
    Route::post("eliminar-personal/{id}",[App\Http\Controllers\PersonalController::class, 'jq_deshabilitar']);
    Route::get("reactivar-personal",[App\Http\Controllers\PersonalController::class, 'reactivarPersonal'])->name('personal.reactivar');
    Route::get("lista-de-personal-a-rehabilitar",[App\Http\Controllers\PersonalController::class, 'jq_listaRehabilitar']);
    Route::post("habilitando-personal/ou9hugyhi99dhuyg78d9i0",[App\Http\Controllers\PersonalController::class, 'reactivando']);
});

Route::middleware('auth')->prefix('control-de-obras')->group(function () {
    Route::get("/",[App\Http\Controllers\ObraController::class, 'index'])->name('obra.index');
    Route::get("lista-de-obras",[App\Http\Controllers\ObraController::class, 'jq_lista']);
    Route::get("crear-obra",[App\Http\Controllers\ObraController::class, 'create'])->name('obra.crear');
    Route::get("consultar-coord/{id}",[App\Http\Controllers\ObraController::class, 'consultarCoord']);
    Route::post("cargando", [App\Http\Controllers\ObraController::class, 'store'])->name('obra.creando');
    // Route::get("ver-obra/89ssgvd76ds7tdsgds8gsuddrdst789dsijbhsdvt{id}9s7dds8gsd", [App\Http\Controllers\ObraController::class, 'show'])->name('obra.ver');
    Route::get("modificar-obra/9s7dds8gsd891ssgvd7gs89dsijbhsdvt23{id}d3d4d321", [App\Http\Controllers\ObraController::class, 'edit'])->name('obra.modificar');
    Route::get("modificar-personal-3948/8330/{id}", [App\Http\Controllers\ObraController::class, 'consultarPersonal3456']);
    Route::post("modificando/09uyhc9ed8y7ygeuhijei8ye{id}7t6yegc", [App\Http\Controllers\ObraController::class, 'update'])->name('obra.modificando');
    Route::post("eliminando-personal-obra", [App\Http\Controllers\ObraController::class, 'eliminarPersonalRelacionadoObra']);
    Route::post("desactivar/i9u4rdddu9ih", [App\Http\Controllers\ObraController::class, 'jq_desactivarObra']);
    Route::post("reactivar/39u4radea9ih", [App\Http\Controllers\ObraController::class, 'jq_reactivarObra']);
    Route::get("reactivar-obra", [App\Http\Controllers\ObraController::class, 'reactivar'])->name('obra.reactivar');
    Route::get("lista-de-obras-deshabilitadas/09uyghid9876tdyuido",[App\Http\Controllers\ObraController::class, 'jq_listaDes']);

    Route::post("valuaciones-cargadas/987yujiy765t78idd", [App\Http\Controllers\ObraController::class, 'consultarValuacion']);
    Route::post("valuaciones-mod-valuacion/987yujiy{id}765t78idd", [App\Http\Controllers\ObraController::class, 'updateValuacion'])->name('valuacion.modificar');
    Route::get("valuacion-obra/9y7yuu0ij{id}d68jbhgu8yt7d3gyuhijo23", [App\Http\Controllers\ObraController::class, 'indexValuacion'])->name('obra.valuacion.index');
    Route::post("valuation/crear", [App\Http\Controllers\ObraController::class, 'valuacionCreate'])->name('valuacion.crear');
    Route::post("desactivar/876tyu89ojbhdbvgytrdrftgyh", [App\Http\Controllers\ObraController::class, 'desactivarValuacion']);

    Route::post("consultar-dato-obra", [App\Http\Controllers\ObraController::class, 'consultarObra']);
});

Route::middleware('auth')->prefix('suministros')->group(function () {
    Route::get("/",[App\Http\Controllers\SuministroController::class, 'index'])->name('suministro.index');
    Route::get("listado-suministro",[App\Http\Controllers\SuministroController::class, 'jq_lista']);
    Route::post('agregando',[App\Http\Controllers\SuministroController::class, 'store'])->name("suministro.guardar");
    Route::get("modificar/98uihjhsft6t79ys8u{id}",[App\Http\Controllers\SuministroController::class, 'jq_modificar']);
    Route::post("modificando/9ihbi8cgdu",[App\Http\Controllers\SuministroController::class, 'update'])->name("suministro.modificar");
    Route::get("deshabilitar/cefefdfsfdsfys8u{id}", [App\Http\Controllers\SuministroController::class, 'js_deshabilitar']);
    Route::get("habilitar/cefe45fdfds6v3svdvsf9ds30fys098u{id}", [App\Http\Controllers\SuministroController::class, 'js_habilitar']);
    Route::get("suministros-deshabilitados", [App\Http\Controllers\SuministroController::class, 'indexDeshabilitados'])->name("suministros.deshabilitados");
    Route::get("listado-suministros-deshabilitados",[App\Http\Controllers\SuministroController::class, 'jq_listaDes']);
});

Route::middleware('auth')->prefix('proveedores')->group(function () {
    Route::get("/",[App\Http\Controllers\ProveedoresController::class, 'index'])->name('proveedor.index');
    Route::get("lista-proveedores",[App\Http\Controllers\ProveedoresController::class, 'jq_lista']);
    Route::post("creando",[App\Http\Controllers\ProveedoresController::class, 'store'])->name('proveedor.crear');
    Route::get("consultar-proveedor/90dcghuocdtd7cgudocudc0y8{id}cd",[App\Http\Controllers\ProveedoresController::class, 'show'])->name('proveedor.consultar');
    Route::get("modificar-proveedor/19102d34cghu5ocd56td7cgudoasascudc0y8{id}cd",[App\Http\Controllers\ProveedoresController::class, 'edit'])->name('proveedor.modificar');
    Route::post("modificando-proveedor/191treoe7cgudoasascudc0y8{id}cd",[App\Http\Controllers\ProveedoresController::class, 'update'])->name('proveedor.modificando');
    Route::post("desactivar-proveedor/191trwfwddsgyhus64567ushcd",[App\Http\Controllers\ProveedoresController::class, 'destroy']);
    Route::get("cuenta-bancaria/5678uhgbjdiuyt567du{id}agdb4hj23md7h", [App\Http\Controllers\BancoController::class, 'consultar'])->name('proveedor.cuenta');
    Route::post("guardar-cuenta", [App\Http\Controllers\BancoController::class, 'store'])->name('proveedor.guardarCuenta');
    Route::post("desactivar-cuenta/tgyu89876tty789oiuhgfdrftgyhuji9u8ygtfcdxedrfty7ytrfdfgyuiokjhgf",[App\Http\Controllers\BancoController::class, 'jq_desactivar']);
    Route::get("deshabilitadas",[App\Http\Controllers\ProveedoresController::class, 'deshabilitadas'])->name('proveedor.deshabilitada');
    Route::get("lista-proveedores-deshabilitadas",[App\Http\Controllers\ProveedoresController::class, 'jq_listaDeshabilitada']);
    Route::post("reactivar-proveedor/poiuy7t6fyguiuo",[App\Http\Controllers\ProveedoresController::class, 'reactivarProveedor']);
});

Route::middleware('auth')->prefix('materiales')->group(function () {
    Route::get("/",[App\Http\Controllers\MaterialController::class, 'index'])->name('materiales.index');
    Route::get("lista-materiales", [App\Http\Controllers\MaterialController::class, 'jq_material']);
    Route::post("cargar-materiales", [App\Http\Controllers\MaterialController::class, 'store'])->name('materiales.crear');
    Route::post("modificar-materiales", [App\Http\Controllers\MaterialController::class, 'update'])->name('materiales.modificar');
    Route::get("modificar-material/j92bsnkjiugy2dhijokdlm32{id}", [App\Http\Controllers\MaterialController::class, 'jq_modificar']);
    Route::post("eliminar-material/j192bs2qnsqk1ji8ugy27dhijokd5l55", [App\Http\Controllers\MaterialController::class, 'destroy']);
});



Route::middleware('auth')->prefix('requisicion')->group(function () {
    Route::get("/",[App\Http\Controllers\RequisicionController::class, 'index'])->name('requisicion.index');
    Route::get("lista-de-requisicion",[App\Http\Controllers\RequisicionController::class, 'jq_lista']);
    Route::get("crear-requisicion",[App\Http\Controllers\RequisicionController::class, 'create'])->name('requisicion.crear');
    Route::get("tipo-solicitud/{valor}/987yuisjihu8u7t6rstfyuiijshugytfrs5t6",[App\Http\Controllers\RequisicionController::class, 'jq_consultarTipo']);
    Route::get("consultar-proveedor/987yuiokkjhgy8u9i9876edght{id}", [App\Http\Controllers\RequisicionController::class, 'jq_consultarprov']);
    Route::get("consultar-obra/vhbjihugvcf5678uishugfdrstfyg8t7stc{id}", [App\Http\Controllers\RequisicionController::class, 'jq_consultarObra']);
    Route::get("consultar-nombre-concepto/x33ddwqfvhbjihugvcdcdf5678t7stc{id}/{tipo}", [App\Http\Controllers\RequisicionController::class, 'jq_consultarNombreConcepto']);
    Route::post("cargar-requisicion", [App\Http\Controllers\RequisicionController::class, 'store'])->name('requisicion.cargar');
    Route::get("consultar/098husnkhsuhii0s9u8ustfyguiusoi08s9y8{id}ugysyugyiuoisp0u8yt7ys8s99ushi",[App\Http\Controllers\RequisicionController::class, 'show'])->name('requisicion.ver');
    Route::get("modificar/9yuidjhu98dyujdnbgyuiod8{id}7ywnbtfgj3hty78y",[App\Http\Controllers\RequisicionController::class, 'edit'])->name('requisicion.modificar');
    Route::get("modificar/consultar-materiales-guardados/6t7yhutgyuhy7t6{id}/{tipo}",[App\Http\Controllers\RequisicionController::class, 'jq_listaMateriales']);
    Route::get("eliminar-solicitud-de-material/{id}",[App\Http\Controllers\RequisicionController::class, 'destroy'])->name('requisicion.eliminar');
    Route::post("modificar-nombre-concepto/x33ddwqfvhbjihugvcdcdf5678t7stc", [App\Http\Controllers\RequisicionController::class, 'jq_modificarNombreConcepto']);
    Route::post("modificar-formulario/87ytyuijgtyu8987tyui{id}jhgft5ertyhftyutrtyuihgfty7",[App\Http\Controllers\RequisicionController::class, 'update'])->name('requisicion.modificarCampo');
    Route::post("anular-requisicion/metodo-app/huijbvcfghji66789ijdvgyu8d7yt",[App\Http\Controllers\RequisicionController::class, 'anular'])->name('requisicion.anular');
});


Route::middleware('auth')->prefix('solicitud')->group(function () {
    Route::get("/",[App\Http\Controllers\SolicitudController::class, 'index'])->name('solicitud.index');
    Route::get("crear-solicitud",[App\Http\Controllers\SolicitudController::class, 'create'])->name('solicitud.crear');
    Route::get("lista-de-solicitud",[App\Http\Controllers\SolicitudController::class, 'jq_lista']);
    Route::get("consultar-obra/{id}",[App\Http\Controllers\SolicitudController::class, 'consultarObra']);
    Route::get("consultar-proveedores/{id}",[App\Http\Controllers\SolicitudController::class, 'consultarProveedores']);
    Route::get("listar-requisicion/{id}",[App\Http\Controllers\SolicitudController::class, 'listarRequisicion']);
    Route::get("consultar-requisicion/{id}/{valor}",[App\Http\Controllers\SolicitudController::class, 'consultarRequisicion']);
    Route::get("numero-de-cuenta/{id}",[App\Http\Controllers\SolicitudController::class, 'consultarNroCuenta']);
    Route::get("lista-de-momina",[App\Http\Controllers\SolicitudController::class, 'consultarNomina']);
    Route::get("lista-de-materiales/{id}",[App\Http\Controllers\SolicitudController::class, 'consultarListaMateriales']);
    Route::post("cargar-nombre-concepto",[App\Http\Controllers\SolicitudController::class, 'cargarNombreConcepto']);
    Route::post("cargar-solicitud-completa",[App\Http\Controllers\SolicitudController::class, 'store'])->name('solicitud.cargarSolicitud');
    Route::get("anulacion-solicitud/{id}",[App\Http\Controllers\SolicitudController::class, 'destroy']);
    Route::get("consultar/98uyuijdhy8987dy9ojidu8998d76tyuihdhvgt5dr{id}tygtwr4e3wertygsft65rdty7udh",[App\Http\Controllers\SolicitudController::class, 'show'])->name('solicitud.consultar');
    Route::get("modificar/987yuiijnhghui98u7ytfr{id}tdgu8",[App\Http\Controllers\SolicitudController::class, 'edit'])->name('solicitud.modificar');
    Route::post("modificar-el-dato/987yuii34rewsdefr3ewerffcdsjnhghui98u7ytfr{id}tdgu8",[App\Http\Controllers\SolicitudController::class, 'update'])->name('solicitud.modificarSolicitud');
    Route::post("primeraCarga/87yushdyu87dyghunjdhu8d7",[App\Http\Controllers\SolicitudController::class, 'cargaInicial']);
    Route::get("listar-requisicionsegun-requerimiento/{tipo}/{valor}",[App\Http\Controllers\SolicitudController::class, 'consultarListaReq']);
    Route::post("agregar-material-extra",[App\Http\Controllers\SolicitudController::class, 'agregarMaterialExtra']);
    Route::post("eliminar-una-solicitud",[App\Http\Controllers\SolicitudController::class, 'eliminarSolicitudDetalle']);

    Route::get("solicitud-de-pago/",[App\Http\Controllers\SolicitudController::class, 'solicitudesPagoIndex'])->name('sPagoIndex.index');
    Route::get("solicitud-de-pago/lista-solicitud/",[App\Http\Controllers\SolicitudController::class, 'solicitudesPagoLista']);
    Route::get("solicitud-de-pago/consultar/validar/87tyuhhgvxugfsft6787t6s6t7y8u9sxihugyxsf7t{id}8yxst7s",[App\Http\Controllers\SolicitudController::class, 'consultarAprobacion'])->name('sPagoIndex.consultarAprobacion');
    Route::post("solicitud-de-pago/respuesta1",[App\Http\Controllers\SolicitudController::class, 'solicitudesPagoRespuestaAprobada'])->name('sPagoIndex.respuesta1');
    Route::post("solicitud-de-pago/respuesta2",[App\Http\Controllers\SolicitudController::class, 'solicitudesPagoRespuestaNegada'])->name('sPagoIndex.respuesta2');

    Route::get("solicitud-de-pago/costos-de-obra",[App\Http\Controllers\SolicitudController::class, 'costoObraIndex'])->name('costosObra.index');

    Route::post("calculo-solicitudes",[App\Http\Controllers\SolicitudController::class, 'calcularSolicitud']);
    Route::get("obra-seleccionada/{id}",[App\Http\Controllers\SolicitudController::class, 'controlGasto']);
    Route::post("estadistica",[App\Http\Controllers\SolicitudController::class, 'calcularEstadistica'])->name('solicitud.estadistica');
    Route::get("calcular-histograma/{id}",[App\Http\Controllers\SolicitudController::class, 'histograma']);
    Route::get("calcular-grafica/{id}",[App\Http\Controllers\SolicitudController::class, 'graficoGastos']);
});
Route::middleware('auth')->prefix('servicio')->group(function () {
    Route::get("/",[App\Http\Controllers\ServicioController::class, 'index'])->name('servicio.index');
    Route::get("lista-servicios",[App\Http\Controllers\ServicioController::class, 'jq_lista']);
    Route::post("cargar-servicio",[App\Http\Controllers\ServicioController::class, 'store'])->name('servicio.guardar');
    Route::post("eliminar-servicio",[App\Http\Controllers\ServicioController::class, 'destroy']);
});

Route::middleware('auth')->prefix('viatico')->group(function () {
    Route::get("/",[App\Http\Controllers\ViaticoController::class, 'index'])->name('viatico.index');
    Route::post("cargar-viatico",[App\Http\Controllers\ViaticoController::class, 'store'])->name('viatico.guardar');
    Route::get("lista-viaticos",[App\Http\Controllers\ViaticoController::class, 'jq_lista']);
    Route::post("deshabilitar-viatico",[App\Http\Controllers\ViaticoController::class, 'destroy']);
});

Route::middleware('auth')->prefix('solicitud/cuentas')->group(function () {
    Route::get("/",[App\Http\Controllers\SolicitudController::class, 'indexCuenta'])->name('cuentas.index');
    Route::get("solicitud-de-pago/{id}",[App\Http\Controllers\SolicitudController::class, 'solicitudesPagoCuenta']);
    Route::get("consultar/76yuijshy787sysj{id}iusy8s9uygshji7s",[App\Http\Controllers\SolicitudController::class, 'showCuenta'])->name('cuentas.consultar');
    Route::post("guardar-cuenta",[App\Http\Controllers\SolicitudController::class, 'createCuenta'])->name('cuentas.crear');
    Route::post("anular-cuenta",[App\Http\Controllers\SolicitudController::class, 'anularCuenta'])->name('cuentas.anularCuenta');
    Route::post("busqueda-chequera/65rdt78u9i0dibhdgyt65rdd",[App\Http\Controllers\ChequeraController::class, 'buscarChequera_Solicitud']);
    Route::post("busqueda-cheque/98u7ytfghuiijuyftrserdtyyuy7tt",[App\Http\Controllers\ChequeController::class, 'buscarCheque_solicitud']);
});

Route::middleware('auth')->prefix('conciliacion')->group(function () {
    Route::get("/",[App\Http\Controllers\ConciliacionController::class, 'index'])->name('conciliacion.index');
    Route::post("imprimir-conciliacion",[App\Http\Controllers\ConciliacionController::class, 'imprimirConciliacion'])->name('conciliacion.imprimir');
});

Route::middleware('auth')->prefix('permisos')->group(function () {
    Route::get("/", [App\Http\Controllers\PermisosController::class, 'index'])->name('permisos.index');
    Route::get("lista-permisos", [App\Http\Controllers\PermisosController::class, 'jq_lista']);
    Route::get("crear-permisos", [App\Http\Controllers\PermisosController::class, 'create'])->name('permisos.crear');
    Route::post("cargar-permisos", [App\Http\Controllers\PermisosController::class, 'store'])->name('permisos.cargar');
    Route::get("modificar-permisos/yuid7gytdyuh9i87yduhijnjdhuh8{id}ud87gyd", [App\Http\Controllers\PermisosController::class, 'edit'])->name('permiso.modificar');
    Route::post("modificar-permisos/7gytd48yuh3{id}39i87yduhijnjdhu", [App\Http\Controllers\PermisosController::class, 'update'])->name('permisos.modificar');
    Route::post("desactivar/i9u4928sdd92sdv6272dv82rdddvdu9ih", [App\Http\Controllers\PermisosController::class, 'deshabilitar']);
});

Route::middleware('auth')->prefix('nomina')->group(function () {
    Route::get("/", [App\Http\Controllers\NominaController::class, 'index'])->name('nomina.index');
    Route::get("listado-nomina", [App\Http\Controllers\NominaController::class, 'jq_lista']);
    Route::post("guardar-nomina", [App\Http\Controllers\NominaController::class, 'store'])->name('nomina.guardar');
    Route::get("modificar/8uhdi7282j92uh2j{id}", [App\Http\Controllers\NominaController::class, 'edit']);
    Route::post("modificar-nomina", [App\Http\Controllers\NominaController::class, 'update'])->name('nomina.modificar');
    Route::get("deshabilitar/cwd34qfe5vc2u{id}", [App\Http\Controllers\NominaController::class, 'destroy']);
    Route::get("nominas-deshabilitadas", [App\Http\Controllers\NominaController::class, 'disabled'])->name('nomina.deshabilitadas');
    Route::get("listado-nomina-deshabilitada", [App\Http\Controllers\NominaController::class, 'jq_listaDeshabilitadas']);
    Route::get("rehabilitar/87yuijdhhudegy7y8{id}", [App\Http\Controllers\NominaController::class, 'enabled']);
});

Route::middleware('auth')->prefix('bancos')->group(function () {
    Route::get("/",[App\Http\Controllers\BancoController::class, 'index'])->name('banco.index');
    Route::get("listado-bancos", [App\Http\Controllers\BancoController::class, 'jq_lista']);
    Route::post("guardar-banco",[App\Http\Controllers\BancoController::class, 'guardar'])->name('banco.guardar');
    Route::post("modificar/eweefwefwef2uh2j",[App\Http\Controllers\BancoController::class, 'edit']);
    Route::post("modificar-banco",[App\Http\Controllers\BancoController::class, 'update'])->name('banco.modificar');
    Route::post("desactivar-banco",[App\Http\Controllers\BancoController::class, 'destroy']);
});

Route::middleware('auth')->prefix('bancos/cuentas')->group(function () {
    Route::get("/",[App\Http\Controllers\CuentaController::class, 'index'])->name('cuenta.index');
    Route::get("listado-bancos-empresa", [App\Http\Controllers\CuentaController::class, 'jq_lista']);
    Route::post("cargar_bancos_empresa",[App\Http\Controllers\CuentaController::class, 'store'])->name('cuenta.guardar');
    Route::post("mostrar-modificacion",[App\Http\Controllers\CuentaController::class, 'edit']);
    Route::post("modificando_bancos_empresa",[App\Http\Controllers\CuentaController::class, 'update'])->name('cuenta.guardando');
    Route::post("desactivar-banco-jhcp",[App\Http\Controllers\CuentaController::class, 'destroy']);
});

Route::middleware('auth')->prefix('bancos/cuentas/chequeras')->group(function () {
    Route::get("87yygu8u9oihdhvgyg7y8d98y7y{id}dgu9i0d",[App\Http\Controllers\ChequeraController::class, 'index'])->name('chequera.index');
    Route::get("modificar/9yedide7t6tfgihe/{id}",[App\Http\Controllers\ChequeraController::class, 'edit']);
    Route::post("modificando/poi2u287y2gihe",[App\Http\Controllers\ChequeraController::class, 'update'])->name('chequera.modificar');
    Route::get("lista-chequera/{id}",[App\Http\Controllers\ChequeraController::class, 'jq_lista']);
    Route::post("crear-nueva-chequera",[App\Http\Controllers\ChequeraController::class, 'store'])->name('chequera.crear');
    Route::post("desactivar/98uyuikjhui9uygvg2yui98uywghuis",[App\Http\Controllers\ChequeraController::class, 'destroy']);
});

Route::middleware('auth')->prefix('bancos/cuentas/chequeras/cheque')->group(function () {
    Route::get("iuyyd9ii98ytghdidu23ewq2234e3ws2d32dssd{id}dgu9i0d",[App\Http\Controllers\ChequeController::class, 'index'])->name('cheque.index');
    Route::get("lista-cheque/{id}",[App\Http\Controllers\ChequeController::class, 'jq_lista']);
    Route::post("crear-un-cheque",[App\Http\Controllers\ChequeController::class, 'store'])->name('cheque.crear');
    Route::post("anular-cheque",[App\Http\Controllers\ChequeController::class, 'destroy']);
});




Auth::routes();

