<?php
$usuario = htmlentities($_POST['usuario'], ENT_QUOTES, 'UTF-8');


// loggin
if(isset($_POST['log-admin'] ) &&(int)$_POST['log-admin'] == 1 ){
    $usuario = htmlentities($_POST['usuario'], ENT_QUOTES, 'UTF-8');
    $password = $_POST['password'];

    try {
        require_once "../includes/funciones/dbconnection.php";
        $stmt = $conn->prepare("SELECT * FROM administradores WHERE adminUsuario = ?; " );
        $stmt->bind_param( "s", $usuario);
        $stmt->execute();

        $stmt->bind_result($idAdmin, $usuarioAdmin, $nombreAdmin, $passwordAdmin, $editado, $nivelAdmin);
        if($stmt->affected_rows){
            $existe = $stmt->fetch();
            if($existe){
                if(password_verify($password, $passwordAdmin)){
                    session_start();
                    $_SESSION['usuario'] = $usuarioAdmin;
                    $_SESSION['nombre'] = $nombreAdmin;
                    $_SESSION['nivel'] = $nivelAdmin;
                    $_SESSION['id'] = $idAdmin;

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
        $respuesta = array(
            'respuesta' => $e->getMessage()
        );
    }

    die(json_encode($respuesta));
};// end login-admin