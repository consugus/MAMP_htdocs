<footer class="site-footer">
      <div class="contenedor clearfix">
        <div class="footer-informacion">
          <h3>Sobre <span>gdlwebcamp</span></h3>
          <p>Quae ad modi quis occaecati sunt consectetur possimus ratione. Ipsum suscipit maxime dolor eaque. Animi voluptate tempora
            et atque soluta porro autem quod. Et rem libero cupiditate dolores libero facilis provident velit. In ut illo voluptate
            ab. Perferendis in aut debitis. Vero dolor iusto consequatur in. Est eum officiis maiores beatae voluptate sunt reiciendis.
            Sit mollitia quia est suscipit velit vel doloribus dicta. Dolorum tenetur dolorem et eaque molestiae. Voluptatem minima
            consectetur. Dolorem officia accusantium.</p>
        </div>
        <div class="ultimos-tweets">
            <h3>Últimos <span>tweets</span></h3>
            <ul>
              <li><p>Dolorem rerum quos voluptates facilis tempore. Quaerat voluptas aut et qui est sit minus. Exercitationem assumenda minus
                  nesciunt veniam commodi saepe ea non eaque. </p></li>
              <li><p>Dolorem rerum quos voluptates facilis tempore. Quaerat voluptas aut et qui est sit minus. Exercitationem assumenda minus
                  nesciunt veniam commodi saepe ea non eaque. </p></li>
              <li><p>Dolorem rerum quos voluptates facilis tempore. Quaerat voluptas aut et qui est sit minus. Exercitationem assumenda minus
                  nesciunt veniam commodi saepe ea non eaque. </p></li>
            </ul>
          </div>
        <div class="menu">
          <h3>Redes <span>sociales</span></h3>
          <nav class="redes-sociales">
            <a href="https://www.facebook.com/" target=”_blank”><i class="fab fa-facebook-f"></i></a>
            <a href="https://twitter.com/login?lang=es" target=”_blank”><i class="fab fa-twitter"></i></a>
            <a href="https://ar.pinterest.com/" target=”_blank”><i class="fab fa-pinterest-p"></i></a>
            <a href="https://www.youtube.com/" target=”_blank”><i class="fab fa-youtube"></i></a>
            <a href="https://www.instagram.com/" target=”_blank”><i class="fab fa-instagram"></i></a>
        </nav>
        </div>
      </div>

      <p class="copywrigth">
        Todos los derechos reservados GLDWBCAMP 2016.
      </p>

    </footer><!-- seccion site-footer -->

        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous"></script>
    <script>
      window.jQuery || document.write('<script src="js/vendor/jquery-3.3.1.min.js"><\/script>')
    </script>
    <script src="js/plugins.js"></script>
    <script src="https://unpkg.com/leaflet@1.3.3/dist/leaflet.js"></script>
    <script src="js/jquery.animateNumber.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/jquery.lettering.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>

    <?php
        // almacena en archivo el nombre de la página que está abierta
        // en nuestro proyecto una página podra ser invitados.php
        $archivo = basename($_SERVER['PHP_SELF']); // <-- almacenará 'invitados.php'


        $pagina = str_replace(".php", "", $archivo);  // str_replace(find, replace, string)
                                                      // find    -> texto a buscar para reemplazar
                                                      // replace -> texto con lo que se va a reemplazar la parte encontrada
                                                      // string  -> cadena donde se va a aplicar find y replace
                                                      // el resultado es que $pagina contendrá "invitado"

        if($pagina == 'invitados' || $pagina == 'index'){
          echo '<script src="js/jquery.colorbox-min.js"></script>';
        } else if ($pagina = 'conferencia') {
          echo '<script src="js/lightbox.js"></script>';
        }
    ?>

    <script src="js/main.js"></script>


    <!--
      Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
    <!-- <script>
      window.ga = function () {
        ga.q.push(arguments)
      };
      ga.q = [];
      ga.l = +new Date;
      ga('create', 'UA-XXXXX-Y', 'auto');
      ga('send', 'pageview')
    </script>
    <script src="https://www.google-analytics.com/analytics.js" async defer></script>
    -->