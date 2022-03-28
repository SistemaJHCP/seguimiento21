$(document).ready(function(){

    limpiar();

    $("#banco").on("change", function(){
        if( $("#banco").val() >= 1 ){
        activar();
        } else {
            $("#agregar").attr("disabled", true);
        }
    });

    $(document).on("change", "#tipo",  function(){
        if($("#tipo").val() >= 1){
        activar();
        } else {
            $("#agregar").attr("disabled", true);
        }
    });

    $("#cerrar").click(function(){
        limpiar();
    });

    $(document).on('click', "#deshabilitarCuenta",function(){
        var dato = this.attributes.value.textContent;

        Swal.fire({
            title: 'Eliminar datos bancarios',
            text: "¿Esta usted seguro?, esta acción no se puede reversar",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminar!',
            cancelButtonText: 'Cancelar'
          }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: "../desactivar-cuenta/tgyu89876tty789oiuhgfdrftgyhuji9u8ygtfcdxedrfty7ytrfdfgyuiokjhgf",
                    type: 'POST',
                    dataType: 'json',
                    data: {id: dato},
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                })
                .done(function(comp) {

                    if (comp) {
                        location.reload()
                    } else {
                    Swal.fire(
                        'Hubo un error!',
                        'al deshabilitar esta cuenta!',
                        'error'
                      )
                    return false;
                    }

                })

              Swal.fire(
                'Solicitud procesada!',
                'Se ha eliminado su númerobde cuenta.',
                'success'
              )
            }
          })
    });

    $("#nroCuenta").numeric();

    $("#nroCuenta").keyup(function(){
        if ( $("#nroCuenta").val().length < 16 ) {
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
        if( $("#banco").val() >= 1 && $("#nroCuenta").val().length > 9 && $("#tipo").val().length  >= 1  ){
            $("#agregar").attr("disabled", false);
        } else {
            $("#agregar").attr("disabled", true);
        }
    }

    function limpiar(){
        $("#banco").val("");
        $("#nroCuenta").val("");
        $("#nroCuenta").css({"border": "1px solid #ced4da"});
        $("#tipo").val("");
        $("#agregar").attr("disabled", true);
    }

    $("#agregar").click(function(){
        $("form").on("submit", function () {
            $("#agregar").attr("value", "Guardando, espere...");
            $("#agregar").prop("disabled", true);
        });
    });




    // $(document).on("click", "#deshabilitarCuenta", function(){
    //     console.log( "No toma el valor: " +  );
    // });


    // $(document).on("click","#deshabilitar",function(){
        // alert( $("#deshabilitar").val() );
        // Swal.fire({
        //     title: '¿Esta usted seguro?',
        //     text: "¿Desea deshabilitar a este número de cuenta?",
        //     icon: 'warning',
        //     showCancelButton: true,
        //     confirmButtonColor: '#3085d6',
        //     cancelButtonColor: '#d33',
        //     confirmButtonText: 'Si, deshabilita!',
        //     cancelButtonText: 'Cancelar'
        //   }).then((result) => {
        //     if (result.isConfirmed) {

        //         $.ajax({
        //             url: "../desactivar-cuenta/tgyu89876tty789oiuhgfdrftgyhuji9u8ygtfcdxedrfty7ytrfdfgyuiokjhgf",
        //             type: 'POST',
        //             dataType: 'json',
        //             data: {id: this.value},
        //             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        //         })
        //         .done(function(comp) {

        //             if (comp) {

        //                 Swal.fire(
        //                     'Solicitud procesada!',
        //                     'Se ha desahabilitado a este proveedor',
        //                     'success'
        //                   )
        //             } else {
        //             Swal.fire(
        //                 'Hubo un error!',
        //                 'al deshabilitar al proveedor!',
        //                 'error'
        //               )
        //             }

        //         })
        //         .fail( function(){
        //             Swal.fire(
        //                 'Hubo un error!',
        //                 'al momento de realizar esta accion!',
        //                 'error'
        //               )
        //         })

        //     }
        // })
    // });


});
