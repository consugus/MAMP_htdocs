<?php
    include 'inc/funciones/sesiones.php';
    include 'inc/funciones/funciones.php';
    include 'inc/templates/header.php';
    include 'inc/templates/barra.php';

    // Obtener el id de la página
    if(isset($_GET['id_proyecto'])){
        // echo $_GET['id_proyecto'];
        $id_proyecto = $_GET['id_proyecto'];
    }else{
        echo "no";
    };

?>

<body>

    <div class="contenedor">
    <?php
        include "inc/templates/sidebar.php";
    ?>

        <main class="contenido-principal">

            <?php
                $proyecto = obtenerNombreProyecto($id_proyecto);
                if($proyecto):  ?>
                    <h1>Proyecto Actual:
                            <?php
                                foreach ($proyecto as $nombre): ?>
                                    <span><?php echo $nombre['proyecto_nombre'] ?></span>
                        <?php endforeach; ?>
                    </h1>

            <form action="#" class="agregar-tarea">
                <div class="campo">
                    <label for="tarea">Tarea:</label>
                    <input type="text" placeholder="Nombre Tarea" class="nombre-tarea">
                </div>
                <div class="campo enviar">
                    <input type="hidden" id = "id_proyecto" value="<?php echo $id_proyecto; ?>" value="id_proyecto">
                    <input type="submit" class="boton nueva-tarea" value="Agregar">
                </div>
            </form>

            <?php
                else:
                    // Si no hay proyectos seleccionados
                    echo '<div id="parrafo">';
                        echo "<p>Selecciona algún proyecto en la barra lateral para las tareas</p>";
                    echo '</div>';
                endif; ?>

            <h2>Listado de tareas:</h2>

            <div class="listado-pendientes">
                <ul>

                    <?php
                            // Obtener las tareas del proyecto actual
                            $tareas = obtenerTareasProyecto($id_proyecto);
                            if($tareas->num_rows > 0){
                                // Existen tareas
                                foreach($tareas as $tarea): ?>
                                <?php // var_dump($tarea); ?>
                                <li id="tarea:<?php echo $tarea['tarea_id'] ?>" class="tarea">
                                <p><?php echo $tarea['tarea_nombre'] ?></p>
                                    <div class="acciones">
                                        <i class="far fa-check-circle <?php echo ($tarea['estado'] === '1' ? 'completo': '')  ?>"></i>
                                        <i class="fas fa-trash"></i>
                                    </div>
                                </li>
                        <?php   endforeach;
                            } else{
                                echo "<p>No hay tareas en éste proyecto<?p>";
                            };
                            echo "<pre>";
                                // var_dump($tareas);
                            echo "</pre>";

                    ?>

                </ul>
            </div>
        </main>
    </div><!--.contenedor-->

<?php include 'inc/templates/footer.php'?>