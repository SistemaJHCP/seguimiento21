$(document).ready(function(){

    $('#listaSolicitud').DataTable({
        serverSide: false,
        processing: true,
        ajax: "solicitud/lista-de-solicitud",
        columns: [
            {data: 'solicitud_numerocontrol'},
            {data: 'fecha'},
            {data: 'solicitud_motivo'},
            {data: 'proveedor_nombre', 'visible': false},
            {data: 'btn2'},
            {data: 'nombre'},
            {data: 'obra_nombre', 'visible': true},
            {data: 'suma', render: $.fn.dataTable.render.number( ',', '.', 2)},
            {data: 'btn'}
        ],
        order: [
            [8, "DESC"]
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
        columnDefs: [
            { "width": "7%", "targets": 0 },
            { "width": "7%", "targets": 1 },
            { "width": "10%", "targets": 4 },
            { "width": "12%", "targets": 5 },
            { "width": "12%", "targets": 6 },
            { "width": "12%", "targets": 7 },
            { "width": "16%", "targets": 8 }
          ],
    });


    $(document).on('click', '#desactivar', function(){
        Swal.fire({
            title: '¿Esta seguro',
            text: "de anular esta solicitud?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, anular!',
            cancelButtonText: 'Cancelar'
          }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: 'solicitud/anulacion-solicitud/' + this.value ,
                    type: 'GET',
                    dataType: 'json',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                })
                .done(function(comp) {

                    $('#listaSolicitud').DataTable().ajax.reload()
                    if (comp == true) {
                        Swal.fire(
                            'Anulado',
                            'Se ha realizado la anulación satisfactoriamente.',
                            'success'
                        );
                    } else {
                        Swal.fire(
                            'Error',
                            'Hubo un error al procesar la solicitud.',
                            'error'
                        );
                    }



                })
                .fail( function(){
                    Swal.fire(
                        'Error',
                        'No tiene autorizado realizar esta acción.',
                        'error'
                    );
                })


            }
          })
    });




});
