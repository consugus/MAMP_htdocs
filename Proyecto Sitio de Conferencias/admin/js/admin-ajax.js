$(document).ready(function(){

    $('#guardar-registro').on('submit', function(e){
        e.preventDefault();
        var datos = $(this).serializeArray();

        $.ajax({
            type: $(this).attr('method'), // POST
            data: datos,
            url:  $(this).attr('action'), // // va a modelo-admin.php
            datatype: 'json',
            success: function(data){
                var resultado = JSON.parse(data);
                console.log(resultado);

                if(resultado.respuesta == "correcto"){
                    swal({
                        position: 'center',
                        type: 'success',
                        title: 'El administrador se guardó exitosamente',
                        showConfirmButton: false,
                        timer: 3000
                      });
                      //borrar datos del formulario
                      //   if(resultado.id_actualizado == 0){
                        $("#crear-admin").trigger("reset");
                      // };
                } else {
                    swal({
                        position: 'center',
                        type: 'error',
                        title: 'No se pudo guardar el nuevo administrador. Revise los datos ingresados',
                        showConfirmButton: false,
                        timer: 3000
                      })
                };

            }
        });
    });


    $('#login-admin').on('submit', function(e){
        e.preventDefault();
        var datos = $(this).serializeArray();
        $.ajax({
            type: $(this).attr('method'), // POST
            data: datos,
            url:  $(this).attr('action'), // va a modelo-admin.php
            datatype: 'json',
            success: function(data){
                var resultado = JSON.parse(data);
                if(resultado.respuesta == "exitoso"){
                    swal({
                        position: 'center',
                        type: 'success',
                        title: 'Bienvenido/a, ' + resultado.nombreAdmin,
                        showConfirmButton: false,
                        timer: 2000
                      });
                        setTimeout(function(){
                            window.location.href = "admin-area.php";
                        }, 3000);
                } else {
                swal({
                    position: 'center',
                    type: 'error',
                    title: 'Usuario o password incorrectos',
                    showConfirmButton: false,
                    timer: 2000
                  })};
            }
        });
    });
}); // end $(document).ready()

