$(document).ready(function(){

    $("#cargar").attr("disabled", true);

    $('#listaViaticos1').DataTable({
        serverSide:false,
        processing: true,
        ajax: "viatico/lista-viaticos",
        columns: [
            {data: 'viatico_codigo'},
            {data: 'viatico_nombre'},
            {data: 'btn'}
        ],
        order: [
            [2, "desc"]
          ],
        bLengthChange: false,
        searching: true,
        responsive: true,
        autoWidth: false,
        info: false,
        language: {
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

    $('#viatico').keyup(function(){
        if($("#viatico").val().length < 3)
        {
            $("#viatico").css({"border": "1px solid red"});
            $("#cargar").attr("disabled", true);
        } else {
            $("#viatico").css({"border": "1px solid #eaecef"});
            $("#cargar").attr("disabled", false);
        }
    });

    $("#cargar").click(function(){
        $("form").on("submit", function () {
            $("#cargar").attr("value", "Guardando, espere...");
            $("#cargar").prop("disabled", true);
        });
    });


    $(document).on('click', '#deshabilitarVia', function(){

        Swal.fire({
            title: '¿Esta seguro',
            text: "de querer deshabilitar este viático?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, deshabilitar!',
            cancelButtonText: 'Cancelar!'
          }).then((result) => {
            if (result.isConfirmed) {


                $.ajax({
                    url: 'viatico/deshabilitar-viatico',
                    type: 'POST',
                    dataType: 'json',
                    data: {id: this.value},
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                })
                .done(function(comp) {
                    $('#listaViaticos1').DataTable().ajax.reload();
                    if (comp) {
                        Swal.fire(
                            'Solicitud procesada!',
                            'Se ha desactivado este viático.',
                            'success'
                          )
                    }

                })
                .fail( function(){
                    Swal.fire(
                        'Hubo un error',
                        'No se pudo eliminar este Viático',
                        'error'
                      )
                });








            }
          })

    });


});
