$(document).ready(function(){

    $('#tipo').val("0");
    datosObra(0);
    $('#numero').html("-----------");
    $('#cliente').html("-----------");
    $('#nombre').html("-----------");
    $('#total').html("-----------");
    $('#fecha').html("-----------");

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
            return false
        } else {
            datosObra( this.value );
            calculo( this.value );
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

            }
        });
    }

    function limpiar(){
        $('#numero').empty();
        $('#cliente').empty();
        $('#nombre').empty();
        $('#total').empty();
        $('#fecha').empty();
    }


    function listadoObra(b){

        $('#listaObras').DataTable({
            serverSide:true,
            processing: true,
            ajax: "obra-seleccionada/" + b,
            columns: [
                {data: 'solicitud_numerocontrol'},
                {data: 'solicitud_motivo'},
                {data: 'pago_monto'},
                {data: 'moneda'},
                {data: 'usuario'}
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
        });

    }

    function calculo(c){
        $.ajax({
            type: "post",
            url: "../../solicitud/calculo-solicitudes",
            data: {id: c},
            dataType: "json",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (comp) {
                console.log(comp);
            }
        });
    }

});
