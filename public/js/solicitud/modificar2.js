$(document).ready(function(){

    cargaInicial();
    function cargaInicial(a){

        $.ajax({
            url: '../primeraCarga/87yushdyu87dyghunjdhu8d7',
            type: 'POST',
            dataType: 'json',
            data:{id: $('#dato').val() },
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        })
        .done(function(comp) {
            var solicitud = comp[0];
            console.log( solicitud );
            $('#pagos').val( solicitud.solicitud_tipo );
            $('#obra').val( solicitud.obra_id );
            $('#proveedor').val( solicitud.proveedor_id );
            $('#forma_pago').val( solicitud.solicitud_formapago );

        })
        .fail( function(){
            console.log("fallo el ajax en el modulo de lista de requisicion");
        })



    }




});
