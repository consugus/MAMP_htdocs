<?php include_once "includes/templates/header.php"?> <!-- incluye el encabezado, leyendo un archivo externo -->

    <section class="seccion contenedor">
      <h2>La mejor conferencia de diseño web en español</h2>
      <p>Magnam architecto exercitationem consequatur dolor aut sit. Saepe aliquid ut voluptatem laborum minus consequatur delectus
        voluptate. Autem et asperiores explicabo beatae.Magnam architecto exercitationem consequatur dolor aut sit. Saepe aliquid
        ut voluptatem laborum minus consequatur delectus voluptate. Autem et asperiores explicabo beatae.</p>
    </section><!-- fin section seccion -->

    <section class="programa">
      <div class="contenedor-video">
        <video autoplay loop poster="img/ImagenesSitioWeb/bg-talleres.jpg">
          <source src="videos/video.mp4" type="video/mp4">
          <source src="videos/video.webm" type="video/webm">
          <source src="videos/video.ogv" type="video/ogv">
        </video>
      </div><!-- fin contenedor-video -->
      <div class="contenido-programa">
        <div class="contenedor">
          <div class="programa-evento">
            <h2>Programa del evento</h2>

        <?php
            try{
                require_once('includes/funciones/dbconnection.php');
                $sql =  " SELECT * FROM `categoria_evento` ";
                $sql .= " ORDER BY `orden` ";
                $resultado = $conn->query($sql);
            } catch(\Exception $e){
                echo $e->getMessage();
            }
        ?>

            <nav class="menu-programa">
            <?php while($cat = $resultado->fetch_array(MYSQLI_ASSOC)) { ?>
                <?php $categoria = $cat['cat_evento'];
                      $icono = $cat['icono'];
                ?>
                <a href="#<?php echo strtolower($categoria) ?>"><i class="fas <?php echo $icono?>"></i> <?php echo $categoria?></a>

              <?php } ?>
            </nav>

            <?php //Multiquery
                try{
                    require_once('includes/funciones/dbconnection.php');
                    $sql =  " SELECT 	e.evento_id AS 'id', ";
                    $sql .= " e.nombre_evento AS 'nombre_evento', ";
                    $sql .= " e.fecha_evento AS 'fecha_evento', ";
                    $sql .= " e.hora_evento AS 'hora_evento', ";
                    $sql .= " ce.cat_evento AS 'cat_evento', ";
                    $sql .= " ce.icono AS 'icono', ";
                    $sql .= " concat(i.nombre, ' ', i.apellido) AS 'Nombre_y_Apellido' ";
                    $sql .= " from eventos e ";
                    $sql .= " join categoria_evento ce on e.id_cat_evento = ce.id_categoria ";
                    $sql .= " join invitados i on e.id_invitado = i.invitado_id ";
                    $sql .= " where ce.cat_evento = ";
                    $sqlMedio1 = " 'Conferencias' ";
                    $sqlMedio2 = " 'Seminario' ";
                    $sqlMedio3 = " 'Talleres' ";
                    $sqlFinal = " order by ce.cat_evento, e.fecha_evento LIMIT 2; ";
                  /*  $sql .= " SELECT e.evento_id AS 'id', ";
                    $sql .= " e.nombre_evento AS 'nombre_evento', ";
                    $sql .= " e.fecha_evento AS 'fecha_evento', ";
                    $sql .= " e.hora_evento AS 'hora_evento', ";
                    $sql .= " ce.cat_evento AS 'cat_evento', ";
                    $sql .= " ce.icono AS 'icono', ";
                    $sql .= " concat(i.nombre, ' ', i.apellido) AS 'Nombre_y_Apellido' ";
                    $sql .= " from eventos e ";
                    $sql .= " join categoria_evento ce on e.id_cat_evento = ce.id_categoria ";
                    $sql .= " join invitados i on e.id_invitado = i.invitado_id ";
                    $sql .= " where ce.cat_evento = 'Seminario' ";
                    $sql .= " order by ce.cat_evento, e.fecha_evento LIMIT 2; ";
                    $sql .= " SELECT e.evento_id AS 'id', ";
                    $sql .= " e.nombre_evento AS 'nombre_evento', ";
                    $sql .= " e.fecha_evento AS 'fecha_evento', ";
                    $sql .= " e.hora_evento AS 'hora_evento', ";
                    $sql .= " ce.cat_evento AS 'cat_evento', ";
                    $sql .= " ce.icono AS 'icono', ";
                    $sql .= " concat(i.nombre, ' ', i.apellido) AS 'Nombre_y_Apellido' ";
                    $sql .= " from eventos e ";
                    $sql .= " join categoria_evento ce on e.id_cat_evento = ce.id_categoria ";
                    $sql .= " join invitados i on e.id_invitado = i.invitado_id ";
                    $sql .= " where ce.cat_evento = 'Talleres' ";
                    $sql .= " order by ce.cat_evento, e.fecha_evento LIMIT 2; "; */

                    $result1 = $conn->query($sql . $sqlMedio1 . $sqlFinal); // Conferencias
                    $result2 = $conn->query($sql . $sqlMedio2 . $sqlFinal); // Seminario
                    $result3 = $conn->query($sql . $sqlMedio3 . $sqlFinal); // Talleres
                } catch(\Exception $e){
                    echo $e->getMessage();
                }
            ?>

            <?php // Código php para el menú de Conferencias
                $i = 0;
                while($evento = $result1->fetch_assoc()) {
                  if($i == 0){ ?>
                    <div id="<?php echo strtolower(($evento["cat_evento"]))?>" class="info-curso ocultar clearfix">
            <?php // Código php para el menú de Converencias
                  $i = 1;
                  } // cierra el if de la categoría?>
                        <div class="detalle-evento">
                          <h3><?php echo utf8_encode($evento['nombre_evento']) ?></h3>
                          <p><i class="far fa-clock"></i> <?php echo $evento['hora_evento'] ?></p>
                          <p><i class="fas fa-calendar-alt"></i> <?php echo $evento['fecha_evento'] ?></p>
                          <p><i class="fas fa-user"></i> <?php echo $evento['Nombre_y_Apellido'] ?></p>
                        </div>
              <?php  } // cierra el while
                  if($i = 1){ ?>
                    <a href="calendario.php" class="button float-rigth">Ver Todos</a>
              <?php  } // cierra el if del botón ?>
                  </div>
            <!-- fin conferencias -->

            <?php // Código php para el menú de Seminarios
                $i = 0;
                while($evento = $result2->fetch_assoc()) {
                  if($i == 0){ ?>
                    <div id="<?php echo strtolower(($evento["cat_evento"]))?>" class="info-curso ocultar clearfix">
            <?php // Código php para el menú de Seminarios
                  $i = 1;
                  } // cierra el if de la categoría?>
                        <div class="detalle-evento">
                          <h3><?php echo utf8_encode($evento['nombre_evento']) ?></h3>
                          <p><i class="far fa-clock"></i> <?php echo $evento['hora_evento'] ?></p>
                          <p><i class="fas fa-calendar-alt"></i> <?php echo $evento['fecha_evento'] ?></p>
                          <p><i class="fas fa-user"></i> <?php echo $evento['Nombre_y_Apellido'] ?></p>
                        </div>
              <?php  } // cierra el while
                  if($i = 1){ ?>
                    <a href="calendario.php" class="button float-rigth">Ver Todos</a>
              <?php  } // cierra el if del botón ?>
                  </div>

            <!-- fin seminarios -->

            <?php // Código php para el menú de Talleres
                $i = 0;
                while($evento = $result3->fetch_assoc()) {
                  if($i == 0){ ?>
                    <div id="<?php echo strtolower(($evento["cat_evento"]))?>" class="info-curso ocultar clearfix">
            <?php // Código php para el menú de Talleres
                  $i = 1;
                  } // cierra el if de la categoría?>
                        <div class="detalle-evento">
                          <h3><?php echo utf8_encode($evento['nombre_evento']) ?></h3>
                          <p><i class="far fa-clock"></i> <?php echo $evento['hora_evento'] ?></p>
                          <p><i class="fas fa-calendar-alt"></i> <?php echo $evento['fecha_evento'] ?></p>
                          <p><i class="fas fa-user"></i> <?php echo $evento['Nombre_y_Apellido'] ?></p>
                        </div>
              <?php  } // cierra el while
                  if($i = 1){ ?>
                    <a href="calendario.php" class="button float-rigth">Ver Todos</a>
              <?php  } // cierra el if del botón ?>
                  </div>
            <!-- fin seminarios -->

          <!-- Código HTML viejo con el Programa de los eventos
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
            </div>
            -->
            <!-- .seminarios -->

            <!--
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
            </div>-->
            <!-- .talleres -->

            <!--
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
            </div>-->
            <!-- .conferencias -->









          </div><!-- .programa-evento -->
        </div><!-- .contenedor -->
      </div><!-- .contenido-programa -->
    </section><!-- .programa -->


    <!-- se reemplazó la funcionalidad hecha toda a mano con html por php -->
    <?php include_once 'includes/templates/invitados.php'?>


    <!-- #region código HTML comentado porque fué reemplazado por invitados.php
    <section class="invitados contenedor seccion">
      <h2>Nuestros Invitados</h2>
      <ul class="lista-invitados clearfix">
        <li>
          <div class="invitado">
            <img src="img/ImagenesSitioWeb/invitado1.jpg" alt="imagen invitado">
            <p>Rafael Bautista</p>
          </div>
        </li>
        <li>
          <div class="invitado">
            <img src="img/ImagenesSitioWeb/invitado2.jpg" alt="imagen invitado">
            <p>Shari Herrera</p>
          </div>
        </li>
        <li>
          <div class="invitado">
            <img src="img/ImagenesSitioWeb/invitado3.jpg" alt="imagen invitado">
            <p>Gregorio Sánchez</p>
          </div>
        </li>
        <li>
          <div class="invitado">
            <img src="img/ImagenesSitioWeb/invitado4.jpg" alt="imagen invitado">
            <p>Susana Rivera</p>
          </div>
        </li>
        <li>
          <div class="invitado">
            <img src="img/ImagenesSitioWeb/invitado5.jpg" alt="imagen invitado">
            <p>Harold García</p>
          </div>
        </li>
        <li>
          <div class="invitado">
            <img src="img/ImagenesSitioWeb/invitado6.jpg" alt="imagen invitado">
            <p>Susan Sánchez</p>
          </div>
        </li>
      </ul>

    </section> .expositores
    #endregion
    -->

    <section>
      <div class="contador parallax">
        <ul class="resumen-evento clearfix">
          <li><p class="numero">0</p>Invitados</li>
          <li><p class="numero">0</p>Talleres</li>
          <li><p class="numero">0</p>Días</li>
          <li><p class="numero">0</p>Conferencias</li>
        </ul>
      </div>
    </section><!-- seccion parallax -->

    <section class="precios seccion">
      <h2>Precios</h2>
      <div class="contenedor">
        <ul class="lista-precios clearfix">
          <li>
            <div class="tabla-precios">
              <h3>Pase por día</h3>
              <p class="numero">$30</p>
              <ul>
                <li>Bocadillos gratis</li>
                <li>Todas las conferencias</li>
                <li>Todos los talleres</li>
              </ul>
              <a href="#" class="button hollow">Comprar</a>
            </div>
          </li>

          <li>
              <div class="tabla-precios">
                <h3>Todos los días</h3>
                <p class="numero">$50</p>
                <ul>
                  <li>Bocadillos gratis</li>
                  <li>Todas las conferencias</li>
                  <li>Todos los talleres</li>
                </ul>
                <a href="#" class="button">Comprar</a>
              </div>
            </li>

            <li>
                <div class="tabla-precios">
                  <h3>Pase por dos día</h3>
                  <p class="numero">$45</p>
                  <ul>
                    <li>Bocadillos gratis</li>
                    <li>Todas las conferencias</li>
                    <li>Todos los talleres</li>
                  </ul>
                  <a href="#" class="button hollow">Comprar</a>
                </div>
              </li>
        </ul>

      </div>

    </section><!-- seccion precios -->

    <section class="contenedor">
      <div class="mapa" id="mapa"></div>
    </section> <!-- Mapa -->

    <section class="seccion ">
      <div class="testimoniales contenedor clearfix">
        <h2>Testimoniales</h2>
        <div class="testimonial">
          <blockquote>
              <p>Consequuntur repellendus iure commodi esse dicta. At et voluptas quidem
                  corporis ipsam dicta. Sunt eos quia quas repellat itaque. Consequuntur
                  repellendus iure commodi esse dicta. At et voluptas quidem corporis ipsam
                  dicta. Sunt eos quia quas repellat itaque.</p>
              <footer class="info-testimonial clearfix">
                <img src="img/ImagenesSitioWeb/invitado1-cuadrado.jpg" alt="imagen testimonial">
                <cite>Oswaldo Aponte Escobedo <span>Diseñador en @prisma</span></cite>
              </footer>
          </blockquote>
        </div><!-- testimonial -->
        <div class="testimonial">
            <blockquote>
                <p>Consequuntur repellendus iure commodi esse dicta. At et voluptas quidem
                    corporis ipsam dicta. Sunt eos quia quas repellat itaque. Consequuntur
                    repellendus iure commodi esse dicta. At et voluptas quidem corporis ipsam
                    dicta. Sunt eos quia quas repellat itaque.</p>
                <footer class="info-testimonial clearfix">
                  <img src="img/ImagenesSitioWeb/invitado1-cuadrado.jpg" alt="imagen testimonial">
                  <cite>Oswaldo Aponte Escobedo <span>Diseñador en @prisma</span></cite>
                </footer>
            </blockquote>
          </div><!-- testimonial -->
          <div class="testimonial">
              <blockquote>
                <p>Consequuntur repellendus iure commodi esse dicta. At et voluptas quidem
                  corporis ipsam dicta. Sunt eos quia quas repellat itaque. Consequuntur
                  repellendus iure commodi esse dicta. At et voluptas quidem corporis ipsam
                  dicta. Sunt eos quia quas repellat itaque.</p>
                <footer class="info-testimonial clearfix">
                    <img src="img/ImagenesSitioWeb/invitado1-cuadrado.jpg" alt="imagen testimonial">
                    <cite>Oswaldo Aponte Escobedo <span>Diseñador en @prisma</span></cite>
                  </footer>
              </blockquote>
            </div><!-- testimonial -->
        </div>
    </section><!-- seccion testimoniales -->

    <section>
      <div class="newsletter parallax">
        <div class="contenedor contenido">
          <p>Regístrate al newsletter</p>
          <h3>gldWebCamp</h3>
          <a href="#" class="button transparent">Registro</a>

        </div>
      </div>
    </section><!-- seccion newsletters -->

    <section class="seccion">
      <h2>Faltan</h2>
      <div class="cuenta-regresiva contenedor">
        <ul class="clearfix">
          <li><p id="dias" class="numero"></p> días</li>
          <li><p id="horas" class="numero"></p> horas</li>
          <li><p id="min" class="numero"></p> minutos</li>
          <li><p id="seg" class="numero"></p> seguntos</li>
        </ul>
      </div>
    </section><!-- seccion contador regresivo -->

    <script src="js/cargaMapa.js"></script>
    <?php include_once "includes/templates/footer.php" ?> <!-- Incluye el footer de la página, leyendo un archivo externo -->

  </body>

</html>