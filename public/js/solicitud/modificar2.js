$(document).ready(function(){

    cargaInicial();

    $('#obra').select2({
        theme: 'bootstrap4'
    });

    $('#conceptoSelect').select2({
        theme: 'bootstrap4'
    });

    $('#proveedor').select2({
        theme: 'bootstrap4'
    });

    $('#cantidadSelect').numeric('.');

    $('#precioUnitarioSelect').numeric('.');

    $('#requisicion').select2({
        theme: 'bootstrap4'
    });

    $('#cantidadSelect').numeric('.');

    $('#precioUnitarioSelect').numeric('.');

    $("#cargarLaSolicitud").click(function(){
        $("form").on("submit", function () {
            $("#cargarLaSolicitud").attr("value", "Guardando, espere...");
            $("#cargarLaSolicitud").prop("disabled", true);
        });
    });


    function cargaInicial(a){

        $.ajax({
            url: '../primeraCarga/87yushdyu87dyghunjdhu8d7',
            type: 'POST',
            // dataType: 'json',
            data:{id: $('#dato').val() },
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        })
        .done(function(comp) {

            var solicitud = comp[0];

            $('#pagos').val( solicitud.solicitud_tiposolicitud );
            $('#obra').val( solicitud.obra_id );
            $('#proveedor').val( solicitud.proveedor_id );
            $('#forma_pago').val( solicitud.solicitud_formapago );
            $('#iva').val( solicitud.solicitud_iva );
            $('#motivo').val( solicitud.solicitud_motivo );
            $('#observacion').val( solicitud.solicitud_observaciones );
            consultarListaSol( $('#opciones').val() );

            consultarObra( $('#obra').val() );
            consultarProveedor( solicitud.proveedor_id );
            // cargarCuentaBancaria( $('#proveedor').val() );

            if( $('#forma_pago').val() == 1 || $('#forma_pago').val() == 2 ){
                cargarCuentaBancaria( $('#proveedor').val() );
            } else {
                $('#numero_cuenta').attr('disabled', true);
                $('#numero_cuenta').attr('required', false);
            }

            consultarRequisicion( solicitud.solicitud_tipo, solicitud.requisicion_id );
            consultarDatoEspecificoRequisicion( solicitud.requisicion_id, solicitud.solicitud_tipo );

            caragarListaSolicitud( $('#opciones').val() , $('#dato').val() )


        })
        .fail( function(){
            console.log("fallo el ajax en el modulo de lista de requisicion");
        })

    }

    $('#obra').change(function(){

        if( $('#obra').val() == "" ) {
            $('#botonObra').empty();
            return false;
        }
        consultarObra( $('#obra').val() );

    });

    $('#agregar132').on("click", function(){
        agregarMaterial();
    });

    $('#forma_pago').change(function(){

        if( $('#forma_pago').val() == 1 || $('#forma_pago').val() == 2 ){
            cargarCuentaBancaria( $('#proveedor').val() );
            $('#numero_cuenta').attr('disabled', false);
        } else {
            $('#numero_cuenta').attr('disabled', true);
            $('#numero_cuenta').val("");
        }

    });



    $('#proveedor').change(function(){

        if( $('#proveedor').val() == "" ) {
            $('#botonProveedor').empty();
            return false;
        }
        $('#botonProveedor').empty();
        consultarProveedor( $('#proveedor').val() );
        cargarCuentaBancaria( $('#proveedor').val() );

    });

    $('#requisicion').change(function(){

        if( $('#requisicion').val() == "" ) {
            $('#botonrequisicion').empty();
            return false;
        }
        $('#botonRequisicion').empty();
        consultarDatoEspecificoRequisicion( $('#requisicion').val(), $('#opciones').val() );

    });

    function consultarListaSol( valor ){

        //Esto es lo que buscaria de ser material, viatico o servicio
        $.ajax({
            url: '../lista-de-materiales/' + valor,
            type: 'GET',
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        })
        .done(function(comp) {

            $('#conceptoSelect').empty();

            var listaConcepto = '<option value="">Seleccione...</option>';

            if ( $('#opciones').val() == 1 ) {
                for (let i = 0; i < comp.length; i++) {
                    listaConcepto+= '<option value="' + comp[i].id + '">' + comp[i].material_codigo + ' | ' + comp[i].material_nombre + '</option>';
                }
            } else {
                if ( $('#opciones').val() == 2 ) {
                    for (let i = 0; i < comp.length; i++) {
                        listaConcepto+= '<option value="' + comp[i].id + '">' + comp[i].servicio_codigo + ' | ' + comp[i].servicio_nombre + '</option>';
                    }
                } else {
                    if ( $('#opciones').val() == 5) {
                        for (let i = 0; i < comp.length; i++) {
                            listaConcepto+= '<option value="' + comp[i].id + '">' + comp[i].nomina_codigo + ' | ' + comp[i].nomina_nombre + '</option>';
                        }
                    } else {
                        for (let i = 0; i < comp.length; i++) {
                            listaConcepto+= '<option value="' + comp[i].id + '">' + comp[i].viatico_codigo + ' | ' + comp[i].viatico_nombre + '</option>';
                        }
                    }
                }
            }

            $('#conceptoSelect').html(listaConcepto);
            // $('#opciones').attr('disabled', true);
            $('#agregar132').attr('disabled', false);
        })

    }

    function agregarMaterial(){

        let cant = $('#cantidadSelect').val();
        let concepto = $('#conceptoSelect').val();
        let precio = $('#precioUnitarioSelect').val();
        let id = $('#dato').val();
        let tipo = $('#opciones').val();
        let moneda = $('#moneda').val();
        let opcion = $('#opciones').val();

        var combo = document.getElementById("conceptoSelect");
        var texto = combo.options[combo.selectedIndex].text;
        var coin = "";

        if(moneda === "$"){
            coin = "$";
        } else {
            coin = "B/."
        }


        mensaje = texto.split('|');
        msj = mensaje[1];
        // console.log(msj);

        $('#agregar132').attr('disabled', true);

        $.ajax({
            url: '../agregar-material-extra',
            type: 'POST',
            dataType: 'json',
            data:{id: id, cantidad: cant, concepto: concepto, precio: precio, tipo: tipo, moneda: moneda, opcion: opcion},
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        })
        .done(function(comp) {

            consultarListaSol( $('#opciones').val() );
            if (comp) {
                let html = "";
                html+= '<tr id="pull' + comp + '"><td>' + cant + '</td><td>' + msj + '</td><td style="float: right;">' + precio + coin + '</td><td onclick="borrar(' + comp + ')"><i class="fas fa-trash-alt" style="color:#6b1022; text-align:center;"></i></td></tr>';
                $('#tableListado > tbody').append( html );
            } else {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                      toast.addEventListener('mouseenter', Swal.stopTimer)
                      toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                  })

                Toast.fire({
                    icon: 'error',
                    title: 'No se pudo eliminar, es posible que ya haya sido visto su solicitud'
                })
            }


            $('#cargarLaSolicitud').attr('disabled', false);

            $('#cantidadSelect').val("");

            $('#precioUnitarioSelect').val("");
        })
        .fail( function(){
            console.log("fallo el ajax en el modulo de lista de requisicion");
        })


    }


    function consultarObra( valor ) {

        $.ajax({
            url: '../consultar-obra/' + valor,
            type: 'GET',
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        })
        .done(function(comp) {

            if(comp == false){
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                      toast.addEventListener('mouseenter', Swal.stopTimer)
                      toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                  })

                Toast.fire({
                    icon: 'error',
                    title: 'No se pudo eliminar, es posible que ya haya sido visto su solicitud'
                })
                return false;
            }

            var html = "";
            html+= '<div class="info-box" id="consultarO" data-toggle="modal" data-target="#consultarObra">' +
                '<span class="info-box-icon bg-info"><i class="far fa-building"></i></span>' +
                '<div class="info-box-content" >' +
                '<span class="info-box-text">Consultar</span>' +
                '<span class="info-box-number">OBRA</span>' +
                '</div>' +
                '</div>'
            $('#botonObra').html( html );


            var info = "";

            info+= '<div class="card">' +
            '<img src="../../imagen/solicitud.jpg" class="card-img-top" alt="...">' +
            '<div class="card-body">' +
            '<p class="card-text">' +
            '<b>Código: </b>' + comp[0].obra_codigo +  '<br>' +
            '<b>Nombre: </b>' + comp[0].obra_nombre +  '<br>' +
            '<b>Cliente: </b>' + comp[0].cliente_nombre +  '<br>' +
            '<b>Código de venta: </b>' + comp[0].codventa_codigo +  '<br>' +
            '<b>Fecha de inicio: </b>' + comp[0].obra_fechafin +  '<br>' +
            '<b>Fecha final: </b>' + comp[0].obra_fechainicio +  '<br>' +
            '<b>Tipo: </b>' + comp[0].tipo_nombre +  '<br>' +
            '</p>' +
            '</div>' +
            '</div>';

            $('#infoObra').html(info);

        })
        .fail( function(){
            console.log("fallo el ajax en el modulo de carga de datos de la obra");
        })

    }

    function consultarProveedor( valor ){

        $.ajax({
            url: '../consultar-proveedores/' + valor,
            type: 'GET',
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        })
        .done(function(comp) {

            var html = "";
            html+= '<div class="info-box" id="consultarO" data-toggle="modal" data-target="#consultarProveedor">' +
                '<span class="info-box-icon bg-info"><i class="fas fa-tools"></i></span>' +
                '<div class="info-box-content" >' +
                '<span class="info-box-text">Consultar</span>' +
                '<span class="info-box-number">PROVEEDOR</span>' +
                '</div>' +
                '</div>';

            $('#botonProveedor').html( html );

            var info = "";
            info+= '<div class="card">' +
            '<img src="../../imagen/proveedor.jpg" class="card-img-top" alt="...">' +
            '<div class="card-body">' +
            '<p class="card-text">' +
            '<b>Código: </b>' + comp.proveedor_codigo +  '<br>' +
            '<b>Nombre: </b>' + comp.proveedor_nombre +  '<br>' +
            '<b>Dirección: </b>' + comp.proveedor_direccion +  '<br>' +
            '<b>Número ID: </b>' + comp.proveedor_rif +  '<br>' +
            '<b>Telefono: </b>' + comp.proveedor_telefono +  '<br>' +
            '<b>Correo: </b>' + comp.proveedor_correo +  '<br>' +
            '</p>' +
            '</div>' +
            '</div>';

            $('#infoProveedor').html( info );

        })
        .fail( function(){
            console.log("fallo el ajax en el modulo de carga de datos del proveedor");
        })

    }

    function cargarCuentaBancaria(a){

        $.ajax({
            url: '../numero-de-cuenta/' + a,
            type: 'GET',
            // dataType: 'json',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        }).done(function(comp){

            var ban = "";
            var cuenta = "";
            var sel ="";
            var list = '<option value="">Seleccione...</option>';

            if (comp) {
                for (let i = 0; i < comp.length; i++) {

                    if (comp[i].tipoCuenta == 1) {
                        cuenta = "Ahorro";
                    } else {
                        if (comp[i].tipoCuenta == 2) {
                            cuenta = "Corriente";
                        } else {
                            cuenta = "Tarjeta";
                        }
                    }
                    console.log(comp[i].banco_proveedor_id)
                    if (comp[i].banco_proveedor_id != null) {
                        sel = 'selected="selected"';
                    } else {
                        sel = "";
                    }

                    ban+=   '<div class="info-box mb-3 bg-info">' +
                                '<span class="info-box-icon"><i class="fas fa-money-bill"></i></span>' +
                            '<div class="info-box-content">'+
                                '<span class="">Nro. ' + comp[i].numero + '</span>' + '<span class="">Cuenta: ' + cuenta + '</span>'+
                                '<span class="">Rif / Cédula: ' + comp[i].banco_rif + '</span>'+
                                '<span class="info-box-number"><b>Banco: </b>' + comp[i].banco_nombre + '</span>'+
                            '</div>'+
                            '</div>';

                    list+= '<option value="' + comp[i].id + '" ' + sel + '>' + comp[i].numero + '</option>';

                }
                $('#numero_cuenta').html(list);
                $('#datosBancos').html(ban);
                $('#numero_cuenta').attr('disabled', false);


                    setTimeout(function(){
                        $('#numero_cuenta').val( a );
                        $('#numero_cuenta').trigger('change');
                    }, 34632000)



            } else {
                console.log("error en el ajax que se encarga de traer a los proveedores y las cuentas");
                return false;
            }

        }).fail(function(){

            alert("Error en la carga los datos de la cuenta");

        });

    }

    function consultarRequisicion( valor, id ){

        $.ajax({
            url: '../listar-requisicion/' + valor,
            type: 'GET',
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        })
        .done(function(comp) {

            $('#requisicion').empty();

            var listaReq = '<option value="">Seleccione...</option>';
                for (let i = 0; i < comp.length; i++) {
                    listaReq+= '<option value="' + comp[i].id + '" >' + comp[i].requisicion_codigo + ' | ' + comp[i].obra + '</option>';
                }

            $('#requisicion').html(listaReq);
            $('#requisicion').attr('disabled', false);

            $('#requisicion').val( id );

        })
        .fail( function(){
            console.log("fallo el ajax en el modulo de lista de requisicion");
        })

    }

    function consultarDatoEspecificoRequisicion(requerimiento, tipo) {
        $.ajax({
            url: '../consultar-requisicion/' + requerimiento + '/' + tipo,
            type: 'GET',
            // dataType: 'json',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        })
        .done(function(comp) {
            // console.log(comp);

            var html = "";
            html+= '<div class="info-box" id="consultarReq" data-toggle="modal" data-target="#consultarRequisicion">' +
                '<span class="info-box-icon bg-info"><i class="far fa-list-alt"></i></span>' +
                '<div class="info-box-content" >' +
                '<span class="info-box-text">Consultar</span>' +
                '<span class="info-box-number">Requisición</span>' +
                '</div>' +
                '</div>';

            $('#botonRequisicion').html( html );

            var info = "";
            info+= '<div class="card">' +
            '<img src="../../imagen/requisicion.jpg" class="card-img-top" alt="...">' +
            '<div class="card-body">' +
            '<p class="card-text">' +
            '<b>Código: </b>' + comp[0][0].requisicion_codigo +  '<br>' +
            '<b>Obra: </b>' + comp[0][0].obra +  '<br>' +
            '<b>Fecha inicio: </b>' + comp[0][0].requisicion_fecha +  '<br>' +
            '<b>Fecha final: </b>' + comp[0][0].requisicion_fechae +  '<br>' +
            '<b>Estado: </b>' + comp[0][0].requisicion_estado +  '<br>' +
            '<b>Motivo: </b>' + comp[0][0].requisicion_motivo +  '<br>' +
            '<b>Tipo de requisición: </b>' + comp[0][0].requisicion_tipo +  '<br>' +
            '<b>Creado por: </b>' + comp[0][0].usuario_nombre +  '<br>' +
            '</p>' +
            '</div>' +
            '</div>';


            var lista = '';
            for (let e = 0; e < comp[1].length; e++) {

                lista+= '<tr><td>' + comp[1][e].sd_cantidad + '</td><td>' + comp[1][e].nombre + '</td><td>' + comp[1][e].sd_caracteristicas + '</td></tr>';

            }

            $('#tableDesplegable > tbody').html( lista );
            $('#infoRequisicion').html( info );

        })
        .fail( function(){
            console.log("fallo el ajax en el modulo de la requisicion");
        })

    }

    function caragarListaSolicitud( tipo , valor ){

        $.ajax({
            url: '../listar-requisicionsegun-requerimiento/' + tipo + '/' + valor,
            type: 'GET',
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        })
        .done(function(comp) {

            let html = "";
            for (let i = 0; i < comp.length; i++) {
                html+= '<tr id="pull' + comp[i].id + '"><td>' + comp[i].sd_cantidad + '</td><td>' + comp[i].nombre + '</td><td style="float: right;">' + comp[i].sd_preciounitario + comp[i].moneda + '</td><td onclick="borrar(' + comp[i].id + ')"><i class="fas fa-trash-alt" style="color:#6b1022; text-align:center;"></i></td></tr>';
            }
            // $('.loader').attr('id','load');
            $('#tableListado > tbody').append( html );
            $('.switch').attr('id', 'out');
        })
        .fail( function(){
            console.log("fallo el ajax en el modulo de lista de la solicitud");
        })




    }

});

function borrar(a){
    $.ajax({
        url: '../eliminar-una-solicitud',
        type: 'POST',
        data: {id: a},
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    })
    .done(function(comp) {

        if (comp) {

            let id = "#pull" + a;
            $(id).empty();

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener('mouseenter', Swal.stopTimer)
                  toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
              })

            Toast.fire({
                icon: 'success',
                title: 'Se ha eliminado un material'
            })

        } else {

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener('mouseenter', Swal.stopTimer)
                  toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
              })

              Toast.fire({
                icon: 'error',
                title: 'No pudo eliminar este material'
              })

        }

    })
    .fail( function(){
        console.log("fallo el ajax en el modulo de lista de la solicitud");
    })
}
