

// cargarProveedor( $('#proveedorRec').val() );
// cargarObra( $('#obraRel927y2').val() );

// $('#proveedorRec').change(function(){
//     cargarProveedor( $('#proveedorRec').val() );
// });

    //Initialize Select2 Elements
    $('.select2').select2({
        theme: 'bootstrap4'
      });

      $('.select3').select2({
          theme: 'bootstrap4'
      });

      $('.select4').select2({
          theme: 'bootstrap4'
      });


function requisicionMaterial( valor ){

    $.ajax({
        url: "../tipo-solicitud/"+ valor +"/987yuisjihu8u7t6rstfyuiijshugytfrs5t6",
        type: 'GET',
        dataType: 'json',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    })
    .done(function(comp) {

        $('#selectRequis8ty').attr('disabled', true);
        var html = '<option value="" selected">Seleccione...</option>';

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

        $('.select4').html(html);
        $('#selectRequis8ty').attr('disabled', false);

    })
    .fail( function(){
        Swal.fire(
            'Hubo un error!',
            'en la lectura del código!',
            'error'
          )
    })

}


function listaMaterial( valor ){

    $.ajax({
        url: "consultar-materiales-guardados/6t7yhutgyuhy7t6" + valor,
        type: 'GET',
        dataType: 'json',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    })
    .done(function(comp) {
        console.log( comp );
        $("#table").append('<tr><td>' + comp.sd_cantidad + '</td><td>' + comp. + '</td>' + '<td>' + comp. + '</td>' + '<td>' + especificaciones + '</td>' );


    })
    .fail( function(){
        Swal.fire(
            'Hubo un error!',
            'en la lectura del código!',
            'error'
          )
    })

}





function cargarProveedor( valorPro ){
    $('#proovedorRelacionado').val("");
    $.ajax({
        url: '../consultar-proveedor/987yuiokkjhgy8u9i9876edght' + valorPro,
        type: 'GET',
        dataType: 'json',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    })
    .done(function(comp) {

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

}

function cargarObra( valorObra){

    $.ajax({
        url: '../consultar-obra/vhbjihugvcf5678uishugfdrstfyg8t7stc' + valorObra,
        type: 'GET',
        dataType: 'json',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    })
    .done(function(comp) {

        let html2 = '';

        html2 += '<div class="callout callout-info">' +
                    '<h5>Código de Obra: '+ comp.obra_codigo +'</h5>' +
                    '<b>Nombre: </b> '+ comp.obra_nombre +' <br>' +
                    '<b>Fecha inicio: </b> '+ comp.obra_fechainicio +' <br>' +
                    '<b>Fecha fín:</b> '+ comp.obra_fechafin +' <br>' +
                    '<b>Residente: </b> '+ comp.obra_residente +' <br>' +
                    '<b>Coordinador: </b> '+ comp.obra_coordinador +' <br>' +
                    '<b>Observación: </b> '+ comp.obra_observaciones +' <br>' +
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



}



