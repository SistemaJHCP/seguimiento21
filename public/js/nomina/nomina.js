$(document).ready(function(){

    $(document).on("click", "#agregarNomina", function(){
        $("form").on("submit", function () {
            $("#agregarNomina").attr("value", "Guardando, espere...");
            $("#agregarNomina").attr("disabled", true);
        });
    });

    $(document).on("click", "#agregarSuministroMod", function(){
        $("form").on("submit", function () {
            $("#agregarSuministroMod").attr("value", "Guardando, espere...");
            $("#agregarSuministroMod").attr("disabled", true);
        });
    });


    $("#nombreSuministro").val("");
    $("#nombreSuministroMod").val("");
    $("#cerrar").click(function(){
        $("#nombreSuministro").val("");
        $("#agregarSuministro").attr("disabled", true);
    });

    $('#listaNominas').DataTable({
        serverSide:true,
        processing: true,
        ajax: "nomina/listado-nomina",
        columns: [
            {data: 'nomina_codigo'},
            {data: 'nomina_nombre'},
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

    $("#nombreNomina").keyup(function(){
        if($("#nombreNomina").val().length < 3)
        {
            $("#nombreNomina").css({"border": "1px solid red"});
            $("#agregarNomina").attr("disabled", true);
        } else {
            $("#nombreNomina").css({"border": "1px solid #ced4da"});
            $("#agregarNomina").attr("disabled", false);
        }
    });

    $(document).on("click", "#modificar", function(){
        $("#agregarNominaMod").attr("disabled", true);
        $("#nombreNominaMod").val("");
        $.ajax({
            url: "nomina/modificar/8uhdi7282j92uh2j" + this.value,
            type: 'GET',
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        })
        .done(function(comp) {
            console.log(comp);
            $("#nombreNominaMod").val(comp.nomina_nombre);
            $("#dato").val(comp.id);
            $("#agregarNominaMod").attr("disabled", false);
        })
        .fail( function(){
            console.log("Hubo un error en el ajax de mostra el suministro para modificarlo");
        });

    $("#cerrarMod").click(function(){
        $("#agregarNominaMod").attr("disabled", true);
        $("#nombreNominaMod").css({"border": "1px solid #ced4da"});
        $("#nombreNominaMod").val("");
        $("#dato").val("");
    });

    $("#nombreSuministroMod").keyup(function(){
        if($("#nombreSuministroMod").val().length < 3)
        {
            $("#nombreSuministroMod").css({"border": "1px solid red"});
            $("#agregarSuministroMod").attr("disabled", true);
        } else {
            $("#nombreSuministroMod").css({"border": "1px solid #ced4da"});
            $("#agregarSuministroMod").attr("disabled", false);
        }
    });


    });

    $(document).on("click", "#deshabilitar", function(){

        Swal.fire({
            title: '¿Esta seguro?',
            text: "¿de querer deshabilitar este suministro?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, deshabilita!',
            cancelButtonText: 'Cancelar'
          }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: "suministros/deshabilitar/cefefdfsfdsfys8u" + this.value,
                    type: 'GET',
                    dataType: 'json',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                })
                .done(function(comp) {

                    if(comp == true){
                        $('#listaSuministros').DataTable().ajax.reload();
                        Swal.fire(
                            'Solicitud procesada',
                            'Se ha desactivado este suministro.',
                            'success'
                        )
                    }else{
                        Swal.fire(
                            'Hubo un error',
                            'No se pudo desactivar el suministro.',
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
