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

    $("#cerrarNuevo, .cerrarCruz, #cerrarMod").on("click", function(){
        limpiar();
    });

    $(document).on("click", "#modificar", function(){

        $("#rifMod").val("");
        $("#nombreBancoMod").val("");

        $.ajax({
            url: "bancos/modificar/eweefwefwef2uh2j",
            type: 'POST',
            dataType: 'json',
            data: {valor: this.value},
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        })
        .done(function(comp) {

            $("#rifMod").attr("disabled", false);
            $("#nombreBancoMod").attr("disabled", false);
            $("#rifMod").val(comp.banco_rif);
            $("#nombreBancoMod").val(comp.banco_nombre);
            $("#dato").val(comp.id);

        })
        .fail( function(){
            console.log("Hubo un error en el ajax de mostra el suministro para modificarlo");
        });

    });

    function limpiar(){
        $("#rif").val("");
        $("#nombreBanco").val("");
        $("#rifMod").val("");
        $("#nombreBancoMod").val("");
        $("#rifMod").attr("disabled", true);
        $("#nombreBancoMod").attr("disabled", true);
    }

    $("#cargar").click(function(){
        $("form").on("submit", function () {
            $("#cargar").attr("value", "Guardando, espere...");
            $("#cargar").attr("disabled", true);
        });
    });

    $(document).on("click", "#modificarValor", function(){
        $("form").on("submit", function () {
            $("#modificarValor").attr("value", "Guardando, espere...");
            $("#modificarValor").attr("disabled", true);
        });
    });


    $(document).on('click', "#deshabilitar", function(){

        Swal.fire({
            title: '¿Esta seguro?',
            text: "¿de querer deshabilitar estos datos bancarios?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, deshabilita!',
            cancelButtonText: 'Cancelar'
          }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: "bancos/desactivar-banco",
                    type: 'POST',
                    dataType: 'json',
                    data: { dato: this.value },
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                })
                .done(function(comp) {



                    if(comp == true){
                        $('#listaBancos').DataTable().ajax.reload();
                        Swal.fire(
                            'Solicitud procesada',
                            'Se ha desactivado este banco.',
                            'success'
                        )
                    }else{
                        Swal.fire(
                            'Hubo un error',
                            'No se pudo desactivar el banco.',
                            'error'
                        )
                    }
                })
                .fail( function(){
                    Swal.fire(
                        'Hubo un error',
                        'No se pudo desactivar el suministro solicitado.',
                        'error'
                    )
                });

            }
          })

    });

});
