<?php

require_once "conexion.php";

class ModeloCarrito{

	/*=============================================
	MOSTRAR TARIFAS
	=============================================*/

	static public function mdlMostrarTarifas($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$tmt =null;

	}

	/*=============================================
	NUEVAS COMPRAS
	=============================================*/

	static public function mdlNuevasCompras($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_usuario, id_producto, metodo, email, direccion, pais, cantidad, detalle, pago) VALUES (:id_usuario, :id_producto, :metodo, :email, :direccion, :pais, :cantidad, :detalle, :pago)");

		$stmt->bindParam(":id_usuario", $datos["idUsuario"], PDO::PARAM_INT);
		$stmt->bindParam(":id_producto", $datos["idProducto"], PDO::PARAM_INT);
		$stmt->bindParam(":metodo", $datos["metodo"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":pais", $datos["pais"], PDO::PARAM_STR);
		$stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_STR);
		$stmt->bindParam(":detalle", $datos["detalle"], PDO::PARAM_STR);
		$stmt->bindParam(":pago", $datos["pago"], PDO::PARAM_STR);

		if($stmt->execute()){ 

			return "ok"; 

		}else{ 

			return "error"; 

		}

		$stmt->close();

		$tmt =null;
	}

	/*=============================================
	VERIFICAR PRODUCTO COMPRADO
	=============================================*/

	static public function mdlVerificarProducto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_usuario = :id_usuario AND id_producto = :id_producto");

		$stmt->bindParam(":id_usuario", $datos["idUsuario"], PDO::PARAM_INT);
		$stmt->bindParam(":id_producto", $datos["idProducto"], PDO::PARAM_INT);

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$tmt =null;

	}

	/*=============================================
	VERIFICAR PRODUCTO COMPRADO
	=============================================*/

	static public function mdlVerUltimaVenta($tabla, $item,$valor){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item order by id desc limit 1");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);
		

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$tmt =null;

	}

	/*=============================================
		ACTUALIZAR DATOS DE ENTRREGA
	=============================================*/

	static public function mdlActualizarDatosEntrega($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET telefono = :telefono, direccion =:direccion WHERE id_usuario= :id_usuario and length(telefono) = 0  ");

		
		$stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);


		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;
	}

	/*=============================================
		MODIFICAR DATOS DE ENVIO
	=============================================*/

	static public function mdlModificarDatosDeEnvio($tabla, $datos){
	// echo "UPDATE Compras SET telefono = '".$datos["telefono"]."', direccion='".$datos['direccion']."' WHERE id=".$datos["idCompraEnvio"];
	
		$stmt = Conexion::conectar()->prepare("UPDATE compras SET telefono = '".$datos["telefono"]."', direccion='".$datos['direccion']."' WHERE id=".$datos["idCompraEnvio"]);

		
		// $stmt->bindParam(":id", $datos["idCompraEnvio"], PDO::PARAM_INT);
		// $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		// $stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);

 
		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;
	}

	/*=============================================
	MOSTRAR TARIFAS
	=============================================*/

	static public function mdlMostrarMercadoPago($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$tmt =null;

	}

}

