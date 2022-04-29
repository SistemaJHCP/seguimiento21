$(document).ready(function(){

    $('#listaPermisos').DataTable({
        serverSide: false,
        processing: true,
        ajax: "permisos/lista-permisos",
        columns: [
            {data: 'id'},
            {data: 'nombre_permiso'},
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
        columnDefs: [
            { "width": "10%", "targets": 0 },
            { "width": "32%", "targets": 2 }
          ],
    });

    $(document).on('click', "#desactivarPermiso", function(){
        Swal.fire({
            title: '¿Esta seguro',
            text: "de deshabilitar el permiso?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, deshabilitar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                url: "permisos/desactivar/i9u4928sdd92sdv6272dv82rdddvdu9ih",
                type: 'POST',
                dataType: 'json',
                data: {id: this.value},
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            })
            .done(function(comp) {

                if(comp == true){
                    Swal.fire(
                        'Deshabilitado',
                        'El permiso a sido deshabilitado.',
                        'success'
                    )
                    $('#listaPermisos').DataTable().ajax.reload()
                } else {
                    Swal.fire(
                        'Hubo un error',
                        'no se pudo deshabilitar este permiso.',
                        'error'
                    )
                }


            })
            .fail( function(){
                console.log("Error al deshabilitar un permiso");
            })
        }
        })
    });

});
