$(document).ready(function(){

    cargarListado("cuentas/solicitud-de-pago/" + 1);


    function cargarListado(url){

        $('#listaCuenta').DataTable({
            serverSide: false,
            processing: true,
            ajax: url,
            columns: [
                {data: 'solicitud_numerocontrol'},
                {data: 'fecha'},
                {data: 'obra_nombre'},
                {data: 'solicitud_motivo'},
                {data: 'solicitud_aprobacion'},
                {data: 'pago'},
                {data: 'nombre'},
                {data: 'btn'}
            ],
            order: [
                [1, "desc"]
              ],
            bLengthChange: false,
            searching: true,
            responsive: true,
            autoWidth: false,
            info: false,
            destroy: true,
            paging: true,
            searching: true,
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
            "columnDefs": [
                { "width": "6%", "targets": 7 }
              ],
        });

    }

    $(document).on('change', '.menu', function(){

        $('#listaCuenta > tbody').empty();

        if (this.value == 1) {
            url = "cuentas/solicitud-de-pago/" + 1;
            cargarListado(url);
        }

        if (this.value == 2) {
            url = "cuentas/solicitud-de-pago/" + 2;
            cargarListado(url);
        }

        if (this.value == 3) {
            url = "cuentas/solicitud-de-pago/" + 3;
            cargarListado(url);
        }

        if (this.value == 4) {
            url = "cuentas/solicitud-de-pago/" + 4;
            cargarListado(url);
        }

        if (this.value == 5) {
            url = "cuentas/solicitud-de-pago/" + 5;
            cargarListado(url);
        }

        if (this.value == 6) {
            url = "cuentas/solicitud-de-pago/" + 6;
            cargarListado(url);
        }

    });

    $(document).on('click', '.menu2', function(){

        if (this.value == 1) {
            $('#listaCuenta > tbody').empty();
            url = "cuentas/solicitud-de-pago/" + 1;
            cargarListado(url);
        }

        if (this.value == 2) {
            $('#listaCuenta > tbody').empty();
            url = "cuentas/solicitud-de-pago/" + 2;
            cargarListado(url);
        }

        if (this.value == 3) {
            $('#listaCuenta > tbody').empty();
            url = "cuentas/solicitud-de-pago/" + 3;
            cargarListado(url);
        }

        if (this.value == 4) {
            $('#listaCuenta > tbody').empty();
            url = "cuentas/solicitud-de-pago/" + 4;
            cargarListado(url);
        }

        if (this.value == 5) {
            $('#listaCuenta > tbody').empty();
            url = "cuentas/solicitud-de-pago/" + 5;
            cargarListado(url);
        }

        if (this.value == 6) {
            $('#listaCuenta > tbody').empty();
            url = "cuentas/solicitud-de-pago/" + 6;
            cargarListado(url);
        }

    });


});
