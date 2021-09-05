<?php

class ControladorFooter{

	/*=============================================
	Mostrar las footer
	=============================================*/

	static public function ctrMostrarFooter($item, $valor){

		$tabla = "plantilla_footer";

		$respuesta = ModeloFooter::mdlMostrarFooter($tabla, $item, $valor);

		return $respuesta;
	
	}




}