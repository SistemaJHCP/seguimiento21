$(document).ready(function(){

    limpiar();
    $('#num_cuenta').numeric("2");
    $('#monto_inicial').numeric();

    $('#listaEmpresa').DataTable({
        serverSide:false,
        processing: true,
        ajax: "cuentas/listado-bancos-empresa",
        columns: [
            {data: 'cuenta_tipo'},
            {data: 'cuenta_numero'},
            {data: 'cuenta_montoinicial'},
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
            { "width": "22%", "targets": 4 }
          ],
    });

    $(document).on("click", "#deshabilitar", function(){
        alert("eliminar " + this.value);
    });

    $(document).on("click", "#modificarCuent", function(){
        $("form").on("submit", function () {
            $("#modificarCuent").attr("value", "Guardando, espere...");
            $("#modificarCuent").attr("disabled", true);
        });
    });

    $('#cerrarCuenta, #cerrarCuentaMod').click(function(){
        limpiar();
    });


    $(document).on("click", "#modificar", function(){

        limpiar();

        $.ajax({
            url: "cuentas/mostrar-modificacion",
            type: 'POST',
            dataType: 'json',
            data: {valor: this.value},
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        })
        .done(function(comp) {

            $("#tipo_cuenta_MOD").attr("disabled", false);
            $("#num_cuenta_MOD").attr("disabled", false);
            $("#monto_inicial_MOD").attr("disabled", false);
            $("#nombre_banco_MOD").attr("disabled", false);

            $("#tipo_cuenta_MOD").val( comp.cuenta_tipo );
            $("#num_cuenta_MOD").val( comp.cuenta_numero );
            $("#monto_inicial_MOD").val( comp.cuenta_montoinicial );
            $("#nombre_banco_MOD").val( comp.banco_id );
            $("#dato").val( comp.id );

        })
        .fail( function(){
            console.log("Hubo un error en el ajax de mostra el suministro para modificarlo");
        });

    });

    $("#cargar").click(function(){
        $("form").on("submit", function () {
            $("#cargar").attr("value", "Guardando, espere...");
            $("#cargar").attr("disabled", true);
        });
    });

    function limpiar(){
        $("#tipo_cuenta").val("");
        $("#num_cuenta").val("");
        $("#monto_inicial").val("");
        $("#nombre_banco").val("");

        $("#tipo_cuenta_MOD").val("");
        $("#num_cuenta_MOD").val("");
        $("#monto_inicial_MOD").val("");
        $("#nombre_banco_MOD").val("");

        $("#tipo_cuenta_MOD").attr("disabled", true);
        $("#num_cuenta_MOD").attr("disabled", true);
        $("#monto_inicial_MOD").attr("disabled", true);
        $("#nombre_banco_MOD").attr("disabled", true);
    }

});
