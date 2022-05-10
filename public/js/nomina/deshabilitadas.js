$(document).ready(function(){

    $('#listaNominasDeshabilitadas').DataTable({
        serverSide:true,
        processing: true,
        ajax: "../nomina/listado-nomina-deshabilitada",
        columns: [
            {data: 'nomina_codigo'},
            {data: 'nomina_nombre'},
            {data: 'btn'}
        ],
        bLengthChange: false,
        searching: true,
        order: [
            [0, "desc"]
          ],
        responsive: true,
        autoWidth: false,
        info: false,
        "language": {
            "search": "Buscar: ",
            "lengthMenu": "Display _MENU_ records per page",
            "zeroRecords": "Lo que busca no esta en el registro",
            "info": "Mostrando la página _PAGE_ of _PAGES_",
            "infoEmpty": "No hay información que mostrar",
            "infoFiltered": "(Filtrado de _MAX_ registros totales)",
            'paginate':{
                'next': 'Siguiente',
                'previous': 'Anteror'
            },
            "processing" : "procesando."
        },
    });

    $(document).on("click", "#rehabilitar", function(){

        Swal.fire({
            title: '¿Desea rehabilitar',
            text: "esta nómina inhabilitada?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, rehabilita!',
            cancelButtonText: 'Cancelar'
          }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: "rehabilitar/87yuijdhhudegy7y8" + this.value,
                    type: 'GET',
                    dataType: 'json',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                })
                .done(function(comp) {

                    if(comp == true){
                        $('#listaNominasDeshabilitadas').DataTable().ajax.reload();
                        Swal.fire(
                            'Solicitud procesada',
                            'Se ha desactivado este suministro.',
                            'success'
                        )
                    }else{
                        Swal.fire(
                            'Hubo un error',
                            'No se pudo desactivar el suministro.',
                            'error'
                        )
                    }

                })
                .fail( function(){
                    Swal.fire(
                        'Hubo un error',
                        'No se pudo desactivar el suministro solicitado.',
                        'error'
                    )
                });
            }
          })

    });



});
