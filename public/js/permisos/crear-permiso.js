$(document).ready(function(){



    $("#maestro").click(function(){

        $('#opcionesMaestro').toggle(400);

        if( $(this).is(':checked') == false ){
            limpiarSuministro();
            limpiarProveedores();
            limpiarClientes();
            limpiarMaestroMateriales();
            limpiarMaestroServicio();
            limpiarMaestroViativo();
            limpiarUsuarios();
            limpiarPermisos();
            limpiarMaestroPTC();
        }

    });

    $("#Bancos").click(function(){

        $('#opcionesBancos').toggle(400);
        if( $(this).is(':checked') == false ){
            limpiarCuentaEmp();
            limpiarChequera();
            limpiarCheque();
        }


    });



    $("#obra").click(function(){
        $('#opcionesObras').toggle(400);

        if( $(this).is(':checked') == false ){
            obra();
            tipoObra();
            personal();
        }
    });

    $("#requisicion").click(function(){
        $('#opcionesRequisicion').toggle(400);
        requisicion();
    });

    $("#solicitud").click(function(){
        $('#opcionesSolicitud').toggle(400);
        solicitud();
        opcionesDeBotones();
    });

    $("#pago").click(function(){
        $('#opcionesPago').toggle(400);
        pagos()
    });

    $("#cuentasx").click(function(){
        $('#opcionesCXP').toggle(400);
        cxp();
        conciliacion();
    });

    $("#configuracion").click(function(){
        $('#opcionesConfiguracion').toggle(400);
        usuarios();
        permisos();
    });


    function limpiarSuministro(){
        $('#sum').prop("checked", "");
        $('#crearSum').prop("checked", "");
        $('#modSum').prop("checked", "");
        $('#verSum').prop("checked", "");
        $('#desSum').prop("checked", "");
        $('#reacSum').prop("checked", "");
    }

    function limpiarProveedores(){
        $('#prov').prop("checked", "");
        $('#crearProv').prop("checked", "");
        $('#modProv').prop("checked", "");
        $('#verProv').prop("checked", "");
        $('#desProv').prop("checked", "");
        $('#reacProv').prop("checked", "");
    }

    function limpiarClientes(){
        $('#cli').prop("checked", "");
        $('#crearCli').prop("checked", "");
        $('#modCli').prop("checked", "");
        $('#verCli').prop("checked", "");
        $('#desCli').prop("checked", "");
        $('#reacCli').prop("checked", "");
    }

    function limpiarCuentaEmp(){
        $('#CuentaEmp').prop("checked", "");
        $('#crearCuentaEmp').prop("checked", "");
        $('#modCuentaEmp').prop("checked", "");
        $('#verCuentaEmp').prop("checked", "");
        $('#desCuentaEmp').prop("checked", "");
    }

    function limpiarChequera(){
        $('#chequera').prop("checked", "");
        $('#crearChequera').prop("checked", "");
        $('#modChequera').prop("checked", "");
        $('#verChequera').prop("checked", "");
        $('#desChequera').prop("checked", "");
    }

        function limpiarCheque(){
        $('#Cheque').prop("checked", "");
        $('#crearCheque').prop("checked", "");
        $('#modCheque').prop("checked", "");
        $('#verCheque').prop("checked", "");
        $('#anularCheque').prop("checked", "");
    }

    function limpiarMaestroMateriales(){
        $('#mate').prop("checked", "");
        $('#crearMate').prop("checked", "");
        $('#verMate').prop("checked", "");
        $('#desMate').prop("checked", "");
    }

    function limpiarMaestroServicio(){
        $('#serv').prop("checked", "");
        $('#crearServ').prop("checked", "");
        $('#verServ').prop("checked", "");
        $('#desServ').prop("checked", "");
    }

    function limpiarMaestroViativo(){
        $('#viat').prop("checked", "");
        $('#crearViat').prop("checked", "");
        $('#verViat').prop("checked", "");
        $('#desViat').prop("checked", "");
    }

    function limpiarUsuarios(){
        $('#usua').prop("checked", "");
        $('#crearUsuario').prop("checked", "");
        $('#modUsuario').prop("checked", "");
        $('#verUsuario').prop("checked", "");
        $('#desUsuario').prop("checked", "");
        $('#reacUsuario').prop("checked", "");
    }

    function limpiarPermisos(){
        $('#perm').prop("checked", "");
        $('#crearPerm').prop("checked", "");
        $('#modPerm').prop("checked", "");
        $('#verPerm').prop("checked", "");
        $('#desPerm').prop("checked", "");
        $('#reacPerm').prop("checked", "");
    }

    function limpiarMaestroPTC(){
        $('#master').prop("checked", "");
        $('#crearMaster').prop("checked", "");
        $('#modMaster').prop("checked", "");
        $('#verMaster').prop("checked", "");
        $('#desMaster').prop("checked", "");
        $('#ReacMaster').prop("checked", "");
    }

    //-------------------------------------------------

    function obra(){
        $('#obras').prop("checked", "");
        $('#crearObras').prop("checked", "");
        $('#modObras').prop("checked", "");
        $('#verObras').prop("checked", "");
        $('#desObras').prop("checked", "");
        $('#ReacObras').prop("checked", "");
    }

    function tipoObra(){
        $('#tipos').prop("checked", "");
        $('#crearTipos').prop("checked", "");
        $('#modTipos').prop("checked", "");
        $('#verTipos').prop("checked", "");
        $('#desTipos').prop("checked", "");
    }

    function personal(){
        $('#personal').prop("checked", "");
        $('#crearPersonal').prop("checked", "");
        $('#modPersonal').prop("checked", "");
        $('#verPersonal').prop("checked", "");
        $('#desPersonal').prop("checked", "");
        $('#reacPersonal').prop("checked", "");
    }

    function requisicion(){
        $('#Req').prop("checked", "");
        $('#crearRequisicion').prop("checked", "");
        $('#modRequisicion').prop("checked", "");
        $('#verRequisicion').prop("checked", "");
        $('#anularRequisicion').prop("checked", "");
    }

    function solicitud(){
        $('#hacerSolicitud').prop("checked", "");
        $('#crearSolicitud').prop("checked", "");
        $('#modSolicitud').prop("checked", "");
        $('#verSolicitud').prop("checked", "");
        $('#anularSolicitud').prop("checked", "");
    }

    function opcionesDeBotones(){
        $('#btnMateriales').prop("checked", "");
        $('#btnNomina').prop("checked", "");
        $('#btnServicios').prop("checked", "");
        $('#brnCajaCh').prop("checked", "");
        $('#btnViatico').prop("checked", "");
    }

    function pagos(){
        $('#solPago').prop("checked", "");
        $('#aprobarPago').prop("checked", "");
        $('#verPago').prop("checked", "");
    }

    function cxp(){
        $('#CXP').prop("checked", "");
        $('#aprobarCXP').prop("checked", "");
        $('#verCXP').prop("checked", "");

    }


    function conciliacion(){
        $('#conciliacion').prop("checked", "");
        $('#crearConciliacion').prop("checked", "");
    }


    function usuarios(){
        $('#ConfUsuario').prop("checked", "");
        $('#crearConfUsuario').prop("checked", "");
        $('#modConfUsuario').prop("checked", "");
        $('#verConfUsuario').prop("checked", "");
        $('#desConfUsuario').prop("checked", "");
        $('#ReacConfUsuario').prop("checked", "");
    }


    function permisos(){
        $('#ConfPermisos').prop("checked", "");
        $('#crearConfPermisos').prop("checked", "");
        $('#modConfPermisos').prop("checked", "");
        $('#verConfPermisos').prop("checked", "");
        $('#desConfPermisos').prop("checked", "");
        $('#ReacConfPermisos').prop("checked", "");
    }

    $("#cargarPermisos").click(function(){
        $("form").on("submit", function () {
            $("#cargarPermisos").attr("value", "Guardando, espere...");
            $("#cargarPermisos").prop("disabled", true);
        });
    });

});

