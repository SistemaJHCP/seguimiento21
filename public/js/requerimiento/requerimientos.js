$(document).ready(function(){

    $('#listaObras').DataTable({
        serverSide:false,
        processing: true,
        ajax: "requisicion/lista-de-requisicion",
        columns: [
            {data: 'requisicion_codigo'},
            {data: 'requisicion_tipo'},
            {data: 'requisicion_fecha'},
            {data: 'requisicion_fechae'},
            {data: 'obra'},
            {data: 'requisicion_motivo'},
            {data: 'requisicion_estado'},
            {data: 'usuario_nombre'},
            {data: 'btn'}
        ],
        order: [
            [0, "desc"]
          ],
        bLengthChange: false,
        searching: true,
        responsive: true,
        autoWidth: false,
        info: false,
        language: {
            "search": "Buscar: ",
            "lengthMenu": "Display _MENU_ records per page",
            "zeroRecords": "Ninguna requisición cargada por usted",
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

    $(document).on("click", '#desactivar', function(){
        Swal.fire({
            title: '¿Desea anular',
            text: "esta requisicion?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, anular!',
            cancelButtonText: 'Cancelar'
          }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: "requisicion/anular-requisicion/metodo-app/huijbvcfghji66789ijdvgyu8d7yt",
                    type: 'post',
                    dataType: 'json',
                    data:{dato: this.value},
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                })
                .done(function(comp) {

                    if (comp) {

                        $('#listaObras').DataTable().ajax.reload();

                        Swal.fire(
                            'Anulado!',
                            'La requisicion ha sido anulada.',
                            'success'
                          )
                    }


                })
                .fail( function(){
                    Swal.fire(
                        'Hubo un error!',
                        'no pudo anular la requisición.',
                        'error'
                      )
                })

            }
          })
    });



});
