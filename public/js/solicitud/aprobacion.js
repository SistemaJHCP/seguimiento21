$(document).ready(function(){

    $('#listaSolicitud').DataTable({
        serverSide: true,
        processing: true,
        ajax: "solicitud-de-pago/lista-solicitud",
        columns: [
            {data: 'solicitud_numerocontrol'},
            {data: 'obra_nombre'},
            {data: 'fecha'},
            {data: 'solicitud_motivo'},
            {data: 'aproRepro'},
            {data: 'btn2'},
            {data: 'nombre'},
            {data: 'suma',render: $.fn.dataTable.render.number( ',', '.', 2)},
            {data: 'btn'}
        ],
        order: [
            [8, "desc"]
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
                'previous': 'Anterior'
            },
            "processing" : "procesando."
        },
        "columnDefs": [
            { "width": "7%", "targets": 1 },
            { "width": "10%", "targets": 2 },
            { "width": "40%", "targets": 3 },
            { "width": "10%", "targets": 4 },
            { "width": "10%", "targets": 5 }
          ],
    });


});
