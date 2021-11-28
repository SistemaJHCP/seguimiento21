$(document).ready(function(){

    //limpiar();
    $("#cedula").numeric(false);
    $("#telefono").numeric(false);

    $('#listaProveedores').DataTable({
        serverSide:true,
        processing: true,
        ajax: "proveedores/lista-proveedores",
        columns: [
            {data: 'codigo'},
            {data: 'tipo'},
            {data: 'rif'},
            {data: 'nombre'},
            {data: 'tlf'},
            {data: 'correo'},
            {data: 'contacto'},
            {data: 'suministro'},
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
                'previous': 'Anteror'
            },
            "processing" : "procesando."
        },
    });

    $("#cedula").on("keyup", function(){
        if ( $("#cedula").val().length < 6 ) {
            $("#cedula").css({'border':'1px solid red'});
            activarBoton();
        } else {
            $("#cedula").css({'border':'1px solid #e3e6ea'});
            activarBoton();
        }
    });

    $("#nombre").on("keyup", function(){
        if ( $("#nombre").val().length < 6 ) {
            $("#nombre").css({'border':'1px solid red'});
            activarBoton();
        } else {
            $("#nombre").css({'border':'1px solid #e3e6ea'});
            activarBoton();
        }
    });

    $("#telefono").on("keyup", function(){
        if ( $("#telefono").val().length < 6 ) {
            $("#telefono").css({'border':'1px solid red'});
            activarBoton();
        } else {
            $("#telefono").css({'border':'1px solid #e3e6ea'});
            activarBoton();
        }
    });

    $("#direccion").on("keyup", function(){
        if ( $("#direccion").val().length < 6 ) {
            $("#direccion").css({'border':'1px solid red'});
            activarBoton();
        } else {
            $("#direccion").css({'border':'1px solid #e3e6ea'});
            activarBoton();
        }
    });

    $("#email").on("keyup", function(){
        if ( $("#email").val().length < 6 ) {
            $("#email").css({'border':'1px solid red'});
            activarBoton();
        } else {
            $("#email").css({'border':'1px solid #e3e6ea'});
            activarBoton();
        }
    });

    $("#contacto").on("keyup", function(){
        if ( $("#contacto").val().length < 6 ) {
            $("#contacto").css({'border':'1px solid red'});
            activarBoton();
        } else {
            $("#contacto").css({'border':'1px solid #e3e6ea'});
            activarBoton();
        }
    });

    function activarBoton(){
        if( $("#cedula").val().length > 1 &&  $("#nombre").val().length > 1 && $("#telefono").val().length > 1 && $("#direccion").val().length > 1 && $("#email").val().length > 1 && $("#contacto").val().length > 1 ){
            $('#crear').prop('disabled',false);
        } else {
            $('#crear').prop('disabled',true);
        }
    }

    function limpiar()
    {
        $("#cedula").val("");
        $("#nombre").val("");
        $("#suministro").val("");
        $("#telefono").val("");
        $("#direccion").val("");
        $("#email").val("");
        $("#contacto").val("");
    }





});
