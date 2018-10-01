<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Aprendiendo PHP</title>
    <link href="https://fonts.googleapis.com/css?family=Proza+Libre" rel="stylesheet">

    <link rel="stylesheet" href="css/estilos.css" media="screen" title="no title">
  </head>
  <body>

    <div class="contenedor">
      <h1>Aprendiendo PHP</h1>

        <div class="contenido">
            <h2>Esto es una pruebita</h2>
            <h2>
                <?php
                    $nombre = "Gustavo";
                    echo "Esto es una segunda prueba" . " " . $nombre;
                ?>
            </h2>
        </div>
    </div>




  </body>
</html>
