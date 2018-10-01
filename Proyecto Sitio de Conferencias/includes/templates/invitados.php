        <!--
         select 	e.evento_id AS 'id',
                e.nombre_evento AS 'Nombre del Evento',
                e.fecha_evento AS 'Fecha',
                e.hora_evento AS 'Hora',
                ce.cat_evento AS 'Categoría',
            concat(i.nombre, ' ', i.apellido) AS 'Nombre y Apellido'
            from eventos e
            join categoria_evento ce on e.id_cat_evento = ce.id_categoria
            join invitados i on e.id_invitado = i.invitado_id
            order by ce.cat_evento, e.fecha_evento
        -->


        <?php
            try{
                require_once('includes/funciones/dbconnection.php');
                $sql =  " select * from invitados ";
                $resultado = $conn->query($sql);
            } catch(\Exception $e){
                echo $e->getMessage();
            }
        ?>

        <section class="invitados contenedor seccion">
            <h2>Invitados</h2>
            <ul class="lista-invitados clearfix">

                <?php while($invitados = $resultado->fetch_assoc() ) { ?>

                    <li>
                        <div class="invitado">
                            <a class="invitado-info" href="#invitado<?php echo $invitados['invitado_id']?>">
                                <img src="img/ImagenesSitioWeb/<?php echo $invitados['url_imagen'] ?>" alt="imagen invitado">
                                <p><?php echo $invitados['nombre'] . " " . $invitados['apellido'] ?></p>
                            </a>
                        </div>
                    </li>
                    <div style="display:none;">
                        <div class="invitado-info" id="invitado<?php echo $invitados['invitado_id']; ?>">
                            <h2><?php echo $invitados['nombre'] . " " . $invitados['apellido']?></h2>
                            <img src="img/ImagenesSitioWeb/<?php echo $invitados['url_imagen'] ?>" alt="imagen invitado">
                            <p><?php echo $invitados['descripcion'] ?></p>
                        </div>
                    </div>

                    <!-- <pre>
                        <?php // var_dump($invitados)?>
                    </pre> -->

                <?php } ?>
            </ul>

        </section> <!-- .invitados -->

        <?php $conn->close(); ?>