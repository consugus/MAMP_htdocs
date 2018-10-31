<aside class="contenedor-proyectos">
            <div class="panel crear-proyecto">
                <a href="#" class="boton">Nuevo Proyecto <i class="fas fa-plus"></i> </a>
            </div>

            <div class="panel lista-proyectos">
                <h2>Proyectos</h2>
                <ul id="proyectos">
                    <?php
                        $proyectos = obtenerProyectos();
                        if($proyectos){
                            foreach ($proyectos as $proyecto) { ?>
                                <li>
                                    <?php //echo "<pre>"; var_dump($proyecto); echo "</pre>;"?>
                                    <a href="index.php?id_proyecto=<?php echo $proyecto['proyecto_id'] ?>" id="proyecto:<?php echo $proyecto['proyecto_id'] ?>">
                                    <?php echo $proyecto['proyecto_nombre'] ?>
                                    </a>
                                </li>

                    <?php   }   };
                    ?>
                </ul>
            </div>
        </aside>