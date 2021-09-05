<?php

class ControladorPlantilla{

	/*=============================================
	LLAMAMOS LA PLANTILLA
	=============================================*/

	public function plantilla(){

		include "vistas/plantilla.php";

	}

	/*=============================================
	TRAEMOS LOS ESTILOS DINÁMICOS DE LA PLANTILLA
	=============================================*/

	public function ctrEstiloPlantilla(){

		$tabla = "plantilla";

		$respuesta = ModeloPlantilla::mdlEstiloPlantilla($tabla);

		return $respuesta;
	}

	/*=============================================
	TRAEMOS LAS CABECERAS
	=============================================*/

	static public function ctrTraerCabeceras($ruta){

		$tabla = "cabeceras";

		$respuesta = ModeloPlantilla::mdlTraerCabeceras($tabla, $ruta);

		return $respuesta;	

	}
	/*=============================================
	SABER SI ESTA ONLINE
	=============================================*/

	static public function ctrMostrarSitio($item,$valor){

		$tabla = "landing_datos";

		$respuesta = ModeloPlantilla::mdlMostrarSitio($tabla,$item, $valor);

		return $respuesta;

	}

}