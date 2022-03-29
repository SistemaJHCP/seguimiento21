$(document).ready(function(){

    $('#listaPersonal').DataTable({
        serverSide:true,
        processing: true,
        ajax: "../personal/lista-de-personal-a-rehabilitar",
        columns: [
            {data: 'personal_codigo'},
            {data: 'personal_nombre'},
            {data: 'personal_profesion'},
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
            search: "Buscar: ",
            lengthMenu: "Display _MENU_ records per page",
            zeroRecords: "Lo que busca no esta en el registro",
            info: "Mostrando la página _PAGE_ of _PAGES_",
            infoEmpty: "No records available",
            infoFiltered: "(Filtrado de _MAX_ registros totales)",
            paginate:{
                next: 'Siguiente',
                previous: 'Anteror'
            },
            processing : "procesando."
        },
        columnDefs: [
            { "width": "5%", "targets": 3 }
          ],
    });

    $(document).on('click', '#reactivar', function(){

        Swal.fire({
            title: '¿Desea rehabilitar',
            text: "a esta pesona en el sistema?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, habilítalo!',
            cancelButtonText: 'Cancelar'
          }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: "habilitando-personal/ou9hugyhi99dhuyg78d9i0",
                    type: 'POST',
                    dataType: 'json',
                    data:{id: this.value},
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                })
                .done(function(comp) {

                    if(comp){
                        $('#listaPersonal').DataTable().ajax.reload();
                        Swal.fire(
                            'Solicitud procesada!',
                            'se ha reactivado a este personal',
                            'success'
                        )
                    } else {
                        Swal.fire(
                            'Hubo un error!',
                            'al reactivar a este personal',
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
        });

    })

});
