var listaDeProyectos = document.querySelector("ul#proyectos");

(function eventListeners(){
    document.querySelector(".crear-proyecto a").addEventListener("click", nuevoProyecto);
})();


function nuevoProyecto(e){
    e.preventDefault();
    // console.log("presionaste click");

    // Creación de un input para el nombre del nuevo proyeto

    var nuevoProyecto = document.createElement("LI");
    nuevoProyecto.innerHTML = '<input type="text" id="nuevo-proyecto">';
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
    console.log("el nuevo proyecto se llama: " + nombreProyecto);
    // inyectar el html para el nuevo proyecto ingresado
    var nuevoProyecto = document.createElement("LI");
    nuevoProyecto.innerHTML = `<a href="#"> ${nombreProyecto} </a> `;
    listaDeProyectos.appendChild(nuevoProyecto);
};