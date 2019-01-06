<?php
include_once "funciones/funciones.php";
// die(json_encode($_POST));

$nombre = $_POST['nombre_invitado'];
$apellido = $_POST['apellido_invitado'];
$descripcion = $_POST['descripcion_invitado'];
$nombre_categoria = $_FILES['imagen_invitado'];
$id_registro = $_POST['id_registro'];


// agregar-invitado
if( isset($_POST['registro']) && $_POST['registro'] == "nuevo" ){
    /*
    $respuesta = array(
        'post' => $_POST,
        'file' => $_FILES
    );
    */
    // die(json_encode($respuesta)); // a partir de die, el código que sigue no se ejecuta

    $directorio = "../img/invitados/";      // es importante que tenga la barra inclinada al final

    if(!is_dir($directorio)){               // is_dir es una función de apache que verifica si existe el directorio
        mkdir($directorio, 0755, true);     // mkdir(ruta&directorio, permisos, recursivo)
                                            // permisos: u(user) g(group) o(other) a(all), user y group son los dueños del archivo/directorio
                                            //           r(read) w(escritura) x(ejecución):
                                            //           0-> ---, 1-> --x, 2-> -w-, 3-> -wx, 4-> r--, 5-> r-x, 6-> rw-, 7-> rwx
                                            //           0755 => usuario sin permisos, grupo con todos los permisos, y otros&all con permisos de lectura y ejecución
                                            // recursivo: true => permite crear directorios anidados en un solo comando y otorga los mismos
                                            //            permisos a los archivos contenidos (para no tener que estar agregando permisos a
                                            //            cada archivo)
    };

    if(move_uploaded_file($_FILES['imagen_invitado']['tmp_name'], $directorio . $_FILES['imagen_invitado']['name'] )){
        $imagen_url = $_FILES['imagen_invitado']['name'];
        $imagen_resultado = "Se subió correctamente";
    } else{
        $respuesta = array(
            'respuesta' => error_get_last() // asigna el último error que se haya registrado en el servidor
        );
    };

    try {
        $stmt->execute();
        $id_insertado = $stmt->insert_id;
        if($stmt->affected_rows > 0){
            $respuesta = array(
                'respuesta' => 'exito',
                'id_insertado' => $id_insertado
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
};// end agregar-invitado


// actualizar-invitado
if(isset($_POST['registro']) && $_POST['registro'] == "actualizar" ){
    // die(json_encode($_POST));

    $directorio = "../img/invitados/";      // es importante que tenga la barra inclinada al final

    if(!is_dir($directorio)){               // is_dir es una función de apache que verifica si existe el directorio
        mkdir($directorio, 0755, true);     // mkdir(ruta&directorio, permisos, recursivo)
                                            // permisos: u(user) g(group) o(other) a(all), user y group son los dueños del archivo/directorio
                                            //           r(read) w(escritura) x(ejecución):
                                            //           0-> ---, 1-> --x, 2-> -w-, 3-> -wx, 4-> r--, 5-> r-x, 6-> rw-, 7-> rwx
                                            //           0755 => usuario sin permisos, grupo con todos los permisos, y otros&all con permisos de lectura y ejecución
                                            // recursivo: true => permite crear directorios anidados en un solo comando y otorga los mismos
                                            //            permisos a los archivos contenidos (para no tener que estar agregando permisos a
                                            //            cada archivo)
    };

    if(move_uploaded_file($_FILES['imagen_invitado']['tmp_name'], $directorio . $_FILES['imagen_invitado']['name'] )){
        $imagen_url = $_FILES['imagen_invitado']['name'];
        $imagen_resultado = "Se actualizó correctamente";
    } else{
        $respuesta = array(
            'respuesta' => 'Error: ' . error_get_last() // asigna el último error que se haya registrado en el servidor
        );
    };

    try {

        // Si el usuario selecciona una imagen, el UPDATE debe actualizar dicho campo, caso contrario no
        if($_FILES['imagen_invitado']['size'] > 0){
            // si es mayor a cero significa que el usuario subió un archivo, SI se actualiza url_imagen
            $sql = "UPDATE invitados SET nombre = ?, apellido = ?, descripcion = ?, url_imagen = ?, editado = NOW() WHERE invitado_id = ? ";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ssssi', $nombre, $apellido, $descripcion, $imagen_url, $id_registro );
        } else{
            // si es igual a cero el usuario no subió nada y no debe actualizarse la imagen, NO se actualiza url_imagen
            $sql = "UPDATE invitados SET nombre = ?, apellido = ?, descripcion = ?, editado = NOW() WHERE invitado_id = ? ";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('sssi', $nombre, $apellido, $descripcion, $id_registro );
        };
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
}; // end actualizar-invitado


// eliminación de un registro
if(isset($_POST['registro']) && $_POST['registro'] == "eliminar" ){
    // die(json_encode($_POST));
    $id_borrar = $_POST['id'];
    try {
        $stmt = $conn->prepare("DELETE FROM invitados WHERE invitado_id = ? ");
        $stmt->bind_param("i", $id_borrar);
        $stmt->execute();
        if($stmt->affected_rows > 0){
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

