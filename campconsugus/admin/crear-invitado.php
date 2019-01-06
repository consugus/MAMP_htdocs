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
  <!-- fontawesome -->
  <!-- Es necesario cargarlo para que funcione el pluggin fontawsome-iconpicker -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
  <!-- fontawesome-iconpicker -->
  <link rel="stylesheet" href="css/fontawesome-iconpicker.min.css">



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Formulario para la creación de invitados a los eventos
        <small>Llena el formulario para crear un nuevo invitado</small>
      </h1>
    </section>

    <div class="row">
      <div class="col-md-8">

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Crear invitado</h3>
      <div class="box-body">

        <div class="box box-primary">
          <div class="box-header with-border">
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" name="guardar-registro" id="guardar-registro-archivo" method="post" action="modelo-invitado.php" enctype="multipart/form-data">

            <div class="box-body">

              <div class="form-group">
                <label for="nombre_categoria">Nombre: </label>
                <input type="text" class="form-control" id="nombre_invitado" name="nombre_invitado" placeholder="Ingresa el nombre del invitado">
              </div><!-- Nombre del invitado -->

              <div class="form-group">
                <label for="nombre_categoria">Apellido: </label>
                <input type="text" class="form-control" id="apellido_invitado" name="apellido_invitado" placeholder="Ingresa el apellido del invitado">
              </div><!-- Apellido del invitado -->

              <div class="form-group">
                <label for="nombre_categoria">Descripción: </label>
                <textarea class="form-control" rows="4" id="descripcion_invitado" name="descripcion_invitado" placeholder="Ingresa la descripción del invitado"></textarea>
              </div><!-- Descripción del invitado -->

              <div class="form-group">
                  <label for="imagen_invitado">Imagen</label>
                  <input type="file" id="imagen_invitado" name="imagen_invitado">
                  <p class="help-block">Seleccione un archivo como imagen para el invitado</p>
              </div><!-- Imagen del invitado -->


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
<!-- fontawesome-iconpicker -->
<script src="js/fontawesome-iconpicker.min.js"></script>

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

    });
</script>





