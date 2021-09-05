<?php

class ControladorCarrito{

	/*=============================================
	MOSTRAR TARIFAS
	=============================================*/

	public function ctrMostrarTarifas(){

		$tabla = "comercio";

		$respuesta = ModeloCarrito::mdlMostrarTarifas($tabla);

		return $respuesta;

	}	

	/*=============================================
	NUEVAS COMPRAS
	=============================================*/

	static public function ctrNuevasCompras($datos){

		$tabla = "compras";

		$respuesta = ModeloCarrito::mdlNuevasCompras($tabla, $datos);

		if($respuesta == "ok"){

			$tabla = "comentarios";
			ModeloUsuarios::mdlIngresoComentarios($tabla, $datos);

			/*=============================================
			ACTUALIZAR NOTIFICACIONES NUEVAS VENTAS
			=============================================*/

			$traerNotificaciones = ControladorNotificaciones::ctrMostrarNotificaciones();

			$nuevaVenta = $traerNotificaciones["nuevasVentas"] + 1;

			ModeloNotificaciones::mdlActualizarNotificaciones("notificaciones", "nuevasVentas", $nuevaVenta);

		}

		return $respuesta;

	}

	/*=============================================
	VERIFICAR PRODUCTO COMPRADO
	=============================================*/

	static public function ctrVerificarProducto($datos){

		$tabla = "compras";

		$respuesta = ModeloCarrito::mdlVerificarProducto($tabla, $datos);
	 
	    return $respuesta;

		
	}

	/*=============================================
	TOMAR LA ULTIMA VENTA
	=============================================*/

	static public function ctrVerUltimaVenta($item,$valor){

		$tabla = "compras";

		$respuesta = ModeloCarrito::mdlVerUltimaVenta($tabla, $item,$valor);
	 
	    return $respuesta;

		
	}

	/*=============================================
	ACTUALIZAR DATOS DE ENTRREGA
	=============================================*/

	static public function ctrActualizarDatosEntrega(){
		
		if(isset($_POST['idCompra'])){

			$datos = array("idUsuario"=>$_POST["idUsuarioCompra"],
                     "idCompra"=>$_POST["idUsuarioCompra"],
                     "telefono"=>$_POST["telefono"],
                     "direccion"=>$_POST["direccion"]." - ".$_POST["localidad"]);

		$tabla = "compras";

		$respuesta = ModeloCarrito::mdlActualizarDatosEntrega($tabla,$datos);
	 
	    return $respuesta;

		}

	}

	/*=============================================
	MODIFICAR DATOS DE ENVIO
	=============================================*/

	static public function ctrModificarDatosDeEnvio(){


		if(isset($_POST["idCompraEnvio"])){
			
			$tabla = "compras";
			$direccion =$_POST["direccion"]." - ".$_POST["localidad"];

			$datos = array("idCompraEnvio"=>$_POST["idCompraEnvio"],
                     "telefono"=>$_POST["telefono"],
                     "direccion"=>$direccion);

			$respuesta = ModeloCarrito::mdlModificarDatosDeEnvio($tabla, $datos);
		 
		    echo '<script>
							
					window.location = "https://www.abrilamoblamientos.com.ar/tienda/perfil";

				</script>';

		}
		
	}

	/*=============================================
	MOSTRAR CODIGO MERCADO PAGO
	=============================================*/

	public function ctrMostrarMercadoPago(){

		$tabla = "comercio";

		$respuesta = ModeloCarrito::mdlMostrarMercadoPago($tabla);

		return $respuesta;

	}	



}