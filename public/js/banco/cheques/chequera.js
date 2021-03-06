$(document).ready(function(){

    $("#nroCheque").numeric();
    limpiar();

    $("#fechaE, #fechaEMod").datepicker({
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

    $(document).on('click', '#modCheq', function(){

        $('#fechaEMod').val("");
        $('#nroChequeMod').val("");
        $('#correlativoMod').val("");
        $('#fechaEMod').attr('disabled', true);
        $('#nroChequeMod').attr('disabled', true);
        $('#correlativoMod').attr('disabled', true);

        $.ajax({
            type: "get",
            url: "modificar/9yedide7t6tfgihe/" + this.value,
            dataType: "json",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (comp) {
                $('#fechaEMod').attr('disabled', false);
                // $('#nroChequeMod').attr('disabled', false);
                $('#correlativoMod').attr('disabled', false);
                $('#fechaEMod').val( comp.chequera_fecha );
                $('#nroChequeMod').val( comp.chequera_cantidadcheque );
                $('#correlativoMod').val( comp.chequera_correlativo );
                $('#id').val( comp.id );
                $('#modificaChequera').attr('disabled', false);

            },error: function(){
                alert("Error al momento de cargar los datos del archivo a modificar");
            }
        });
    });

    $(document).on('click', '#cerrar, #cerrar2', function(){
        limpiar();
    });

    $('#cargarChequera').on('click', function(){
        $("form").on("submit", function () {
            $("#cargarChequera").attr("value", "Guardando, espere...");
            $("#cargarChequera").attr("disabled", true);
        });
    });

    $('#modificaChequera').on('click', function(){
        $("form").on("submit", function () {
            $("#modificaChequera").attr("value", "Guardando, espere...");
            $("#modificaChequera").attr("disabled", true);
        });
    });


    function limpiar(){
        $('#fechaE').val("");
        $('#nroCheque').val("");
        $('#correlativo').val("");
        $('#fechaEMod').val("");
        $('#nroChequeMod').val("");
        $('#correlativoMod').val("");
        $('#fechaEMod').attr('disabled', true);
        $('#nroChequeMod').attr('disabled', true);
        $('#correlativoMod').attr('disabled', true);
        $('#id').val("");
        $('#modificaChequera').attr('disabled', true);
    }


});

$(document).on('click', '#desactivar', function(){

    Swal.fire({
        title: '¿Esta seguro',
        text: "de querer deshabilitar esta chequera?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, deshabilita!',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                type: "post",
                url: "desactivar/98uyuikjhui9uygvg2yui98uywghuis",
                data: {id: this.value},
                dataType: "json",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (comp) {
                    if (comp) {
                        $('#listaChequeras').DataTable().ajax.reload();
                        Swal.fire(
                            'Desactivado!',
                            'Se ha desactivado la chequera.',
                            'success'
                        );
                    } else {
                        Swal.fire(
                            'Hubo un error!',
                            'Hubo un problema al momento de realizar la solicitud.',
                            'success'
                        );
                    }
                }, error: function() {
                    Swal.fire(
                        'Hubo un error!',
                        'Hubo un problema al momento de realizar esta consulta.',
                        'success'
                    );
                }
            });







        }
      })

});

function listar(a){

    $('#listaChequeras').DataTable({
        serverSide: false,
        processing: true,
        ajax: "lista-chequera/" + a,
        columns: [
            {data: 'chequera_codigo'},
            {data: 'fecha'},
            {data: 'chequera_cantidadcheque'},
            {data: 'chequera_correlativo'},
            {data: 'emitido'},
            {data: 'anulado'},
            {data: 'btn'}
        ],
        order: [
            [6, "DESC"]
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
            { "width": "17%", "targets": 6 }
          ],
    });
}
