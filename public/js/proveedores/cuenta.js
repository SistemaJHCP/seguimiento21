$(document).ready(function(){

    $("#nroCuenta").keyup(function(){
        if ($("#nroCuenta").val().length < 20) {
            $("#nroCuenta").css({"border": "1px solid red"});
            $("#agregar").attr("disabled", true);
            activar();
        }else{
            $("#nroCuenta").css({"border": "1px solid #ced4da"});
            activar();
        }
    });

    function activar()
    {
        if( $("#banco").val() != "" && $("#nroCuenta").val().length > 19 && $("#tipo").val().length != ""  ){
            $("#agregar").attr("disabled", false);
            console.log("si");
        } else {
            console.log($("#banco").val().length);
            console.log("no");
        }
    }


});
