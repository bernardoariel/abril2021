<?php

require_once "conexion.php";

class ModeloPlantilla{

	static public function mdlEstiloPlantilla($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

	}

	/*=============================================
	MOSTRAR CATALOGO
	=============================================*/

	static public function mdlMostrarCatalogo($tabla,$item,$valor){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :valor");

		$stmt->bindParam(":valor", $valor, PDO::PARAM_STR); 
		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

}