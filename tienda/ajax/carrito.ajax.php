<?php

require_once "../controladores/carrito.controlador.php";
require_once "../modelos/carrito.modelo.php";


class AjaxCarrito{

	/*=============================================
	ACTUALIZAR DATOS DE ENVIO
	=============================================*/	
	
	// public $idCompra;
	// public $telefono;
	// public $direccion;

	public function ajaxActualizarDatosEntrega(){

		
		$tabla = "compras";
		$datos = array("idCompra"=>$_POST["idCompra"],
						"id_usuario"=>$_POST["idUsuarioCompra"],
                        "telefono"=>$_POST["telefono"],
                        "direccion"=>$_POST["direccion"]."-".$_POST["localidad"]);

		$respuesta = ModeloCarrito::mdlActualizarDatosEntrega($tabla,$datos);

		echo $respuesta;

		
	}
	
	/*=============================================
	VERIFICAR QUE NO TENGA EL PRODUCTO ADQUIRIDO
	=============================================*/

	public $idUsuario;
	public $idProducto;

	public function ajaxVerificarProducto(){

		$datos = array("idUsuario"=>$this->idUsuario,
					   "idProducto"=>$this->idProducto);

		$respuesta = ControladorCarrito::ctrVerificarProducto($datos);

		echo json_encode($respuesta);

	}

}


/*=============================================
VERIFICAR QUE NO TENGA EL PRODUCTO ADQUIRIDO
=============================================*/	

if(isset($_POST["idUsuario"])){

	$deseo = new AjaxCarrito();
	$deseo -> idUsuario = $_POST["idUsuario"];
	$deseo -> idProducto = $_POST["idProducto"];
	$deseo ->ajaxVerificarProducto();
}

if(isset($_POST["idCompra"])){

	$datosEnvio = new AjaxCarrito();
	
	// $datosEnvio -> idCompra = $_POST["idCompra"];
	// $datosEnvio -> telefono = $_POST["telefono"];
	// $datosEnvio -> direccion = $_POST["direccion"];

	$datosEnvio ->ajaxActualizarDatosEntrega();
}
