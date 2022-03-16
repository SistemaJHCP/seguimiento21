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
        } else {
            $('#cuentaJHCP').attr('disabled', true);
            $('#cuentaJHCP').attr('required', false);
            $('#cuentaJHCP').val('');
        }
    });



});


