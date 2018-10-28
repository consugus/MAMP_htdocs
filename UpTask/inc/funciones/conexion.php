<?php
    $usuario_DB = 'root';
    $password_DB = 'root';
    $database = 'uptask';
    // $conn = new PDO('mysql:host=localhost;dbname=uptask', $usuario, $password);
    // PDO permite conectarse a 12 DB distintas: Oracle, MS SQL Server, MySQL entre otras, sin tener que cambiar nada

    $conn = new mysqli("localhost", $usuario_DB, $password_DB, $database);
    $conn->set_charset('utf8');

    // Para probar que se estableció correctamente la conexión, incluir conexion.php en el index y recargar

    // if($conn->ping()){
    //     echo 'Conexión exitosa';
    // } else {
    //     echo 'Falló la conexión';
    // }

?>
