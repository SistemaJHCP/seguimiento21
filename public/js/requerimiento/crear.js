$(document).ready(function(){

$("#fechaE").datepicker({
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

    //Initialize Select2 Elements
    $('.select2').select2({
      theme: 'bootstrap4'
    });

    $('.select3').select2({
        theme: 'bootstrap4'
    });

    $('#conceptoDescrip').select2({
        theme: 'bootstrap4'
    });

    $('#tipo').change(function(){
        if ( $('#tipo').val() == "") {
            return false;
        }
        $.ajax({
            url: "tipo-solicitud/"+ $('#tipo').val() +"/987yuisjihu8u7t6rstfyuiijshugytfrs5t6",
            type: 'GET',
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        })
        .done(function(comp) {

            $('#selectReq').attr('disabled', true);
            var html = '<option value="">Seleccione...</option>';

            if ($('#tipo').val() === 'Material') {
                for (let i = 0; i < comp.length; i++) {
                    html += '<option value="' + comp[i].id + '">'+ comp[i].material_nombre +'</option>';
                }
            }else{
                if ($('#tipo').val() === 'Servicio') {
                    for (let i = 0; i < comp.length; i++) {
                        html += '<option value="' + comp[i].id + '">'+ comp[i].servicio_nombre +'</option>';
                    }
                } else {

                    for (let i = 0; i < comp.length; i++) {
                        html += '<option value="' + comp[i].id + '">'+ comp[i].viatico_nombre +'</option>';
                    }
                }
            }

            $('#concepto').html(html);
            $('#selectReq').attr('disabled', false);

        })
        .fail( function(){
            Swal.fire(
                'Hubo un error!',
                'en la lectura del código!',
                'error'
              )
        })
    });


    $('#proveedorRec').change(function(){
        if ( $('#proveedorRec').val() == "") {
            return false;
        }

        $.ajax({
            url: 'consultar-proveedor/987yuiokkjhgy8u9i9876edght' + $('#proveedorRec').val(),
            type: 'GET',
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        })
        .done(function(comp) {
            console.log( comp );

            let html = '';

            html += '<div class="callout callout-info">' +
                        '<h5>Código de proveedor: ' + comp.proveedor_codigo + '</h5>'+
                        '<b>Tipo: </b>' + comp.proveedor_tipo + '<br>'+
                        '<b>CI o Rif: </b>' + comp.proveedor_rif + '<br>'+
                        '<b>Nombre:</b>' + comp.proveedor_nombre + '<br>'+
                        '<b>Correo: </b>' + comp.proveedor_correo + '<br>'+
                        '<b>Teléfono: </b> '+ comp.proveedor_telefono +
                    '</div>';

            $('#proovedorRelacionado').html(html);

        })
        .fail( function(){
            Swal.fire(
                'Hubo un error!',
                'al momento de realizar esta accion!',
                'error'
              )
        })

    });


    $('#obraRel').change(function(){
        if ( $('#obraRel').val() == "") {
            return false;
        }

        $.ajax({
            url: 'consultar-obra/vhbjihugvcf5678uishugfdrstfyg8t7stc' + $('#obraRel').val(),
            type: 'GET',
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        })
        .done(function(comp) {
            console.log( comp )

            let html2 = '';

            html2 += '<div class="callout callout-info">' +
                        '<h5>Código de Obra: '+ comp.obra_codigo +'</h5>' +
                        '<b>Nombre: </b> '+ comp.obra_nombre +' <br>' +
                        '<b>Fecha inicio: </b> '+ comp.obra_codigo +' <br>' +
                        '<b>Fecha fín:</b> '+ comp.obra_codigo +' <br>' +
                        '<b>Residente: </b> '+ comp.obra_codigo +' <br>' +
                        '<b>Coordinador: </b> '+ comp.obra_codigo +' <br>' +
                        '<b>Observación: </b> '+ comp.obra_codigo +' <br>' +
                     '</div>'

            $('#obraRelacionada').html(html2);

        })
        .fail( function(){
            Swal.fire(
                'Hubo un error!',
                'al momento de realizar esta accion!',
                'error'
              )
        })


    });





});
