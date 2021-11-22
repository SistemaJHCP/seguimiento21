$(document).ready(function(){

    $('#listaObras').DataTable({
        serverSide:true,
        processing: true,
        ajax: "control-de-obras/lista-de-obras",
        columns: [
            {data: 'obra_codigo'},
            {data: 'obra_tipo'},
            {data: 'obra_cliente'},
            {data: 'obra_codventa'},
            {data: 'obra_nombre'},
            {data: 'obra_fechaInicio'},
            {data: 'obra_fechaFin'},
            {data: 'obra_monto'},
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
