$(document).ready(function(){

    limpiar();

    $('#obra').select2({
        theme: 'bootstrap4'
    });

    $('#conceptoSelect').select2({
        theme: 'bootstrap4'
    });

    $('#proveedor').select2({
        theme: 'bootstrap4'
    });

    $('#requisicion').select2({
        theme: 'bootstrap4'
    });

    $('#obra').change(function(){

        if( this.value == "" ) {
            $('#botonObra').empty();
            return false;
        }
        consultarObra( this.value );

    });

    $('#proveedor').change(function(){

        if( this.value == "" ) {
            $('#botonProveedor').empty();
            return false;
        }
        $('#botonProveedor').empty();
        consultarProveedor( this.value );

        $.ajax({
            url: 'numero-de-cuenta/' + this.value,
            type: 'GET',
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        }).done(function(comp){
            console.log(comp);
            var ban = "";
            var list = '<option value="">Seleccione...</option>';
            if (comp) {
                for (let i = 0; i < comp.length; i++) {

                    ban+=   '<div class="info-box mb-3 bg-info">' +
                                '<span class="info-box-icon"><i class="fas fa-money-bill"></i></span>' +
                            '<div class="info-box-content">'+
                                '<span class="">Nro. ' + comp[i].numero + '</span>'+
                                '<span class="">Rif / Cédula: ' + comp[i].banco_rif + '</span>'+
                                '<span class="info-box-number"><b>Banco: </b>' + comp[i].banco_nombre + '</span>'+
                            '</div>'+
                            '</div>';

                    list+= '<option value="' + comp[i].id + '">' + comp[i].numero + '</option>';

                }
                $('#numero_cuenta').html(list);
                $('#datosBancos').html(ban);
                $('#numero_cuenta').attr('disabled', false);
            } else {
                console.log("error en el ajax que se encarga de traer a los proveedores y las cuentas");
                return false;
            }

        }).fail(function(){

            alert("Error en la carga del listado");

        });


    });


    $('#opciones').change(function(){

        if( this.value == ""  ) {
            $('#botonRequisicion').empty();
            $('#requisicion').attr('disabled', true);
            $('#requisicion').attr('required', false);
            $('#requisicion').empty();
            $('#requisicion').html('<option value="">Seleccione...</option>');
            $('#btn-agregar').attr('disabled', true);
            return false;
        }

        if( this.value === "Nomina" ) {
            $('#botonRequisicion').empty();
            $('#requisicion').attr('disabled', true);
            $('#requisicion').attr('required', false);
            $('#requisicion').empty();
            $('#requisicion').html('<option value="">Seleccione...</option>');

            $('#btn-agregar').attr('disabled', false);

            $.ajax({
                url: 'lista-de-momina',
                type: 'GET',
                dataType: 'json',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            })
            .done(function(comp) {
                console.log(comp);
                $('#conceptoSelect').empty();

                var listaConcepto = '<option value="">Seleccione...</option>';
                    for (let i = 0; i < comp.length; i++) {
                        listaConcepto+= '<option value="' + comp[i].id + '">' + comp[i].nomina_codigo + ' | ' + comp[i].nomina_nombre + '</option>';
                    }

                $('#conceptoSelect').html(listaConcepto);
                // $('#opciones').attr('disabled', true);
            })

            .fail( function(){
                console.log("fallo el ajax en el modulo de carga de solicitud");
            })

            return false;
        } else {
            //Esto es lo que buscaria de ser material, viatico o servicio
            $.ajax({
                url: 'lista-de-materiales/' + this.value,
                type: 'GET',
                dataType: 'json',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            })
            .done(function(comp) {
                console.log(comp);
                $('#conceptoSelect').empty();

                var listaConcepto = '<option value="">Seleccione...</option>';
                    for (let i = 0; i < comp.length; i++) {
                        listaConcepto+= '<option value="' + comp[i].id + '">' + comp[i].material_codigo + ' | ' + comp[i].material_nombre + '</option>';
                    }

                $('#conceptoSelect').html(listaConcepto);
                // $('#opciones').attr('disabled', true);
            })
        }

        consultarRequisicion( this.value );
        $('#requisicion').attr('disabled', true);
        $('#requisicion').attr('required', true);
        $('#btn-agregar').attr('disabled', false);
        $('#botonRequisicion').empty();


    });

    function limpiar(){
        $('#opciones').val("");
        $('#pagos').val("");
        $('#obra').val("");
        $('#proveedor').val("");
        $('#forma_pago').val("");
        $('#numero_cuenta').val("");
        $('#numero_cuenta').attr("disabled", true);
        $('#iva').val("");
        $('#requisicion').val("");
        $('#requisicion').attr("disabled", true);
        $('#btn-agregar').attr('disabled', true);
    }





    $('#requisicion').change(function(){

        $.ajax({
            url: 'consultar-requisicion/' + this.value,
            type: 'GET',
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        })
        .done(function(comp) {

            console.log(comp);
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
            '<img src="http://localhost/seguimiento21/public/imagen/requisicion.jpg" class="card-img-top" alt="...">' +
            '<div class="card-body">' +
            '<p class="card-text">' +
            '<b>Código: </b>' + comp[0].requisicion_codigo +  '<br>' +
            '<b>Obra: </b>' + comp[0].obra +  '<br>' +
            '<b>Fecha inicio: </b>' + comp[0].requisicion_fecha +  '<br>' +
            '<b>Fecha final: </b>' + comp[0].requisicion_fechae +  '<br>' +
            '<b>Estado: </b>' + comp[0].requisicion_estado +  '<br>' +
            '<b>Motivo: </b>' + comp[0].requisicion_motivo +  '<br>' +
            '<b>Tipo de requisición: </b>' + comp[0].requisicion_tipo +  '<br>' +
            '<b>Creado por: </b>' + comp[0].usuario_nombre +  '<br>' +
            '</p>' +
            '</div>' +
            '</div>';

            $('#infoRequisicion').html( info );

        })
        .fail( function(){
            console.log("fallo el ajax en el modulo de carga de datos de la obra");
        })


    });


    function consultarProveedor( valor ){

        $.ajax({
            url: 'consultar-proveedores/' + valor,
            type: 'GET',
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        })
        .done(function(comp) {
            console.log(comp);
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
            '<img src="http://localhost/seguimiento21/public/imagen/proveedor.jpg" class="card-img-top" alt="...">' +
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


    function consultarObra( valor ) {

        $.ajax({
            url: 'consultar-obra/' + valor,
            type: 'GET',
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        })
        .done(function(comp) {
            console.log(comp);
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
            '<img src="http://localhost/seguimiento21/public/imagen/solicitud.jpg" class="card-img-top" alt="...">' +
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


    function consultarRequisicion( valor ){

        $.ajax({
            url: 'listar-requisicion/' + valor,
            type: 'GET',
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        })
        .done(function(comp) {
            console.log(valor);
            $('#requisicion').empty();

            var listaReq = '<option value="">Seleccione...</option>';
                for (let i = 0; i < comp.length; i++) {
                    listaReq+= '<option value="' + comp[i].id + '">' + comp[i].requisicion_codigo + ' | ' + comp[i].obra + '</option>';
                }

            $('#requisicion').html(listaReq);
            $('#requisicion').attr('disabled', false);


        })
        .fail( function(){
            console.log("fallo el ajax en el modulo de carga de datos de la obra");
        })

    }





});
