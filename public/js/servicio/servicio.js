$(document).ready(function(){

    $("#cargar").attr("disabled", true);

    $('#listaServicio').DataTable({
        serverSide:false,
        processing: true,
        ajax: "servicio/lista-servicios",
        columns: [
            {data: 'servicio_codigo'},
            {data: 'servicio_nombre'},
            {data: 'btn'}
        ],
        bLengthChange: false,
        searching: true,
        responsive: true,
        autoWidth: false,
        order: [[ 2, "desc" ]],
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

    $('#servicio').keyup(function(){
        if($("#servicio").val().length < 3)
        {
            $("#servicio").css({"border": "1px solid red"});
            $("#cargar").attr("disabled", true);
        } else {
            $("#servicio").css({"border": "1px solid #eaecef"});
            $("#cargar").attr("disabled", false);
        }
    });

    $("#cargar").click(function(){
        $("form").on("submit", function () {
            $("#cargar").attr("value", "Guardando, espere...");
            $("#cargar").prop("disabled", true);
        });
    });

    $(document).on('click', '#deshabilitar', function(){

        Swal.fire({
            title: '¿Desea deshabilitar',
            text: "esta solicitud?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, deshabilítar',
            cancelButtonText: 'Cancelar!'
          }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: 'servicio/eliminar-servicio',
                    type: 'POST',
                    dataType: 'json',
                    data: {id: this.value},
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                })
                .done(function(comp) {
                    $('#listaServicio').DataTable().ajax.reload();
                    if (comp) {
                        Swal.fire(
                            'Desactivado!',
                            'Se ha desactivado este material.',
                            'success'
                          )
                    }

                })
                .fail( function(){
                    Swal.fire(
                        'Hubo un error',
                        'no pudo eliminarse el servicio.',
                        'error'
                      )
                });


            }
          })

    })



});
