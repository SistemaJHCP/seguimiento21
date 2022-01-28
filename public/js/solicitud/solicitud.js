$(document).ready(function(){



    $('#listaSolicitud').DataTable({
        serverSide: false,
        processing: true,
        ajax: "solicitud/lista-de-solicitud",
        columns: [
            {data: 'solicitud_numerocontrol'},
            {data: 'fecha'},
            {data: 'solicitud_motivo'},
            {data: 'solicitud_aprobacion'},
            {data: 'nombre'},
            {data: 'btn'}
        ],
        order: [
            [1, "desc"]
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
        "columnDefs": [
            { "width": "16%", "targets": 5 }
          ],
    });







});
