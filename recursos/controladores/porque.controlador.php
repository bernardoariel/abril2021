<?php

class ControladorPorque{

	/*=============================================
	Mostrar las Porque
	=============================================*/

	static public function ctrMostrarPorque($item, $valor){

		$tabla = "plantilla_porque";

		$respuesta = ModeloPorque::mdlMostrarPorque($tabla, $item, $valor);

		return $respuesta;
	
	}




}