<?php
include_once "funciones/funciones.php";

$nombre_evento = $_POST['nombre_evento'];
$fecha_evento = date( 'Y-m-d', strtotime($_POST['fecha_evento']) );
$hora_evento = date( 'H:i:s', strtotime($_POST['hora_evento']) );
// $categoria_id = $_POST['categoria_evento'];
$id_cat_evento = $_POST['categoria_evento'];
$id_invitado = $_POST['invitado'];

// $usuario = htmlentities($_POST['usuario'], ENT_QUOTES, 'UTF-8');
// $nombre = htmlentities($_POST['nombre'], ENT_QUOTES, 'UTF-8');
// $password = $_POST['password'];
// $opciones = array( 'cost' => 12 );
// $password_hashed = password_hash($_POST['password'], PASSWORD_BCRYPT,$opciones);
// $id_registro = $_POST['id_registro'];

// agregar-admin
if( isset($_POST['registro']) && $_POST['registro'] == "nuevo" ){
    // die(json_encode($_POST)); // a partir de die, el código que sigue no se ejecuta

    try {
        $sql = "INSERT INTO eventos (nombre_evento, fecha_evento, hora_evento, id_cat_evento, id_invitado) VALUES (?, ?, ?, ?, ? ) ";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssii', $nombre_evento, $fecha_evento, $hora_evento, $id_cat_evento, $id_invitado );
        $stmt->execute();
        $id_insertado = $stmt->insert_id;
        if($stmt->affected_rows > 0){
            $respuesta = array(
                'respuesta' => 'exito',
                'id_insertado' => $id_insertado,
                'affected_rows' => $stmt->affected_rows
            );
        } else{
            $respuesta = array(
                'respuesta' => 'Error'
            );
        };
        $stmt->close();
        $conn->close();

    } catch (Exception $e) {
        $respuesta = array(
            'respuesta' => 'Error' . $e->getMessage()
        );;
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

