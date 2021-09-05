<!--=====================================
BANNER
======================================-->

<?php

$servidor = Ruta::ctrRutaServidor();

$ruta = "sin-categoria";

$banner = ControladorProductos::ctrMostrarBanner($ruta);


if($banner != null){

	if($banner["estado"] != 0){

		echo '<figure class="banner">

				<img src="'.$servidor.$banner["img"].'" class="img-responsive" width="100%">	

			  </figure>';

	}

}

/*=============================================
PRODUCTOS DESTACADOS
=============================================*/

$titulosModulos = array("CATALOGO DEL MES", "LO MÁS VISTO");//"LO MÁS VENDIDO",

$rutaModulos = array("catalogo","lo-mas-visto");//"lo-mas-vendido",

$base = 0;
$tope = 4;


//if($titulosModulos[0] == "ARTÍCULOS GRATUITOS"){

//$ordenar = "id";
//$item = "precio";
//$valor = 0;
//$modo = "DESC";

//$gratis = ControladorProductos::ctrMostrarProductos($ordenar, $item, $valor, $base, $tope, $modo);

//}

if($titulosModulos[0] == "CATALOGO DEL MES"){

	$ordenar = "ventas";
	$item = "estado"; //ESTADO=0 NO ESTA ACTIVO ESTADO=1 ESTA ACTIVO CON FOTO ESTADO 2 ESTA ACTIVO SIN FOTO NO SALE EN LA PORTADA
	$valor = 1;
	$modo = "DESC";
	$tabla="productos";
	$ventas = ControladorProductos::ctrMostrarProductosCatalogo($ordenar, $item, $valor, $base, $tope, $modo,$tabla);
	

}

if($titulosModulos[1] == "LO MÁS VISTO"){

	$ordenar = "vistas";
	$item = "estado"; //ESTADO=0 NO ESTA ACTIVO ESTADO=1 ESTA ACTIVO CON FOTO ESTADO 2 ESTA ACTIVO SIN FOTO NO SALE EN LA PORTADA
	$valor = 1;
	$modo = "DESC";
	$tabla="productos";

	$vistas = ControladorProductos::ctrMostrarProductosPortada($ordenar, $item, $valor, $base, $tope, $modo,$tabla);
	

}




$modulos = array($ventas,$vistas);


