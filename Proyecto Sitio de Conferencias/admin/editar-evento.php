<?php
        // Si el id no es válido muestra un mensaje de error. Caso contrario se muestra el formulario de edición
        $id = $_GET['id'];
        if(!filter_var($id, FILTER_VALIDATE_INT) ){
          die('Error');
        } else{

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

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Formulario para la edición de  eventos
        <small>Llena el formulario para editar un evento</small>
      </h1>
    </section>

    <div class="row">
      <div class="col-md-8">

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Editar evento</h3>
      <div class="box-body">

        <div class="box box-primary">
          <div class="box-header with-border">
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" name="guardar-registro" id="guardar-registro" method="post" action="modelo-evento.php">

            <div class="box-body">

              <?php

                  $sql = "SELECT * FROM eventos WHERE evento_id = $id ";
                  $resultado = $conn->query($sql);
                  $evento = $resultado->fetch_assoc();

              ?>

              <div class="form-group">
                <label for="nombre_evento">Nombre del evento: </label>
                <input type="text" class="form-control" id="nombre_evento" name="nombre_evento" placeholder="Ingresa el nombre del evento" value="<?php echo $evento['nombre_evento']; ?>" ?>
              </div><!-- Nombre del evento -->



              <div class="form-group">
                <label for="nombre_evento">Categoría del evento: </label>
                <select name="categoria_evento" class="form-control select2" id="categoria_evento">
                  <option> - Seleccione - </option>
                  <?php //Select a la BD
                      try {
                        $categoria_actual = $evento['id_cat_evento'];
                        $sql = "SELECT * FROM categoria_evento";
                        $resultado = $conn->query($sql);
                        while($cat_evento = $resultado->fetch_assoc()){

                            if( $cat_evento['id_categoria'] == $categoria_actual){ ?>

                                  <option value="<?php echo $cat_evento['id_categoria']; ?>" selected >
                                      <?php echo $cat_evento['cat_evento']; ?>
                                  </option>
                            <?php
                            } else { ?>

                                  <option value="<?php echo $cat_evento['id_categoria']; ?>">
                                      <?php echo $cat_evento['cat_evento']; ?>
                                  </option>
                            <?php
                            }; // end if
                        };// End while

                      } catch (Exception $e) {
                        echo "Error: ". $e->getMessage();
                      }
                  ?>
                </select>
              </div><!-- Categoría del evento -->

              <div class="form-group">
                <label for="fecha_evento">Fecha del evento: </label>

                      <?php
                          $fecha = $evento['fecha_evento'];
                          $fecha = date('m/d/Y', strtotime($fecha) );
                      ?>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="fecha_evento" name="fecha_evento" value=<?php echo $fecha ?>>
                </div><!-- /.input group -->
              </div><!-- Fecha del evento -->

              <div class="bootstrap-timepicker">
                <div class="form-group">
                  <label>Hora del evento:</label>

                      <?php
                          $hora = $evento['hora_evento'];
                          $hora = date( 'H:i', strtotime($hora) );
                      ?>

                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                    <input type="text" class="form-control timepicker" id="hora_evento" name="hora_evento" value=<?php echo $hora ?>>
                  </div><!-- /.input group -->
                </div><!-- /.form group -->
              </div><!-- Hora del evento -->

              <div class="form-group">



                <label for="nombre_evento">Invitado o Expositor: </label>
                <select name="invitado" class="form-control select2" id="invitado">
                  <option value="0"> - Seleccione - </option>
                  <?php //Select a la BD
                      try {
                        $invitado_actual = $evento['id_invitado'];
                        $sql = "SELECT invitado_id as id, concat(apellido, ', ', nombre) as ape_nom FROM invitados  ORDER BY ape_nom";
                        $resultado = $conn->query($sql);
                        while($invitado = $resultado->fetch_assoc()){

                            if($invitado['id'] == $invitado_actual){ ?>
                                <option value="<?php echo $invitado['id']; ?>" selected>
                                    <?php echo $invitado['ape_nom']; ?>
                                </option>
                            <?php
                            } else{ ?>

                                <option value="<?php echo $invitado['id']; ?>">
                                    <?php echo $invitado['ape_nom']; ?>
                                </option>

                            <?php
                            }; // end if
                        };// End while

                      } catch (Exception $e) {
                        echo "Error: ". $e->getMessage();
                      }
                  ?>
                </select>
              </div><!-- Invitado -->



            </div><!-- /.box-body -->
            <div class="box-footer">
                <input type="hidden" name="registro" value="actualizar">
                <input type="hidden" name="id_registro" value="<?php echo $id ?>">
                <button type="submit" class="btn btn-primary" id="crear-registro">Guardar</button>
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
    };
?>

<!-- bootstrap datepicker -->
<script src="js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap timepicker -->
<script src="js/bootstrap-timepicker.min.js"></script>
<!-- select2 -->
<script src="js/select2.full.min.js"></script>

<script>
    $(function () {
        $('#fecha_evento').datepicker({
          autoclose: true
        });

        $('#hora_evento').timepicker({
          showInputs: false
        })

        //Initialize Select2 Elements
        $('#invitado').select2()

    });
</script>




