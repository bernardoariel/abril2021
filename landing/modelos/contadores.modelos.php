<?php

require_once "conexion.php";

class ModeloContadores{

	/*=============================================
	BUSCAR IP EXISTENTE
	=============================================*/

	static public function mdlSeleccionarIp($tabla, $ip){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE ip = :ip");

		$stmt->bindParam(":ip", $ip, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

	}
	

	/*=============================================
	GUARDAR IP NUEVA
	=============================================*/

	static public function mdlGuardarNuevaIp($tabla, $ip, $pais, $visita){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(ip, pais, visitas) VALUES (:ip, :pais, :visitas)");

		$stmt->bindParam(":ip", $ip, PDO::PARAM_STR);
		$stmt->bindParam(":pais", $pais, PDO::PARAM_STR);
		$stmt->bindParam(":visitas", $visita, PDO::PARAM_INT);
	
		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";	
		}

		$stmt->close();

		$stmt = null;
	}

	/*=============================================
	MOSTRAR EL TOTAL DE VISITAS
	=============================================*/	

	static public function mdlMostrarTotalVisitasHome($tipo,$tabla){

		if($tipo=="mes"){

			$stmt = Conexion::conectar()->prepare("SELECT SUM(visitas) as total FROM $tabla WHERE MONTH(fecha) = ".date("m")." AND YEAR(fecha) = ".date("Y"));

		}else{
			
			$stmt = Conexion::conectar()->prepare("SELECT sum(visitas) as total FROM $tabla");
		}
		
		
		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	INSERTAR VISITAS
	=============================================*/
	static public function mdlInsertarVisitaArticulo($tabla,$articulo,$ip){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(articulo,ip) VALUES (:articulo,:ip)");

		$stmt->bindParam(":articulo", $articulo, PDO::PARAM_STR);
		$stmt->bindParam(":ip", $ip, PDO::PARAM_STR);
		

		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";	
		}

		$stmt->close();

		$stmt = null;
	}

	/*=============================================
	MOSTRAR EL TOTAL DE VISITAS
	=============================================*/	

	static public function mdlMostrarLinksVisitados($tabla,$link){

		$stmt = Conexion::conectar()->prepare("SELECT sum(visitas) as total  FROM $tabla WHERE articulo = :link and MONTH(fecha) = ".date("m")." AND YEAR(fecha) = ".date("Y"));

		$stmt->bindParam(":link", $link, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

}