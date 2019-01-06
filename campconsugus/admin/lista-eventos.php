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
        Listado de eventos<small></small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Maneja los eventos en ésta sección</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="registros" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Nombre del evento</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Categoría</th>
                    <th>Invitado</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                        try {
                            $sql = "SELECT   e.evento_id AS eventoId, ";
		                        $sql .=         "e.nombre_evento, ";
                            $sql .=         "e.fecha_evento, ";
                            $sql .=         "e.hora_evento, ";
                            $sql .=         "ce.cat_evento AS categoria, ";
                            $sql .=         "concat(i.nombre, ' ', i.apellido) AS nom_ape ";
                            $sql .= "FROM eventos e ";
                            $sql .=     "JOIN categoria_evento ce ON e.id_cat_evento = ce.id_categoria ";
                            $sql .=     "JOIN invitados i ON e.id_invitado = i.invitado_id ";
                            $sql .= "ORDER BY e.evento_id ";
                            $resultado = $conn->query($sql);
                        } catch (Exception $e) {
                          echo $e->getMessage();
                        }
                        //$eventos = $resultado->fetch_assoc();
                        // echo "<pre>";
                        //     var_dump( ($eventos) );
                        // echo "</pre>";
                        while($eventos = $resultado->fetch_assoc()){ ?>
                          <tr>
                            <td><?php  echo $eventos['nombre_evento'] ?></td>
                            <td><?php  echo date('d-m-Y', strtotime($eventos['fecha_evento']) ) ?></td>
                            <td><?php  echo date('h:i a', $eventos['hora_evento']) ?></td>
                            <td><?php  echo $eventos['categoria'] ?></td>
                            <td><?php  echo $eventos['nom_ape'] ?></td>
                            <td>
                              <a href="editar-evento.php?id=<?php  echo $eventos['eventoId']; ?>" class="btn bg-orange btn-flat margin"> <i class="fas fa-pencil-alt"></i></a>
                              <a href="#" data-id=<?php  echo $evento['eventoId']; ?> data-tipo="evento" class="btn bg-maroon btn-flat margin borrar-registro" > <i class="fa fa-trash"></i>
                              </a>
                            </td>
                          </tr>

                        <?php  } ?>
                </tbody>
                <tfoot>
                <tr>
                <th>Nombre del evento</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Categoría</th>
                    <th>Invitado</th>
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




