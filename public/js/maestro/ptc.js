$(document).ready(function(){

    limpiar();
    $("#telefonoPTC").numeric(false);

    $('#listaPTC').DataTable({
        serverSide:true,
        processing: true,
        ajax: "maestroPTC/lista-ptc",
        columns: [
            {data: 'codventa_codigo'},
            {data: 'codventa_nombre'},
            {data: 'codventa_codigo2'},
            {data: 'btn'}
        ],
        order: [
            [1, "desc"]
          ],
        bLengthChange: false,
        searching: true,
        "order": [[ 3, "desc" ]],
        responsive: true,
        autoWidth: false,
        info: false,
        "language": {
            "search": "Buscar: ",
            "lengthMenu": "Display _MENU_ records per page",
            "zeroRecords": "Lo que busca no esta en el registro",
            "info": "Mostrando la página _PAGE_ of _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": "(Filtrado de _MAX_ registros totales)",
            'paginate':{
                'next': 'Siguiente',
                'previous': 'Anterior'
            },
            "processing" : "procesando."
        },
    });


        $("#codigoPTC").keyup( function(){
            if ($('#codigoPTC').val().length <= 2 || $('#codigoPTC').val().length > 23) {
                $('#codigoPTC').css({'border':'1px solid red'});
                $('#cargar').prop('disabled',true);
                activarBoton(false);
                return false;
            } else {
                $('#codigoPTC').css({'border':'1px solid #d2d6de'});
                activarBoton(false);
            }
        });

        $("#nombrePTC").keyup( function(){
            if ($('#nombrePTC').val().length <= 2 || $('#nombrePTC').val().length > 100) {
                $('#nombrePTC').css({'border':'1px solid red'});
                $('#cargar').prop('disabled',true);
                activarBoton(false);
                return false;
            } else {
                $('#nombrePTC').css({'border':'1px solid #d2d6de'});
                activarBoton(false);
            }
        });

        $("#telefonoPTC").keyup( function(){
            if ($('#telefonoPTC').val().length <= 2 || $('#telefonoPTC').val().length > 40) {
                $('#telefonoPTC').css({'border':'1px solid red'});
                $('#cargar').prop('disabled',true);
                activarBoton(false);
                return false;
            } else {
                $('#telefonoPTC').css({'border':'1px solid #d2d6de'});
                activarBoton(false);
            }
        });

        $("#direccionPTC").keyup( function(){
            if ($('#direccionPTC').val().length <= 2 || $('#direccionPTC').val().length > 220) {
                $('#direccionPTC').css({'border':'1px solid red'});
                $('#cargar').prop('disabled',true);
                activarBoton(false);
                return false;
            } else {
                $('#direccionPTC').css({'border':'1px solid #d2d6de'});
                activarBoton(false);
            }
        });

        $("#correoPTC").keyup(function(){
            var correo = $("#correoPTC").val();
            var resp = correo.includes("@");
            if(resp){
                activarBoton(true);
            } else {
                activarBoton(false);
            }
        });

        $("#cargar").click(function(){
            $("form").on("submit", function () {
                $("#cargar").attr("value", "Guardando, espere...");
                $(this).find(":submit").prop("disabled", true);
            });
        });


        function activarBoton(a){
            if($('#codigoPTC').val().length > 2 && $('#nombrePTC').val().length > 2 && $('#telefonoPTC').val().length > 2 && $('#direccionPTC').val().length > 2 && a == true){
                $('#cargar').prop('disabled',false);
            } else {
                $('#cargar').prop('disabled',true);
            }
        };

        $(document).on("click", "#desactivar", function(){
            Swal.fire({
                title: '¿Seguro desea desactivar',
                text: "la PTC seleccionada?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Desactivar!',
                cancelButtonText: 'Cancelar'
              }).then((result) => {
                if (result.value) {

                    var url = "maestroPTC/eliminar-ptc/8yg28yb2728"+ $(this).val() +"282";

                    $.ajax({
                        url: url,
                        type: 'POST',
                        dataType: 'json',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                    })
                    .done(function(comp) {

                        if(comp == true){
                            $('#listaPTC').DataTable().ajax.reload();
                            Swal.fire(
                                'Solicitud procesada!',
                                'Se a guardado el PTC satisfactoriamente!',
                                'success'
                              )
                        } else {
                            Swal.fire(
                                'Hubo un error!',
                                'al momento de guardar el PTC!',
                                'error'
                            );
                        }
                    })
                    .fail( function(){
                        Swal.fire(
                            'Hubo un error!',
                            'al momento de realizar esta accion!',
                            'error'
                          )
                    })
                }
            })
        });

        function limpiar(){
            $("#codigoPTC").val("");
            $("#codigoPTC").css({'border':'1px solid #d2d6de'});
            $("#nombrePTC").val("");
            $("#nombrePTC").css({'border':'1px solid #d2d6de'});
            $("#telefonoPTC").val("");
            $("#telefonoPTC").css({'border':'1px solid #d2d6de'});
            $("#direccionPTC").val("");
            $("#direccionPTC").css({'border':'1px solid #d2d6de'});
            $("#correoPTC").val("");
            $("#correoPTC").css({'border':'1px solid #d2d6de'});
        }

        $("#cerrar").on("click", function(){
            limpiar();
        });



});

