<?php  

$carpeta ="landing";

/*=============================================
CREADOR DE IP
=============================================*/

//https://www.browserling.com/tools/random-ip

$ip = $_SERVER['REMOTE_ADDR'];

//$ip = "153.205.198.22";

$enviarIp = ControladorContadores::ctrEnviarIp($ip);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <!-- <meta content="width=device-width, initial-scale=1.0" name="viewport"> -->
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
  <title>Abril Amoblamientos - Home</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?php echo $carpeta.'/'; ?>vistas/img/favicon.png" rel="icon">
  <link href="<?php echo $carpeta.'/'; ?>vistas/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet"> -->
<link rel="preconnect" href="https://fonts.gstatic.com">
<!-- <link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:ital,wght@0,300;0,700;1,300&display=swap" rel="stylesheet"> -->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;600;700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?php echo $carpeta.'/'; ?>vistas/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo $carpeta.'/'; ?>vistas/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="<?php echo $carpeta.'/'; ?>vistas/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?php echo $carpeta.'/'; ?>vistas/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="<?php echo $carpeta.'/'; ?>vistas/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?php echo $carpeta.'/'; ?>vistas/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="<?php echo $carpeta.'/'; ?>vistas/vendor/aos/aos.css" rel="stylesheet">
  <!-- Template Main CSS File -->
 <!--  <link href="<?php echo $carpeta.'/'; ?>vistas/css/style.css" rel="stylesheet"> -->
  <link href="<?php echo $carpeta.'/'; ?>vistas/css/1.general.css" rel="stylesheet">

  <link rel="stylesheet" href="<?php echo $carpeta.'/'; ?>vistas/css/2.topbar.css">
  <link rel="stylesheet" href="<?php echo $carpeta.'/'; ?>vistas/css/3.menu.css">
  <link rel="stylesheet" href="<?php echo $carpeta.'/'; ?>vistas/css/4.portada.css">
  <link rel="stylesheet" href="<?php echo $carpeta.'/'; ?>vistas/css/5.productos.css">
  <link rel="stylesheet" href="<?php echo $carpeta.'/'; ?>vistas/css/6.contadores.css">
  <link rel="stylesheet" href="<?php echo $carpeta.'/'; ?>vistas/css/7.valenziana.css">
  <link rel="stylesheet" href="<?php echo $carpeta.'/'; ?>vistas/css/8.nosotros.css">
  <link rel="stylesheet" href="<?php echo $carpeta.'/'; ?>vistas/css/9.contacto.css">
  <link rel="stylesheet" href="<?php echo $carpeta.'/'; ?>vistas/css/10.footer.css">
  <link rel="stylesheet" href="<?php echo $carpeta.'/'; ?>vistas/css/11.visiones.css">
  <link rel="stylesheet" href="<?php echo $carpeta.'/'; ?>vistas/css/12.tienda.css">
  <script src="<?php echo $carpeta.'/'; ?>vistas/plugins/sweetalert2/sweetalert2.all.js"></script>
  
</head>
<body>
  
  <!--=====================================
      ----------- Preload -----------
  ======================================-->

  <!-- <div id="loader-wrapper">

      <img src="<?php echo $carpeta; ?>/vistas/img/plantilla/loader.jpg">
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>

  </div>   -->

 <?php 
   include("paginas/parametros.php");
   include("paginas/top-bar.php");  
   include("paginas/menu.php");
   include("paginas/portada.php");
 ?>
   <div class="main">
    <!--/ End Slider Area -->

    <?php

      // PARA TIENDA
      // include("paginas/tienda/seccion-3.php");
      //include("paginas/tienda/seccion-4.php");
      // include("paginas/tienda/slide-4.php");
      // include("paginas/tienda/seccion-2.php");


      include("paginas/productos-slide.php");
      include("paginas/contadores.php");
      include("paginas/valenziana.php");

      include("paginas/nosotros.php");
      include("paginas/vision.php");
      include("paginas/contacto.php");
      
      include("paginas/footer.php");
        
    ?>
     
   </div>

 <!-- The Modal -->
  <div class="modal fade" id="myModal">
    
    <div class="modal-dialog">

      <div class="modal-content">
        <!-- Modal Header -->

        <div class="modal-header" style="background:#252525;color:#ffdd33">
          <h6 class="modal-title">Su Abril mas cercano.</h6>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body" style="background:#424242;color:#ffdd33">
          
           <select class="form-control input-lg " name="localidad" id="localidad"  required>
              
            <?php foreach ($todasSucursales as $key => $value): ?>
              <option value="<?php echo $value["id"]; ?>"><?php echo ucwords($value["nombre"]); ?></option>
            <?php endforeach ?>    
                        

          </select>
        </div>
        
        <!-- Modal footer -->
        <!-- <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div> -->
        
      </div>
    </div>
  </div>

  <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="modalSuscriptor">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
     <p>Se ha creado correctamente</p>
    </div>
  </div>
</div>

  <!--=====================================
  JS PERSONALIZADO
  ======================================-->
  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="<?php echo $carpeta.'/'; ?>vistas/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo $carpeta.'/'; ?>vistas/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo $carpeta.'/'; ?>vistas/vendor/jquery.easing/jquery.easing.min.js"></script>
  
  <script src="<?php echo $carpeta.'/'; ?>vistas/vendor/php-email-form/validate.js"></script>
  <script src="<?php echo $carpeta.'/'; ?>vistas/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="<?php echo $carpeta.'/'; ?>vistas/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="<?php echo $carpeta.'/'; ?>vistas/vendor/counterup/counterup.min.js"></script>
  <script src="<?php echo $carpeta.'/'; ?>vistas/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="<?php echo $carpeta.'/'; ?>vistas/vendor/venobox/venobox.min.js"></script>
  <script src="<?php echo $carpeta.'/'; ?>vistas/vendor/aos/aos.js"></script>
  <!-- paralax de la portada -->
  <script src="<?php echo $carpeta.'/'; ?>vistas/plugins/tween-max/TweenMax.min.js"></script>
  <script src="<?php echo $carpeta.'/'; ?>vistas/js/jquery-parallax.js"></script>

  <script src="<?php echo $carpeta.'/'; ?>vistas/plugins/type/type.js"></script>
  <!-- Template Main JS File -->
  <script src="<?php echo $carpeta.'/'; ?>vistas/js/main.js"></script>

</body>
</html>