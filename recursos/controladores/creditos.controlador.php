<?php

class ControladorCredito{

	/*=============================================
	Mostrar las Creditos
	=============================================*/

	static public function ctrMostrarCredito($item, $valor){

		$tabla = "plantilla_credito";

		$respuesta = ModeloCredito::mdlMostrarCredito($tabla, $item, $valor);

		return $respuesta;
	
	}




}