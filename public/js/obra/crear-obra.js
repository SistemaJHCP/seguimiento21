$(document).ready(function(){

    $("#datepicker").datepicker({
        dateFormat: "dd-mm-yy",
        closeText: 'Cerrar',
        prevText: '< Ant',
        nextText: 'Sig >',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
        weekHeader: 'Sm'
    });

    $("#datepicker2").datepicker({
        dateFormat: "dd-mm-yy",
        closeText: 'Cerrar',
        prevText: '< Ant',
        nextText: 'Sig >',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
        weekHeader: 'Sm'
    });

    // $("#personal").change(function(){
    //     if ($("#personal").val() > 0) {
    //         $("#estudio").attr("disabled", "disabled");
    //     }
    // });


    $(document).on("click", "#agregarResponsable", function(){
        let responsable = $("#personal").val();
        let cargo = $("#estudio").val();
        let url = "consultar-coord/" + responsable;

        if( responsable > "" && cargo > "" ){

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            })
            .done(function(comp) {

                if (cargo == 1) {
                    var car = "Coordinador";
                } else {
                    var car = "Residente";
                }

                $("#cargoPersonal").append('<div class="info-box"><span class="info-box-icon bg-info"><i class="fas fa-user-alt"></i></span><div class="info-box-content"><span class="info-box-text">' + comp.personal_nombre + '</span><span class="info-box-number">' + car + '</span></div></div>');
                // $("#cargoPersonal").append('<div class="callout callout-info"><h5>' + comp.personal_nombre + '</h5><p>' + car + '.</p></div>');
                $("#coordin").append('<input type="hidden" name="responsable[]" value="' + responsable + '">');
                $("#cargooo").append('<input type="hidden" name="cargoResponsable[]" value="' + cargo + '">');
                $("#personal").val("");
                $("#estudio").val("");
            })
            .fail( function(){
                console.log("fallo el ajax en el modulo de cargar coordinador / residente");
            })


            $("#borrarTodo").click(function(){
                $("#cargoPersonal").remove();
                $("#coordin").remove();
                $("#cargooo").remove();
            });












            // $("#cargoPersonal").append('<div class="callout callout-info"><h5>Nombre de la persona</h5><p>Cargo laboral.</p></div>');
            // $("#cargoPersonal").append('<input type="hidden" name="" value="">');

        } else {
            console.log("faltan select por tomar");
        }


    });


});
