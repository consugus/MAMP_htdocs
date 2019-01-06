
<?php $conn->multi_query($sql); ?>
<?php
    do {
      $resultado = $conn->store_result();
      $row = $resultado-> fetch_all(MYSQLI_ASSOC);?>

      <?php $i = 0;
            foreach($row as $evento):
                if($i%2 == 0) { ?>
                <div id="<?php echo strtolower($evento['cat_evento']); ?>" class="info-curso ocultar clearfix">
          <?php } ?>

                <div class="detalle-evento">
                <h3><?php echo utf8_encode($evento['nombre_evento']) ?></h3>
                <p><i class="far fa-clock"></i> <?php echo $evento['hora_evento']; ?></p>
                <p><i class="fas fa-calendar-alt"></i> <?php echo $evento['fecha_evento']; ?></p>
                <p><i class="fas fa-user"></i> <?php echo $evento['Nombre_y_Apellido']; ?></p>
                </div>

            <?php if($i%2 == 1): ?>
                    <a href="calendario.php" class="button float-rigth">Ver Todos</a>
                    </div><!-- .talleres -->
            <?php endif;
                $i++;
            endforeach;
            $resultado->free(); ?>


<?php } while ($conn->more_results() && $conn->next_result()); ?>


    <?php
        if(mysqli_multi_query($conn,$sql)){ //esta línea devuelve TRUE -> hubo conexión exitosa y trae algún resultado
            do {
                if ($result=mysqli_store_result($conn)) { // Store first result set
                while ($row=mysqli_fetch_all($result)) // Fetch one and one row

                {

                    // Acá debería estar el código que de formato a los ítems
                    // var_dump($row);


                } // end while
                mysqli_free_result($result);// Free result set
            }
            } while (mysqli_next_result($conn));
        } // end if multiquery
    ?>












            <div id="seminario" class="info-curso ocultar clearfix">
              <div class="detalle-evento">
                <h3>Diseño UI/UX para móviles</h3>
                <p><i class="far fa-clock"></i> 17:00</p>
                <p><i class="fas fa-calendar-alt"></i> 11 de Diciembre</p>
                <p><i class="fas fa-user"></i> Harold García</p>
              </div>
              <div class="detalle-evento">
                <h3>Aprende a programar en una mañana</h3>
                <p><i class="far fa-clock"></i> 10:00</p>
                <p><i class="fas fa-calendar-alt"></i> 11 de Diciembre</p>
                <p><i class="fas fa-user"></i> Susana Rivera</p>
              </div>
              <a href="calendario.php" class="button float-rigth">Ver Todos</a>
            </div><!-- .seminarios -->

            <div id="talleres" class="info-curso ocultar clearfix">
              <div class="detalle-evento">
                <h3>HTML, CSS3 y JavaScript</h3>
                <p><i class="far fa-clock"></i> 16:00</p>
                <p><i class="fas fa-calendar-alt"></i> 10 de Diciembre</p>
                <p><i class="fas fa-user"></i> Gustavo Jorge Ríos</p>
              </div>
              <div class="detalle-evento">
                <h3>Responsive Web Design</h3>
                <p><i class="far fa-clock"></i> 20:00</p>
                <p><i class="fas fa-calendar-alt"></i> 10 de Diciembre</p>
                <p><i class="fas fa-user"></i> Gustavo Jorge Ríos</p>
              </div>
              <a href="calendario.php" class="button float-rigth">Ver Todos</a>
            </div><!-- .talleres -->

            <div id="conferencias" class="info-curso ocultar clearfix">
              <div class="detalle-evento">
                <h3>Cómo ser freelancer</h3>
                <p><i class="far fa-clock"></i> 10:00</p>
                <p><i class="fas fa-calendar-alt"></i> 10 de Diciembre</p>
                <p><i class="fas fa-user"></i> Gregorio Sánchez</p>
              </div>
              <div class="detalle-evento">
                <h3>Tecnologías del futuro</h3>
                <p><i class="far fa-clock"></i> 17:00</p>
                <p><i class="fas fa-calendar-alt"></i> 10 de Diciembre</p>
                <p><i class="fas fa-user"></i> Susana Oria</p>
              </div>
              <a href="calendario.php" class="button float-rigth">Ver Todos</a>
            </div><!-- .conferencias -->