$(document).ready(function(){

    limpiar();

    $('#listaMaterial').DataTable({
        serverSide:true,
        processing: true,
        ajax: "materiales/lista-materiales",
        columns: [
            {data: 'material_codigo'},
            {data: 'material_nombre'},
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

    $("#cerrar").click(function(){
        $("#material").val("");
        $("#material").css({'border':'1px solid #e3e6ea'});
    });

    $("#material").keyup(function(){
        if ($("#material").val().length < 3) {
            $("#material").css({'border':'1px solid red'});
            $("#cargar").attr('disabled', true);
        } else {
            $("#material").css({'border':'1px solid #e3e6ea'});
            $("#cargar").attr('disabled', false);
        }
    });

    $(document).on('click', '#modifMat', function(){

        $.ajax({
            url: 'materiales/modificar-material/j92bsnkjiugy2dhijokdlm32' + this.value,
            type: 'GET',
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        })
        .done(function(comp) {


            $("#materialMod").attr("value", comp.material_nombre).attr("disabled", false);
            $("#dato").attr("value", comp.id);

        })
        .fail( function(){
            Swal.fire(
                'Hubo un error!',
                'al momento de realizar esta accion!',
                'error'
              )
        })

    })

    function limpiar(){
        $("#material").val("");
    }

    $(document).on("click", "#desactivar", function(){
        Swal.fire({
            title: '¿Esta seguro',
            text: "de querer deshabilitar este material?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, deshabilitar!',
            cancelButtonText: 'Cancelar'
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'materiales/eliminar-material/j192bs2qnsqk1ji8ugy27dhijokd5l55',
                    type: 'POST',
                    dataType: 'json',
                    data: { 'dato': this.value },
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                })
                .done(function(comp) {
                    $('#listaMaterial').DataTable().ajax.reload();
                    if (comp == true) {
                        Swal.fire(
                            'Solicitud procesada',
                            'se ha atendido la solicitud satisfactoriamente',
                            'success'
                          )
                    } else {
                        Swal.fire(
                            'Hubo un error!',
                            'al momento de realizar esta accion!',
                            'error'
                          )
                    }

                })
                .fail( function(){
                    Swal.fire(
                        'Hubo un error!',
                        'al momento de realizar esta accion!',
                        'error'
                      )
                })

            }
          })
    });




});
