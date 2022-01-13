$(document).ready(function(){

    limpiar();

    // $('#total').keyup(function(){
    //         this.value = this.value.replace(/[^0-9,.]/g, '').replace(/,/g, '.');
    //     }
    // );

    $('#porcentaje, #total').keypress(function(event) {
        var $this = $(this);
        if ((event.which != 46 || $this.val().indexOf('.') != -1) &&
           ((event.which < 48 || event.which > 57) &&
           (event.which != 0 && event.which != 8))) {
               event.preventDefault();
        }

        var text = $(this).val();
        if ((event.which == 46) && (text.indexOf('.') == -1)) {
            setTimeout(function() {
                if ($this.val().substring($this.val().indexOf('.')).length > 3) {
                    $this.val($this.val().substring(0, $this.val().indexOf('.') + 3));
                }
            }, 1);
        }

        if ((text.indexOf('.') != -1) &&
            (text.substring(text.indexOf('.')).length > 2) &&
            (event.which != 0 && event.which != 8) &&
            ($(this)[0].selectionStart >= text.length - 2)) {
                event.preventDefault();
        }
    });


    $("#datepicker").datepicker({
        dateFormat: "yy-mm-dd",
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
        dateFormat: "yy-mm-dd",
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


    $(document).on("click", "#agregarResponsable", function(){

        let responsable = $("#personal").val();
        let cargo = $("#estudio").val();
        let url = "consultar-coord/" + responsable;

        if(responsable != "" && cargo != ""){
            $("#agregarResponsable").attr("disabled", "disabled");
        }

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
                $("#coordin").append('<input type="hidden" name="responsable[]" value="' + responsable + '">');
                $("#cargooo").append('<input type="hidden" name="cargoResponsable[]" value="' + cargo + '">');
                $("#personal").val("");
                $("#estudio").val("");
                $("#agregarResponsable").attr("disabled", false);
            })
            .fail( function(){
                console.log("fallo el ajax en el modulo de cargar coordinador / residente");
            })


            $("#borrarTodo").click(function(){
                $("#cargoPersonal").empty();
                $("#coordin").empty();
                $("#cargooo").empty();
            });

            // $("#cargoPersonal").append('<div class="callout callout-info"><h5>Nombre de la persona</h5><p>Cargo laboral.</p></div>');
            // $("#cargoPersonal").append('<input type="hidden" name="" value="">');

        } else {
            console.log("faltan select por tomar");
        }


    });

    function limpiar(){
        $("#cargoPersonal").val("");
        $("#coordin").val("");
        $("#cargooo").val("");
        $("#tipo").val("");
        $("#cliente").val("");
        $("#codventa").val("");
        $("#nombreObra").val("");
        $("#total").val("");
        $("#porcentaje").val("");
        $("#datepicker").val("");
        $("#datepicker2").val("");
        $("#observaciones").val("");
        $("#personal").val("");
        $("#estudio").val("");
    }






});
