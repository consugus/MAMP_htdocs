<?php

if(isset($_POST['agregar-admin']) && (int)$_POST['agregar-admin'] == 1){
    //die(json_encode($_POST)); // a partir de die, el código que sigue no se ejecuta
    $usuario = htmlentities($_POST['usuario'], ENT_QUOTES, 'UTF-8');
    $nombre = htmlentities($_POST['nombre'], ENT_QUOTES, 'UTF-8');
    $password = $_POST['password'];
    $opciones = array( 'cost' => 12 );
    $password_hashed = password_hash($_POST['password'], PASSWORD_BCRYPT,$opciones);

    // echo 'usuario: ' . $usuario; echo '</br> nombre: ' . $nombre; echo '</br> password: ' . $password;echo '</br>password_hashed: ' . $password_hashed;

    try {
        require_once "../includes/funciones/dbconnection.php";
        $stmt = $conn->prepare("INSERT INTO administradores (adminUsuario, adminNombre, adminPassword) VALUES (?, ?, ?)");
        $stmt->bind_param( "sss", $usuario, $nombre, $password_hashed);
        $stmt->execute();
        $id_registro = $stmt->insert_id;
        if($id_registro > 0){
            $respuesta = array(
                'respuesta' => 'exito',
                'id_admin' => $id_registro
            );
        } else{
            $respuesta = array(
                'respuesta' => 'error'
            );
        };
        $stmt->close();
        $conn->close();

    } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
    }
    die(json_encode($respuesta));
};// end agregar-admin

if(isset($_POST['log-admin']) && (int)$_POST['log-admin'] == 1){
    $usuario = htmlentities($_POST['usuario'], ENT_QUOTES, 'UTF-8');
    $password = $_POST['password'];

    try {
        require_once "../includes/funciones/dbconnection.php";
        $stmt = $conn->prepare("SELECT * FROM administradores WHERE adminUsuario = ?; " );
        $stmt->bind_param( "s", $usuario);
        $stmt->execute();

        $stmt->bind_result($idAdmin, $usuarioAdmin, $nombreAdmin, $passwordAdmin);
        if($stmt->affected_rows){
            $existe = $stmt->fetch();
            if($existe){
                if(password_verify($password, $passwordAdmin)){
                    session_start();
                    $_SESSION['usuario'] = $usuarioAdmin;
                    $_SESSION['nombre'] = $nombreAdmin;

                    $respuesta = array(
                        'respuesta' => 'exitoso',
                        'nombreAdmin' => $nombreAdmin );
                }else{
                    $respuesta = array(
                        'respuesta' => 'error' ); // error de password
                }
            } else{
                $respuesta = array(
                    'respuesta' => 'error' ); // usuario inexistente
            };
        };
        $stmt->close();
        $conn->close();

    } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
    }

    die(json_encode($respuesta));
};// end login-admin










?>

