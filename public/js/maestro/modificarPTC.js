$(document).ready( function(){

    $("#codigoPTC").keyup( function(){
        if ($('#codigoPTC').val().length <= 2 || $('#codigoPTC').val().length > 23) {
            $('#codigoPTC').css({'border':'1px solid red'});
            $('#cargar').prop('disabled',true);
            activarBoton(false);
            return false;
        } else {
            $('#codigoPTC').css({'border':'1px solid #d2d6de'});
            activarBoton(false);
        }
    });


    $("#nombrePTC").keyup( function(){
        if ($('#nombrePTC').val().length <= 2 || $('#nombrePTC').val().length > 100) {
            $('#nombrePTC').css({'border':'1px solid red'});
            $('#cargar').prop('disabled',true);
            activarBoton(false);
            return false;
        } else {
            $('#nombrePTC').css({'border':'1px solid #d2d6de'});
            activarBoton(false);
        }
    });

    $("#telefonoPTC").keyup( function(){
        if ($('#telefonoPTC').val().length <= 2 || $('#telefonoPTC').val().length > 40) {
            $('#telefonoPTC').css({'border':'1px solid red'});
            $('#cargar').prop('disabled',true);
            activarBoton(false);
            return false;
        } else {
            $('#telefonoPTC').css({'border':'1px solid #d2d6de'});
            activarBoton(false);
        }
    });

    $("#direccionPTC").keyup( function(){
        if ($('#direccionPTC').val().length <= 2 || $('#direccionPTC').val().length > 220) {
            $('#direccionPTC').css({'border':'1px solid red'});
            $('#cargar').prop('disabled',true);
            activarBoton(false);
            return false;
        } else {
            $('#direccionPTC').css({'border':'1px solid #d2d6de'});
            activarBoton(false);
        }
    });

    $("#correoPTC").keyup( function(){
        if ($('#correoPTC').val().length <= 2 || $('#correoPTC').val().length > 220) {
            $('#correoPTC').css({'border':'1px solid red'});
            $('#cargar').prop('disabled',true);
            activarBoton(false);
            return false;
        } else {
            $('#correoPTC').css({'border':'1px solid #d2d6de'});
            activarBoton(false);
        }
    });


    $("#cargar").click(function(){
        $("form").on("submit", function () {
            $("#cargar").attr("value", "Guardando, espere...");
            $(this).find(":submit").prop("disabled", true);
        });
    });

    function activarBoton(a){
        if($('#codigoPTC').val().length > 2 && $('#nombrePTC').val().length > 2 && $('#telefonoPTC').val().length > 2 && $('#direccionPTC').val().length > 2){
            $('#cargar').prop('disabled',false);
        } else {
            $('#cargar').prop('disabled',true);
        }
    };


} );
