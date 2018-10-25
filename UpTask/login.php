<?php
    session_start();
    include 'inc/templates/header.php';
    include 'inc/funciones/funciones.php';
    include 'inc/funciones/conexion.php';

    if(isset($_GET['cerrar_sesion'])){
        $_SESSION = array();
    };

?>


<body class="login">

    <div class="contenedor-formulario">
        <h1>UpTask <span>Iniciar sesión</span></h1>
        <form id="formulario" class="caja-login" method="post">
            <div class="campo">
                <label for="usuario">Usuario: </label>
                <input type="text" name="usuario" id="usuario" placeholder="Usuario" autofocus>
            </div>
            <div class="campo">
                <label for="password">Password: </label>
                <input type="password" name="password" id="password" placeholder="Password">
            </div>
            <div class="campo enviar">
                <input type="hidden" id="tipo" value="login">
                <input type="submit" class="boton" value="Iniciar Sesión">
            </div>

            <div class="campo">
                <a href="crear-cuenta.php">Crea una cuenta nueva</a>
            </div>
        </form>
    </div>

    <script src="js/sweetalert2.all.min.js"></script>

<?php include 'inc/templates/footer.php'?>