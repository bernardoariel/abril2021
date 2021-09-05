<?php

  $tabla = "products_categorias";
  $limite = 5;
  $categorias=ControladorPlantilla::ctrMostrarProductosyDetalles($tabla,null,null,$limite);
  $ruta = Ruta::ctrRuta();
  

  
?>
<!-- ======= Footer ======= -->
<footer id="footer">

    <div class="ps-footer" style="">

      <!--=====================================
      Categories Footer
      ======================================-->  

      <div class="ps-footer__links ml-5">

          
            <?php foreach ($categorias as $key => $value): ?>



              <p>

                <strong><?php echo ucfirst(strtolower($value["categoria"]));?>:</strong>
              
                <?php 
                 
                  $tabla = "products_subcategorias";
                  $subcategorias=ControladorPlantilla::ctrMostrarProductosyDetalles($tabla,"id_categoria",$value["id"],$limite);

                  foreach ($subcategorias as $key => $valueSub) {
                    # code...
                     $bsq =str_word_count($valueSub["subcategoria"]);

                     if($bsq==1){
                      echo '<a href="'.$ruta.$valueSub["subcategoria"].'">'.$valueSub["subcategoria"].'</a>';

                     }
                    
                  }

                ?>
              
             
              </p>

            <?php endforeach ?> 
          

          

      </div>

      <!--=====================================
      CopyRight - Payment method Footer
      ======================================-->  

      <div class="ps-footer__copyright ml-5">

        <center>

          <p>

            <span class="ml-2">Nuestros Medios de pagos:</span>

            <a href="#">
              <img src="<?php echo $carpeta.'/'; ?>vistas/img/pagos/mercadopago.jpg" alt="">
            </a>

            <a href="#">
              <img src="<?php echo $carpeta.'/'; ?>vistas/img/pagos/master.jpg" alt="">
            </a>

            <a href="#">
              <img src="<?php echo $carpeta.'/'; ?>vistas/img/pagos/naranja.jpg" alt="">
            </a>

            <a href="#">
              <img src="<?php echo $carpeta.'/'; ?>vistas/img/pagos/visa.jpg" alt="">
            </a>

            <a href="#">
              <img src="<?php echo $carpeta.'/'; ?>vistas/img/pagos/american.jpg" alt="">
            </a>


          </p>

        </center>

      </div>

    </div>

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>Abril Amoblamientos<span>.</span></h3>
            <p>
              <?php echo $sucursal["direccion"]; ?> <br>
               <?php echo $sucursal["localidad"]; ?><br>
              
              <strong>Telefono:</strong> +54  <?php echo $sucursal["telefono"]; ?><br>
              <strong>Email:</strong>  <?php echo $sucursal["email"]; ?><br>
            </p>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Links más visitados</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Inicio</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#nosotros" class="scrollto">Sobre Nosotros</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#productos" class="scrollto">Promo del mes</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#valenziana" class="scrollto">La Valenziana</a></li>
              
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Novedades</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#productos" class="scrollto">Promo del Mes</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#contacto" class="scrollto">Contacto</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#valenziana" class="scrollto">La Valenziana</a></li>
             
            </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter">

            <h4>Suscribite Newsletter</h4>
            <p>Las mejores ofertas en tu mail</p>

            <form method="post">

              <input type="email" name="email_suscriptor" id="email_suscriptor"/>
              
              <input type="submit" value="Subscribe">

              <?php 

                /*=============================================
                AGREGAR... UN SUBSCRIPTOR
                =============================================*/
                $agregarSuscriptor = new ControladorPlantilla();
                $agregarSuscriptor -> ctrAgregarSuscriptor();

                
              ?>

            </form>

          </div>

        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4">

      <div class="mr-md-auto text-center text-md-left">

        <div class="copyright">

          &copy; Copyright <strong><span class="colormedio">Abril</span></strong>. All Rights Reserved

        </div>

        <div class="credits">
          
          Diseñado por <a href="http://www.arielbernardo.com.ar" class="colorsuave">Ariel Bernardo</a>

        </div>

      </div>

      <div class="social-links text-center text-md-right pt-3 pt-md-0">
        
        
        <a href="<?php echo $redes[0]["facebook"]; ?>" class="facebook" target="_blank"><i class="bx bxl-facebook"></i></a>
        <a href="<?php echo $redes[0]["instagram"]; ?>" class="instagram" target="_blank"><i class="bx bxl-instagram"></i></a>
        <a href="<?php echo $redes[0]["whatsapp"]; ?>" class="instagram" target="_blank"><i class="bx bxl-whatsapp"></i></a>

      </div>

    </div>


</footer><!-- End Footer -->

 