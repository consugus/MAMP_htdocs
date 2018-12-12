<?php
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
        Formulario para la creación de nuevos eventos
        <small>Llena el formulario para crear un evento</small>
      </h1>
    </section>

    <div class="row">
      <div class="col-md-8">

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Crear evento</h3>
      <div class="box-body">

        <div class="box box-primary">
          <div class="box-header with-border">
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" name="guardar-registro" id="guardar-registro" method="post" action="modelo-evento.php">

            <div class="box-body">

              <div class="form-group">
                <label for="nombre_evento">Categoría del evento: </label>
                <select name="categoria_evento" class="form-control select2" id="">
                  <option value="0"> - Seleccione - </option>
                  <?php //Select a la BD
                      try {
                        $sql = "SELECT * FROM categoria_evento";
                        $resultado = $conn->query($sql);
                        while($cat_evento = $resultado->fetch_assoc()){ ?>

                          <option value="<?php echo $cat_evento['id_categoria']; ?>">
                              <?php echo $cat_evento['cat_evento']; ?>
                          </option>

                        <?php };// End Select a la BD

                      } catch (Exception $e) {
                        echo "Error: ". $e->getMessage();
                      }
                  ?>
                </select>
              </div><!-- Nombre del evento -->

              <div class="form-group">
                <label for="nombre_evento">Nombre del evento: </label>
                <input type="text" class="form-control" id="nombre_evento" name="nombre_evento" placeholder="Ingresa el nombre del evento">
              </div><!-- Nombre del evento -->

              <div class="form-group">
                <label for="fecha_evento">Fecha del evento: </label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="datepicker" name="fecha_evento">
                </div><!-- /.input group -->
              </div><!-- FEcha del evento -->

              <div class="bootstrap-timepicker">
                <div class="form-group">
                  <label>Hora del evento:</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                    <input type="text" class="form-control timepicker" id="hora_evento" name="hora_evento">
                  </div><!-- /.input group -->
                </div><!-- /.form group -->
              </div><!-- Hora del evento -->

              <div class="form-group">
                <label for="nombre_evento">Invitado o Expositor: </label>
                <select name="invitado" class="form-control select2" id="">
                  <option value="0"> - Seleccione - </option>
                  <?php //Select a la BD
                      try {
                        $sql = "SELECT invitado_id as id, concat(apellido, ', ', nombre) as ape_nom FROM invitados  ORDER BY ape_nom";
                        $resultado = $conn->query($sql);
                        while($invitado = $resultado->fetch_assoc()){ ?>

                          <option value="<?php echo $invitado['id']; ?>">
                              <?php echo $invitado['ape_nom']; ?>
                          </option>

                        <?php };// End Select a la BD

                      } catch (Exception $e) {
                        echo "Error: ". $e->getMessage();
                      }
                  ?>
                </select>
              </div><!-- Nombre del evento -->



            </div><!-- /.box-body -->
            <div class="box-footer">
                <input type="hidden" name="registro" value="nuevo">
                <button type="submit" class="btn btn-primary" id="crear-registro">Agregar</button>
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

<script>
    $(function () {
        $('#datepicker').datepicker({
          autoclose: true
        });

        $('.timepicker').timepicker({
          showInputs: false
        })

        //Initialize Select2 Elements
        $('.select2').select2()

    });
</script>




