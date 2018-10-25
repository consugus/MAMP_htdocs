<?php

    include '../funciones/conexion.php';
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];
    $accion = $_POST['accion'];

    if($accion === 'crear'){
        // código para crear los administradores



        // Hashear passwords
        $opciones = array( 'cost' => 12, );
        $hashed_password = password_hash($password, PASSWORD_BCRYPT, $opciones ); // VariableString, AlgoritmoDeContraseñas, options

        try{
            // realizar la consulta a la base de datos
            $sql = "insert into usuarios (usuario, password) values (?, ?) ";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ss', $usuario, $hashed_password);
            $stmt->execute();
            if($stmt->affected_rows > 0 ){
                $respuesta = array(
                    'respuesta'=> 'correcto',
                    'id_insertado' => $stmt->insert_id,
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


    };


    if($accion === 'login'){
        // código para loggearse

        try{
            // seleccionar el administrador de la BD
            $sql = "select usuario_id, usuario, password from usuarios where usuario = ? ";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('s', $usuario);
            $stmt->execute();

            //loggin del usuario
            $stmt->bind_result($id_usuario, $nombre_usuario, $pass_usuario);
            $stmt->fetch();

            $respuesta = [
                'usuario' => $usuario,
                'nombreUsuario' => $nombre_usuario,
                'password' => $password,
                'pass_Usuario' => $pass_usuario
            ];

            if($nombre_usuario){
                // el usuario existe, verificar si el password es válido

                if(password_verify($password, $pass_usuario)){
                    // login correcto
                    $respuesta = array(
                        'respuesta' => 'correcto',
                        'nombre' => $nombre_usuario
                    );

                } else{
                    // login incorrecto, enviar error
                    $respuesta = array(
                        'respuesta' => 'correcto',
                        'resultado' => 'Password incorrecto'
                    );

                };

            } else{
                $respuesta = array(
                    'error' => $nombre_usuario
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

    };

    echo json_encode($respuesta);


?>