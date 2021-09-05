<?php

class ControladorMarcas{

	/*=============================================
	Mostrar las marcas
	=============================================*/

	static public function ctrMostrarMarcas($item, $valor){

		$tabla = "plantilla_marcas";

		$respuesta = ModeloMarcas::mdlMostrarMarcas($tabla, $item, $valor);

		return $respuesta;
	
	}




}