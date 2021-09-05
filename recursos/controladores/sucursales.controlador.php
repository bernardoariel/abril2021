<?php

class ControladorSucursales{

	/*=============================================
	Mostrar las sucursales
	=============================================*/

	static public function ctrMostrarSucursales($item, $valor){

		$tabla = "plantilla_sucursales";

		$respuesta = ModeloSucursales::mdlMostrarSucursales($tabla, $item, $valor);

		return $respuesta;
	
	}




}