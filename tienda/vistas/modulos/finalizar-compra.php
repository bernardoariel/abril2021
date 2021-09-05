
<!--=====================================
VENTANA PARA PEDIDO DE TELEFONO
======================================-->

<div class="modal fade modalFormulario" id="modalDatos" role="dialog">

    <div class="modal-content modal-dialog">

        <div class="modal-body modalTitulo">

          <h3 class="barraSuperior">DATOS PARA EL ENVIO</h3>

           <input type="hidden" id="idUsuarioCompra" value="<?php echo $_SESSION["id"]; ?>">

           <input type="hidden" id="idCompra" value="">
          
      <!--=====================================
      OLVIDO CONTRASEÑA
      ======================================-->

      <form method="post">

        <label class="text-muted">Para realizar el envio necesitamos un ultimo paso. Ingrese por favor su nro de Telefono </label>

        <div class="form-group">
          
          <div class="input-group">
            
            <span class="input-group-addon">
              
              <i class="glyphicon glyphicon-phone"></i>
            
            </span>
          
            <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Ingrese su numero telefonico para concertar el envio" required>

          </div>

        </div>

        <div class="form-group">
        
          <div class="input-group">
            
            <span class="input-group-addon">
              
             <i class="glyphicon glyphicon-home"></i>
            
            </span>
          
            <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Ingrese su direccion" required>

          </div>
        
        </div>

        <div class="form-group">

          <div class="input-group">
            
            <span class="input-group-addon">
              
              <i class="glyphicon glyphicon-road"></i>
            
            </span>
          
            <input type="text" class="form-control" id="localidad" name="localidad" placeholder="Ingrese su localidad" required>

          </div>

        </div>      

        
        
        <input type="button" id="btnAgregarEnvio" class="btn btnCarritoCss btn-block" value="ENVIAR">

        


      </form>

        </div>

        <div class="modal-footer">
          
     Por favor ingrese los datos correctos | <strong><a href="perfil" data-dismiss="modal" data-toggle="modal">Mi Perfil</a></strong>

        </div>
      
    </div>

</div>
<?php

$url = Ruta::ctrRuta();

if(!isset($_SESSION["validarSesion"])){

   echo '<script>window.location = "'.$url.'";</script>';

   exit();

}

/*=============================================
PAGO MERCADO PAGO
=============================================*/

#evaluamos si la compra está aprobada
if(isset( $_GET['mercadopago']) && $_GET['mercadopago'] === 'true' && isset($_COOKIE["sumadeCesta"])){

  $item = null;
  $valor =  null;

  $miMercadoPago = ControladorCarrito::ctrMostrarMercadoPago($item, $valor);

  $llaveSecretaPaypal=$miMercadoPago["llaveSecretaPaypal"];

  #recibo los productos comprados
  require_once 'extensiones/vendor/autoload.php';
            
  if(isset($_REQUEST["token"])){
    
    $token = $_REQUEST["token"];
    
    $payment_method_id = $_REQUEST["payment_method_id"];
    
    $installments = $_REQUEST["installments"];
    
    $issuer_id = $_REQUEST["issuer_id"];
              
    require_once 'extensiones/vendor/autoload.php';

    MercadoPago\SDK::setAccessToken($llaveSecretaPaypal);
    //...
    $payment = new MercadoPago\Payment();
    $payment->transaction_amount =  $_COOKIE["sumadeCesta"];
    
    $payment->token = $token;
    $payment->description = $_COOKIE["listaCarrito"]; 
    $payment->installments = $installments;
    $payment->payment_method_id = $payment_method_id;
    $payment->issuer_id = $issuer_id;
    $payment->payer = array("email" =>$_SESSION["email"]);
    // Guarda y postea el pago
    $payment->save();
    
    //...
    if($payment->status == "approved"){
      
      $productosVendidos = json_decode($_COOKIE["listaCarrito"],true);
                  
      for($i = 0; $i < count($productosVendidos); $i++){
       # code...
       $datos = array("idUsuario"=>$_SESSION["id"],
                     "idProducto"=>$productosVendidos[$i]["idProducto"],
                     "metodo"=>"mercadopago",
                     "email"=>$_SESSION["email"],
                     "direccion"=>"",
                     "pais"=>"argentina",
                     "cantidad"=>$productosVendidos[$i]["cantidad"],
                     "detalle"=>$productosVendidos[$i]["titulo"],
                     "pago"=>$productosVendidos[$i]["precio"]);

       $respuesta = ControladorCarrito::ctrNuevasCompras($datos);

      }
                  
      if($respuesta == "ok"){

        $item = "id_usuario";
        $valor = $_SESSION["id"];
       

        $respuesta = ControladorCarrito::ctrVerUltimaVenta($item,$valor);
        

        echo '<script>

                    localStorage.removeItem("listaProductos");
                    localStorage.removeItem("cantidadCesta");
                    localStorage.removeItem("sumaCesta");
                    document.cookie = "sumadeCesta=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";
                    document.cookie = "listaCarrito=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";
                    $(".cantidadCesta").html("0");
                    $(".sumaCesta").html("0");
                    $("#modalDatos").modal("show");
                    $("#idCompra").val('.$respuesta["id"].');



              </script>';


      }

    }else{

      echo $payment->status;

    }
               
  }

}else{ //#evaluamos si la compra está aprobada if(isset( $_GET['mercadopago']) && $_GET['mercadopago'] === 'true'){

   echo '<script>window.location = "'.$url.'cancelado";</script>';

}


        
$datosCompra = new ControladorCarrito();
$datosCompra -> ctrActualizarDatosEntrega();
  



