$(document).ready(function(){

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
                  })}; // end if... else...
            } // end success
        }); // end ajax
    }); // end on(submit,...)

}); // end $(document).ready()