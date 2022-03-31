$(document).ready(function(){

    $("#apro").click(function(){
        $("form").on("submit", function () {
            $("#apro").attr("value", "Guardando, espere...");
            $("#apro").prop("disabled", true);
        });
    });

    $("#recha").click(function(){
        $("form").on("submit", function () {
            $("#recha").attr("value", "Guardando, espere...");
            $("#recha").prop("disabled", true);
        });
    });


});
