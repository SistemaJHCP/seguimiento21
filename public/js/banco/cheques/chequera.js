$(document).ready(function(){

    $("#fecha").datepicker({
        dateFormat: "yy-mm-dd",
        closeText: 'Cerrar',
        prevText: '< Ant',
        nextText: 'Sig >',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
        weekHeader: 'Sm'
    });





});


function listar(a){

    $('#listaChequeras').DataTable({
        serverSide: false,
        processing: true,
        ajax: "lista-chequera/" + a,
        columns: [
            {data: 'chequera_codigo'},
            {data: 'fecha'},
            {data: 'chequera_cantidadcheque'},
            {data: 'chequera_correlativo'},
            {data: 'emitido'},
            {data: 'anulado'},
            {data: 'btn'}
        ],
        order: [
            [6, "DESC"]
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
            { "width": "17%", "targets": 6 }
          ],
    });
}
