<?php
    
    $url = Ruta::ctrRuta();


	$item = null;
	$valor =  null;

	$miMercadoPago = ControladorCarrito::ctrMostrarMercadoPago($item, $valor);
	

	$clienteIdPaypal = $miMercadoPago["clienteIdPaypal"];

 ?>

<!--=====================================
BREADCRUMB CARRITO DE COMPRAS
======================================-->

<div class="container-fluid well well-sm">
	
	<div class="container">
		
		<div class="row">
			
			<ul class="breadcrumb fondoBreadcrumb text-uppercase">
				
				<li><a href="<?php echo $url;  ?>">CARRITO DE COMPRAS</a></li>
				<li class="active pagActiva"><?php echo $rutas[0] ?></li>

			</ul>

		</div>

	</div>

</div>

<!--=====================================
TABLA CARRITO DE COMPRAS
======================================-->

<div class="container-fluid">

	<div class="container">

		<div class="panel panel-default">
			
			<!--=====================================
			CABECERA CARRITO DE COMPRAS
			======================================-->

			<div class="panel-heading cabeceraCarrito">
				
				<div class="col-md-6 col-sm-7 col-xs-12 text-center">
					
					<h3>
						<small>PRODUCTO</small>
					</h3>

				</div>

				<div class="col-md-2 col-sm-1 col-xs-0 text-center">
					
					<h3>
						<small>PRECIO</small>
					</h3>

				</div>

				<div class="col-sm-2 col-xs-0 text-center">
					
					<h3>
						<small>CANTIDAD</small>
					</h3>

				</div>

				<div class="col-sm-2 col-xs-0 text-center">
					
					<h3>
						<small>SUBTOTAL</small>
					</h3>

				</div>

			</div>

			<!--=====================================
			CUERPO CARRITO DE COMPRAS
			======================================-->

			<div class="panel-body cuerpoCarrito">

				

			</div>

			<!--=====================================
			SUMA DEL TOTAL DE PRODUCTOS
			======================================-->

			<div class="panel-body sumaCarrito">

				<div class="col-md-4 col-sm-6 col-xs-12 pull-right well">
					
					<div class="col-xs-6">
						
						<h4>TOTAL:</h4>

					</div>

					<div class="col-xs-6">

						<h4 class="sumaSubTotal">
							
							

						</h4>

					</div> 

				</div>

			</div>

			<!--=====================================
			BOTÓN CHECKOUT
			======================================-->

			<div class="panel-heading cabeceraCheckout">

			<?php

				if(isset($_SESSION["validarSesion"])){

					if($_SESSION["validarSesion"] == "ok"){

						echo '<a id="btnCheckout" href="#modalCheckout" data-toggle="modal" idUsuario="'.$_SESSION["id"].'"><button class="btn  btnCarritoCss btn-lg pull-right">REALIZAR PAGO</button></a>';

					}


				}else{

					echo '<a href="#modalIngreso" data-toggle="modal"><button class="btn btnCarritoCss btn-lg pull-right">REALIZAR PAGO</button></a>';
				}

			?>	

			</div>

		</div>

	</div>

</div>

<!--=====================================
VENTANA MODAL PARA CHECKOUT
======================================-->

