<?php
include_once "funciones/funciones.php";
// die(json_encode($_POST));

$nombre = $_POST['nombre_registrado'];
$apellido = $_POST['apellido_registrado'];
$email = $_POST['email_registrado'];
$boletos = $_POST['boletos'];
$camisas = $_POST['pedido_extra']['camisas']['cantidad'];
$etiquetas = $_POST['pedido_extra']['etiquetas']['cantidad'];
$pedido = productos_json($boletos, $camisas, $etiquetas);
$id_registrado = $_POST['id_registrado'];
$total = number_format($_POST['total_pedido'], 2, '.', '');
$total_pagado = $_POST['total_pedido'];
$fecha_registro = $_POST[''];
$regalo = $_POST['regalo'];
$eventos = $_POST['registro_evento'];
$registro_eventos = eventos_json($eventos);

// agregar-categoría
if( isset($_POST['registro']) && $_POST['registro'] == "nuevo" ){
    // die(json_encode($_POST)); // a partir de die, el código que sigue no se ejecuta

    $respuesta = array(
        'boletos' => $pedido
    );

    try {
        $sql = "INSERT INTO registrados (nombre_registrado,
                                         apellido_registrado,
                                         email_registrado,
                                         fecha_registro,
                                         pases_articulos,
                                         talleres_registrados,
                                         regalo,
                                         total_pagado,
                                         pagado) VALUES (?, ?, ?, NOW(),?, ?, ?, ?, 1  ) ";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssssis', $nombre, $apellido, $email, $pedido, $registro_eventos, $regalo, $total );
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
        $sql = "UPDATE registrados SET nombre_registrado = ?, apellido_registrado = ?, email_registrado = ?, pases_articulos = ?, talleres_registrados = ?, regalo = ?, total_pagado = ? editado = NOW() WHERE id_registrado = ? ";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssisi",   $nombre, $apellido, $email, $pedido, $registro_eventos, $regalo, $total_pagado, $id_registrado );

        $stmt->execute();
        if($stmt->affected_rows > 0){
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
        $stmt = $conn->prepare("DELETE FROM registrados WHERE id_registrado = ? ");
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

