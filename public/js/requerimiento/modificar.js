$("#cantidad").numeric();

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
        url: "consultar-materiales-guardados/6t7yhutgyuhy7t6" + valor + '/' + $("#tipo").val(),
        type: 'GET',
        dataType: 'json',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    })
    .done(function(comp) {

        if (comp[1] === "Material") {
            for (let i = 0; i < comp[0].length; i++) {
                $("#table").append('<tr><td>' + comp[0][i].sd_cantidad + '</td><td>' + comp[0][i].material_nombre + '</td>' + '<td>' + comp[0][i].sd_caracteristicas + '</td>' + '<td><i class="fas fa-trash-alt" id="elemento" value="'+ comp[0][i].id +'"></i></td>' );
            }
        }

        if (comp[1] === "Servicio") {
            for (let i = 0; i < comp[0].length; i++) {
                $("#table").append('<tr><td>' + comp[0][i].sd_cantidad + '</td><td>' + comp[0][i].servicio_nombre + '</td>' + '<td>' + comp[0][i].sd_caracteristicas + '</td>' + '<td><i class="fas fa-trash-alt" id="elemento" value="'+ comp[0][i].id +'"></i></td>' );
            }
        }

        if (comp[1] === "Viatico") {

            for (let i = 0; i < comp[0].length; i++) {
                $("#table").append('<tr><td>' + comp[0][i].sd_cantidad + '</td><td>' + comp[0][i].viatico_nombre + '</td>' + '<td>' + comp[0][i].sd_caracteristicas + '</td>' + '<td><i class="fas fa-trash-alt" id="elemento" value="'+ comp[0][i].id +'"></i></td>' );
            }
        }
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

$('#obraRel927y2').change(function(){
    consultarObra( $('#obraRel927y2').val() );
});



function consultarObra( valorObra ){

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




    // $('#proveedorRec').change(function(){
    //     if ( $('#proveedorRec').val() == "") {
    //         return false;
    //     }

    //     proveedorRecomendado( $('#proveedorRec').val() );

    // });


    // function proveedorRecomendado( valor ) {
    //     $.ajax({
    //         url: '../consultar-proveedor/987yuiokkjhgy8u9i9876edght' + valor,
    //         type: 'GET',
    //         dataType: 'json',
    //         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    //     })
    //     .done(function(comp) {

    //         $('#proovedorRelacionado').empty();
    //         let html = '';

    //         html += '<div class="callout callout-info">' +
    //                     '<h5>Código de proveedor: ' + comp.proveedor_codigo + '</h5>'+
    //                     '<b>Tipo: </b>' + comp.proveedor_tipo + '<br>'+
    //                     '<b>CI o Rif: </b>' + comp.proveedor_rif + '<br>'+
    //                     '<b>Nombre:</b>' + comp.proveedor_nombre + '<br>'+
    //                     '<b>Correo: </b>' + comp.proveedor_correo + '<br>'+
    //                     '<b>Teléfono: </b> '+ comp.proveedor_telefono +
    //                 '</div>';

    //         $('#proovedorRelacionado').append(html);

    //     })
    //     .fail( function(){
    //         Swal.fire(
    //             'Hubo un error!',
    //             'al momento de realizar esta accion!',
    //             'error'
    //           )
    //     });
    // }




}

$('#agregarModificacion').click(function(){
    let cant = $('#cantidad').val();
    let concepto = $('.select4').val();
    let especificaciones = $('#especificaciones').val();
    let tipo = $('#tipo').val();
    let dato = $('#dato').val();

    $('#tipo').attr('disabled', true);
    $.ajax({
        url: '../modificar-nombre-concepto/x33ddwqfvhbjihugvcdcdf5678t7stc',
        type: 'post',
        dataType: 'json',
        data:{cantidad: cant, concepto: concepto, especificaciones:especificaciones, tipo:tipo,dato: dato},
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    })
    .done(function(comp) {

        if(comp){
            $("#table").append('<tr id="tabla' + tipo + concepto + '"><td>' + cant + '</td>' + '<td>' + comp[0] + '</td>' + '<td>' + especificaciones + '</td>' + '<td><i class="fas fa-trash-alt" id="elemento" value="'+ comp[1] +'"></i></td>' );
            $('#cargarRequisicion').attr('disabled', false);

        }

        $('#cantidad').val("");
        $('.select4').val("");
        $('#sel45').attr('selected', 'selected');
        $('#especificaciones').val("");
        $('#agregarModificacion').attr('disabled', true);

        listarMaterial( $('#tipo').val() );




    })
    .fail( function(){
        console.log("hay un error en la carga de solicitud de nombre de concepto")
    });


});

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

$(document).on("click", "#elemento", function(){

    $.ajax({
        url: "../../requisicion/eliminar-solicitud-de-material/" + $(this).attr('value'),
        type: 'GET',
        dataType: 'json',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    })
    .done(function(comp) {

        Swal.fire({
            title: '¿Esta seguro de eliminar?',
            text: "Esta acción, no se puede reversar",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, elimina!',
            cancelButtonText: 'Cancelar!'
          }).then((result) => {
            if (result.isConfirmed) {
              location.reload();
            }
          })

    })
    .fail( function(){
        console.log("fallo el ajax en el modulo de eliminar un material");
    })

});


$("#cargarRequisicion").click(function(){
    $("form").on("submit", function () {
        $("#cargarRequisicion").attr("value", "Guardando, espere...");
        $("#cargarRequisicion").prop("disabled", true);
    });
});




function listarMaterial( valor ){
    if ( $('#tipo').val() == "") {
        $('#selectRequis8ty').attr('disabled', true);
        return false;
    }
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


$('#cantidad').keyup(function(){
    cargarMateriales()
});

$('.select4').change(function(){
    cargarMateriales()
});

$('#especificaciones').keyup(function(){
    cargarMateriales()
});

function cargarMateriales(){
    if ( $('#cantidad').val().length >= 1 &&  $('.select4').val().length != "" &&  $('#especificaciones').val().length >= 3 ) {
        $('#agregarModificacion').attr('disabled', false);
    } else {
        $('#agregarModificacion').attr('disabled', true);
    }
}



