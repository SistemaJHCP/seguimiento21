$(document).ready(function(){

    $('#comprobante').numeric();
    limpiar();

    function limpiar(){
        $('#forma_pago').val("");
        $('#cuentaJHCP').val("");
        $('#comprobante').val("");
        $('#cheque').val("");
        $('#comentario').val("");
        $('#cuentaJHCP').attr('disabled', true);
        $('#chequera').attr('disabled', true);
        $('#cheque').attr('disabled', true);
    }

    $('.close').on('click', function(){
        limpiar();
    });

    $(document).on('click', "#question", function(){
        event.preventDefault();
        Swal.fire({
            title: '¿Esta seguro?',
            text: "¿Desea anular esta solicitud?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Anula la solicitud',
            cancelButtonText: 'No, cancelar!'
          }).then((result) => {
            if (result.isConfirmed) {

                document.anular.submit();

            }
          })
    });


    $("#procesarPago").click(function(){
        $("form").on("submit", function () {
            $("#procesarPago").attr("value", "Guardando, espere...");
            $("#procesarPago").prop("disabled", true);
        });
    });

    $('#forma_pago').on('change', function(){
        if($('#forma_pago').val() == "Transferencia" || $('#forma_pago').val() == "Deposito"){
            $('#cuentaJHCP').attr('disabled', false);
            $('#cuentaJHCP').attr('required', true);
            $('#ocultarTransferencia').css('display', "");
            $('#ocultarCheque').css('display', "none");
            $("#chequera").prop("disabled", true);
            $("#cheque").prop("disabled", true);
            $("#chequera").prop("click");
            $("#cheque").prop("click");
            $("#chequera").val("");
            $("#cheque").val("");
            $("#cuentaJHCP").val("");
        } else {
            if( $('#forma_pago').val() == "Cheque" ){
                $('#ocultarTransferencia').css('display', "none");
                $('#ocultarCheque').css('display', "");
                $('#cuentaJHCP').attr('disabled', false);
                $('#cuentaJHCP').attr('required', true);
                $("#cuentaJHCP").val("");

                $('.opcionCuenta').on('change', function(){
                    $('#chequera').attr('disabled', true);
                    $.ajax({
                        type: "post",
                        url: "../busqueda-chequera/65rdt78u9i0dibhdgyt65rdd",
                        data: { id: $('.opcionCuenta').val() },
                        dataType: "json",
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        success: function (comp) {
                            if (comp.length == 0) {
                                $('#chequera').attr('disabled', true);
                                return false;
                            }
                            var chequera = '<option value="">Seleccione...</option>';
                            for (let i = 0; i < comp.length; i++) {
                                chequera+= '<option value="' + comp[i].id + '">' + comp[i].chequera_codigo + ' | ' + comp[i].chequera_correlativo + '</option>'
                            }

                            $('#chequera').html(chequera);
                            $('#chequera').attr('disabled', false);


                        },error:function(){
                            alert("Hubo un error al traer la informacion del listado de chequeras");
                        }
                    });
                });




            }else{
                $('#cuentaJHCP').attr('disabled', true);
                $('#cuentaJHCP').attr('required', false);
                $('#cuentaJHCP').val('');
                $('#ocultarCheque').css('display', "none");
                $('#ocultarTransferencia').css('display', "none");
            }
        }
    });

    $('#chequera').on('change',function(){

        $.ajax({
            type: "post",
            url: "../busqueda-cheque/98u7ytfghuiijuyftrserdtyyuy7tt",
            data: { id: $('#chequera').val() },
            dataType: "json",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (comp) {
                if (comp.length == 0) {
                    $('#cheque').attr('disabled', true);
                    return false;
                }
                var cheque = '<option value="">Seleccione...</option>';
                for (let i = 0; i < comp.length; i++) {
                    cheque+= '<option value="' + comp[i].id + '"><b>Cod: </b>' + comp[i].cheque_codigo + ' | ' + comp[i].cheque_destinatario + ' | <b>Monto: </b>' + comp[i].cheque_monto + '</option>'
                }
                $('#cheque').html(cheque);
                $('#cheque').attr('disabled', false);

            }
        });




        $('#cheque').attr('disabled', false);
    });


});


