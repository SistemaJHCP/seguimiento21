
setTimeout(function(){
    Swal.fire({
        title: 'Cierre por tiempo de inactividad',
        text: 'presione F5 para evitar el cierre.',
        imageUrl: 'imagen/logo-borde-blanco-3.png',
        imageWidth: 400,
        imageHeight: 200,
        imageAlt: 'Custom image',
    })

}, 1080000);

setTimeout(function(){
    window.location.href = "http://localhost/seguimiento21/public/";
}, 1140000);

