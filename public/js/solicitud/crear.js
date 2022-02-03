$(document).ready(function(){

    $('#obra').select2({
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

            console.log( comp );

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
            alert("Aqui");
            $.ajax({
                url: 'materiales-y-nomina/' + this.value,
                type: 'GET',
                dataType: 'json',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            }).done(function(comp){

                console.log( comp );

            }).fail(function(){

                alert("Error en la carga del listado");

            });





            $('#btn-agregar').attr('disabled', false);
            return false;
        }



        consultarRequisicion( this.value );
        $('#requisicion').attr('disabled', false);
        $('#requisicion').attr('required', true);
        $('#botonRequisicion').empty();








    });


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
            '<b>Código: </b>' + comp[0].obra_nombre +  '<br>' +
            '<b>Código: </b>' + comp[0].cliente_nombre +  '<br>' +
            '<b>Código: </b>' + comp[0].codventa_codigo +  '<br>' +
            '<b>Código: </b>' + comp[0].obra_fechafin +  '<br>' +
            '<b>Código: </b>' + comp[0].obra_fechainicio +  '<br>' +
            '<b>Código: </b>' + comp[0].tipo_nombre +  '<br>' +
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

            $('#requisicion').empty();

            var lista = '<option value="">Seleccione...</option>';
                for (let i = 0; i < comp.length; i++) {
                    lista+= '<option value="' + comp[i].id + '">' + comp[i].requisicion_codigo + ' | ' + comp[i].obra + '</option>';
                }

            $('#requisicion').html(lista);





            var info = "";
            // info+= '<div class="card">' +
            // '<img src="http://localhost/seguimiento21/public/imagen/proveedor.jpg" class="card-img-top" alt="...">' +
            // '<div class="card-body">' +
            // '<p class="card-text">' +
            // '<b>Código: </b>' + comp[0].proveedor_codigo +  '<br>' +
            // '<b>Nombre: </b>' + comp[0].proveedor_nombre +  '<br>' +
            // '<b>Dirección: </b>' + comp[0].proveedor_direccion +  '<br>' +
            // '<b>Número ID: </b>' + comp[0].proveedor_rif +  '<br>' +
            // '<b>Telefono: </b>' + comp[0].proveedor_telefono +  '<br>' +
            // '<b>Correo: </b>' + comp[0].proveedor_correo +  '<br>' +
            // '</p>' +
            // '</div>' +
            // '</div>';

            // $('#infoProveedor').html( info );

        })
        .fail( function(){
            console.log("fallo el ajax en el modulo de carga de datos de la obra");
        })

    }





});
