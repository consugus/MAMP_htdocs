<?php
    // La llamada a las funciones de control de sesión se hace en cada página que necesite protección,
    // al principio de cualquier otro código de la página
    include_once "funciones/sesiones.php";
    include_once "funciones/funciones.php";
    include_once "templates/header.php";
    include_once "templates/barra.php";
    include_once "templates/navegacion.php";
?>

<link rel="stylesheet" href="css/morris.css">


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        DASHBOARD
        <small>Información sobre el evento</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="row">
      <div class="box-body chart-responsive">
          <div class="chart" id="grafica_registros" style="height: 300px;"></div>
      </div>
    </div><!-- .end row -->

    <h2 class="page-header">Registrados</h2>
      <div class="row">

          <div class="col-lg-3 col-xs-6">
            <?php
              $sql = "SELECT COUNT(id_registrado) AS 'recuento_registrados' FROM registrados ";
              $resultado = $conn->query($sql);
              $registrados = $resultado->fetch_assoc();
            ?>
            <!-- small box -->
            <div class="small-box bg-aqua">
              <div class="inner">
                <h3><?php echo $registrados['recuento_registrados'] ?></h3>
                <p>Total registrados</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-plus"></i>
              </div>
              <a href="lista-registrados.php" class="small-box-footer">
                Más información &nbsp<i class="fa fa-arrow-circle-right"></i>
              </a>
            </div>
          </div><!-- end Total registrados -->

          <div class="col-lg-3 col-xs-6">
            <?php
              $sql = "SELECT COUNT(id_registrado) AS 'recuento_registrados_pagados' FROM registrados WHERE pagado = 1 ";
              $resultado = $conn->query($sql);
              $registrados = $resultado->fetch_assoc();
            ?>
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3><?php echo $registrados['recuento_registrados_pagados'] ?></h3>
                <p>Total registrados pagados</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
              <a href="lista-registrados.php" class="small-box-footer">
                Más información &nbsp<i class="fa fa-arrow-circle-right"></i>
              </a>
            </div>
          </div><!-- end Total registrados Pagados -->

          <div class="col-lg-3 col-xs-6">
            <?php
              $sql = "SELECT COUNT(id_registrado) AS 'recuento_registrados_noPagados' FROM registrados WHERE pagado = 0 ";
              $resultado = $conn->query($sql);
              $registrados = $resultado->fetch_assoc();
            ?>
            <!-- small box -->
            <div class="small-box bg-red">
              <div class="inner">
                <h3><?php echo $registrados['recuento_registrados_noPagados'] ?></h3>
                <p>Total registrados no pagados</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-times"></i>
              </div>
              <a href="lista-registrados.php" class="small-box-footer">
                Más información &nbsp<i class="fa fa-arrow-circle-right"></i>
              </a>
            </div>
          </div><!-- End Registrados no pagados -->

          <div class="col-lg-3 col-xs-6">
            <?php
              $sql = "SELECT SUM(total_pagado) AS total_pagado FROM registrados WHERE pagado = 1 ";
              $resultado = $conn->query($sql);
              $registrados = $resultado->fetch_assoc();
            ?>
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                <h3>U$D <?php echo number_format( (float)$registrados['total_pagado'], 2, '.', '' ) ?></h3>
                <p>Recaudado</p>
              </div>
              <div class="icon">
              <i class="fas fa-dollar-sign"></i>
              </div>
              <a href="lista-registrados.php" class="small-box-footer">
                Más información &nbsp <i class="fa fa-arrow-circle-right"></i>
              </a>
            </div>
          </div><!-- End Recaudado -->

      </div><!-- End .row -->

      <br><br>

      <h2 class="page-header">Regalos</h2>

      <div class="row">

          <div class="col-lg-4 col-xs-6">
            <?php
              $sql = "SELECT COUNT(regalo) AS 'pulseras' FROM registrados WHERE regalo = 1 AND pagado = 1";
              $resultado = $conn->query($sql);
              $registrados = $resultado->fetch_assoc();
            ?>
            <!-- small box -->
            <div class="small-box bg-teal">
              <div class="inner">
                <h3><?php echo $registrados['pulseras'] ?></h3>
                <p>Total pulseras</p>
              </div>
              <div class="icon">
                <i class="fas fa-gift"></i>
              </div>
              <a href="lista-registrados.php" class="small-box-footer">
                Más información &nbsp<i class="fa fa-arrow-circle-right"></i>
              </a>
            </div>
          </div><!-- end Total etiquetas -->

          <div class="col-lg-4 col-xs-6">
            <?php
              $sql = "SELECT COUNT(regalo) AS 'etiquetas' FROM registrados WHERE regalo = 2 AND pagado = 1";
              $resultado = $conn->query($sql);
              $registrados = $resultado->fetch_assoc();
            ?>
            <!-- small box -->
            <div class="small-box bg-purple-active">
              <div class="inner">
                <h3><?php echo $registrados['etiquetas'] ?></h3>
                <p>Total etiquetas</p>
              </div>
              <div class="icon">
                <i class="fas fa-gift"></i>
              </div>
              <a href="lista-registrados.php" class="small-box-footer">
                Más información &nbsp<i class="fa fa-arrow-circle-right"></i>
              </a>
            </div>
          </div><!-- end Total etiquetas -->

          <div class="col-lg-4 col-xs-6">
            <?php
              $sql = "SELECT COUNT(regalo) AS 'plumas' FROM registrados WHERE regalo = 3 AND pagado = 1";
              $resultado = $conn->query($sql);
              $registrados = $resultado->fetch_assoc();
            ?>
            <!-- small box -->
            <div class="small-box bg-light-blue">
              <div class="inner">
                <h3><?php echo $registrados['plumas'] ?></h3>
                <p>Total plumas</p>
              </div>
              <div class="icon">
                <i class="fas fa-gift"></i>
              </div>
              <a href="lista-registrados.php" class="small-box-footer">
                Más información &nbsp<i class="fa fa-arrow-circle-right"></i>
              </a>
            </div>
          </div><!-- end Total plumas -->

      </div><!-- End .row -->



    </section> <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->




<?php
    include_once "templates/footer.php";
?>

 <!-- morris chart.js -->
<script src="js/raphael.min.js"></script>
<script src="js/morris.js"></script>


