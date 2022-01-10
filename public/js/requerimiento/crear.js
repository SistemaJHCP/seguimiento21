$(document).ready(function(){




limpiar();
$("#cantidad").numeric();
$("#selectRequis8ty").attr('disabled', true);

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

    $('#sugsbjhs98yu').select2({
        theme: 'bootstrap4'
    });

    $('#tipo').change(function(){
        if ( $('#tipo').val() == "") {
            $('#selectRequis8ty').attr('disabled', true);
            return false;
        }
        $.ajax({
            url: "tipo-solicitud/"+ $('#tipo').val() +"/987yuisjihu8u7t6rstfyuiijshugytfrs5t6",
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

            $('#sugsbjhs98yu').html(html);
            $('#selectRequis8ty').attr('disabled', false);

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


    $('#obraRel927y2').change(function(){
        if ( $('#obraRel927y2').val() == "") {
            return false;
        }

        $.ajax({
            url: 'consultar-obra/vhbjihugvcf5678uishugfdrstfyg8t7stc' + $('#obraRel927y2').val(),
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


    });


    function limpiar(){
        $("#tipo").val("");
        $("#fechaE").val("");
        $("#proveedorRec").val("");
        $("#obraRel927y2").val("");
        $("#direccion").val("");
        $("#cantidad").val("");
        $("#concrip").val("");
        $("#especificaciones").val("");
        $("#agregar").attr('disabled', true);
    }

    $('#cantidad').keyup(function(){
        cargarMateriales()
    });

    $('#concrip').keyup(function(){
        cargarMateriales()
    });

    $('#especificaciones').keyup(function(){
        cargarMateriales()
    });

    function cargarMateriales(){
        if ( $('#cantidad').val().length >= 1 &&  $('#sugsbjhs98yu').val().length >= 1 &&  $('#especificaciones').val().length >= 3 ) {
            $('#agregar').attr('disabled', false);
        } else {
            $('#agregar').attr('disabled', true);
        }
    }

    $("#agregar").on("click", function(){
        let cant = $('#cantidad').val();
        let concepto = $('#sugsbjhs98yu').val();
        let especificaciones = $('#especificaciones').val();
        let tipo = $('#tipo').val();
        $('#tipo').attr('disabled', true);
        $.ajax({
            url: 'consultar-nombre-concepto/x33ddwqfvhbjihugvcdcdf5678t7stc' + concepto +'/'+ tipo,
            type: 'GET',
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        })
        .done(function(comp) {

            // console.log( comp );
            // console.log( comp.servicio_nombre );
            // console.log( tipo );

            let nombre = '';
            let union = tipo + concepto;

            if(tipo == 'Material'){
                nombre = comp.material_nombre;
            } else {
                if(tipo == 'Servicio'){
                    nombre = comp.servicio_nombre;
                } else {
                    nombre = comp.viatico_nombre;
                }
            }

            $("#table").append('<tr id="tabla' + tipo + concepto + '"><td>' + tipo + '</td><td>' + cant + '</td>' + '<td>' + nombre + '</td>' + '<td>' + especificaciones + '</td>' + '<td> <i style="color:#6b1022;" onclick="borrarMat('+ union +')" class="fas fa-trash"></i> </td>' + '<tr>');
            $('#cargarRequisicion').attr('disabled', false);
            $('#ctipo234').append('<input type="hidden" id="tipos' + concepto + '" name="tipos[]" value="' + tipo + '">');
            $('#cantidad234').append('<input type="hidden" id="cantdd' + concepto + '" name="cantdd[]" value="' + cant + '">');
            $('#concrip234').append('<input type="hidden" id="concrip424' + concepto + '" name="concrip424[]" value="' + concepto + '">');
            $('#especificaciones234').append('<input type="hidden" id="especificacionesewq' + concepto + '" name="especificacionesewq[]" value="' + especificaciones + '">');

            $('#cantidad').val("");
            $('#sugsbjhs98yu').val("");
            $('#sel45').attr('selected', 'selected');
            $('#especificaciones').val("");
            $('#agregar').attr('disabled', true);

        })
        .fail( function(){
            console.log("hay un error en la carga de solicitud de nombre de concepto")
        });


    })


});
