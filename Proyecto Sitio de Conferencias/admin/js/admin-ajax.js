$(document).ready(function(){

    $('#crear-admin').on('submit', function(e){
        e.preventDefault();
        var datos = $(this).serializeArray();

        $.ajax({
            type: $(this).attr('method'), // PoOST
            data: datos,
            url:  $(this).attr('action'), // // va a insertar-admin.php
            datatype: 'json',
            success: function(data){
                var resultado = JSON.parse(data);
                console.log(resultado);

                if(resultado.respuesta == "exito"){
                    swal({
                        position: 'center',
                        type: 'success',
                        title: 'El administrador se guardó exitosamente',
                        showConfirmButton: false,
                        timer: 3000
                      });
                      //borrar datos del formulario
                      $("#crear-admin").trigger("reset");
                } else {
                    swal({
                        position: 'center',
                        type: 'error',
                        title: 'No se pudo generar el nuevo administrador. Revise los datos ingresades',
                        showConfirmButton: false,
                        timer: 3000
                      })
                };

            }
        });
    });


    $('#login-admin').on('submit', function(e){
        console.log("Hola");
        // e.preventDefault();
        var datos = $(this).serializeArray();
        
        $.ajax({
            type: $(this).attr('method'), // POST
            data: datos,
            url:  $(this).attr('action'), // va a insertar-admin.php
            datatype: 'json',
            success: function(data){
                var resultado = JSON.parse(data);
                console.log(resultado);

            }
        });
    });

}); // end $(document).ready()

