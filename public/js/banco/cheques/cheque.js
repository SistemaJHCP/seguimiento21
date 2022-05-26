$(document).ready(function(){

    $("#monto").numeric();
    limpiar();

    $(document).on('click', '#anular', function(){
        var id = this.attributes.value.nodeValue;
        var codigo = this.attributes.stork.nodeValue;
        Swal.fire({
            title: '¿Esta usted seguro',
            text: "de querer anular el cheque " + codigo + "?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, anular!',
            cancelButtonText: 'Cancelar'
          }).then((result) => {

            $.ajax({
                type: "post",
                url: "anular-cheque",
                data: {id: id},
                dataType: "json",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (comp) {
                    if (comp) {
                        $('#listaCheque').DataTable().ajax.reload();
                        Swal.fire(
                            'Solicitud',
                            'anulada.',
                            'success'
                        )

                    } else {
                        alert("Nop");
                    }

                },error: function(){
                    alert("Hubo un error");
                }
            });

        })

    });

    $("#fecha").datepicker({
        dateFormat: "yy-mm-dd",
        closeText: 'Cerrar',
        prevText: '< Ant',
        nextText: 'Sig >',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
        weekHeader: 'Sm'
    });



    $("#destinatario").keyup(function(){
        if($("#destinatario").val().length < 3){
            $("#destinatario").css({"border": "1px solid red"});
            $('#aprobar').attr('disabled', true);
        } else {
            $("#destinatario").css({"border": "1px solid #ced4da"});
            activarBoton();
        }
    });

    $("#monto").keyup(function(){
        if($("#monto").val().length < 2){
            $("#monto").css({"border": "1px solid red"});
            $('#aprobar').attr('disabled', true);
        } else {
            $("#monto").css({"border": "1px solid #ced4da"});
            activarBoton();
        }
    });

    $("#fecha").change(function(){
        if($("#fecha").val().length < 3){
            $("#fecha").css({"border": "1px solid red"});
            $('#aprobar').attr('disabled', true);
        } else {
            $("#fecha").css({"border": "1px solid #ced4da"});
            activarBoton();
        }
    });

    function activarBoton(){
        if ( $("#destinatario").val().length >= 3 && $("#monto").val().length >= 2 && $("#fecha").val().length >= 3 ) {
            $('#aprobar').attr('disabled',false);
        } else {
            $('#aprobar').attr('disabled',true);
        }
    }

    function limpiar(){
        $('#aprobar').attr('disabled', true);
        $("#destinatario").val("");
        $("#monto").val("");
        $("#fecha").val("");
    }

    $("#cerrar").click(function(){
        limpiar();
    });

    $('#aprobar').on('click', function(){
        $("form").on("submit", function () {
            $("#aprobar").attr("value", "Guardando, espere...");
            $("#aprobar").attr("disabled", true);
        });
    });

});




function listar(a){

    $('#listaCheque').DataTable({
        serverSide: false,
        processing: true,
        ajax: "lista-cheque/" + a,
        columns: [
            {data: 'cheque_codigo'},
            {data: 'cheque_monto'},
            {data: 'cheque_destinatario'},
            {data: 'cheque_fecha'},
            {data: 'chequera_codigo'},
            {data: 'btn2'},
            {data: 'btn'}
        ],
        order: [
            [0, "DESC"]
          ],
        bLengthChange: false,
        searching: true,
        responsive: true,
        autoWidth: false,
        info: false,
        language: {
            search: "Buscar: ",
            lengthMenu: "Display _MENU_ records per page",
            zeroRecords: "Lo que busca no esta en el registro",
            info: "Mostrando la página _PAGE_ of _PAGES_",
            infoEmpty: "No records available",
            infoFiltered: "(Filtrado de _MAX_ registros totales)",
            paginate:{
                next: 'Siguiente',
                previous: 'Anterior'
            },
            "processing" : "procesando."
        },
        columnDefs: [
            { "width": "12%", "targets": 6 },
            { "width": "8%", "targets": 5 }
        ],
    });
}
