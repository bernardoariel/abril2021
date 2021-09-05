<?php

class ControladorCorrecciones{

	/*=============================================
	CORRECCIONES DE ESPACIOS
	=============================================*/

	public function ctrCorreccionEspacios($tabla,$datos){

		$respuesta = ModeloCorrecciones::mdlCorreccionEspacios($tabla,$datos);
        return $respuesta;
	}

}