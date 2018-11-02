<?php
    $respuesta = $_POST;
    // echo json_encode($_POST);

    include '../funciones/conexion.php';
    $accion = $_POST['accion'];
    $id_proyecto = (int)$_POST['proyecto_id'];
    $tarea = $_POST['tarea'];
    $estado = (int)$_POST['estado'];
    $id_tarea = (int)$_POST['tarea_id'];

    // echo json_encode($accion);

    if($accion === 'crear'){
        try{
            // realizar la consulta a la base de datos
            $sql = "insert into tareas (tarea_nombre, proyecto_id) values (?, ?) ";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('si', $tarea, $id_proyecto);
            $stmt->execute();
            if($stmt->affected_rows > 0 ){
                $respuesta = array(
                    'respuesta'    => 'correcto',
                    'id_insertado' => $stmt->insert_id,
                    'tipo'         => $accion,
                    'tarea'        => $tarea
                );
            } else{
                $respuesta = array(
                    'respuesta' => 'error'
                );
            };
        } catch(Exception $e){
            // capturar la excepción
            $respuesta = array(
                'error' => $e->getMessage()
            );
        };
    };

    if($accion === 'actualizar'){
        try{
            // realizar la actualización a la BD
            $sql = "UPDATE tareas SET estado = ? WHERE tarea_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param(ii, $estado, $id_tarea);
            $stmt->execute();
            if($stmt->affected_rows > 0 ){
                $respuesta = array( 'respuesta'    => 'correcto' );
            } else{
                $respuesta = array( 'respuesta' => 'error al actualizar la tarea' );
            };

        }catch(Exception $e){
            $respuesta = array( 'error'=> 'error al actualizar' );
        };
    };

    if($accion === "eliminar"){
        try{
            $sql = "DELETE from tareas WHERE tarea_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param(i, $id_tarea);
            $stmt->execute();
            if($stmt->affected_rows > 0){
                $respuesta = array( 'respuesta'    => 'correcto' );
            }else{
                $respuesta = array( 'respuesta' => 'error al eliminar la tarea' );
            };
        }catch(Exception $e){
            $respuesta = array( 'error'=> 'error al eliminar' );
        };

    };

    echo json_encode($respuesta);

    if($stmt){ $stmt->close(); };
    $conn->close();
?>