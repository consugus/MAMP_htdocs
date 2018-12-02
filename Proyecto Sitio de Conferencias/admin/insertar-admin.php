<?php
// if($conn->ping()){ echo "conectado"; } else{ echo "No conectado"; };

// echo "<pre>"; var_dump($_POST); echo "</pre>";

if(isset($_POST['agregar-admin'])){
    if( (int)$_POST['agregar-admin'] == 1){
        $usuario = htmlentities($_POST['usuario'], ENT_QUOTES, 'UTF-8');
        $nombre = htmlentities($_POST['nombre'], ENT_QUOTES, 'UTF-8');
        $password = $_POST['password'];
        $opciones = array( 'cost' => 12 );
        $password_hashed = password_hash($_POST['password'], PASSWORD_BCRYPT,$opciones);
    };
};

// echo 'usuario: ' . $usuario; echo '</br> nombre: ' . $nombre; echo '</br> password: ' . $password;echo '</br>password_hashed: ' . $password_hashed;

try {
    require_once "../includes/funciones/dbconnection.php";
    $stmt = $conn->prepare("INSERT INTO administradores (adminUsuario, adminNombre, adminPassword) VALUES (?, ?, ?)");
    $stmt->bind_param( "sss", $usuario, $nombre, $password_hashed);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    echo "Se insertó con éxito";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}


?>