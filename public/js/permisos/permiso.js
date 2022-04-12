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


});
