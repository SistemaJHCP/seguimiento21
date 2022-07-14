$(document).ready(function(){

    $('#valuacion').numeric().numeric('.');
    $('#valuacionMod').numeric().numeric('.');

    limpiar()

    $("#fecha").datepicker({
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

    $("#fechaMod").datepicker({
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


    $('#valuacion').keyup(function () {
        if ($('#valuacion').val().length < 1 || $('#valuacion').val().length > 21) {
            $('#valuacion').css({'border':'1px solid red'});
            $('#cargarVal').prop('disabled',true);
            activarBoton();
            return false;
        } else {
            $('#valuacion').css({'border':'1px solid #d2d6de'});
            activarBoton();
        }
    });

    $('#fecha').change(function () {
        if ($('#fecha').val().length < 1 || $('#fecha').val().length > 10) {
            $('#fecha').css({'border':'1px solid red'});
            $('#cargarVal').prop('disabled',true);
            activarBoton();
            return false;
        } else {
            $('#fecha').css({'border':'1px solid #d2d6de'});
            activarBoton();
        }
    });

    $('#observacion').keyup(function () {
        if ($('#observacion').val().length < 1 || $('#observacion').val().length > 181) {
            $('#observacion').css({'border':'1px solid red'});
            $('#cargarVal').prop('disabled',true);
            activarBoton();
            return false;
        } else {
            $('#observacion').css({'border':'1px solid #d2d6de'});
            activarBoton();
        }
    });

    $('#valuacionMod').keyup(function () {
        if ($('#valuacionMod').val().length < 1 || $('#valuacionMod').val().length > 21) {
            $('#valuacionMod').css({'border':'1px solid red'});
            $('#cargarVal').prop('disabled',true);
            activarBotonMod();
            return false;
        } else {
            $('#valuacionMod').css({'border':'1px solid #d2d6de'});
            activarBotonMod();
        }
    });

    $('#fechaMod').change(function () {
        if ($('#fechaMod').val().length < 1 || $('#fechaMod').val().length > 10) {
            $('#fechaMod').css({'border':'1px solid red'});
            $('#cargarVal').prop('disabled',true);
            activarBotonMod();
            return false;
        } else {
            $('#fechaMod').css({'border':'1px solid #d2d6de'});
            activarBotonMod();
        }
    });

    $('#observacionMod').keyup(function () {
        if ($('#observacionMod').val().length < 1 || $('#observacionMod').val().length > 21) {
            $('#observacionMod').css({'border':'1px solid red'});
            $('#cargarVal').prop('disabled',true);
            activarBotonMod();
            return false;
        } else {
            $('#observacionMod').css({'border':'1px solid #d2d6de'});
            activarBotonMod();
        }
    });




    $("#cargarVal").click(function(){
        $("form").on("submit", function () {
            $("#cargarVal").attr("value", "Guardando, espere...");
            $("#cargarVal").prop("disabled", true);
        });
    });

    $('#cerrar, .close').on('click',function(){
        limpiar();
    });

    $('#cerrarMod, #closeMod').on('click',function(){
        limpiarMod();
    });

    function limpiar(){
        $('#valuacion').val("");
        $('#fecha').val("");
        $('#observacion').val("");
        $("#cargarVal").prop("disabled", true);
        $('#valuacion').css({'border':'1px solid #d2d6de'});
        $('#fecha').css({'border':'1px solid #d2d6de'});
        $('#observacion').css({'border':'1px solid #d2d6de'});
    }

    function limpiarMod(){
        $('#valuacionMod').val("");
        $('#fechaMod').val("");
        $('#observacionMod').val("");
        $('#valuacionMod').attr("placeholder", 'Espere...');
        $('#fechaMod').attr("placeholder", 'Espere...');
        $('#observacionMod').attr("placeholder", 'Espere...');
        $("#ValMod").prop("disabled", true);
        $('#valuacionMod').prop("disabled", true);
        $('#fechaMod').prop("disabled", true);
        $('#observacionMod').prop("disabled", true);
        $('#valuacionMod').css({'border':'1px solid #d2d6de'});
        $('#fechaMod').css({'border':'1px solid #d2d6de'});
        $('#observacionMod').css({'border':'1px solid #d2d6de'});
    }

    $(document).on('click', '#capturarValuacion',function(){
        $.ajax({
            type: "post",
            url: "../valuaciones-cargadas/987yujiy765t78idd",
            data: {id: this.value},
            dataType: "json",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (comp) {
                console.log( comp );
                limpiarMod();
                $('#valuacionMod').attr('disabled', false);
                $('#valuacionMod').val( comp.valuacion_monto );
                $('#fechaMod').attr('disabled', false);
                $('#fechaMod').attr('readonly', true);
                $('#fechaMod').val( comp.valuacion_fecha );
                $('#observacionMod').attr('disabled', false);
                $('#observacionMod').val( comp.observacion );
                $('#ValMod').prop('disabled',false);
                $('#datoKid').val(comp.id);
            }
        });
    });

    function activarBoton(){
        if($('#valuacion').val().length > 1 && $('#fecha').val().length > 1 && $('#observacion').val().length > 1  ){
            $('#cargarVal').prop('disabled',false);
        } else {
            $('#cargarVal').prop('disabled',true);
        }
    };

    function activarBotonMod(){
        if($('#valuacionMod').val().length > 1 && $('#fechaMod').val().length > 1 && $('#observacionMod').val().length > 1  ){
            $('#ValMod').prop('disabled',false);
        } else {
            $('#ValMod').prop('disabled',true);
        }
    };

    $(document).on('click', "#desactivar", function(){

        Swal.fire({
            title: '¿Esta seguro?',
            text: "¿Desea anular esta valuación?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Anula la valuación',
            cancelButtonText: 'No, cancelar!'
          }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    type: "post",
                    url: "../desactivar/876tyu89ojbhdbvgytrdrftgyh",
                    data: {id: this.value},
                    dataType: "json",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function (comp) {
                        if(comp){
                            location.reload();
                        } else {
                            Swal.fire(
                                'Hubo un error',
                                'No pudo eliminar la valuación?',
                                'error'
                              )
                        }
                    }
                });
                

            }
          })
    });




});
