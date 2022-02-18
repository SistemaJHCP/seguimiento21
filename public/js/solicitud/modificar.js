$(document).ready(function(){





});

function primeraCarga(a){

    $.ajax({
        url: '../primeraCarga/87yushdyu87dyghunjdhu8d7',
        type: 'POST',
        dataType: 'json',
        data: {dato: a},
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    })
    .done(function(comp) {
        console.log( comp );



    })
    .fail( function(){
        console.log("fallo el ajax al cargar los datos de la solicitud");
    })

}
