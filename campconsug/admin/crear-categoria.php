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
        Formulario para la creación de categoría de eventos
        <small>Llena el formulario para crear una categoría</small>
      </h1>
    </section>

    <div class="row">
      <div class="col-md-8">

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Crear categoría</h3>
      <div class="box-body">

        <div class="box box-primary">
          <div class="box-header with-border">
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" name="guardar-registro" id="guardar-registro" method="post" action="modelo-categoria.php">

            <div class="box-body">

              <div class="form-group">
                <label for="nombre_categoria">Nombre de la categoría: </label>
                <input type="text" class="form-control" id="nombre_categoria" name="nombre_categoria" placeholder="Ingresa el nombre de la categoría">
              </div><!-- Nombre de la categoría -->

              <div class="form-group">
                <label for="">Icono: </label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-address-book"></i>
                  </div>
                  <input type="text" id="icono" name="icono" placeholder="fa-icon" class="form-control pull-right" data-placement="bottomRight"><!-- form-control icp icp-auto iconpicker-element iconpicker-input -->
                </div>
              </div><!-- Icono -->

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





