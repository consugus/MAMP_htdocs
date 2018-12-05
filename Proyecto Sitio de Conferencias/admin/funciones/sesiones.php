<?php
function usuarioAutenticado(){
    // Si el usuario no está loggeado lo redirige a la pantalla de login
    if( !revisarUsuario() ){
        header('location:login.php');
        exit();
    };
};

function revisarUsuario(){
    // retorna true si el usuario está loggeado, o false si no lo está
    return isset($_SESSION['usuario']);
};

session_start();
usuarioAutenticado();

?>
