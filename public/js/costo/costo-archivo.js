$(document).ready(function(){

    $('#tipo').val("0");
    datosObra(0);

    $('#numero').html("-----------");
    $('#cliente').html("-----------");
    $('#nombre').html("-----------");
    $('#total').html("-----------");
    $('#fecha').html("-----------");
    $('#gasto1').html("--");
    $('#ganancia1').html("--");
    $('#porGan').html("-- % ganancia");
    $('#porGas').html("-- % gastos");
    listadoObra(0);
    $('#estadistic').attr('disabled', true);

    $('#tipo').select2({
        theme: 'bootstrap4'
    });

    $(document).on('change', '#tipo', function(){
        if ( this.value == "0" ) {
            $('#numero').html("-----------");
            $('#cliente').html("-----------");
            $('#nombre').html("-----------");
            $('#total').html("-----------");
            $('#fecha').html("-----------");
            $('#anticipo').html("--");
            $('#gasto1').html("--");
            $('#ganancia1').html("--");
            $('#porGan').html("-- % ganancia");
            $('#porGas').html("-- % gastos");
            $('#chartdiv').empty();
            $('#estadistic').attr('disabled', true);
            listadoObra(0);

            return false
        } else {
            datosObra( this.value );
            calculo( this.value );
            listadoObra( this.value );

            // $('#estadistic').attr('disabled', false);
        }

    });

    function datosObra(a){

        limpiar();

        $.ajax({
            type: "post",
            url: "../../control-de-obras/consultar-dato-obra",
            data: {id: a},
            dataType: "json",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (comp) {

                $('#numero').html(comp.obra_codigo);
                $('#cliente').html(comp.cliente_nombre);
                $('#nombre').html(comp.obra_nombre);
                $('#total').html(comp.obra_monto);
                $('#fecha').html(comp.obra_fechainicio);
                $('#anticipo').html(comp.obra_anticipo);

            }
        });
    }

    function limpiar(){
        $('#numero').empty();
        $('#cliente').empty();
        $('#nombre').empty();
        $('#total').empty();
        $('#fecha').empty();
        $('#fecha').empty();
        $('#anticipo').empty();
    }


    function listadoObra(b){
        limpiar();

        // $.ajax({
        //     type: "post",
        //     url: "../../solicitud/calculo-solicitudes",
        //     data: {id: b},
        //     dataType: "json",
        //     headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        //     success: function (response) {
        //         if(response.monto_gasto){
        //             $('#estadistic').attr('disabled', false);
        //         } else {
        //             $('#estadistic').attr('disabled', true);
        //         }
        //     }
        // });

        if ($('#tipo').val() == "0") {
            $('#estadistic').attr('disabled', true);
        } 
        $('#listasolicitudesGastos').DataTable({
            serverSide: true,
            processing: true,
            ajax: "../obra-seleccionada/" + b,
            columns: [
                {data: 'solicitud_numerocontrol'},
                {data: 'solicitud_motivo'},
                {data: 'pago_monto'},
                {data: 'solicitud_fecha'},
                {data: 'nombre_usuario'}
            ],
            order: [
                [0, "desc"]
              ],
            bLengthChange: false,
            searching: true,
            responsive: true,
            autoWidth: false,
            info: false,
            bDestroy: true,
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
        });

    }

    function calculo(c){

        $.ajax({
            type: "post",
            url: "../../solicitud/calculo-solicitudes",
            data: {id: c},
            dataType: "json",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (comp1) {

                if(comp1.monto_gasto > 1){
                    $('#estadistic').attr('disabled', false);
                } else {
                    $('#estadistic').attr('disabled', true);
                }

                if(comp1.monto_gasto){
                    $('#gasto1').html(comp1.monto_gasto);
                    if ( Number(comp1.resta) >= 1 ) {
                        $('#ganancia1').html(comp1.resta).css('color', '##303438');
                    } else {
                        $('#ganancia1').html(comp1.resta).css('color', 'red');
                    }

                    var porc = Number(comp1.por_ganancia);
                    porcentaje_ganancia = porc.toFixed(2);
                    var porcGas = Number(comp1.por_gasto);
                    porcentaje_gasto = porcGas.toFixed(2);

                    if ( Number(porcentaje_ganancia) > 0 ) {
                        $('#porGan').html(porcentaje_ganancia + "% ganancia").css('color', '##303438');
                    } else {
                        $('#porGan').html(porcentaje_ganancia + "% perdida").css('color', 'red');
                    }
                    $('#porGas').html(porcentaje_gasto + "% gastos");
                } else {
                    $('#gasto1').html("0");
                    $('#ganancia1').html("0");
                    $('#porGan').html("0.00% ganancia");
                    $('#porGas').html("0.00% gastos");
                }

            }
        });
    }







});
