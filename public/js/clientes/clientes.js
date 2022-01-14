$(document).ready(function(){

    $("#codigo").numeric(false);
    $("#telefono").numeric(false);

    $('#listaClientes').DataTable({
        serverSide:true,
        processing: true,
        ajax: "cliente/lista-de-clientes",
        columns: [
            {data: 'cliente_codigo'},
            {data: 'cliente_rif'},
            {data: 'cliente_nombre'},
            {data: 'btn'}
        ],
        order: [
            [1, "desc"]
          ],
        bLengthChange: false,
        searching: true,
        "order": [[ 3, "desc" ]],
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

    $("#codigo").keyup(function(){
        if ($('#codigo').val().length <= 5 || $('#codigo').val().length > 10) {
            $('#codigo').css({'border':'1px solid red'});
            $('#cargarCliente').prop('disabled',true);
            activarBoton();
            return false;
        } else {
            $('#codigo').css({'border':'1px solid #d2d6de'});
            activarBoton();
        }
    });

    $("#nombre").keyup(function(){
        if ($('#nombre').val().length <= 3 || $('#nombre').val().length > 51) {
            $('#nombre').css({'border':'1px solid red'});
            $('#cargarCliente').prop('disabled',true);
            activarBoton();
            return false;
        } else {
            $('#nombre').css({'border':'1px solid #d2d6de'});
            activarBoton();
        }
    });


    $("#telefono").keyup(function(){
        if ($('#telefono').val().length <= 6 || $('#telefono').val().length > 14) {
            $('#telefono').css({'border':'1px solid red'});
            $('#cargarCliente').prop('disabled',true);
            activarBoton();
            return false;
        } else {
            $('#telefono').css({'border':'1px solid #d2d6de'});
            activarBoton();
        }
    });

    $("#direccion").keyup(function(){
        if ($('#direccion').val().length <= 6 || $('#direccion').val().length > 190) {
            $('#direccion').css({'border':'1px solid red'});
            $('#cargarCliente').prop('disabled',true);
            activarBoton();
            return false;
        } else {
            $('#direccion').css({'border':'1px solid #d2d6de'});
            activarBoton();
        }
    });

    $("#correo").keyup(function(){
        if ($('#correo').val().length <= 6 || $('#correo').val().length > 41) {
            $('#correo').css({'border':'1px solid red'});
            $('#cargarCliente').prop('disabled',true);
            activarBoton();
            return false;
        } else {
            $('#correo').css({'border':'1px solid #d2d6de'});
            activarBoton();
        }
    });


    // function key(){
    //     iff();
    // }

    // function iff(){
    //     if ($('#correo').val().length <= 1) {
    //         console.log("qqqq");
    //         $('#correo').css({'border':'1px solid red'});
    //         $('#cargarCliente').prop('disabled',true);
    //         activarBoton();
    //         return false;
    //     } else {
    //         console.log("rrrrr");
    //         $('#correo').css({'border':'1px solid #d2d6de'});
    //         $('#cargarCliente').prop('disabled',false);
    //         activarBoton();
    //     }
    // }

    function activarBoton(){
        if($('#codigo').val().length > 1 && $('#nombre').val().length > 1 && $('#telefono').val().length > 1 && $('#direccion').val().length > 1 && $('#correo').val().length > 1 ){
            $('#cargarCliente').prop('disabled',false);
        } else {
            $('#cargarCliente').prop('disabled',true);
        }
    };

    $("#cargarCliente").click(function(){
        $("form").on("submit", function () {
            $("#cargarCliente").attr("value", "Guardando, espere...");
            $("#cargarCliente").prop("disabled", true);
        });
    });


    $(document).on("click", "#desactivar", function(){
        Swal.fire({
            title: '¿Esta seguro',
            text: "que desea desactivar a este cliente?!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, desactiva!',
            cancelButtonText: 'No por favor!'
          }).then((result) => {
            if (result.isConfirmed) {
                var id = $(this).val();
                var url = "cliente/deshabilitando/"+ id;

                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'json',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                })
                .done(function(comp) {
                    console.log("SI: " + comp )
                    if(comp == true){
                        $('#listaClientes').DataTable().ajax.reload();
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


    $("#cerrar").on("click", function(){
        $("#codigo").val("");
        $('#codigo').css({'border':'1px solid #d2d6de'});
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

    function errorCaracteres(){
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
            title: 'faltan caracteres, o tiene campos vacios'
          })
    }


});
