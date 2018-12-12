$(document).ready(function(){

    // guardar un registro
    $('#guardar-registro').on('submit', function(e){
        e.preventDefault();
        var datos = $(this).serializeArray();

        $.ajax({
            type: $(this).attr('method'), // POST
            data: datos,
            url:  $(this).attr('action'), // // va a modelo-evento.php
            datatype: 'json',
            success: function(data){
                // console.log( JSON.parse(data) );
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
                        $(this).trigger("reset"); // "#guardar-registro"
                } else {
                    swal({
                        position: 'center',
                        type: 'error',
                        title: 'No se pudo guardar el nuevo registro. Revise los datos ingresados',
                        showConfirmButton: false,
                        timer: 3000
                      })
                };

            }
        });
    }); // end guardar un registro


    // eliminar un registro
    $('.borrar-registro').on('click', function(e){
        e.preventDefault();
        var id = $(this).attr('data-id');
        var tipo = $(this).attr('data-tipo');


        Swal({
            title: 'Está Ud seguro/a?',
            text: "La eliminación de un registro no puede revertirse!",
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
                                'El registro se ha eliminado.',
                                'success'
                              )
                              jQuery('[data-id="' +  resultado.id_eliminado + '"]').parents('TR').remove();
                        } else {
                            Swal({
                                type: 'error',
                                title: 'Error...',
                                text: 'El registro seleccionado no se pudo eliminar!'
                              })
                        }; // end if
                    }
                }); // end ajax
            }
          }) // end promise (.then)
    }); // end eliminación de un registro

}); // end $(document).ready()

