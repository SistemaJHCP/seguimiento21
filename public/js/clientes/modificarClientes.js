$(document).ready(function(){

    $("#codigo").keyup(function(){
        if ($('#codigo').val().length <= 5 || $('#codigo').val().length > 10) {
            $('#codigo').css({'border':'1px solid red'});
            $('#modificandoCli').prop('disabled',true);
            return false;
        } else {
            $('#codigo').css({'border':'1px solid #d2d6de'});
            activarBoton();
        }
    });

    $("#nombre").keyup(function(){
        if ($('#nombre').val().length <= 3 || $('#nombre').val().length > 51) {
            $('#nombre').css({'border':'1px solid red'});
            $('#modificandoCli').prop('disabled',true);
            return false;
        } else {
            $('#nombre').css({'border':'1px solid #d2d6de'});
            activarBoton();
        }
    });

    $("#telefono").keyup(function(){
        if ($('#telefono').val().length <= 6 || $('#telefono').val().length > 14) {
            $('#telefono').css({'border':'1px solid red'});
            $('#modificandoCli').prop('disabled',true);
            return false;
        } else {
            $('#telefono').css({'border':'1px solid #d2d6de'});
            activarBoton();
        }
    });

    $("#direccion").keyup(function(){
        if ($('#direccion').val().length <= 6 || $('#direccion').val().length > 201) {
            $('#direccion').css({'border':'1px solid red'});
            $('#modificandoCli').prop('disabled',true);
            return false;
        } else {
            $('#direccion').css({'border':'1px solid #d2d6de'});
            activarBoton();
        }
    });

    $("#modificandoCli").click(function(){
        $("form").on("submit", function () {
            $("#modificandoCli").attr("value", "Guardando, espere...");
            $(this).find(":submit").prop("disabled", true);
        });
    });

    $("#correo").keyup(function(){
        if ($('#correo').val().length <= 6 || $('#correo').val().length > 41) {
            $('#correo').css({'border':'1px solid red'});
            $('#modificandoCli').prop('disabled',true);
            return false;
        } else {
            $('#correo').css({'border':'1px solid #d2d6de'});
            activarBoton();
        }
    });

    function key(){
        iff();
    }

    function iff(){
        if ($('#correo').val().length <= 1) {
            console.log("qqqq");
            $('#correo').css({'border':'1px solid red'});
            $('#modificandoCli').prop('disabled',true);
            return false;
        } else {
            console.log("rrrrr");
            $('#correo').css({'border':'1px solid #d2d6de'});
            $('#modificandoCli').prop('disabled',false);
            activarBoton();
        }
    }

    function activarBoton(){
        if($('#codigo').val().length > 1 && $('#nombre').val().length > 1 && $('#telefono').val().length > 1 && $('#direccion').val().length > 1 && $('#correo').val().length > 1 ){
            $('#modificandoCli').prop('disabled',false);
        } else {
            $('#modificandoCli').prop('disabled',true);
        }
    };


    function success()
    {
        Swal.fire(
            'Solicitud procesada!',
            'Se ha cargado la información satisfactoriamente!',
            'success'
          )
    }

    function error(){
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
          })

          Toast.fire({
            icon: 'error',
            title: 'Hubo un problema'
          })
    }

    function errorCaracteres(){
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
          })

          Toast.fire({
            icon: 'error',
            title: 'faltan caracteres, o tiene campos vacios'
          })
    }


    function checkSubmit() {
        if (!enviando) {
            enviando= true;
            return true;
        } else {
            //Si llega hasta aca significa que pulsaron 2 veces el boton submit
            alert("El formulario ya se esta enviando");
            return false;
        }
    }


});
