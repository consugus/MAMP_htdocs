var listaDeProyectos = document.querySelector("ul#proyectos");

(function eventListeners(){
    document.querySelector(".crear-proyecto a").addEventListener("click", nuevoProyecto);
})();


function nuevoProyecto(e){
    e.preventDefault();
    // console.log("presionaste click");

    // Creación de un input para el nombre del nuevo proyeto

    var nuevoProyecto = document.createElement("LI");
    nuevoProyecto.innerHTML = '<input type="text" id="nuevo-proyecto" autofocus>';
    listaDeProyectos.appendChild(nuevoProyecto);

    // Seleccionar el ID con el nuevo proyecto
    var inputNuevoProyecto = document.querySelector("#nuevo-proyecto");

    // Al presionar Enter crear el proyecto
    inputNuevoProyecto.addEventListener("keypress", function(e){
        var tecla = e.key;
        if(tecla === "Enter"){
            //console.log("presionaste enter");
            guardarProyectoDB(inputNuevoProyecto.value);
            listaDeProyectos.removeChild(nuevoProyecto);
        };
    });
};

function guardarProyectoDB(nombreProyecto){

    // console.log("el nuevo proyecto se llama: " + nombreProyecto);
    // // inyectar el html para el nuevo proyecto ingresado
    // var nuevoProyecto = document.createElement("LI");
    // nuevoProyecto.innerHTML = `<a href="#"> ${nombreProyecto} </a> `;
    // listaDeProyectos.appendChild(nuevoProyecto);



    // Crear el objeto AJAX
    var xhr = new XMLHttpRequest();

    // Crear el formData para en envío de datos
    var datos = new FormData();
    datos.append("proyecto", nombreProyecto);
    datos.append("accion", "crear");

    // Abrir la conexión
    xhr.open("POST", "inc/modelos/modelo-proyecto.php", true);

    // acción para la carga
    xhr.onload = function(){
        if(this.status === 200){
            // console.log( JSON.parse(xhr.responseText));
            // Obtener datos de la respuesta
            var respuesta = JSON.parse(xhr.responseText);
            var nombre_proyecto = respuesta.nombre_proyecto,
                id_proyecto = respuesta.id_insertado,
                tipo = respuesta.tipo,
                resultado = respuesta.respuesta;
                if(resultado === "correcto"){
                    // fue exitoso
                    if(tipo === "crear"){
                        // Se creó un nuevo proyecto
                        // Inyectar en el html
                        var nuevoProyecto = document.createElement("LI");
                        nuevoProyecto.innerHTML = `
                            <a href="index.php?id_proyecto=${id_proyecto}" id="${id_proyecto}">
                                ${nombre_proyecto}
                            </a>
                        `;

                        // agregar el LI creado a la lista de proyectos
                        listaDeProyectos.appendChild(nuevoProyecto);

                        // enviar el alert
                        swal({
                            title: "¡Perfecto!",
                            text: "El proyecto " + nombre_proyecto + " se creó exitosamente",
                            type: "success"
                        }).then( resultado => {
                            if(resultado.value){
                            // Redireccionar a la nueva URL
                            window.location.href = "index.php?id_proyecto=" + id_proyecto;
                            }

                        });



                    } else{
                        // Se actualizó el proyecto o se eliminó

                    };
                } else{
                    // hubo un error
                    swal({
                        title: "Error",
                        text: "hubo un error al intentar insertar un nuevo proyecto",
                        type: "error"
                    });
                };
        }
    };

    // enviar el request
    xhr.send(datos);


};