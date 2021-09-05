 <?php

  $visitas = ControladorContadores::ctrMostrarTotalVisitasHome("mes");
  switch (date("m")) {
    case '01':
      # code...
        $mes = "ENERO";
      break;
    case '02':
      # code...
      $mes = "FEBRERO";
      break;
    case '03':
      $mes = "MARZO";
      # code...
      break;
    case '04':
    $mes = "ABRIL";
      # code...
      break;
    case '05':
    $mes = "MAYO";
      # code...
      break;
    case '06':
    $mes = "JUNIO";
      # code...
      break;
    case '07':
    $mes = "JULIO";
      # code...
      break;
    case '08':
    $mes = "AGOSTO";
      # code...
      break;
    case '09':
      # code...
    $mes = "SEPTIEMBRE";
      break;
    case '10':
      # code...
    $mes = "OCTUBRE";
      break;
    case '11':
      # code...
    $mes = "NOVIEMBRE";
      break;
    case '12':
      # code...
    $mes = "DICIEMBRE";
      break;
    
  }

      // $vistasProductos = ControladorContadores::ctrMostrarTotalVistasProductos("id");

      $productos = ControladorPlantilla::ctrMostrarCantProductos();
      $totalProductos = count($productos);
     

  ?>
<!-- ======= Counts Section ======= -->
    <section id="counts" class="counts">
      <div class="container" data-aos="fade-up">

        <div class="row">

          <div class="col-lg-3 col-md-6">
            <div class="count-box">
              <i class="icofont-foot-print"></i>
              <span data-toggle="counter-up"><?php echo $visitas["total"]; ?></span>
              <p>Visitas de <?php echo  $mes; ?></p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
            <div class="count-box">
              <i class="icofont-gift"></i>
              <span data-toggle="counter-up"><?php echo $totalProductos; ?></span>
              <p>Productos</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
            <div class="count-box">
              <i class="icofont-binoculars"></i>
              <span data-toggle="counter-up">1,463</span>
              <p>El más visitado</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
            <div class="count-box">
              <i class="icofont-badge"></i>
              <span data-toggle="counter-up">15</span>
              <p>Tu eres el visitante Nro.</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Counts Section -->