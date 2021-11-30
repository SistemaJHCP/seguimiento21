$(document).ready(function(){

    $("#nombreSuministro").val("");
    $("#nombreSuministroMod").val("");
    $("#cerrar").click(function(){
        $("#nombreSuministro").val("");
        $("#agregarSuministro").attr("disabled", true);
    });

    $('#listaSuministros').DataTable({
        serverSide:true,
        processing: true,
        ajax: "suministros/listado-suministro",
        columns: [
            {data: 'suministro_codigo'},
            {data: 'suministro_nombre'},
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

    $("#nombreSuministro").keyup(function(){
        if($("#nombreSuministro").val().length < 3)
        {
            $("#nombreSuministro").css({"border": "1px solid red"});
            $("#agregarSuministro").attr("disabled", true);
        } else {
            $("#nombreSuministro").css({"border": "1px solid black"});
            $("#agregarSuministro").attr("disabled", false);
        }
    });

    $(document).on("click", "#modificar", function(){
        $("#agregarSuministroMod").attr("disabled", true);
        $.ajax({
            url: "suministros/modificar/98uihjhsft6t79ys8u" + this.value,
            type: 'GET',
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        })
        .done(function(comp) {

            $("#nombreSuministroMod").val(comp.suministro_nombre);
            $("#dato").val(comp.id);
            $("#agregarSuministroMod").attr("disabled", false);
        })
        .fail( function(){
            console.log("Hubo un error en el ajax de mostra el suministro para modificarlo");
        });

    $("#cerrarMod").click(function(){
        $("#agregarSuministroMod").attr("disabled", true);
        $("#nombreSuministroMod").css({"border": "1px solid black"});
        $("#nombreSuministroMod").val("");
        $("#dato").val("");
    });

    $("#nombreSuministroMod").keyup(function(){
        if($("#nombreSuministroMod").val().length < 3)
        {
            $("#nombreSuministroMod").css({"border": "1px solid red"});
            $("#agregarSuministroMod").attr("disabled", true);
        } else {
            $("#nombreSuministroMod").css({"border": "1px solid black"});
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
                            'No se pudo desactivar el suministro suministro.',
                            'success'
                        )
                    }
                })
                .fail( function(){
                    console.log("Hubo un error en el ajax de mostra el suministro para deshabilitarlo");
                });

            }
          })
    });
});
