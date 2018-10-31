<?php
    //echo json_encode($_POST);

    include '../funciones/conexion.php';
    $accion = $_POST['accion'];
    $id_proyecto = (int)$_POST['proyecto_id'];
    $tarea = $_POST['tarea'];

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
                    'respuesta'       => 'correcto',
                    'id_insertado'    => $stmt->insert_id,
                    'tipo'            => $accion,
                    'tarea' => $tarea
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

    $stmt->close();
    $conn->close();

    echo json_encode($respuesta);

?>