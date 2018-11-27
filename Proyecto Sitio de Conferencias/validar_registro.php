<?php
    if(isset($_POST['submit'])){
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

                //echo "<pre>";  var_dump($pedido);  echo "<pre>";

                // Eventos
                $eventos = $_POST['registro'];
                $registro = eventos_json($eventos);
                try{
                    require_once('includes/funciones/dbconnection.php');
                    $query = "INSERT INTO registrados (";
                    $query .= "nombre_registrado, ";
                    $query .= "apellido_registrado, ";
                    $query .= "email_registrado, ";
                    $query .= "fecha_registro, ";
                    $query .= "pases_articulos, ";
                    $query .= "talleres_registrados, ";
                    $query .= "regalo, ";
                    $query .= "total_pagado )";
                    $query .= "VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($query);
                    // Se coloca una legra s por cada parámetro que se ingresa que no sea un entero, y una letra
                    // i por cada valor númerico
                    $stmt ->bind_param("ssssssis", $nombre, $apellido, $email, $fecha, $pedido, $registro, $regalo, $total);
                    $stmt->execute();
                    $stmt->close();
                    $conn->close();
                    header("Location: validar_registro.php?Exitoso=1");
                } catch(\Exception $e){
                    echo $e->getMessage();
                }
            ?>
    <?php } ?>

<?php include_once "includes/templates/header.php" ?>

    <section class="seccion contenedor">
      <h2>Resumen de Registro</h2>

            <?php
                if(isset($_GET["Exitoso"])):
                    if($_GET["Exitoso"] == 1):
                        echo "Se registró con éxito";
                    endif;
                endif;
            ?>

    </section>

<?php include_once "includes/templates/footer.php" ?>