<div id="modalCheckout" class="modal fade modalFormulario" role="dialog">
	
	 <div class="modal-content modal-dialog">
	 	
		<div class="modal-body modalTitulo">
			
			<h3 class="barraSuperior">REALIZAR PAGO</h3>

			<button type="button" class="close" data-dismiss="modal">&times;</button>

			<div class="contenidoCheckout">

			<!-- 		
				<?php
																																			
				
			    

				$respuesta = ControladorCarrito::ctrMostrarTarifas();

				echo '<input type="hidden" id="tasaImpuesto" value="'.$respuesta["impuesto"].'">
					  <input type="hidden" id="envioNacional" value="'.$respuesta["envioNacional"].'">
				      <input type="hidden" id="envioInternacional" value="'.$respuesta["envioInternacional"].'">
				      <input type="hidden" id="tasaMinimaNal" value="'.$respuesta["tasaMinimaNal"].'">
				      <input type="hidden" id="tasaMinimaInt" value="'.$respuesta["tasaMinimaInt"].'">
				      <input type="hidden" id="tasaPais" value="'.$respuesta["pais"].'">

				';

				?>
					 -->
			
				

				<div class="listaProductos row">
					
					<h4 class="text-center well text-muted text-uppercase">Productos a comprar</h4>

					<table class="table table-striped tablaProductos">
						
						 <thead>
						 	
							<tr>		
								<th>Producto</th>
								<th>Cantidad</th>
								<th>Precio</th>
							</tr>

						 </thead>

						 <tbody>
						 	


						 </tbody>

					</table>

					<br>	

					<div class="col-sm-6 col-xs-12 pull-right">
						
						<table class="table table-striped tablaTasas">
							
							<tbody>
								
								<tr style="display: none;">
									<td>Subtotal</td>	
									<td><span class="cambioDivisa"></span> $<span class="valorSubtotal" valor="0">0</span></td>	
								</tr>

								<tr style="display: none;">
									<td>Envío</td>	
									<td><span class="cambioDivisa"></span> $ <span class="valorTotalEnvio" valor="0">0</span></td>	
								</tr style="display: none;">

								<tr style="display: none;">
									<td>Impuesto</td>	
									<td><span class="cambioDivisa"></span> $ <span class="valorTotalImpuesto" valor="0">0</span></td>	
								</tr>

								<tr>
									<td><strong>Total</strong></td>	
									<td>	</td>
									<td>	</td>
									<td>	</td>
									<td>	</td>
									<td><strong><span class="cambioDivisa "></span> $ <span class="valorTotalCompra pull-righ" valor="0">0</span></strong></td>	
								</tr>

							</tbody>	

						</table>				

					</div>

					<div class="clearfix"></div>

					<div class="col-sm-6 col-xs-12 pull-left">

						<img src="vistas/img/plantilla/mercadopago.jpg" alt="">

					</div>

					<div class="col-sm-6 col-xs-12 pull-right">

						<form class="formPayu" style="display:none">
						 
							<input name="merchantId" type="hidden" value=""/>
							<input name="accountId" type="hidden" value=""/>
							<input name="description" type="hidden" value=""/>
							<input name="referenceCode" type="hidden" value=""/>	
							<input name="amount" type="hidden" value=""/>
							<input name="tax" type="hidden" value=""/>
							<input name="taxReturnBase" type="hidden" value=""/>
							<input name="shipmentValue" type="hidden" value=""/>
							<input name="currency" type="hidden" value=""/>
							<input name="lng" type="hidden" value="es"/>
							<input name="confirmationUrl" type="hidden" value="" />
							<input name="responseUrl" type="hidden" value=""/>
							<input name="declinedResponseUrl" type="hidden" value=""/>
							<input name="displayShippingInformation" type="hidden" value=""/>
							<input name="test" type="hidden" value="" />
							<input name="signature" type="hidden" value=""/>

						  <input name="Submit" class="btn btn-block btn-lg btn-default backColor" type="submit"  value="PAGAR" >
						</form>
					
						<!-- <button class="btn btn-block btn-lg btn-default backColor btnPagar">PAGAR</button> -->
						<?php if (isset($_COOKIE['sumadeCesta'])): ?>

							<form action="index.php?ruta=finalizar-compra&mercadopago=true&total=<?php echo $_COOKIE['sumadeCesta']; ?>" method="POST">
							  
							  <script
							    src="https://www.mercadopago.com.ar/integrations/v1/web-tokenize-checkout.js"
							    data-public-key="<?php echo $clienteIdPaypal; ?>"
							    data-transaction-amount="<?php echo $_COOKIE['sumadeCesta']; ?>"
							    data-button-label="Comprar"
							    data-sumary-product-label='<?php echo $_COOKIE["listaCarrito"]; ?>'>
							  </script>

							</form>

						<?php endif ?>

					</div>

				</div>

			</div>

		</div>

		<div class="modal-footer">

			<center>
		
			<h4><small>Esta es una conexion segura <i class="fa fa-lock" aria-hidden="true" style="color:green"></i> </small></h4>
      		
      		</center>
      	</div>

	</div>

</div>
