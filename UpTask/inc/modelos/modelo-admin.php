<?php
    $accion = $_POST['accion'];
    $password = $_POST['password'];
    $usuario = $_POST['usuario'];

    if($accion === 'crear'){
        // código para crear los administradores

        // Hashear passwords
        $opciones = array(
            'cost' => 12
        );

        $hashed_password = password_hash($password, PASSWORD_BCRYPT, $opciones ); // VariableString, AlgoritmoDeContraseñas, options

        include '../funciones/conexion.php';

        try{
            // realizar la consulta a la base de datos
            $sql = "insert into usuarios (usuario, password) values (?, ?) ";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ss', $usuario, $hashed_password);
            $stmt->execute();
            if($stmt->affected_rows > 0 ){
                $respuesta = array(
                    'respuesta'=> 'correcto',
                    'id_insertado' => '$stmt->insert_id',
                    'tipo' => $accion
                );
            } else{
                $respuesta = array(
                    'respuesta' => 'error'
                );
            };

            $stmt->close();
            $conn->close();

        } catch(Exception $e){
            // capturar la excepción
            $respuesta = array(
                'pass' => $e->getMessage()
            );
        };

        echo json_encode($respuesta);
    };



    if($accion === 'login'){
        // código para loggearse
        include "../funciones/conexion.php";

        try{
            // seleccionar el administrador de la BD
            $sql = "select * from usuarios where usuario = ? ";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('s', $usuario);
            $stmt->execute();

            //loggin del usuario
            $stmt->bind_result($id_usuario, $nombre_usuario, $pass_usuario);
            $stmt->fetch();



            if($nombre_usuario){
                $respuesta = array(
                    'respuesta' => 'correcto',
                    'id' => $id_usuario,
                    'usuario' => $nombre_usuario,
                    'pass' => $pass_usuario
                );
            } else{
                $respuesta = array(
                    'error' => 'Usuario inexistente'
                );
            };


            $stmt->close();
            $conn->close();


        } catch(Exception $e){
            // capturar la excepción
            $respuesta = array(
                'pass' => $e->getMessage()
            );
        };

        echo json_encode($respuesta);
    };

    


?>