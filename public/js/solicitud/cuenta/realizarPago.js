$(document).ready(function(){

    $('#comprobante').numeric();
    limpiar();

    function limpiar(){
        $('#forma_pago').val("");
        $('#cuentaJHCP').val("");
        $('#comprobante').val("");
        $('#cheque').val("");
        $('#comentario').val("");
    }

    $('.close, #cerrar').on('click', function(){
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



});


