<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>GldWebCamp</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="manifest" href="site.webmanifest">
  <link rel="apple-touch-icon" href="icon.png">
  <!-- Place favicon.ico in the root directory -->

  <!-- <link rel="stylesheet" href="css/normalize.css"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">  
  <!-- <link rel="stylesheet" href="css/font-awesome.min.css"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans|Oswald|PT+Sans" rel="stylesheet">
  <link rel="stylesheet" href="css/all.min.css">
  
  <link rel="stylesheet" href="css/main.css">

  <!-- Para que funcione anno.js -->
  <link rel="stylesheet" href="css/anno.css">

  <?php
      // almacena en archivo el nombre de la página que está abierta
      // en nuestro proyecto una página podra ser invitados.php
      $archivo = basename($_SERVER['PHP_SELF']); // <-- almacenará 'invitados.php'


      // str_replace(find, replace, string)
      // find    -> texto a buscar para reemplazar
      // replace -> texto con lo que se va a reemplazar la parte encontrada
      // string  -> cadena donde se va a aplicar find y replace
      // el resultado es que $pagina contendrá "invitado"
      $pagina = str_replace(".php", "", $archivo);
      if($pagina == 'invitados' || $pagina == 'index'){
        echo '<link rel="stylesheet" href="css/colorbox.css">';
      } else if ($pagina == 'conferencia') {
        echo '<link rel="stylesheet" href="css/lightbox.css">';
      } else if($pagina == "index"){
        echo '<link rel="stylesheet" href="css/leaflet.css">';
      }
   ?>

  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.3/dist/leaflet.css" />
</head>

  <body class="<?php echo $pagina; ?>">
    <!--[if lte IE 9]>
      <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->

    <header class="site-header">
      <div class="hero">
        <nav class="redes-sociales">
          <a href="https://www.facebook.com/" target=”_blank”><i class="fab fa-facebook-f"></i></a>
          <a href="https://twitter.com/login?lang=es" target=”_blank”><i class="fab fa-twitter"></i></a>
          <a href="https://ar.pinterest.com/" target=”_blank”><i class="fab fa-pinterest-p"></i></a>
          <a href="https://www.youtube.com/" target=”_blank”><i class="fab fa-youtube"></i></a>
          <a href="https://www.instagram.com/" target=”_blank”><i class="fab fa-instagram"></i></a>
        </nav>
        <div class="informacion-evento">
          <div class="clearfix">
            <p class="fecha"><i class="fas fa-calendar-alt"></i> 10-12 Dic</p>
            <p class="ciudad"><i class="fas fa-map-marker-alt"></i> Córdoba, AR</p>
          </div>
          <h1 class="nombre-sitio">gdlwebcamp</h1>
          <p class="slogan">la mejor conferencia de<span> diseño web</span></p>
        </div><!-- Información del evento -->
      </div><!-- hero -->
    </header>

    <div class="barra">
      <div class="contenedor clearfix">
        <div class="logo">
          <a href="index.php">
            <img src="img/logo.svg" alt="logo gdlwebcamp">
          </a>
        </div>
        <div class="menu-movil">
          <span></span>
          <span></span>
          <span></span>
        </div>

        <nav class="navegacion-principal hidden">
          <a href="#" id="tour">Iniciar Tour</a>
          <a href="conferencia.php">Conferencia</a>
          <a href="calendario.php">Calendario</a>
          <a href="invitados.php">Invitados</a>
          <a href="registro.php">Reservaciones</a>
        </nav>
      </div>
    </div>
    <!-- fin barra de Navegación  -->