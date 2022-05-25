$(document).ready(function(){

    $(document).on('click', '#anular', function(){
        var id = this.attributes.value.nodeValue;

        





    });



});




function listar(a){

    $('#listaCheque').DataTable({
        serverSide: false,
        processing: true,
        ajax: "lista-cheque/" + a,
        columns: [
            {data: 'cheque_codigo'},
            {data: 'cheque_monto'},
            {data: 'cheque_destinatario'},
            {data: 'cheque_fecha'},
            {data: 'chequera_codigo'},
            {data: 'btn2'},
            {data: 'btn'}
        ],
        order: [
            [0, "DESC"]
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
                previous: 'Anterior'
            },
            "processing" : "procesando."
        },
        columnDefs: [
            { "width": "12%", "targets": 6 },
            { "width": "8%", "targets": 5 }
        ],
    });
}
