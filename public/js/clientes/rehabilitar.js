$(document).ready(function(){

    $('#listaClientes').DataTable({
        serverSide:true,
        processing: true,
        ajax: "../cliente/lista-deshabilitado",
        columns: [
            {data: 'cliente_codigo'},
            {data: 'cliente_rif'},
            {data: 'cliente_nombre'},
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
        language: {
            "search": "Buscar: ",
            "lengthMenu": "Display _MENU_ records per page",
            "zeroRecords": "Lo que busca no esta en el registro",
            "info": "Mostrando la página _PAGE_ of _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": "(Filtrado de _MAX_ registros totales)",
            'paginate':{
                'next': 'Siguiente',
                'previous': 'Anteror'
            },
            "processing" : "procesando."
        },
        "columnDefs": [
            { "width": "6%", "targets": 3},
            { "width": "40%", "targets": 2 },
            { "width": "24%", "targets": 0 }
          ],
    });

    $(document).on("click", "#rehabilitar", function(){
        Swal.fire({
            title: 'Rehabilitar',
            text: "¿Desea rehabilitar este cliente?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Rehabilitar',
            cancelButtonText: 'Cancelar'
          }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: "../cliente/rehabilitar/ihuu9jjpou0y9tt",
                    type: 'POST',
                    dataType: 'json',
                    data:{dato: this.value},
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                })
                .done(function(comp) {

                    Swal.fire(
                        'Solicitud procesada!',
                        'Se ha rehabilitado este cliente.',
                        'success'
                    );
                    $('#listaClientes').DataTable().ajax.reload();
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

});
