<?php include_once "includes/templates/header.php" ?>

    <section class="seccion contenedor">
      <h2>Resumen de Registro</h2>

        <?php if(isset($_POST['submit'])){
                $nombre = $_POST['nombre'];
                $apellido = $_POST['apellido'];
                $email = $_POST['eMail'];
                $regalo = $_POST['regalo'];
                $total = $_POST['total_pedido'];
                $fecha = date('Y-m-d H:i:s');

                // Pedidos
                $camisas = $_POST['camisas'];
                $etiquetas = $_POST['etiquetas'];
                $boletos = $_POST['boletos'];
                include_once "includes/funciones/funciones.php";
                $pedido = productos_json($boletos, $camisas, $etiquetas);
                echo "<pre>";
                    var_dump($pedido);
                echo "<pre>";

            ?>

        <?php } ?>

    </section>

<?php include_once "includes/templates/footer.php" ?>