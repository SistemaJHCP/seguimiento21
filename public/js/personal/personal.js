$(document).ready(function(){

    limpiar();

    $('#listaPersonal').DataTable({
        serverSide:false,
        processing: true,
        ajax: "personal/lista-de-personal",
        columns: [
            {data: 'personal_codigo'},
            {data: 'personal_nombre'},
            {data: 'personal_profesion'},
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
        language: {
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
        columnDefs: [
            { "width": "20%", "targets": 3 }
          ],

    });

    $("#personal").keyup(function(){
        if ($('#personal').val().length <= 2 || $('#personal').val().length > 80) {
            $('#personal').css({'border':'1px solid red'});
            $('#agregar').prop('disabled',true);
            activarBoton();
            return false;
        } else {
            $('#personal').css({'border':'1px solid #d2d6de'});
            activarBoton();
        }
    });

    $("#profesion").change(function(){
        if ( $("#profesion").val() == "" ) {
            $('#agregar').prop('disabled',true);
        } else {
            activarBoton();
        }
    });

    function activarBoton(){
        if($('#personal').val().length > 1 && $('#profesion').val() != "" ){
            $('#agregar').prop('disabled',false);
        } else {
            $('#agregar').prop('disabled',true);
        }
    };

    function activarBotonMod(){
        if($('#personalMod').val().length > 1 && $('#profesionMod').val() != "" ){
            $('#agregarMod').prop('disabled',false);
        } else {
            $('#agregarMod').prop('disabled',true);
        }
    };


    function limpiar(){
        $('#personal').val("");
        $("#profesion").val("");
        $('#agregar').prop('disabled',true);
        $('#personal').css({'border':'1px solid #d2d6de'});
        $('#personalMod').val("");
        $("#profesionMod").val("");
        $('#agregarMod').prop('disabled',true);
        $('#personalMod').css({'border':'1px solid #d2d6de'});
    }

    $("#cerrar, #cerrarCruz").click(function(){
        limpiar();
    });


    $("#agregar").click(function(){
        $("form").on("submit", function () {
            $("#agregar").attr("value", "Guardando, espere...");
            $("#agregar").prop("disabled", true);
        });
    });


    $(document).on("click", "#modificar",function(){

        let url = "personal/modificar/y89onjhehy89" + this.value;

        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        })
        .done(function(comp) {
            $("#personalMod").val( comp.personal_nombre ).attr('disabled', false);
            $("#profesionMod").val( comp.personal_profesion ).attr('disabled', false);
            $("#dato").val( comp.id );
            $("#agregarMod").prop("disabled", false);
        })
        .fail( function(){
            Swal.fire(
                'Hubo un error!',
                'al momento de realizar esta accion!',
                'error'
              )
        })

    });


    $("#cerrarMod, #cerrarCruzMod").click(function(){
        $("#personalMod").attr('disabled', true);
        $("#profesionMod").attr('disabled', true);
        limpiar();
    });

    $("#agregarMod").click(function(){
        $("form").on("submit", function () {
            $("#agregarMod").attr("value", "Guardando, espere...");
            $("#agregarMod").prop("disabled", true);
        });
    });

    $(document).on("click", "#desactivar", function(){
        Swal.fire({
            title: '¿Esta seguro',
            text: "que desea desactivar al personal?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, desactiva!',
            cancelButtonText: 'No por favor!'
          }).then((result) => {
            if (result.isConfirmed) {

                let url = "personal/eliminar-personal/" + this.value;

                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'json',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                })
                .done(function(comp) {
                    console.log("SI: " + comp )
                    if(comp == true){
                        $('#listaPersonal').DataTable().ajax.reload();
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



    $("#personalMod").keyup(function(){
        if ($('#personalMod').val().length <= 2 || $('#personalMod').val().length > 80) {
            $('#personalMod').css({'border':'1px solid red'});
            $('#agregarMod').prop('disabled',true);
            activarBotonMod();
            return false;
        } else {
            $('#personalMod').css({'border':'1px solid #d2d6de'});
            activarBotonMod();
        }
    });

    $("#profesionMod").change(function(){
        if ( $("#profesionMod").val() == "" ) {
            $('#agregarMod').prop('disabled',true);
        } else {
            activarBotonMod();
        }
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
