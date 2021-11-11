$(document).ready(function(){
    $('#listaDeshabilitar').DataTable({
        serverSide:true,
        processing: true,
        ajax: "lista-inhabilitados",
        columns: [
            {data: 'user_login'},
            {data: 'email'},
            {data: 'btn'}
        ],
        order: [
            [1, "asc"]
          ],
        bLengthChange: false,
        searching: true,
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
    });


    $(document).on("click", "#habilitar", function(){
        Swal.fire({
            title: '¿Seguro desea reactivar',
            text: "a este usuario del sistema?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Reactivar!',
            cancelButtonText: 'Cancelar'
          }).then((result) => {
            if (result.value) {
                var id = $(this).val();
                var url = "reactivar/8y8gstudigf6r5drt8"+id+"2820u9hid"

                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'json',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                })
                .done(function(comp) {

                    if(comp == true){
                        $('#listaDeshabilitar').DataTable().ajax.reload();
                        Swal.fire(
                            'Solicitud procesada!',
                            'Se ha desactivado al usuario satisfactoriamente!',
                            'success'
                        )
                    } else {
                        Swal.fire(
                            'Hubo un problema!',
                            'con su solicitud',
                            'error'
                        )
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



});
