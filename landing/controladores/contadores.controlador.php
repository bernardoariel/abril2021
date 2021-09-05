<?php

class ControladorContadores{

	/*=============================================
	GUARDAR IP
	=============================================*/

	static public function ctrEnviarIp($ip){
		
		$tabla = 'landing_visitas_personas';
		
		$visita = 1;

		$pais = "Desconocida";

		$respuestaInsertarIp = null;
		$respuestaActualizarIp= null;
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

		
	}

	/*=============================================
	MOSTRAR EL TOTAL DE VISITAS
	=============================================*/	

	static public function ctrMostrarTotalVisitasHome($tipo){

		$tabla ="landing_visitas_personas";

		$respuesta = ModeloContadores::mdlMostrarTotalVisitasHome($tipo,$tabla);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR LOS LINK VISITADOS
	=============================================*/	

	static public function ctrMostrarLinksVisitados($tabla,$link){


		$respuesta = ModeloContadores::mdlMostrarLinksVisitados($tabla,$link);

		return $respuesta;

	}


}