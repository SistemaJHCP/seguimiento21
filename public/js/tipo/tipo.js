$(document).ready(function(){

    $('#listaTipo').DataTable({
        serverSide: false,
        processing: true,
        ajax: "tipo/lista-de-tipos-de-obras",
        columns: [
            {data: 'tipo_codigo'},
            {data: 'tipo_nombre'},
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
                'previous': 'Anterior'
            },
            "processing" : "procesando."
        },
    });

    $("#cerrar, #cerrarCruz").click(function(){
        $("#tipo").val("");
    });

    $("#cerrarMod, #cerrarCruzMod").click(function(){
        $("#tipoMod").val("");
        $("#tipoMod").attr("disabled", true);
        $("#agregarMod").attr("disabled", true);
        $('#tipoMod').css({'border':'1px solid #d2d6de'});
    });

    $("#cerrar, #cerrarCruz").click(function(){
        $("#tipo").val("");
        $('#tipo').css({'border':'1px solid #d2d6de'});
    });

    $(document).on("click","#editar",function(){

        var url = "tipo/busqueda-tipo/" + this.value;

        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        })
        .done(function(comp) {
            $("#dato").attr("value", comp.id);
            $("#tipoMod").attr("disabled", false);
            $("#agregarMod").attr("disabled", false);
            $("#tipoMod").val( comp.tipo_nombre );
        })
        .fail( function(){
            Swal.fire(
                'Hubo un error!',
                'al momento de realizar esta accion!',
                'error'
              )
        })





    });





    $("#agregar").click(function(){
        $("form").on("submit", function () {
            $("#agregar").attr("value", "Guardando, espere...");
            $("#agregar").prop("disabled", true);
        });
    });


    $('#tipoMod').keyup(function(){
        if ($('#tipoMod').val().length <= 2 || $('#tipoMod').val().length > 80) {
            $('#tipoMod').css({'border':'1px solid red'});
            $('#agregarMod').prop('disabled',true);
            return false;
        } else {
            $('#tipoMod').css({'border':'1px solid #d2d6de'});
            $('#agregarMod').prop('disabled',false);
        }
    });

    $('#tipo').keyup(function(){
        if ($('#tipo').val().length <= 2 || $('#tipo').val().length > 80) {
            $('#tipo').css({'border':'1px solid red'});
            $('#agregar').prop('disabled',true);
            return false;
        } else {
            $('#tipo').css({'border':'1px solid #d2d6de'});
            $('#agregar').prop('disabled',false);
        }
    });


    $('#agregarMod').click(function(){
        $("form").on("submit", function () {
            $("#agregarMod").attr("value", "Guardando, espere...");
            $("#agregarMod").prop("disabled", true);
        });
    });

    $(document).on("click", "#borrar", function(){
        Swal.fire({
            title: '¿Esta seguro',
            text: "que desea desactivar este tipo de obra?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, desactiva!',
            cancelButtonText: 'No por favor!'
          }).then((result) => {
            if (result.isConfirmed) {
                var id = $(this).val();
                var url = "tipo/deshabilitando/"+ id;

                $.ajax({
                    url: url,
                    type: 'get',
                    dataType: 'json',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                })
                .done(function(comp) {
                    console.log("SI: " + comp )
                    if(comp == true){
                        $('#listaTipo').DataTable().ajax.reload();
                        success();
                    } else {
                        error();
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

    function success()
    {
        Swal.fire(
            'Solicitud procesada!',
            'Se ha cargado la información satisfactoriamente!',
            'success'
          )
    }

    function error(){
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
          })

          Toast.fire({
            icon: 'error',
            title: 'Hubo un problema'
          })
    }


});
