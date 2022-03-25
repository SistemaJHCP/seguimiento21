$(document).ready(function(){

    $('#listaPTC').DataTable({
        serverSide:true,
        processing: true,
        ajax: "../maestroPTC/lista-ptc-a-deshabilitar",
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
                'previous': 'Anteror'
            },
            "processing" : "procesando."
        },
        "columnDefs": [
            { "width": "6%", "targets": 3},

        ],
    });

    $(document).on('click', "#desactivar", function(){
        Swal.fire({
            title: 'Rehabilitar',
            text: "¿Desea rehabilitar este PTC?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Rehabilitar',
            cancelButtonText: 'Cancelar'
          }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: "../maestroPTC/rehabilitar/987yguhsjyt7y8ud90",
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
                    $('#listaPTC').DataTable().ajax.reload();
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
