$(document).ready(function(){

    $('#listaBancos').DataTable({
        serverSide:false,
        processing: true,
        ajax: "bancos/listado-bancos",
        columns: [
            {data: 'banco_rif'},
            {data: 'banco_nombre'},
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

    $("#cerrarNuevo, .cerrarCruz").on("click", function(){
        limpiar();
    });

    $(document).on("click", "#modificar", function(){

        $.ajax({
            url: "bancos/modificar/eweefwefwef2uh2j",
            type: 'POST',
            dataType: 'json',
            data: {valor: this.value},
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        })
        .done(function(comp) {
            console.log(comp);
            // $("#nombreNominaMod").val(comp.nomina_nombre);
            // $("#dato").val(comp.id);
            // $("#agregarNominaMod").attr("disabled", false);
        })
        .fail( function(){
            console.log("Hubo un error en el ajax de mostra el suministro para modificarlo");
        });

    });



    function limpiar(){
        $("#rif").val("");
        $("#nombreBanco").val("");
    }


});
