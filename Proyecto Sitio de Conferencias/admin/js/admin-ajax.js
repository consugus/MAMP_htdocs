$(document).ready(function(){

    // guardar un registro de administrador
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

                if(resultado.respuesta == "correcto"){
                    swal({
                        position: 'center',
                        type: 'success',
                        title: 'El administrador se guardó exitosamente',
                        showConfirmButton: false,
                        timer: 3000
                      });
                      //borrar datos del formulario
                        $(this).trigger("reset"); // "#guardar-registro"
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
    }); // end guardar de un registro de administrador


    // eliminar un registro de administrador
    $('.borrar-registro').on('click', function(e){
        e.preventDefault();
        var id = $(this).attr('data-id');
        var tipo = $(this).attr('data-tipo');


        Swal({
            title: 'Está Ud seguro/a?',
            text: "La eliminación de un administrador no puede revertirse!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminarlo!',
            cancelButtonText: 'Cancelar'
          }).then((result) => {
            if (result.value) {

                $.ajax({
                    type    : 'post',
                    data    : {  'id'       : id,
                                 'registro' : 'eliminar' },
                    url     : 'modelo-'+ tipo +'.php',
                    success : function(data){
                        var resultado = JSON.parse(data);
                        if(resultado.respuesta == "exito"){
                            Swal(
                                'Eliminado!',
                                'El administrador se ha eliminado.',
                                'success'
                              )
                              jQuery('[data-id="' +  resultado.id_eliminado + '"]').parents('TR').remove();
                        } else {
                            Swal({
                                type: 'error',
                                title: 'Error...',
                                text: 'El administrador seleccionado no se pudo eliminar!'
                              })
                        }; // end if
                    }
                }); // end ajax
            }
          }) // end promise (.then)
    }); // end eliminación de un registro de administrador

}); // end $(document).ready()

