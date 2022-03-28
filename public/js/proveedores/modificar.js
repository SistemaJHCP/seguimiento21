$(document).ready( function(){

    $("#cedula").numeric(false);
    $("#telefono").numeric(false);

    $("#cedula").on("keyup", function(){
        if ( $("#cedula").val().length < 6 ) {
            $("#cedula").css({'border':'1px solid red'});
            activarBoton();
        } else {
            $("#cedula").css({'border':'1px solid #e3e6ea'});
            activarBoton();
        }
    });

    $("#nombre").on("keyup", function(){
        if ( $("#nombre").val().length < 6 ) {
            $("#nombre").css({'border':'1px solid red'});
            activarBoton();
        } else {
            $("#nombre").css({'border':'1px solid #e3e6ea'});
            activarBoton();
        }
    });

    $("#telefono").on("keyup", function(){
        if ( $("#telefono").val().length < 6 ) {
            $("#telefono").css({'border':'1px solid red'});
            activarBoton();
        } else {
            $("#telefono").css({'border':'1px solid #e3e6ea'});
            activarBoton();
        }
    });

    $("#direccion").on("keyup", function(){
        if ( $("#direccion").val().length < 6 ) {
            $("#direccion").css({'border':'1px solid red'});
            activarBoton();
        } else {
            $("#direccion").css({'border':'1px solid #e3e6ea'});
            activarBoton();
        }
    });

    $("#email").on("keyup", function(){
        if ( $("#email").val().length < 6 ) {
            $("#email").css({'border':'1px solid red'});
            activarBoton();
        } else {
            $("#email").css({'border':'1px solid #e3e6ea'});
            activarBoton();
        }
    });

    $("#contacto").on("keyup", function(){
        if ( $("#contacto").val().length < 6 ) {
            $("#contacto").css({'border':'1px solid red'});
            activarBoton();
        } else {
            $("#contacto").css({'border':'1px solid #e3e6ea'});
            activarBoton();
        }
    });

    function activarBoton(){
        if( $("#cedula").val().length > 1 &&  $("#nombre").val().length > 1 && $("#telefono").val().length > 1 && $("#direccion").val().length > 1  ){
            $('#modificar').prop('disabled',false);
        } else {
            $('#modificar').prop('disabled',true);
        }
    }

    $("#modificar").click(function(){
        $("form").on("submit", function () {
            $("#modificar").attr("value", "Guardando, espere...");
            $("#modificar").prop("disabled", true);
        });
    });

});
