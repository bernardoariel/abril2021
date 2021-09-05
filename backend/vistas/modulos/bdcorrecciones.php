<div class="content-wrapper">
    
  <section class="content-header">
      
    <h1>
      Gestor Correcion de Bd
    </h1>
 
    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Gestor Correcion de Bd</li>
      
    </ol>

  </section>

  <section class="content">

    <div class="col-lg-6">
      
      <div class="box box-danger">

        <?php 

        $ordenar = "id";
        $productos = ControladorProductos::ctrMostrarTotalProductos($ordenar);

        ?>

        <div class="box-header with-border">

          <input type="hidden" name="espacios" val="1">
          
          <h3 class="box-title">Correcciones en titulo</h3>

          <div class="box-tools pull-right">

            <span class="label label-danger"><?php echo count($productos); ?> Productos</span>

            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>

          </div>

        </div>

        <div class="box-body no-padding">
        
        <p>Realizar los cammbios para la barra </p>

        </div>


        <div class="box-footer text-center">
          
          <button  class="btn btn-primary" id="btnCorregir">Realizar Correccion</button>

        </div>
      
      </div>
      
    </div>

     <div class="col-lg-6">
      
      <div class="box box-warning">

        <?php 

        $ordenar = "id";
        $productos = ControladorProductos::ctrMostrarTotalProductos($ordenar);

        ?>

        <div class="box-header with-border">

          <input type="hidden" name="espacios" val="1">
          
          <h3 class="box-title">Actualizar precios</h3>

          <div class="box-tools pull-right">

            <span class="label label-danger"><?php echo count($productos); ?> Productos</span>

            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>

          </div>

        </div>

        <div class="box-body no-padding">
        
        <p>Primero importamos la tabla en Import</p>

        </div>


        <div class="box-footer text-center">
          
          <button  class="btn btn-primary" id="btnStockaCero">stock a cero</button>
          <button  class="btn btn-danger" id="btnActualizarProductos">Actualizar Productos</button>

        </div>
      
      </div>
      
    </div>

    <div class="col-lg-6">
      
      <div class="box box-info">

        <?php 

        $ordenar = "id";
        $productos = ControladorProductos::ctrMostrarTotalProductos($ordenar);

        $gruposCodigo = array();
        $gruposId = array();

        foreach ($productos as $key => $value) {

          $bsq_sql = strstr($value["ruta"],"-", true);

          if($bsq_sql==true){

            array_push ($gruposCodigo , $value["codigo"]);
            array_push ($gruposId , $value["id"]);
          }

        }

        ?>

        <div class="box-header with-border">

          <input type="hidden" name="espacios" val="1">
          
          <h3 class="box-title">Revisar los items con guiones</h3>

          <div class="box-tools pull-right">

            <span class="label label-danger"><?php echo count($gruposId); ?> Grupos</span>

            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>

          </div>

        </div>

        <div class="box-body no-padding">

          

           <table class="table table-bordered table-striped dt-responsive tablaProductos" width="100%">
        
            <thead>
           
              <tr>
               
                 <th style="width:10px">#</th>
                 <th>Titulo</th>
                 <th>Ruta</th>
                 <th>Descripción</th>
                 <th>Imagen Principal</th>
                 <th>Precio</th>
                

              </tr> 

            </thead>   

            <tbody>

              <?php

                foreach ($gruposId as $key => $valueGrupoId) {            

                  $item="id";
                  $valor=$valueGrupoId;

                  $productosGrupos = ModeloProductos::mdlMostrarProductos2("productos",$item, $valor);
                  
                  echo "<tr>
                          <td>".$productosGrupos["id"]."</td>  
                          <td>".$productosGrupos["titulo"]."</td>
                          <td>".$productosGrupos["ruta"]."</td>
                          <td>".$productosGrupos["descripcion"]."</td>
                          <td><img src='".$productosGrupos["portada"]."' width='50px'></td>
                          <td>".$productosGrupos["precio"]."</td>
                        </tr>";
                }

                
              ?>

            </tbody>

            </table>

  
         

        </div>


        <div class="box-footer text-center">
          
          <button  class="btn btn-primary" id="btnCorregir">Realizar Correccion</button>

        </div>
      
      </div>
      
    </div>

  </section>

</div>


      

      




