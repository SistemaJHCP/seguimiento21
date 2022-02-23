$(document).ready(function(){

    consultarObra( $('#obra').val() );
    validarMoneda();
    consultarProveedor( $('#proveedor').val() );
    consultarListaSol( $('#opciones').val() );
    cargarCuentaBancaria( $('#proveedor').val() );

    setTimeout(function(){
        $(".loader").fadeOut("slow");
    },2000);



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


    if ( $('#opciones').val() == "" || $('#opciones').val() == 5 ) {
        $('#requisicion').attr('disabled', true);
    } else {

        consultarDatoEspecificoRequisicion()
        consultarRequisicion( $('#opciones').val() );
        $('#requisicion').attr('disabled', true);
        $('#requisicion').attr('required', true);
        $('#btn-agregar').attr('disabled', false);
        $('#botonRequisicion').empty();

        $('#requisicion').attr('disabled', false);
    }


    function consultarRequisicion( valor ){

        $.ajax({
            url: 'listar-requisicion/' + valor,
            type: 'GET',
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        })
        .done(function(comp) {

            $('#requisicion').empty();

            var listaReq = '<option value="">Seleccione...</option>';
                for (let i = 0; i < comp.length; i++) {
                    listaReq+= '<option value="' + comp[i].id + '">' + comp[i].requisicion_codigo + ' | ' + comp[i].obra + '</option>';
                }

            $('#requisicion').html(listaReq);
            $('#requisicion').attr('disabled', false);



        })
        .fail( function(){
            console.log("fallo el ajax en el modulo de lista de requisicion");
        })

    }




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
        if ($('#requisicion').val() === "") {
            $('#botonRequisicion').empty();
            return false;
        }

        $('#botonRequisicion').empty();
        $.ajax({
            url: '../consultar-requisicion/' + $('#requisicion').val() + '/' + $("#opciones").val(),
            type: 'GET',
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        })
        .done(function(comp) {


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

            console.log( comp[1] );
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


    });


    $('#tramiteDolar').on('change', function(){
        validarMoneda();
    });

    function validarMoneda(){
        if( $( '#tramiteDolar').prop("checked") == true ){
            $('#precioUnitarioSelect').attr('placeholder', 'Ingrese el monto en divisas');
            $('#mensajeMoneda').empty();
            $('#mensajeMoneda').append("Solicitud en Dolares");
        }else{
            $('#precioUnitarioSelect').attr('placeholder', 'Ingrese el monto en Bolivares');
            $('#mensajeMoneda').empty();
            $('#mensajeMoneda').append("Solicitud en Bolivares");
        }
    }

    $('#agregar132').on("click", function(){
        agregarMaterial();
    });


    $('#obra').change(function(){

        if( $('#obra').val() == "" ) {
            $('#botonObra').empty();
            return false;
        }
        consultarObra( $('#obra').val() );

    });

    $('#proveedor').change(function(){
        if( $('#proveedor').val() == "" ) {
            $('#botonProveedor').empty();
            return false;
        }

        consultarProveedor( $('#proveedor').val() );

    });

    caragarListaSolicitud( $('#opciones').val() , $('#dato').val() )
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
                html+= '<tr><td>' + comp[i].sd_cantidad + '</td><td>' + comp[i].nombre + '</td><td>' + comp[i].sd_preciounitario + comp[i].moneda + '</td><td onclick="borrar(' + comp[i].id + ')"><i class="fas fa-trash-alt" style="color:#6b1022; text-align:center;"></i></td></tr>';
            }
            // $('.loader').attr('id','load');
            $('#tableListado > tbody').append( html );
        })
        .fail( function(){
            console.log("fallo el ajax en el modulo de lista de la solicitud");
        })

    }


    function consultarDatoEspecificoRequisicion() {
        $.ajax({
            url: '../consultar-requisicion/' + $('#req2').val() + '/' + $("#opciones").val(),
            type: 'GET',
            dataType: 'json',
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

    function consultarRequisicion( valor ){

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
                    var selected = "";
                    if(comp[i].id == $('#req2').val()){
                        selected = 'selected';
                    } else {
                        selected = '';
                    }
                    listaReq+= '<option value="' + comp[i].id + '" ' + selected +'>' + comp[i].requisicion_codigo + ' | ' + comp[i].obra + '</option>';
                }

            $('#requisicion').html(listaReq);
            $('#requisicion').attr('disabled', false);



        })
        .fail( function(){
            console.log("fallo el ajax en el modulo de lista de requisicion");
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
            '<b>Código: </b>' + comp[0].proveedor_codigo +  '<br>' +
            '<b>Nombre: </b>' + comp[0].proveedor_nombre +  '<br>' +
            '<b>Dirección: </b>' + comp[0].proveedor_direccion +  '<br>' +
            '<b>Número ID: </b>' + comp[0].proveedor_rif +  '<br>' +
            '<b>Telefono: </b>' + comp[0].proveedor_telefono +  '<br>' +
            '<b>Correo: </b>' + comp[0].proveedor_correo +  '<br>' +
            '</p>' +
            '</div>' +
            '</div>';

            $('#infoProveedor').html( info );

        })
        .fail( function(){
            console.log("fallo el ajax en el modulo de carga de datos de la obra");
        })

    }


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


    function consultarObra( valor ) {

        $.ajax({
            url: '../consultar-obra/' + valor,
            type: 'GET',
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        })
        .done(function(comp) {

            var html = "";
            html+= '<div class="info-box" id="consultarO" data-toggle="modal" data-target="#consultarObra">' +
                '<span class="info-box-icon bg-info"><i class="far fa-building"></i></span>' +
                '<div class="info-box-content" >' +
                '<span class="info-box-text">Consultar</span>' +
                '<span class="info-box-number">OBRA</span>' +
                '</div>' +
                '</div>'
            $('#botonObra').html( html ).fadeIn('slow');


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


    function cargarCuentaBancaria(a){

        $.ajax({
            url: '../numero-de-cuenta/' + a,
            type: 'GET',
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        }).done(function(comp){

            var ban = "";
            var cuenta = "";
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

                    ban+=   '<div class="info-box mb-3 bg-info">' +
                                '<span class="info-box-icon"><i class="fas fa-money-bill"></i></span>' +
                            '<div class="info-box-content">'+
                                '<span class="">Nro. ' + comp[i].numero + '</span>' + '<span class="">Cuenta: ' + cuenta + '</span>'+
                                '<span class="">Rif / Cédula: ' + comp[i].banco_rif + '</span>'+
                                '<span class="info-box-number"><b>Banco: </b>' + comp[i].banco_nombre + '</span>'+
                            '</div>'+
                            '</div>';

                    list+= '<option value="' + comp[i].id + '">' + comp[i].numero + '</option>';

                }
                $('#numero_cuenta').html(list);
                $('#datosBancos').html(ban);
                $('#numero_cuenta').val( $('#nroCuenta').val() );
                $('#numero_cuenta').attr('disabled', false);
            } else {
                console.log("error en el ajax que se encarga de traer a los proveedores y las cuentas");
                return false;
            }

        }).fail(function(){

            alert("Error en la carga del listado");

        });

    }

    function agregarMaterial(){

        let cant = $('#cantidadSelect').val();
        let concepto = $('#conceptoSelect').val();
        let precio = $('#precioUnitarioSelect').val();
        let id = $('#dato').val();
        let tipo = $('#opciones').val();

        var combo = document.getElementById("conceptoSelect");
        var texto = combo.options[combo.selectedIndex].text;

        mensaje = texto.split('|');
        msj = mensaje[1];
        console.log(msj);

        $.ajax({
            url: '../agregar-material-extra',
            type: 'POST',
            dataType: 'json',
            data:{id: id, cantidad: cant, concepto: concepto, precio: precio, tipo: tipo},
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        })
        .done(function(comp) {





        })
        .fail( function(){
            console.log("fallo el ajax en el modulo de lista de requisicion");
        })


    }

});


function borrar(a){

    Swal.fire({
        title: '¿Esta seguro',
        text: "de querer eliminar este campo?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!',
        cancelButtonText: 'No, cancelar!'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Eliminado!',
            'Se ha eliminado este campo.',
            'success'
          )
        }
    })

}



