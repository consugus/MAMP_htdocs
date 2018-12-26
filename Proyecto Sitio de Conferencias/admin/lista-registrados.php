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
        Listado de personas registradas<small></small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Maneja los visitantes registrados</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="registros" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>eMail</th>
                    <th>Fecha registro</th>
                    <th>Artículos</th>
                    <th>Talleres</th>
                    <th>Regalo</th>
                    <th>Compra</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                        try {
                            $sql = "SELECT 	r.id_registrado, r.nombre_registrado, r.apellido_registrado, r.email_registrado,
                                            r.fecha_registro, r.pases_articulos, r.talleres_registrados, reg.nombre_regalo,
                                            r.total_pagado, r.pagado
                                    FROM registrados r JOIN regalos reg
                                    ON r.regalo = reg.id_regalo
                                    ORDER BY r.nombre_registrado DESC";
                            $resultado = $conn->query($sql);
                        } catch (Exception $e) {
                          echo $e->getMessage();
                        }
                        // $categorias = $resultado->fetch_assoc();
                        // echo "<pre>";
                        //     var_dump( ($categorias) );
                        // echo "</pre>";
                        while($registrados = $resultado->fetch_assoc()): ?>
                            <tr>
                                <td>
                                    <?php
                                        echo $registrados['nombre_registrado'] . " " . $registrados['apellido_registrado'];
                                        $pagado = $registrados['pagado'];
                                        if($pagado == 1){
                                            echo '<br><span class="badge bg-green"> Pagado</span>';
                                        } else{
                                          echo '<br><span class="badge bg-red"> No pagado</span>';
                                        };
                                    ?>

                                </td>
                                <td><?php  echo $registrados['email_registrado'];?></td>
                                <td><?php  echo date('d/m/Y', strtotime($registrados['fecha_registro']) );?></td>
                                <td>
                                    <?php
                                        $arreglo_articulos = array(
                                          'un_dia' => 'Pase por 1 día',
                                          'pase_2dias' => 'Pase por 2 días',
                                          'pase_completo' => 'Pase completo',
                                          'camisas' => 'Camisas',
                                          'etiquetas' => 'Etiquetas',
                                        );
                                        $articulos = json_decode($registrados['pases_articulos'], true);
                                        foreach ($articulos as $llave => $articulo) {
                                          echo  $articulo . ' ' . $arreglo_articulos[$llave] . '<br>';
                                        } // end foreach articulos
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        $talleres = json_decode($registrados['talleres_registrados'], true);
                                        $talleres = implode("', '", $talleres['eventos']);
                                        $sql = "SELECT nombre_evento, fecha_evento, hora_evento FROM eventos WHERE clave IN ('$talleres') ";
                                        $result = $conn->query($sql);

                                        while($eventos = $result->fetch_assoc()){
                                          echo $eventos['nombre_evento'] . " " . $eventos['fecha_evento'] . " " . $eventos['hora_evento'] . "<br>";
                                        };// end while eventos
                                    ?>
                                </td>
                                <td><?php  echo $registrados['nombre_regalo'];?></td>
                                <td><?php  echo "U\$D " . $registrados['total_pagado'];?></td>
                                <td>
                                  <a href="editar-registrado.php?id=<?php  echo $registrados['id_registrado']; ?>" class="btn bg-orange btn-flat margin"><i class="fas fa-pencil-alt"></i></a>
                                  <a href="#" data-id=<?php echo $registrados['id_registrado']; ?> data-tipo="registrado" class="btn bg-maroon btn-flat margin borrar-registro" > <i class="fa fa-trash"></i></a>
                                </td>
                            </tr>

                        <?php  endwhile ?> <!-- end while registrados -->
                </tbody>
                <tfoot>
                <tr>
                    <th>Nombre</th>
                    <th>eMail</th>
                    <th>Fecha registro</th>
                    <th>Artículos</th>
                    <th>Talleres</th>
                    <th>Regalo</th>
                    <th>Compra</th>
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




