(function (){
    document. querySelector('#formulario').addEventListener('submit', validarRegistro);
})();

function validarRegistro(e){
    e.preventDefault();

    var usuario = document.querySelector("#usuario").value,
        password = document.querySelector("#password").value,
        tipo = document.querySelector("#tipo").value;

        console.log("usuario: " + usuario + "\tpassword: " + password + "\ttipo: " + tipo);


    if(usuario === "" || password === ""){
        // si alguno de los campos está vacío mostrar un sweetAlert
        swal({
            type: "error",
            title: "Error",
            text:"Ambos campos son obligatorios!",
            icon: "error",
            button: "CERRAR"
          })

    } else {
        // Si completó los dos campos, mandar el Ajax
        var datos = new FormData();
        datos.append('usuario', usuario);
        datos.append('password', password);
        datos.append('accion', tipo);

        // Llamado Ajax - Creación de la conexión
        var xhr = new XMLHttpRequest();

        // Llamado Ajax - Abriendo la conexión
        xhr.open('POST', 'inc/modelos/modelo-admin.php', true);

        // Llamado Ajax - Retorno de datos
        xhr.onload = function(){
            if(this.status === 200){
                var respuesta = JSON.parse(xhr.responseText);

                console.log(respuesta);

                if(respuesta.respuesta === "correcto"){
                    if(respuesta.tipo === "crear"){
                        swal({
                            title: "Usuario creado",
                            text: "El usuario se creó correctamente",
                            type: "success"
                        });
                    }
                    else if(respuesta.tipo === "login"){
                        swal({
                            title: "Login correcto",
                            text: "Presiona ok para acceder al index",
                            type: "success"
                        }).then(resultado => {// redirigir al index
                            if(resultado.value){
                                window.location.href = 'index.php';
                            }
                        });
                    }
                } else {
                    // hubo un error al intentar crear el usuario
                    swal({
                        title: "Error",
                        text: "hubo un error al intentar crear el usuario",
                        type: "error"
                    });
                };
            };
        };

        // Llamado Ajax - enviado de los datos
        xhr.send(datos);
    };
};