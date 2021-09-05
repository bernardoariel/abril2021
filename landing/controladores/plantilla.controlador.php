<?php

#PLANTILLA
class ControladorPlantilla{

	public function plantilla(){

		include "landing/vistas/plantilla.php";
	}

	
	/*=============================================
	Mostrar las sucursales
	=============================================*/

	static public function ctrMostrarSucursales($item, $valor){

		$tabla = "landing_sucursales";

		$respuesta = ModeloPlantilla::mdlMostrarSucursales($tabla, $item, $valor);

		return $respuesta;
	
	}


	/*=============================================
	MOSTRAR CANTIDAD DE PRODUCTOS
	=============================================*/	

	static public function ctrMostrarCantProductos(){

		$tabla = "products_productos";

		$respuesta = ModeloPlantilla::mdlMostrarCantProductos($tabla);

		return $respuesta;

	}


	/*=============================================
	MOSTRAR CATEGORIAS
	=============================================*/

	static public function ctrMostrarProductosyDetalles($tabla,$item, $valor, $limite){

		
		$respuesta = ModeloPlantilla::mdlMostrarProductosyDetalles($tabla, $item, $valor,$limite);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR SUSCRIPTORES
	=============================================*/

	static public function ctrMostrarSuscriptores($tabla,$item, $valor){
	
		$respuesta = ModeloPlantilla::mdlMostrarSuscriptores($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	CREAR SUSCRIPTORES
	=============================================*/
	static public function ctrAgregarSuscriptor(){

		if(isset($_POST["email_suscriptor"])){

			$tabla = "suscripcion";
			
			$item = "email";
			$valor = $_POST["email_suscriptor"];

			$existeSuscriptor = ModeloPlantilla::mdlMostrarSuscriptores($tabla, $item, $valor);

			if($existeSuscriptor){

				echo'<script>swal({
						  type: "warning",
						  title: "Ya se encuentra suscripto.",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "index.php";

							}
						})
						</script>';

				

			}else{

				$respuesta = ModeloPlantilla::mdlAgregarSuscriptor($tabla, $_POST["email_suscriptor"]);
				echo'<script>swal({
						  type: "success",
						  title: "Se ha suscripto correctmente.",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "index.php";

							}
						})
						</script>';
			}
			
		
		}

	}

	/*=============================================
	MOSTRAR//OCULTAR
	=============================================*/

	static public function ctrMostrarSeccionDatos($item, $valor){
		
		$tabla = "landing_mostrar";
		
		$respuesta = ModeloPlantilla::mdlMostrarSeccionDatos($tabla, $item, $valor);

		return $respuesta;
	
	}

}