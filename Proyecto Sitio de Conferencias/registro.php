    <?php include_once "includes/templates/header.php" ?>

    <section class="seccion contenedor">
      <h2>Registro de Usuarios</h2>
      <form id="registro" class="registro" action="pagar.php" method="post">
        <div id="datos_usuario" class="registro caja clearfix">
          <div class="campo">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" placeholder="Nombre">
          </div>

          <div class="campo">
            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" placeholder="Apellido">
          </div>

          <div class="campo">
            <label for="email">eMail:</label>
            <input type="text" id="eMail" name="eMail" placeholder="eMail">
          </div>

          <div id="error"></div>

        </div> <!-- fin datos usuario -->


        <div id="paquetes" class="paquetes">
          <h3>Elige el número de boletos</h3>
          <ul class="lista-precios clearfix">
            <li>
              <div class="tabla-precios">
                <h3>Pase por día (Viernes)</h3>
                <p class="numero">$30</p>
                <ul>
                  <li>Bocadillos gratis</li>
                  <li>Todas las conferencias</li>
                  <li>Todos los talleres</li>
                </ul>
                <div class="orden">
                  <label for="pase_dia">Boletos deseados</label>
                  <input type="number" id="pase_dia" min="0" size="3" name="boletos[un_dia][cantidad]" placeholder="0">
                  <input type="hidden" value="30" name="boletos[un_dia][precio]">
                </div>
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
                <div class="orden">
                  <label for="pase_completo">Boletos deseados</label>
                  <input type="number" id="pase_completo" min="0" size="3" name="boletos[completo][cantidad]" placeholder="0">
                  <input type="hidden" value="50" name="boletos[completo][precio]">
                </div>
              </div>
            </li>

            <li>
              <div class="tabla-precios">
                <h3>Pase por dos días (Viernes y Sábado)</h3>
                <p class="numero">$45</p>
                <ul>
                  <li>Bocadillos gratis</li>
                  <li>Todas las conferencias</li>
                  <li>Todos los talleres</li>
                </ul>
                <div class="orden">
                  <label for="pase_dosdias">Boletos deseados</label>
                  <input type="number" id="pase_dos_dias" min="0" size="3" name="boletos[dos_dias][cantidad]" placeholder="0">
                  <input type="hidden" value="45" name="boletos[dos_dias][precio]">
                </div>
              </div>
            </li>
          </ul>
        </div><!-- fin paquetes -->

        <div id="eventos" class="eventos clearfix">
          <h3>Elige tus talleres</h3>
          <div class="caja">
            <?php
                try {
                    require_once("includes/funciones/dbconnection.php");
                    $sql = "SELECT e.*, ce.cat_evento, i.nombre, i.apellido FROM eventos e
                              JOIN categoria_evento ce ON e.id_cat_evento = ce.id_categoria
                              JOIN invitados i ON e.id_invitado = i.invitado_id
                          ORDER BY e.fecha_evento, e.id_cat_evento, e.hora_evento";

                  $resultado = $conn->query($sql);
                } catch (Exception $e) {
                    echo "Error: " . $e->getMessage();
                }
                $eventos_dia = array();
                while($eventos = $resultado->fetch_assoc()){
                    $fecha = $eventos['fecha_evento'];
                    setlocale(LC_ALL, 'es_ES');
                    $dia_semana = strftime("%A", strtotime($fecha));
                    $dia = array(
                      'nombre_evento' => $eventos['nombre_evento'],
                      'hora' => $eventos['hora_evento'],
                      'id' => $eventos['evento_id'],
                      'nombre_invitado' => $eventos['nombre'],
                      'apellido_invitado' => $eventos['apellido']
                    );
                    $eventos_dia[$dia_semana]['eventos'][$eventos['cat_evento']][] = $dia;
                }; ?>

              <?php foreach ($eventos_dia as $dia => $eventos) { ?>
                <div id="<?php echo str_replace('á', 'a', $dia); ?>" class="contenido-dia clearfix">
                  <h4><?php echo $dia ?></h4>
                  <?php foreach ($eventos['eventos'] as $tipo => $evento_dia): ?>
                      <div>
                          <p><?php echo $tipo ?>:</p>
                          <?php foreach ($evento_dia as $evento): ?>
                              <label>
                                  <input type="checkbox" name="registro[]" id="<?php echo $evento['id']; ?>" value="<?php echo $evento['id']; ?>">
                                  <time><?php echo date( 'H:i', strtotime($evento['hora']) ); ?></time> <?php echo $evento['nombre_evento']; ?>
                                  <br>
                                  <span class="autor"><?php echo $evento['nombre_invitado'] . " " . $evento['apellido_invitado'];  ?></span>
                              </label>
                          <?php endforeach; ?><!-- end foreach event -->
                      </div>
                  <?php  endforeach;?><!-- end foreach eventos_dia -->
                </div><!--.contenido_dia-->
              <?php }; ?><!-- end foreach eventos -->
          </div><!--.caja-->
        </div><!--#eventos-->

        <div id="resumen" class="resumen clearfix">
          <h3>Pago y extras</h3>

          <div class="caja clearfix">
            <div class="extras">
              <div class="orden">
                <label for="camisa_evento">Camisa del evento $10
                  <small>(promoción 7% de dto)</small>
                </label>
                <br>
                <input type="number" min="0" id="camisa_evento" name="pedido_extra[camisas][cantidad]" placeholder="0">
                <input type="hidden" value="10" name="pedido_extra[camisas][precio]">
              </div> <!-- orden -->
              <div class="orden">
                <label for="etiquetas">Paquete de 10 etiquetas $2
                  <small>(HTML5, CSS3, JavaScript, Chrome, Google)</small>
                </label>
                <br>
                <input type="number" min="0" name="pedido_extra[etiquetas][cantidad]" size="3" id="etiquetas" placeholder="0">
                <input type="hidden" value="2" name="pedido_extra[etiquetas][precio]">
              </div><!-- orden -->
              <div class="orden">
                <label for="regalo">Seleccione un regalo</label>
                <br>
                <select name="regalo" name="regalo" id="regalo" required>
                  <option value="">- Seleccione un regalo -</option>
                  <option value="2">Etiquetas</option>
                  <option value="1">Pulsera</option>
                  <option value="3">Pluma</option>
                </select>
              </div><!-- orden -->
              <div id="boxCalcular">
                <input type="button" id="calcular" class="button" value="Calcular">
              </div>
            </div><!-- extras -->

            <div class="extras">
              <div class="total">
                <p>Resumen:</p>
                <div id="lista-productos"> </div>
                <div>
                  <p>Total:</p>
                  <div id="suma-total"> </div>
                  <input type="hidden" name="total_pedido" id="total_pedido">
                  <input type="submit" id="btnRegistro" name="submit" class="button" value="Pagar" >
                </div>
              </div><!-- total -->
            </div><!-- extras -->
          </div><!-- caja -->
        </div><!-- resumen -->
      </form>
    </section>

    <?php include_once "includes/templates/footer.php" ?>

  </body>

</html>
