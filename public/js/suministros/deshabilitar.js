$(document).ready(function(){



    $('#listaSuministrosDes').DataTable({
        serverSide:true,
        processing: true,
        ajax: "listado-suministros-deshabilitados",
        columns: [
            {data: 'suministro_codigo'},
            {data: 'suministro_nombre'},
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
            title: '¿Esta seguro?',
            text: "¿de querer habilitar este suministro?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, habilita!',
            cancelButtonText: 'Cancelar'
          }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: "habilitar/cefe45fdfds6v3svdvsf9ds30fys098u" + this.value,
                    type: 'GET',
                    dataType: 'json',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                })
                .done(function(comp) {

                    if(comp == true){
                        $('#listaSuministrosDes').DataTable().ajax.reload();
                        Swal.fire(
                            'Solicitud procesada',
                            'Se ha desactivado este suministro.',
                            'success'
                        )
                    }else{
                        Swal.fire(
                            'Hubo un error',
                            'No se pudo desactivar el suministro suministro.',
                            'success'
                        )
                    }
                })
                .fail( function(){
                    console.log("Hubo un error en el ajax de mostra el suministro para deshabilitarlo");
                });

            }
          })
    });



});
