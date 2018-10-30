<?php
    function obtenerPaginaActual(){
        $archivo = basename($_SERVER['PHP_SELF']);
        $pagina = str_replace(".php", "", $archivo);
        return $pagina;
    }

    // consultas


    // Obtener todos los proyectos almacenados en la BD
    function obtenerProyectos(){
        include "conexion.php";
        try{
            return $conn->query("SELECT proyecto_id, proyecto_nombre FROM proyectos" );
        } catch(Exception $e){
            echo "Error: " . $e->getMessage();
            return false;
        };
    };


    // Obtener nombre del proyecto por id
    function obtenerNombreProyecto($id=null){
        include "conexion.php";
        try{
            return $conn->query("SELECT proyecto_nombre FROM proyectos WHERE proyecto_id={$id}");
        }catch(Exception $e){
            echo "Error!" . $e->getMessage();
        };
    };

?>