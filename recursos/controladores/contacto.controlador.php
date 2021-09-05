<?php

class ControladorContacto{

	/*=============================================
	Mostrar las marcas
	=============================================*/

	static public function ctrMostrarContacto($item, $valor){

		$tabla = "plantilla_contacto";

		$respuesta = ModeloContacto::mdlMostrarContacto($tabla, $item, $valor);

		return $respuesta;
	
	}




}