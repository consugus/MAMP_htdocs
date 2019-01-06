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
        Listado de invitados<small></small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Maneja los invitados en ésta sección</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="registros" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Nombre y apellido </th>
                    <th>Descripción</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                        try {
                            // $sql = "SELECT cat_evento AS nombre, icono, orden FROM categoria_evento ORDER BY orden ";
                            $sql = "SELECT * FROM invitados ";
                            $resultado = $conn->query($sql);
                        } catch (Exception $e) {
                          echo $e->getMessage();
                        }
                        // $categorias = $resultado->fetch_assoc();
                        // echo "<pre>";
                        //     var_dump( ($categorias) );
                        // echo "</pre>";
                        while($invitados = $resultado->fetch_assoc()){ ?>
                            <tr>
                                <td><?php  echo $invitados['nombre'] . " " . $invitados['apellido']; ?></td>
                                <td><?php  echo $invitados['descripcion']; ?></td>
                                <td><img src="../img/invitados/<?php echo $invitados['url_imagen'] ?>" alt="" width="100"></td>

                                <td>
                                  <a href="editar-invitado.php?id=<?php  echo $invitados['invitado_id']; ?>" class="btn bg-orange btn-flat margin"><i class="fas fa-pencil-alt"></i></a>
                                  <a href="#" data-id=<?php echo $invitados['invitado_id']; ?> data-tipo="invitado" class="btn bg-maroon btn-flat margin borrar-registro" > <i class="fa fa-trash"></i></a>
                                </td>
                            </tr>

                        <?php  } ?>
                </tbody>
                <tfoot>
                <tr>
                    <th>Nombre y apellido </th>
                    <th>Descripción</th>
                    <th>Imagen</th>
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




