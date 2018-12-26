<?php
    // Si el id no es válido muestra un mensaje de error. Caso contrario se muestra el formulario de edición
    $id = (int)$_GET['id'];
    if(!filter_var($id, FILTER_VALIDATE_INT) ){
      die('Error');
    }

    // La llamada a las funciones de control de sesióin se hace en cada página que necesite protección,
    // al principio de cualquier otro código de la página
    include_once "funciones/sesiones.php";
    include_once "templates/header.php";
    include_once "funciones/funciones.php";
    include_once "templates/barra.php";
    include_once "templates/navegacion.php";
?>

  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="css/bootstrap-datepicker.min.css">
  <!-- bootstrap timepicker -->
  <link rel="stylesheet" href="css/bootstrap-timepicker.min.css">
  <!-- select2 -->
  <link rel="stylesheet" href="css/select2.min.css">
  <!-- fontawesome -->
  <!-- Es necesario cargarlo para que funcione el pluggin fontawsome-iconpicker -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
  <!-- fontawesome-iconpicker -->
  <link rel="stylesheet" href="css/fontawesome-iconpicker.min.css">
  <!-- fontawesome-iconpicker -->
  <link rel="stylesheet" href="css/icheck.css">



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Formulario para la edición de usuarios registrados
        <small>Llena el formulario para editar un usuario registrado</small>
      </h1>
    </section>

    <div class="row">
      <div class="col-md-8">

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Editar usuario registrado</h3>
      <div class="box-body">

        <?php
              $sql = "SELECT * FROM registrados WHERE id_registrado = $id ";
              $resultado = $conn->query($sql);
              $registrado = $resultado->fetch_assoc();
              // echo "<pre>";
              //   var_dump($registrado);
              // echo "<pre>";
          ?>

        <div class="box box-primary">
          <div class="box-header with-border">
        </div><!-- /.box-header -->

          <!-- form start -->
          <form role="form" class="editar-registrado" name="guardar-registro" id="guardar-registro" method="post" action="modelo-registrado.php">

            <div class="box-body">

              <div class="form-group">
                <label for="nombre_registrado">Nombre : </label>
                <input type="text" class="form-control" id="nombre" name="nombre_registrado" placeholder="Nombre" value="<?php echo $registrado['nombre_registrado']; ?>">
              </div><!-- Nombre de la categoría -->

              <div class="form-group">
                <label for="apellido_registrado">Apellido : </label>
                <input type="text" class="form-control" id="apellido" name="apellido_registrado" placeholder="Apellido" value="<?php echo $registrado['apellido_registrado']; ?>">
              </div><!-- Nombre de la categoría -->

              <div class="form-group">
                <label for="email_registrado">Email : </label>
                <input type="email" class="form-control" id="eMail" name="email_registrado" placeholder="Email" value="<?php echo $registrado['email_registrado']; ?>">
              </div><!-- Nombre de la categoría -->

              <?php
                  $pedido = $registrado['pases_articulos'];
                  $pedido = json_decode($pedido, true);
                  // echo "<pre>";
                  //   var_dump( $pedido );
                  // echo "</pre>";



              ?>


              <div class="form-group">
                <div id="paquetes" class="paquetes">
                <div class="box-header with-border">
                  <h3 class="box-title">Elige el número de boletos</h3>
                </div>
                  <ul class="lista-precios clearfix row">
                    <li class="col-md-4">
                      <div class="tabla-precios text-center">
                        <h3>Pase por día (Viernes)</h3>
                        <p class="numero">$30</p>
                        <ul>
                          <li>Bocadillos gratis</li>
                          <li>Todas las conferencias</li>
                          <li>Todos los talleres</li>
                        </ul>
                        <div class="orden">
                          <label for="pase_dia">Boletos deseados</label>
                          <input type="number" class="form-contol" id="pase_dia" min="0" size="3" name="boletos[un_dia][cantidad]" placeholder="0" value="<?php echo $pedido['un_dia']['cantidad'];?>">
                          <input type="hidden" value="30" name="boletos[un_dia][precio]">
                        </div>
                      </div>
                    </li>

                    <li class="col-md-4">
                      <div class="tabla-precios text-center">
                        <h3>Todos los días</h3>
                        <p class="numero">$50</p>
                        <ul>
                          <li>Bocadillos gratis</li>
                          <li>Todas las conferencias</li>
                          <li>Todos los talleres</li>
                        </ul>
                        <div class="orden">
                          <label for="pase_completo">Boletos deseados</label>
                          <input type="number" class="form-contol" id="pase_completo" min="0" size="3" name="boletos[completo][cantidad]" placeholder="0" value="<?php echo $pedido['pase_completo']['cantidad'];?>">
                          <input type="hidden" value="50" name="boletos[completo][precio]">
                        </div>
                      </div>
                    </li>

                    <li class="col-md-4">
                      <div class="tabla-precios text-center">
                        <h3>Pase por dos días (Viernes y Sábado)</h3>
                        <p class="numero">$45</p>
                        <ul>
                          <li>Bocadillos gratis</li>
                          <li>Todas las conferencias</li>
                          <li>Todos los talleres</li>
                        </ul>
                        <div class="orden">
                          <label for="pase_dosdias">Boletos deseados</label>
                          <input type="number" class="form-contol" id="pase_dos_dias" min="0" size="3" name="boletos[dos_dias][cantidad]" placeholder="0" value="<?php echo $pedido['pase_2dias']['cantidad'];?>">
                          <input type="hidden" value="45" name="boletos[dos_dias][precio]">
                        </div>
                      </div>
                    </li>
                  </ul>
                </div><!-- fin paquetes -->
              </div><!-- end form-group paquetes -->

              <div class="form-group">
                <div class="box-header with-border">
                  <h3 class="box-title">Elige los talleres</h3>
                </div>
                  <div id="eventos" class="eventos clearfix">
                    <div class="caja ">
                      <?php
                          $eventos = $registrado['talleres_registrados'];
                          $id_eventos_registrados = json_decode($eventos, true);

                          try {
                              //require_once("includes/funciones/dbconnection.php");
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
                          <div id="<?php echo str_replace('á', 'a', $dia); ?>" class="contenido-dia clearfix row">
                            <h4 class="text-center nombre_dia"><?php echo $dia ?></h4>
                            <?php foreach ($eventos['eventos'] as $tipo => $evento_dia): ?>
                                <div class="col-md-4">
                                    <p><?php echo $tipo ?>:</p>
                                    <?php foreach ($evento_dia as $evento): ?>
                                        <label>
                                            <input <?php echo (in_array($evento['id'], $id_eventos_registrados['eventos']) ? 'checked' : '' );?> type="checkbox" class="flat-red" name="registro_evento[]" id="<?php echo $evento['id']; ?>" value="<?php echo $evento['id']; ?>">
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

              </div><!-- end form-group talleres -->


              <div id="resumen" class="resumen clearfix">
              <div class="box-header with-border">
                  <h3 class="box-title">Pago y extras</h3>
              </div>

                  <?php
                    // echo "<pre>";
                    //   var_dump($registrado);
                    // echo "<pre>";

                    // echo "<pre>";
                    //   var_dump($id_eventos_registrados);
                    // echo "</pre>";
                  ?>

              <br>
                <div class="caja clearfix row">
                  <div class="extras col-md-6">
                    <div class="orden">
                      <label for="camisa_evento">Camisa del evento $10
                        <small>(promoción 7% de dto)</small>
                      </label>
                      <br>
                      <input type="number" min="0" class="form-control" id="camisa_evento" name="pedido_extra[camisas][cantidad]" placeholder="0" value="<?php echo $pedido['camisas']?>">
                      <input type="hidden" value="10" name="pedido_extra[camisas][precio]">
                    </div> <!-- orden -->
                    <div class="orden">
                      <label for="etiquetas">Paquete de 10 etiquetas $2
                        <small>(HTML5, CSS3, JavaScript, Chrome, Google)</small>
                      </label>
                      <br>
                      <input type="number" min="0"  class="form-control" name="pedido_extra[etiquetas][cantidad]" size="3" id="etiquetas" placeholder="0" value="<?php echo $pedido['etiquetas']?>">>
                      <input type="hidden" value="2" name="pedido_extra[etiquetas][precio]">
                    </div><!-- orden -->
                    <div class="orden">
                      <label for="regalo">Seleccione un regalo</label>
                      <br>
                      <select name="regalo" name="regalo" id="regalo" required class="form-control seleccionar">
                        <option value="">- Seleccione un regalo -</option>
                        <option value="2" <?php echo ($registrado['regalo'] == "2") ? 'selected' : '' ?>  >Etiquetas</option>
                        <option value="1" <?php echo ($registrado['regalo'] == "1") ? 'selected' : '' ?> >Pulsera</option>
                        <option value="3" <?php echo ($registrado['regalo'] == "3") ? 'selected' : '' ?>>Pluma</option>
                      </select>
                    </div><!-- orden -->
                    <br>
                    <div id="boxCalcular">
                      <input type="button" id="calcular" class="btn btn-success" value="Calcular">
                    </div>
                  </div><!-- extras -->

                  <div class="extras col-md-6">
                    <div class="total">
                      <p>Resumen:</p>
                      <p>Pagado anteriormente: <?php echo $registrado['total_pagado'] ?></p>
                      <div id="lista-productos"> </div>
                      <div>
                      
                        <p>Total:</p>
                        <div id="suma-total"> </div>
                        <input type="hidden" name="total_pedido" id="total_pedido">
                        <!-- <input type="submit" id="btnRegistro" name="submit" class="button" value="Pagar" > -->
                      </div>
                    </div><!-- total -->
                  </div><!-- extras -->
                </div><!-- caja -->
              </div><!-- resumen -->



            </div><!-- /.box-body -->
            <div class="box-footer">
                <input type="hidden" name="registro" value="actualizar">
                <!-- <input type="hidden" id="id_registrado" value="<?php echo $registrado['id_registrado']; ?>"> -->
                <!-- <input type="hidden" id="fecha_registro" value="<?php echo $registrado['fecha_registro']; ?>"> -->
                <button type="submit" class="btn btn-primary" id="btnRegistro" >Guardar</button> <!-- id="crear-registro" -->
            </div>
          </form>
        </div><!-- /.box -->

      </div><!-- /.box-body -->
    </div><!-- /.box -->

</section><!-- /.content -->

</div>
</div>



</div>
<!-- /.content-wrapper -->

<?php
    include_once "templates/footer.php";
?>

<!-- bootstrap datepicker -->
<script src="js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap timepicker -->
<script src="js/bootstrap-timepicker.min.js"></script>
<!-- select2 -->
<script src="js/select2.full.min.js"></script>
<!-- fontawesome-iconpicker -->
<script src="js/fontawesome-iconpicker.min.js"></script>
<!-- fontawesome-iconpicker -->
<script src="js/icheck.min.js"></script>

<script>
    $(function() {
        $('#datepicker').datepicker({
          autoclose: true
        });

        $('.timepicker').timepicker({
          showInputs: false
        })

        //Initialize Select2 Elements
        $('.select2').select2()

        $('#icono').iconpicker();

        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-blue',
          radioClass   : 'iradio_flat-blue'
        })

    });
</script>


