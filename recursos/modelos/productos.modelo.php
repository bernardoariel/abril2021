<?php
require_once "conexion.php";

class ModeloProductos{


   /*=============================================
	MOSTRAR PROVEDDORES
	=============================================*/

	static public function mdlMostrarProductos($tabla,$item, $valor, $cantidad,$orden,$tipo){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item order by id desc");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla where imagen_tabla IS NOT NULL order by RAND() $tipo limit $cantidad");
			// $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla order BY RAND() LIMIT 6");

			

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

}