for($i = 0; $i < count($titulosModulos); $i ++){

	echo '

		<div class="container-fluid productos style="background:#f1f0f2;">
	
			<div class="container" style="background:#f1f0f2;">
		
				<div class="row">

					<div class="col-xs-12 ">

						<div class="col-sm-6 col-xs-12">
					
							<h1><small style="tituloPortada">'.$titulosModulos[$i].' </small></h1>

						</div>

						

					</div>

					<div class="clearfix"></div>

					<hr>

				</div>

				<ul class="grid'.$i.'">';


				foreach ($modulos[$i] as $key => $value) {

					if($value["estado"] != 0 && $value["precio"] > 0 && $value["stock"] > 2){
					
					echo '<li class="col-md-3 col-sm-6 col-xs-12">

							<figure style="border-width: 1px;border-style: solid;border-color: #D8D8D8;">
								
								<a href="'.$value["ruta"].'" class="pixelProducto">
									
									<center>';

									if($value["multimedia"]!=""){

										echo             '<img src="'.$servidor.$value["portada"].'" class="img-responsive" width="100%">';

									}else{

										$directory=$servidor."vistas/img/listado/".$value["ruta"]."/";

    $dirint = opendir($directory);
    while (($archivo = $dirint->read()) !== false)
    {
        if (eregi("gif", $archivo) || eregi("jpg", $archivo) || eregi("png", $archivo)){
            echo '<img src="'.$directory."/".$archivo.'">'."\n";
        }
    }
    $dirint->close();
									}

					


					echo 		   '</center>

								</a>

							</figure>

							<h4>
					
								<small>
									
									<a href="'.$value["ruta"].'" class="pixelProducto">
										
										'.$value["titulo"].'<br>

										<span style="color:rgba(0,0,0,0)">-</span>';

										$fecha = date('Y-m-d');
										$fechaActual = strtotime('-30 day', strtotime($fecha));
										$fechaNueva = date('Y-m-d', $fechaActual);

										if($fechaNueva < $value["fecha"]){

											echo '<span class="label label-warning fontSize productoNuevo">Nuevo</span> ';


										}

										if($value["oferta"] != 0 && $value["precio"] != 0 && $value["stock"] > 2){

											echo '<span class="label label-warning fontSize productosOff">'.$value["descuentoOferta"].'% off</span>';

										}

									echo '</a>	

								</small>			

							</h4>

							<div class="col-xs-6 precio">';

							if($value["precio"] == 0){

								echo '<h2><small>GRATIS</small></h2>';

							}else{

								if($value["oferta"] != 0){

									echo '<h2>

											<small>
						
												<strong class="oferta"> $'.$value["precio"].'</strong>

											</small>

											<small class="precioOferta">$'.ceil($value["precioOferta"]).'</small>
										
										</h2>';

								}else{

									echo '<h2><small class="precioSinOferta"> $'.$value["precio"].'</small></h2>';

								}
								
							}
											
							echo '</div>

							<div class="col-xs-6 enlaces">
								
								<div class="btn-group pull-right">
									
									<button type="button" class="btn btn-default btn-xs deseos" idProducto="'.$value["id"].'" data-toggle="tooltip" title="Agregar a mi lista de deseos">
										
										<i class="fa fa-heart" aria-hidden="true"></i>

									</button>';

									if($value["tipo"] == "virtual" && $value["precio"] != 0 && $value["stock"] > 2){

										if($value["oferta"] != 0){

											echo '<button type="button" class="btn btn-default btn-xs agregarCarrito"  idProducto="'.$value["id"].'" imagen="'.$servidor.$value["portada"].'" titulo="'.$value["titulo"].'" precio="'.ceil($value["precioOferta"]).'" tipo="'.$value["tipo"].'" peso="'.$value["peso"].'" data-toggle="tooltip" title="Agregar al carrito de compras">

											<i class="fa fa-shopping-cart" aria-hidden="true"></i>

											</button>';

										}else{

											echo '<button type="button" class="btn btn-default btn-xs agregarCarrito"  idProducto="'.$value["id"].'" imagen="'.$servidor.$value["portada"].'" titulo="'.$value["titulo"].'" precio="'.$value["precio"].'" tipo="'.$value["tipo"].'" peso="'.$value["peso"].'" data-toggle="tooltip" title="Agregar al carrito de compras">

											<i class="fa fa-shopping-cart" aria-hidden="true"></i>

											</button>';

										}

									}

									echo '<a href="'.$value["ruta"].'" class="pixelProducto">
									
										<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver producto">
											
											<i class="fa fa-eye" aria-hidden="true"></i>

										</button>	
									
									</a>

								</div>

							</div>

						</li>';

					}
				}

				echo '</ul>

				<ul class="list'.$i.'" style="display:none">';

				foreach ($modulos[$i] as $key => $value) {

					if($value["estado"] != 0 && $value["precio"] > 0 && $value["stock"] > 2){

					echo '<li class="col-xs-12">
					  
				  		<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
							   
							<figure>
						
								<a href="'.$value["ruta"].'" class="pixelProducto">
									
									<img src="'.$servidor.$value["portada"].'" class="img-responsive">

								</a>

							</figure>

					  	</div>
							  
						<div class="col-lg-10 col-md-7 col-sm-8 col-xs-12">
							
							<h1>

								<small>
								
									<a href="'.$value["ruta"].'" class="pixelProducto">
										
										'.$value["titulo"].'<br>';

										$fecha = date('Y-m-d');
										$fechaActual = strtotime('-30 day', strtotime($fecha));
										$fechaNueva = date('Y-m-d', $fechaActual);

										if($fechaNueva < $value["fecha"]){

											echo '<span class="label label-warning productoNuevo">Nuevo</span> ';


										}

										if($value["oferta"] != 0 && $value["precio"] != 0 && $value["stock"] > 2){

											echo '<span class="label label-warning productosOff">'.$value["descuentoOferta"].'% off</span>';

										}		

									echo '</a>

								</small>

							</h1>

							<p class="text-muted">'.$value["titular"].'</p>';

							if($value["precio"] == 0){

								echo '<h2><small>GRATIS</small></h2>';

							}else{

								if($value["oferta"] != 0){

									echo '<h2>

											<small>
						
												<strong class="oferta"> $'.$value["precio"].'</strong>

											</small>

											<small class="precioOferta">$'.ceil($value["precioOferta"]).'</small>
										
										</h2>';

								}else{

									echo '<h2><small class="precioSinOferta"> $'.$value["precio"].'</small></h2>';

								}
								
							}

							echo '<div class="btn-group pull-left enlaces">
						  	
						  		<button type="button" class="btn btn-default btn-xs deseos"  idProducto="'.$value["id"].'" data-toggle="tooltip" title="Agregar a mi lista de deseos">

						  			<i class="fa fa-heart" aria-hidden="true"></i>

						  		</button>';

						  		if($value["tipo"] == "virtual" && $value["precio"] != 0 && $value["stock"] > 2){

										if($value["oferta"] != 0){

											echo '<button type="button" class="btn btn-default btn-xs agregarCarrito"  idProducto="'.$value["id"].'" imagen="'.$servidor.$value["portada"].'" titulo="'.$value["titulo"].'" precio="'.ceil($value["precioOferta"]).'" tipo="'.$value["tipo"].'" peso="'.$value["peso"].'" data-toggle="tooltip" title="Agregar al carrito de compras">

											<i class="fa fa-shopping-cart" aria-hidden="true"></i>

											</button>';

										}else{

											echo '<button type="button" class="btn btn-default btn-xs agregarCarrito"  idProducto="'.$value["id"].'" imagen="'.$servidor.$value["portada"].'" titulo="'.$value["titulo"].'" precio="'.$value["precio"].'" tipo="'.$value["tipo"].'" peso="'.$value["peso"].'" data-toggle="tooltip" title="Agregar al carrito de compras">

											<i class="fa fa-shopping-cart" aria-hidden="true"></i>

											</button>';

										}

									}

						  		echo '<a href="'.$value["ruta"].'" class="pixelProducto">

							  		<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver producto">

							  		<i class="fa fa-eye" aria-hidden="true"></i>

							  		</button>

						  		</a>
							
							</div>

						</div>

						<div class="col-xs-12"><hr></div>

					</li>';

					}

				}

				echo '</ul>

			</div>

		</div>';

}

?>

