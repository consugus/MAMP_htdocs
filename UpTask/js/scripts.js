var listaDeProyectos = document.querySelector("ul#proyectos");

(function eventListeners(){
    document.querySelector(".crear-proyecto a").addEventListener("click", nuevoProyecto);

    // botón para una nueva tarea
    document.querySelector(".nueva-tarea").addEventListener('click', agregarTarea);

    // botones para las acciones de las tareas
    document.querySelector(".listado-pendientes").addEventListener('click', accionesTareas);

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
                            <a href="index.php?id_proyecto=${id_proyecto}" id="proyecto:${id_proyecto}">
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

function agregarTarea(e){
    e.preventDefault();
    var nombreTarea = document.querySelector(".nombre-tarea").value;
    if(!nombreTarea){
        swal({
            title: "Error",
            text: "No se ingresó ninguna tarea",
            type: "error"
        });
    } else{
        // crear el objeto xhr
        var xhr = new XMLHttpRequest();

        // crear el formData
        var datos = new FormData();
        datos.append('tarea', nombreTarea);
        datos.append('accion', 'crear');
        datos.append('proyecto_id', document.querySelector("#id_proyecto").value);

        // abrir el xhr
        xhr.open("POST", "inc/modelos/modelo-tareas.php", true);

        // onLoad
        xhr.onload = function(){
            if(xhr.status === 200){
                var tmp = JSON.parse(xhr.responseText),
                    resultado = tmp.respuesta,
                    tarea = tmp.tarea,
                    id_insertado = tmp.id_insertado,
                    tipo = tmp.tipo;

                if(resultado === "correcto"){
                    // se agregó correctamente, crear el aviso
                    if(tipo === "crear"){
                        swal({
                            title: "Tarea creada",
                            text: "La tarea " + tarea + " fue creada exitosamente",
                            type: "success"
                        });
                        // construir el HTML
                        var nuevaTarea = document.createElement("LI");
                        nuevaTarea.id = "tarea" + id_insertado;
                        nuevaTarea.classList.add("tarea");
                        nuevaTarea.innerHTML = `
                            <p>${tarea}</p>
                            <div class="acciones">
                                <i class="far fa-check-circle"></i>
                                <i class="fas fa-trash"></i>
                            </div>
                        `;

                        // agretar el HTML agregado al documento
                        var listado = document.querySelector(".listado-pendientes ul");
                        listado.appendChild(nuevaTarea);

                        // limpiar el formulario
                        document.querySelector(".agregar-tarea").reset();
                    };
                } else{
                    // hubo un error
                    swal({
                        title: "Error",
                        text: "No se ingresó ninguna tarea",
                        type: "error"
                    });
                };
            };
        };
        //send
        xhr.send(datos);
    };

    //eliminar mensaje de que no hay elementos en la lista
    var parrafoListaVacia = document.querySelectorAll(".lista-vacia");
    if(parrafoListaVacia.length > 0){
        document.querySelector(".lista-vacia").remove();
    };

};

// Cambia el estado de las tareas o las elimina
function accionesTareas(e){
    e.preventDefault();
    // console.log(e.target);

    //idTareaSeleccionada = getIdTarea(e.target);
    tareaSeleccionada = getIdTarea(e.target);
    idTareaSeleccionada = tareaSeleccionada.id.split(":")[1];

    if(e.target.classList.contains('fa-check-circle')){
        //console.log("cliqueaste en el check");
        if(e.target.classList.contains('completo')){
            e.target.classList.remove('completo');
            cambiarElEstadoDeLaTarea(idTareaSeleccionada, 0); // Si contiene "1", que se lo cambie al nuevo estado 0
        }else{
            e.target.classList.add('completo');
            cambiarElEstadoDeLaTarea(idTareaSeleccionada, 1); // Si contiene "0", que se lo cambie al nuevo estado 1
        };
    } else if(e.target.classList.contains('fa-trash')){
        //console.log("cliqueaste en el tacho de basura");
        eliminarTarea(tareaSeleccionada);
    };

};

function getIdTarea(str){
    return str.parentElement.parentElement;
};

// Cambiar el estado de una tarea
function cambiarElEstadoDeLaTarea(idTarea, nuevoEstado){
    // Crear llamado Ajax
    var xhr = new XMLHttpRequest();                             // Paso 1
    var datos = new FormData();                                 // Paso 2
    datos.append("tarea_id", idTarea);
    datos.append("accion", "actualizar");
    datos.append("estado", nuevoEstado);
    xhr.open("POST", "inc/modelos/modelo-tareas.php", true);    // Paso 3

    xhr.onload = function(){                                    // Paso 4
        if( this.status === 200 ){
            // Código a ejecutar
            console.log(JSON.parse(xhr.responseText));
        };
    };
    xhr.send(datos);                                            // Paso 5
};

function eliminarTarea(tareaSeleccionada){
    // console.log("quieres eliminar la tarea " + idTarea);

    idTarea= tareaSeleccionada.id.split(":")[1];

    // primero lanzamos una advertencia
    swal({
        title: '¿Estás seguro?',
        text: "Esta acción no se puede deshacer",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Eliminar la tarea!',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.value) {
            swal( 'Eliminada!', 'La tarea fue eliminada.', 'success' );
            // Borrar de la BD
            var xhr = new XMLHttpRequest();                             // Paso 1
            var datos = new FormData();                                 // Paso 2
            datos.append("tarea_id", idTarea);
            datos.append("accion", "eliminar");
            xhr.open("POST","inc/modelos/modelo-tareas.php",true);      // Paso 3
            xhr.onload = function(){                                    // Paso 4
                if(xhr.status === 200){ // si todo está ok, ejecutar el código
                    console.log(JSON.parse(xhr.responseText));
                };
            };
            xhr.send(datos);                                            // Paso 5
            // Borrar del html
            tareaSeleccionada.remove();

            // Comprobar que queden otras tareas en la lista o mostrar el cartel
            var listaDeTareasRestantes = document.querySelectorAll("li.tarea");
            if(listaDeTareasRestantes.length === 0){
                var mensaje = "<p class='lista-vacia'>No hay tareas en éste proyecto<?p>";
                document.querySelector(".listado-pendientes ul").innerHTML = mensaje;
            };

        };
      });
};