<?php
// if($conn->ping()){ echo "conectado"; } else{ echo "No conectado"; };
// echo "<pre>"; var_dump($_POST); echo "</pre>";

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

if(isset($_POST['login-admin']) && (int)$_POST['login-admin'] == 1){
    // echo "me cago en la puta que lo parió </br>";
    // die(json_encode($_POST)); // a partir de die, el código que sigue no se ejecuta
    $usuario = htmlentities($_POST['usuario'], ENT_QUOTES, 'UTF-8');
    $password = $_POST['password'];
    $opciones = array( 'cost' => 12 );
    $password_hashed = password_hash($_POST['password'], PASSWORD_BCRYPT,$opciones);

    echo 'usuario: ' . $usuario; echo '</br> password: ' . $password;echo '</br>password_hashed: ' . $password_hashed;

};// end login-admin










?>

