$(document).ready(function(){

    $('#listaProveedores').DataTable({
        serverSide:true,
        processing: true,
        ajax: "proveedores/lista-proveedores",
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
            [0, "desc"]
          ],
        bLengthChange: false,
        searching: true,
        "order": [[ 0, "desc" ]],
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



});
