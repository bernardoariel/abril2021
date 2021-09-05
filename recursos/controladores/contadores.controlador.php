<?php

class ControladorContadores{

	/*=============================================
	GUARDAR IP
	=============================================*/

	static public function ctrEnviarIp($ip, $pais){

		$tabla = "visitaspersonaslanding";
		$visita = 1;

		$respuestaInsertarIp = null;
		$respuestaActualizarIp = null;

		if($pais == ""){

			$pais = "Unknown";
		}

		/*=============================================
		BUSCAR IP EXISTENTE
		=============================================*/

		$buscarIpExistente = ModeloContadores::mdlSeleccionarIp($tabla, $ip);

		if(!$buscarIpExistente){

			/*=============================================
			GUARDAR IP NUEVA
			=============================================*/

			$respuestaInsertarIp = ModeloContadores::mdlGuardarNuevaIp($tabla, $ip, $pais, $visita);

		}else{

			/*=============================================
			SI LA IP EXISTE Y ES OTRO DIA VOLVERLA A GUARDAR
			=============================================*/
			date_default_timezone_set('America/Bogota');
			
			$fechaActual = date('Y-m-d');

			foreach ($buscarIpExistente as $key => $value) {

				$compararFecha = substr($value["fecha"],0,10);
	
			}

			if($fechaActual != $compararFecha){

				$respuestaActualizarIp = ModeloContadores::mdlGuardarNuevaIp($tabla, $ip, $pais, $visita);	
				
			}

		}


		if($respuestaInsertarIp == "ok" || $respuestaActualizarIp == "ok"){

			$tablaPais = "visitaspaises";

			/*=============================================
			SELECCIONAR PAÍS
			=============================================*/

			$seleccionarPais = ModeloContadores::mdlSeleccionarPais($tablaPais, $pais);

			if(!$seleccionarPais){

				/*=============================================
				SI NO EXISTE EL PAÍS AGREGAR NUEVO PAÍS
				=============================================*/	

				$cantidad = 1;

				$insertarPais = ModeloContadores::mdlInsertarPais($tablaPais, $pais, $cantidad);

			}else{

				/*=============================================
				SI EXISTE EL PAÍS ACTUALIZAR UNA NUEVA VISITA
				=============================================*/	
				 $actualizarCantidad = $seleccionarPais["cantidad"] + 1;

				 $actualizarPais = ModeloContadores::mdlActualizarPais($tablaPais, $pais, $actualizarCantidad);

			}	

		}
		
	}

	/*=============================================
	MOSTRAR EL TOTAL DE VISITAS
	=============================================*/	

	static public function ctrMostrarTotalVisitasHome(){

		$tabla = "visitaspersonaslanding";

		$respuesta = ModeloContadores::mdlMostrarTotalVisitasHome($tabla);

		return $respuesta;

	}
	/*=============================================
	MOSTRAR EL TOTAL DE VISTAS DE PRODUCTOS
	=============================================*/	

	static public function ctrMostrarTotalVistasProductos(){

		$tabla = "productos";

		$respuesta = ModeloContadores::mdlMostrarTotalVistasProductos($tabla);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR CANTIDAD DE PRODUCTOS
	=============================================*/	

	static public function ctrMostrarCantProductos(){

		$tabla = "productos";

		$respuesta = ModeloContadores::mdlMostrarCantProductos($tabla);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR EL TOTAL DE VISITAS
	=============================================*/	

	static public function ctrMostrarTotalVisitas(){

		$tabla = "visitaspaises";

		$respuesta = ModeloContadores::mdlMostrarTotalVisitas($tabla);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR LOS PRIMEROS 6 PAISES DE VISITAS
	=============================================*/
	
	static public function ctrMostrarPaises(){

		$tabla = "visitaspaises";
	
		$respuesta = ModeloContadores::mdlMostrarPaises($tabla);
		
		return $respuesta;
	}

}