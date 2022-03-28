$(document).ready(function(){

    $('#listaProveedores').DataTable({
        serverSide:false,
        processing: true,
        ajax: "../proveedores/lista-proveedores-deshabilitadas",
        columns: [
            {data: 'codigo'},
            {data: 'tipo'},
            {data: 'rif'},
            {data: 'nombre'},
            {data: 'tlf'},
            {data: 'correo'},
            {data: 'contacto'},
            {data: 'suministro'},
            {data: 'btn'}
        ],
        order: [
            [8, "DESC"]
          ],
        bLengthChange: false,
        searching: true,
        // "order": [[ 0, "desc" ]],
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
        columnDefs: [
            { "width": "5%", "targets": 8 }
          ],
    });


    $(document).on("click", "#rehabilitar", function(){
        Swal.fire({
            title: '¿Seguro desea rehabilitar',
            text: "a este proveedor en el sistema?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, rehabilitar',
            cancelButtonText: 'Cancelar'
          }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: "reactivar-proveedor/poiuy7t6fyguiuo",
                    type: 'POST',
                    dataType: 'json',
                    data: {id: this.value},
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                })
                .done(function(comp) {
                    $('#listaProveedores').DataTable().ajax.reload();
                    if (comp) {
                        
                        Swal.fire(
                            'Solicitud procesada!',
                            'Se ha rehabilitado a este proveedor',
                            'success'
                          )
                    } else {
                    Swal.fire(
                        'Hubo un error!',
                        'al reabilitar al proveedor!',
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
