$(document).ready(function(){

    limpiar();

    $('#clave').keyup(function(){
        if( $('#clave').val().length <= 5 ){
            $('#clave').css({'border':'1px solid red'});
            $('#cambiar').prop('disabled',true);
        } else {
            $('#clave').css({'border':'1px solid green'});
        }

        if( $('#clave2').val() ===  $('#clave').val() ){
            $('#clave2').css({'border':'1px solid green'});
            $('#cambiar').prop('disabled',false);
        } else {
            $('#clave2').css({'border':'1px solid red'});
            $('#cambiar').prop('disabled',true);
        }

    });

    $('#clave2').keyup(function(){
        if( $('#clave2').val() ===  $('#clave').val() ){
            $('#clave2').css({'border':'1px solid green'});
            $('#cambiar').prop('disabled',false);
        } else {
            $('#clave2').css({'border':'1px solid red'});
            $('#cambiar').prop('disabled',true);
        }
    });



    function limpiar(){
        $('#clave').val("");
        $('#clave2').val("");
        $('#cambiar').prop('disabled',true);
    }





});
