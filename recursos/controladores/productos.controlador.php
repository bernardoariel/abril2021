<?php

class ControladorProductos{

	/*=============================================
	Mostrar los Productos
	=============================================*/

	static public function ctrMostrarProductos($tabla,$item,$valor,$cantidad,$orden,$tipo){

		$tabla = "productos";

		$respuesta = ModeloProductos::mdlMostrarProductos($tabla,$item, $valor, $cantidad,$orden,$tipo);

		return $respuesta;
	
	}




}