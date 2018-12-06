<?php
    // La llamada a las funciones de control de sesióin se hace en cada página que necesite protección,
    // al principio de cualquier otro código de la página
    include_once "funciones/sesiones.php";
    include_once "funciones/funciones.php";
    include_once "templates/header.php";
    include_once "templates/barra.php";
    include_once "templates/navegacion.php";
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Listado de administradores<small></small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Maneja los administradores del sitio en ésta sección</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="registros" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Usuario</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                        try {
                          $sql = "SELECT adminId, adminUsuario, adminNombre FROM administradores";
                          $resultado = $conn->query($sql);
                        } catch (Exception $e) {
                          echo $e->getMessage();
                        }
                        while($admin = $resultado->fetch_assoc()){ ?>
                          <tr>
                            <td><?php echo $admin['adminUsuario'] ?></td>
                            <td><?php echo $admin['adminNombre'] ?></td>
                            <td>
                              <a href="editar-admin.php?id=<?php echo $admin['adminId']; ?>" class="btn bg-orange btn-flat margin"> <i class="fa fa-pencil"></i>
                              <a href="#" data-id=<?php echo $admin['adminId']; ?> data-tipo="admin" class="btn bg-maroon btn-flat margin borrar-registro" > <i class="fa fa-trash"></i>
                              </a>
                          </tr>

                        <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Usuario</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div><!-- /.box -->
        </div>
      </div><!-- /. row -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

<?php
    include_once "templates/footer.php";
?>




