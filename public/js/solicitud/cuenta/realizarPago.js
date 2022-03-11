$(document).ready(function(){

    $('#comprobante').numeric();
    limpiar();

    function limpiar(){
        $('#forma_pago').val("");
        $('#cuentaJHCP').val("");
        $('#comprobante').val("");
        $('#cheque').val("");
        $('#comentario').val("");
    }

    $('#close, #cerrar').on('click', function(){
        limpiar();
    });



});
