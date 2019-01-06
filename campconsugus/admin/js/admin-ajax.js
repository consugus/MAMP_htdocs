$(document).ready(function(){

    // guardar un registro
    $('#guardar-registro').on('submit', function(e){
        e.preventDefault();
        var datos = $(this).serializeArray();

        $.ajax({
            type: $(this).attr('method'), // POST
            data: datos,
            url:  $(this).attr('action'), // // va a modelo-categoria.php
            datatype: 'json',
            success: function(data){
                var resultado = JSON.parse(data);
                console.log(resultado);
                if(resultado.respuesta == "exito"){
                    swal({
                        position: 'center',
                        type: 'success',
                        title: 'El registro se guardó exitosamente',
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

    $('#guardar-registro-archivo').on('submit', function(e){
        e.preventDefault();
        // var datos = $(this).serializeArray();
        var datos = new FormData(this);

        $.ajax({
            type: $(this).attr('method'), // POST
            data: datos,
            url:  $(this).attr('action'), // // va a modelo-categoria.php
            datatype: 'json',

            // PROPIEDADES NUEVAS QUE DEBEN AGREGARSE CUANDO EL FORM ACEPTA UN ARCHIVO
            contentType: false,  // When sending data to the server, use this content type. Default is "application/x-www-form-urlencoded;
                                 // charset=UTF-8", which is fine for most cases. If you explicitly pass in a content-type to $.ajax(), then
                                 // it is always sent to the server (even if no data is sent). You can pass FALSE to tell jQuery to not set
                                 // any content type header
            processData: false, // By default, data passed in to the data option as an object (technically, anything other than a string)
                                 //will be processed and transformed into a query string, fitting to the default content-type
                                 // "application/x-www-form-urlencoded". If you want to send a DOMDocument, or other non-processed data,
                                 // set this option to false
            async: true,
            cache: false,
            // END PROPIEDADES NUEVAS

            success: function(data){
                var resultado = JSON.parse(data);
                console.log(resultado);
                if(resultado.respuesta == "exito"){
                    swal({
                        position: 'center',
                        type: 'success',
                        title: 'El registro se guardó exitosamente',
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
        location.reload();// Recarga la página para mostrar la nueva imagen, si es que ésta cambió
    }); // end guardar un registro-archivo


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
          }).then( (result) => {
            if (result.value) {
                $.ajax({
                    type    : 'post',
                    data    : {  'id'       : id,
                                 'registro' : 'eliminar' },
                    url     :    'modelo-'+ tipo +'.php',
                    success : function(data){
                        var resultado = JSON.parse(data);
                        console.log(resultado);
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

