$(document).ready(function(){

    $(function () {


    $('#listaUsuarios').DataTable({
        serverSide:true,
        processing: true,
        ajax: "usuario/lista-de-usuarios",
        columns: [
            {data: 'user_login'},
            {data: 'email'},
            {data: 'btn'}
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

    });


    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
    });

    $("#nameUser").keyup( function(){
        if ($('#nameUser').val().length <= 2 || $('#nameUser').val().length > 50) {
            $('#nameUser').css({'border':'1px solid red'});
            activarBoton();
            return false;
        } else {
            $('#nameUser').css({'border':'1px solid #d2d6de'});
            activarBoton();
        }
    });

    $("#complete_name").keyup( function(){
        if ($('#complete_name').val().length <= 2 || $('#complete_name').val().length > 50) {
            $('#complete_name').css({'border':'1px solid red'});
            activarBoton();
            return false;
        } else {
            $('#complete_name').css({'border':'1px solid #d2d6de'});
            activarBoton();
        }
    });

    $("#email").keyup( function(){
        if ($('#email').val().length <= 5 || $('#email').val().length > 50) {
            $('#email').css({'border':'1px solid red'});
            $('#cargar').prop('disabled',true);
            activarBoton();
            return false;
        } else {
            $('#email').css({'border':'1px solid #d2d6de'});
            activarBoton();
        }
    });

    $("#password").keyup( function(){
        if ($('#password').val().length <= 5 || $('#password').val().length > 50) {
            $('#password').css({'border':'1px solid red'});
            $('#cargar').prop('disabled',true);
            activarBoton();
            return false;
        } else {
            $('#password').css({'border':'1px solid #d2d6de'});
            activarBoton();
        }
    });

    $("#password2").keyup( function(){

        if($('#password').val() != $('#password2').val()){
            $('#cargar').prop('disabled',true);
            activarBoton();
            return false;
        }

        if ($('#password2').val().length < 5 || $('#password2').val().length > 50) {
            $('#password2').css({'border':'1px solid red'});
            $('#cargar').prop('disabled',true);
            activarBoton();
            return false;
        } else {
            $('#password2').css({'border':'1px solid #d2d6de'});
            activarBoton();
        }
    });

    $("#levelAccess").on("change", function(){


        if($('#levelAccess').val() == ""){
            alert("La seleccion no puede estar vacia")
            $('#cargar').prop('disabled',true);
            activarBoton();
            return false;
        } else {
            // $('#cargar').prop('disabled',false);
            $('#levelAccess').css({'border':'1px solid #d2d6de'});
            activarBoton();
        }

    });

    $("#cargar").click(function(){
        $("form").on("submit", function () {
            $("#cargar").attr("value", "Guardando, espere...");
            $(this).find(":submit").prop("disabled", true);
        });
    });

    function activarBoton(){
        if($('#nameUser').val().length > 3 && $('#complete_name').val().length > 3 && $('#email').val().length > 6 && $('#password').val().length > 6 && $('#levelAccess').val() != ""){
            $('#cargar').prop('disabled',false);
            console.log("cargo en positivo")
        } else {
            $('#cargar').prop('disabled',true);
            console.log("cargo en negativo")
        }
    };

    $(document).on("click", "cerrar2", function(){
        $("#guia").val("");
        $("#nameUser2").val("");
        $("#complete_name2").val("");
        $("#email2").val("");
        $("#password22").val("");
        $("#levelAccess2").val("");
    });

    $(document).on('click',"#modId", function(){

        $("#guia").val("");
        $("#nameUser2").val("");
        $("#complete_name2").val("");
        $("#email2").val("");
        $("#sexo2").val("");
        $("#password22").val("");
        $("#levelAccess2").val("").attr("selected", "selected");


        var id = this.value;

        var url = "usuario/modificarUsuario/sef1scxg"+id+"3oscos425ddf23sdnp"

        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        })
        .done(function(comp) {

            $("#guia").val(comp[0].id);
            $("#nameUser2").val(comp[0].user_login);
            $("#complete_name2").val(comp[0].user_name);
            $("#sexo2").val(comp[0].sexo);
            $("#email2").val(comp[0].email);
            $("#password22").val("");
            $("#levelAccess2").val(comp[0].permiso_id).attr("selected", "selected");
        })
        .fail( function(){
            console.log("fallo el ajax del #modId");
        })

    });

    $(document).on('click', "#modificar", function(){
        if($('#nameUser2').val().length > 1 && $('#complete_name2').val().length > 1 && $('#email2').val().length > 1 && $('#password22').val().length > 1 && $('#levelAccess2').val() == ""){
            alert("No puede dejar campos vacios");
            return false;
        }
    });



//---------------------------------------------------------------------------------------

    $("#nameUser2").keyup( function(){
        if ($('#nameUser2').val().length <= 2 || $('#nameUser2').val().length > 50) {
            $('#nameUser2').css({'border':'1px solid red'});
            return false;
        } else {
            $('#nameUser2').css({'border':'1px solid #d2d6de'});
            activarBoton2();
        }
    });

    $("#complete_name2").keyup( function(){
        if ($('#complete_name2').val().length <= 2 || $('#complete_name2').val().length > 50) {
            $('#complete_name2').css({'border':'1px solid red'});
            activarBoton2();
            return false;
        } else {
            $('#complete_name2').css({'border':'1px solid #d2d6de'});
            activarBoton2();
        }
    });

    $("#modificar").click(function(){
        $("form").on("submit", function () {
            $("#cargar").attr("value", "Guardando, espere...");
            $(this).find(":submit").prop("disabled", true);
        });
    });

    $("#password22").keyup( function(){

        if ($('#password22').val().length < 5 || $('#password22').val().length > 50) {
            $('#password22').css({'border':'1px solid red'});
            $('#modificar').prop('disabled',true);
            activarBoton2();
            return false;
        } else {
            $('#password22').css({'border':'1px solid #d2d6de'});
            $('#modificar').prop('disabled',false);
            activarBoton2();
        }
    });

    $("#password222").keyup( function(){

        if ($('#password22').val() != $('#password222').val()) {
            $('#modificar').prop('disabled',true);
        } else {
            $('#modificar').prop('disabled',false);
        }



        if ($('#password222').val().length < 5 || $('#password222').val().length > 50) {
            $('#password222').css({'border':'1px solid red'});
            $('#modificar').prop('disabled',true);
            activarBoton2();
            return false;
        } else {
            $('#password222').css({'border':'1px solid #d2d6de'});
        }
    });



    $(document).on("click", "#desactivar", function(){
        Swal.fire({
            title: '¿Seguro desea desactivar',
            text: "a este usuario del sistema?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Desactivar!',
            cancelButtonText: 'Cancelar'
          }).then((result) => {
            if (result.value) {
                var id = $(this).val();
                var url = "usuario/eliminarUsuario/8yg28yb2728"+id+"282"

                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'json',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                })
                .done(function(comp) {
                    console.log("SI: " + comp )
                    if(comp == true){
                        $('#listaUsuarios').DataTable().ajax.reload();
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

    function activarBoton2(){
        if($('#nameUser2').val().length > 3 && $('#password22').val().length > 3 && $('#complete_name2').val().length > 2 && $('#password222').val().length > 5 ){
            $('#modificar').prop('disabled',false);
        } else {
            $('#modificar').prop('disabled',true);
        }
    };

    function success()
    {
        Swal.fire(
            'Solicitud procesada!',
            'Se ha desactivado al usuario satisfactoriamente!',
            'success'
          )
    }

    function error(){
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 6000,
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

    function errorCaracteres(){
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 6000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
          })

          Toast.fire({
            icon: 'error',
            title: 'faltan caracteres, o tiene campos vacios'
          })
    }

});
