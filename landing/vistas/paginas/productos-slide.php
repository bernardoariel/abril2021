<?php

$tapa = array();

function listarArchivos( $path ){
    
    $ruta = Ruta::ctrRuta();
  
    // Abrimos la carpeta que nos pasan como parámetro
    $dir = opendir($path);
    $contador = 0;

    // Leo todos los ficheros de la carpeta
    while ($elemento = readdir($dir)){

        // Tratamos los elementos . y .. que tienen todas las carpetas
        if( $elemento != "." && $elemento != ".."){
            // Si es una carpeta
            if( is_dir($path.$elemento) ){
                // Muestro la carpeta
                echo "<p><strong>CARPETA: ". $elemento ."</strong></p>";
            // Si es un fichero
            } else {
                // Muestro el fichero

              $num= rand(1, 20);

              
              if($contador<=18){

                $codigo = substr($elemento, 0, -4);

                  echo '<div class="testimonial-wrap">
          
                          <div class="testimonial-item">
                            
                            <a href="'.$ruta.$codigo.'" target="_blank"><img src="landing/vistas/img/tapa/'.$elemento.'" class="img-fluid" alt="Ir a la Tienda"></a>
                            
                          </div>

                        </div>';

                  $contador++;

              }

            }

        }
    }
}

 
?>

<!-- ======= Testimonials Section ======= -->
<!-- <section id="productos" class="testimonials section-bg" data-aos="fade-up" data-aos-delay="100">
  
  <div class="container" data-aos="fade-up">

    <div class="section-title">

      <h2>Los productos del mes!!!</h2>
      <p>Estos son algunos de los productos pensados para vos!!!</p>

    </div>

  </div>

  <div class="container-fluid">

    <div class="row">


      <?php if ($mostrarSlideCatalogo['valor']=="mostrar"): ?>
        
        <div class="col-md-3 text-center">
      
          <div id="slide" class="carousel slide mb-5" data-ride="carousel">

            <ol class="carousel-indicators">
              <li class="active" data-target="#slide" data-slide-to="0"></li>
              <li data-target="#slide" data-slide-to="1"></li>
              <li data-target="#slide" data-slide-to="2"></li>
            </ol>

            <div class="carousel-inner">
              
              <div class="carousel-item active">
                
                <a href="landing/vistas/img/cartilla/cartilla.pdf" target="_blank">
                  <img src="landing/vistas/img/cartilla/1.jpg" class="img-fluid imgSlide background" alt="bajar catalogo">
                </a>
                
              </div>

              <div class="carousel-item">
                <a href="landing/vistas/img/cartilla/cartilla.pdf" target="_blank">
                  <img src="landing/vistas/img/cartilla/2.jpg" class="img-fluid imgSlide background" alt="bajar catalogo">
                </a>
              </div>

              <div class="carousel-item">
                <a href="landing/vistas/img/cartilla/cartilla.pdf" target="_blank">
                  <img src="landing/vistas/img/cartilla/3.jpg" class="img-fluid imgSlide background" alt="bajar catalogo">
                </a>
              </div>

              <div class="carousel-item">
                <a href="landing/vistas/img/cartilla/cartilla.pdf" target="_blank">
                  <img src="landing/vistas/img/cartilla/4.jpg" class="img-fluid imgSlide background" alt="bajar catalogo">
                </a>
              </div>

              <div class="carousel-item">
                <a href="landing/vistas/img/cartilla/cartilla.pdf" target="_blank">
                  <img src="landing/vistas/img/cartilla/5.jpg" class="img-fluid imgSlide background" alt="bajar catalogo">
                </a>
              </div>

              <div class="carousel-item">
                <a href="landing/vistas/img/cartilla/cartilla.pdf" target="_blank">
                  <img src="landing/vistas/img/cartilla/6.jpg" class="img-fluid imgSlide background" alt="bajar catalogo">
                </a>
              </div>
              <div class="carousel-item">
                <a href="landing/vistas/img/cartilla/cartilla.pdf" target="_blank">
                  <img src="landing/vistas/img/cartilla/7.jpg" class="img-fluid imgSlide background" alt="bajar catalogo">
                </a>
              </div>
              <div class="carousel-item">
                <a href="landing/vistas/img/cartilla/cartilla.pdf" target="_blank">
                  <img src="landing/vistas/img/cartilla/8.jpg" class="img-fluid imgSlide background" alt="bajar catalogo">
                </a>
              </div>
              
            </div>

            <a class="carousel-control-prev" href="#slide" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#slide" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>

          </div>

      </div> 

        
      <?php endif ?>
      
      

      <div class="col-md-8 mt-4">
        
        <div class="owl-carousel testimonials-carousel">

          <?php 

            listarArchivos($carpeta."/vistas/img/tapa");

          ?>
       
        </div>

      </div> 
        
    </div>

  </div>



</section> -->

<script>

</script>