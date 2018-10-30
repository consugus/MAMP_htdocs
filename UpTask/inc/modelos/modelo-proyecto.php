<?php
    include '../funciones/conexion.php';
    $accion = $_POST['accion'];
    $nombre_proyecto = $_POST['proyecto'];

    // echo json_encode($accion);

    if($accion === 'crear'){

        try{
            // realizar la consulta a la base de datos
            $sql = "insert into proyectos (proyecto_nombre) values (?) ";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('s', $nombre_proyecto);
            $stmt->execute();
            if($stmt->affected_rows > 0 ){
                $respuesta = array(
                    'respuesta'       => 'correcto',
                    'id_insertado'    => $stmt->insert_id,
                    'tipo'            => $accion,
                    'nombre_proyecto' => $nombre_proyecto
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