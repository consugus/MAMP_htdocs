<?php include_once 'includes/templates/header.php'; ?>

    <section class="seccion contenedor">
        <h2>Calendario de Eventos</h2>

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
                $sql =  " select 	e.evento_id AS 'id', ";
                $sql .= " e.nombre_evento AS 'nombre_evento', ";
                $sql .= " e.fecha_evento AS 'fecha_evento', ";
                $sql .= " e.hora_evento AS 'hora_evento', ";
                $sql .= " ce.cat_evento AS 'cat_evento', ";
                $sql .= " ce.icono AS 'icono', ";
                $sql .= " concat(i.nombre, ' ', i.apellido) AS 'Nombre_y_Apellido' ";
                $sql .= " from eventos e ";
                $sql .= " join categoria_evento ce on e.id_cat_evento = ce.id_categoria ";
                $sql .= " join invitados i on e.id_invitado = i.invitado_id ";
                $sql .= " order by ce.cat_evento, e.fecha_evento ";

                $resultado = $conn->query($sql);
            } catch(\Exception $e){
                echo $e->getMessage();
            }
        ?>

        <div class="calendario">
            <?php
                $calendario = array();
                while($eventos = $resultado->fetch_assoc()){
                    // obtiene la fecha del evento
                    $fecha = $eventos['fecha_evento'];
                    $evento = array(
                        'titulo' => $eventos['nombre_evento'],
                        'fecha' => $eventos['fecha_evento'],
                        'hora' => $eventos['hora_evento'],
                        'categoria' => $eventos['cat_evento'],
                        'icono' => 'fa' . " " . $eventos['icono'],
                        'invitado' => $eventos['Nombre_y_Apellido']
                    );
                    $calendario[$fecha][] = $evento;
                ?>
            <?php    }; // cierra el while de fetch_assoc  ?>

        <div class="calendario">



            <?php
                // Impresión de todos los eventos
                    foreach($calendario as $dia => $lista_eventos){ ?>

            <h3>
                <i class="fa fa-calendar-alt"></i>
                <?php
                    // Unix
                        setlocale(LC_TIME, 'es_ES.UTF-8', 'esp_esp');
                    // Windows
                        setlocale(LC_TIME, 'spanish');

                        echo strftime("%A, %d de %B del %Y", strtotime($dia));
                ?>
            </h3>

            <?php foreach($lista_eventos as $evento){?>
                <div class="dia">
                    <p class="titulo"> <?php echo utf8_encode($evento['titulo']); ?> </p>
                    <p class="hora"><i class="far fa-clock" aria-hidden="true"></i>
                        <?php echo $evento['fecha'] . " " . $evento['hora'] ?>
                    </p>
                    <p>
                        <i class="<?php echo $evento[icono]; ?> " aria-hidden="true" ></i>
                        <?php echo $evento['categoria']; ?>
                    </p>
                    <p><i class="fa fa-user" aria-hidden="true"></i>
                        <?php echo $evento['invitado']; ?>
                    </p>

                    <!-- <pre>
                        <?php // var_dump($calendario); ?>
                    </pre> -->

                    <br>
                </div>
            <?php  } //fin foreach de eventos ?>
            <?php  } // fin foreach de dias ?>

        </div> <!-- .calendario -->

        </div>

        <?php $conn->close(); ?>

    </section>







<?php include_once 'includes/templates/footer.php'; ?>
