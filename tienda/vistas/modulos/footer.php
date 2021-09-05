 <?php


$servidor = Ruta::ctrRutaServidor();

$url = Ruta::ctrRuta();



  $item = "id";
  $valor = 1;
  $footer = ControladorFooter::ctrMostrarFooter($item,$valor);


?>

<!-- ======= Cta Section ======= -->
    <section id="credito" class="cta" style="background: linear-gradient(rgba(2, 2, 2, 0.7), rgba(0, 0, 0, 0.7)), url('../recursos/img/plantilla/fondo-medio.jpg') fixed center center;">

      <div class="container">

        <div class="text-center" data-aos="zoom-in">
          <h3>Elegí lo que necesites</h3>
          <p> Para cada lugar de tu casa , abril está con vos </p>
        
        </div>

      </div>

    </section><!-- End Cta Section


 ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h2><?php echo $footer['nombre']; ?></h2>
            <p>
              <?php echo $footer['direccion']; ?><br>
              <?php echo $footer['provincia']; ?> | <?php echo $footer['pais']; ?> <br><br>
              <strong>Telefono:</strong> <?php echo $footer['telefono']; ?><br>
              <strong>Email:</strong> <?php echo $footer['email']; ?><br>
            </p>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <br>
            <h4 style="color:#21AD90;">Links Importantes</h4>
            <ul>
              <li>  </li>
              <li><i class="bx bx-chevron-right"></i> <a href="www.abrilamoblamientos.com.ar" target="_blank">Abril Amoblamientos</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#modalIngreso" data-toggle="modal">Mi Tienda</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="ofertas">Ofertas</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="https://formosa.valenziana.com/productos/" target="_blank">La Valenziana </a></li>
              
              
              
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <br>
            <h4 style="color:#21AD90;">Buscar por Rubros</h4>
            <ul>
              <li></li>
              <li><i class="bx bx-chevron-right"></i> <a href="audio-y-television">Audio y Television</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="colchones-y-almohadas">Colchones y Almohadas</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="dormitorio">Dormitorio</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="electrodomesticos">Electrodomesticos</a></li>
              
            </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4 style="color:#FA485A;">Suscribite Newsletter</h4>
            <p>Las mejores ofertas en tu mail</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>
          </div>

        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4">

      <div class="mr-md-auto text-center text-md-left">
        <div class="copyright">
          &copy; Copyright <strong><span>Abril Amoblamientos</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
         
          Designed by <a href="#">Ariel Bernardo</a>
        </div>
 
      </div>
      <div class="social-links text-center text-md-right pt-3 pt-md-0">
       <!--  <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a> -->
        <a href="<?php echo $footer['facebook']; ?>" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="<?php echo $footer['instagram']; ?>" class="instagram"><i class="bx bxl-instagram"></i></a>
        <!-- <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a> -->
        <!-- <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a> -->
      </div>
    </div>
  </footer><!-- End Footer -->

 
    

  </main><!-- End #main -->

  

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>