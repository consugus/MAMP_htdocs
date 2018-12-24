<?php
include_once "funciones/funciones.php";
// die(json_encode($_POST));

$id_registro = $_POST['id_registro'];
$nombre_categoria = $_POST['nombre_categoria'];
$icono = $_POST['icono'];


// agregar-categoría
if( isset($_POST['registro']) && $_POST['registro'] == "nuevo" ){
    // die(json_encode($_POST)); // a partir de die, el código que sigue no se ejecuta

    try {
        $sql = "INSERT INTO categoria_evento (cat_evento, icono) VALUES (?, ? ) ";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $nombre_categoria, $icono );
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
                'respuesta' => 'Error, ninguna línea afectada'
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
};// end agregar-categoría


// editar-categoría
if(isset($_POST['registro']) && $_POST['registro'] == "actualizar" ){
    // die(json_encode($_POST));
    try {

        $stmt = $conn->prepare("UPDATE categoria_evento SET cat_evento = ?, icono = ?, editado = NOW() WHERE id_categoria = ? ");
        $stmt->bind_param("ssi", $nombre_categoria, $icono, $id_registro);

        $stmt->execute();
        if($stmt->affected_rows){
            $respuesta = array(
                'respuesta' => "exito",
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
}; // end editar-categoría


// eliminación de un registro
if(isset($_POST['registro']) && $_POST['registro'] == "eliminar" ){
    // die(json_encode($_POST));
    $id_borrar = $_POST['id'];
    try {
        $stmt = $conn->prepare("DELETE FROM categoria_evento WHERE id_categoria = ? ");
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

