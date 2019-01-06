<?php
include_once "funciones/funciones.php";
$usuario = htmlentities($_POST['usuario'], ENT_QUOTES, 'UTF-8');
$nombre = htmlentities($_POST['nombre'], ENT_QUOTES, 'UTF-8');
$password = $_POST['password'];
$opciones = array( 'cost' => 12 );
$password_hashed = password_hash($_POST['password'], PASSWORD_BCRYPT,$opciones);
$id_registro = $_POST['id_registro'];

// agregar-admin
if( isset($_POST['registro']) && $_POST['registro'] == "nuevo" ){
    //die(json_encode($_POST)); // a partir de die, el código que sigue no se ejecuta

    // echo 'usuario: ' . $usuario; echo '</br> nombre: ' . $nombre; echo '</br> password: ' . $password;echo '</br>password_hashed: ' . $password_hashed;

    try {
        include_once "../includes/funciones/dbconnection.php";
        $stmt = $conn->prepare("INSERT INTO administradores (adminUsuario, adminNombre, adminPassword) VALUES (?, ?, ?)");
        $stmt->bind_param( "sss", $usuario, $nombre, $password_hashed);
        $stmt->execute();
        $id_registro = $stmt->insert_id;
        if($id_registro > 0){
            $respuesta = array(
                'respuesta' => 'correcto',
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
        $respuesta = array(
            'respuesta' => $e->getMessage()
        );
    }
    die(json_encode($respuesta));
};// end agregar-admin


// editar-admin
if(isset($_POST['registro']) && $_POST['registro'] == "actualizar" ){
    try {

        if(empty($_POST['password'])){
            $stmt = $conn->prepare("UPDATE administradores SET adminUsuario = ?, adminNombre = ?, editado = NOW() WHERE adminId = ? ");
            $stmt->bind_param("ssi", $usuario, $nombre, $id_registro);
        } else {
            $stmt = $conn->prepare("UPDATE administradores SET adminUsuario = ?, adminNombre = ?, adminPassword = ?, editado = NOW() WHERE adminId = ? ");
            $stmt->bind_param("sssi", $usuario, $nombre, $password_hashed, $id_registro);
        };
        $stmt->execute();
        if($stmt->affected_rows){
            $respuesta = array(
                'respuesta' => "correcto",
                'id_actualizado' => $stmt->insert_id
            );
        } else{
            $respuesta = array( 'respuesta' => "error al actualizar" );
        };
        $stmt->close();
        $conn->close();

    } catch (Exception $e) {
        $respuesta = array(
            'respuesta' => $e->getMessage()
        );
    }
    die(json_encode($respuesta));
}; // end editar-admin


// eliminación de un registro
if(isset($_POST['registro']) && $_POST['registro'] == "eliminar" ){
    // die(json_encode($_POST));
    $id_borrar = $_POST['id'];
    try {
        $stmt = $conn->prepare("DELETE FROM administradores WHERE adminId = ? ");
        $stmt->bind_param("i", $id_borrar);
        $stmt->execute();
        if($stmt->affected_rows){
            $respuesta = array(
                'respuesta' => 'exito',
                'id_eliminado' => $id_borrar
            );
        } else{
            $respuesta = array(
                'respuesta' => 'error' // hubo algún problema al eliminar
            );
        };
        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        $respuesta = array(
            'respuesta'=>$e->getMessage()
        );
    }
    die(json_encode($respuesta));
}; // end eliminación de un registro











?>

