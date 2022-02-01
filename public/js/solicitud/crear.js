$(document).ready(function(){

    $('#obra').select2({
        theme: 'bootstrap4'
    });

    $('#proveedor').select2({
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
        consultarProveedor( this.value );

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
            '<img src="http://localhost/seguimiento21/public/imagen/solicitud.jpg" class="card-img-top" alt="...">' +
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



});
