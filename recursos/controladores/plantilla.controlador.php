<?php

class ControladorPlantilla{

	/*=============================================
	LLAMAMOS LA PLANTILLA
	=============================================*/

	public function plantilla(){

		include "vistas/plantilla.php";

	}

	/*=============================================
	TRAEMOS LOS DATOS DE LA PLANTILLA
	=============================================*/

	public function ctrEstiloPlantilla($tabla){

		$respuesta = ModeloPlantilla::mdlEstiloPlantilla($tabla);

		return $respuesta;
	}

	/*=============================================
	MOSTRAR CATALOGO
	=============================================*/

	static public function ctrMostrarCatalogo($item,$valor){

		$tabla = "landing_datos";

		$respuesta = ModeloPlantilla::mdlMostrarCatalogo($tabla,$item, $valor);

		return $respuesta;

	}
	

}