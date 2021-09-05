<?php

require_once "conexion.php";

class ModeloCorrecciones{

	/*=============================================
	MOSTRAR EL TOTAL DE VENTAS
	=============================================*/	

	static public function mdlCorreccionEspacios($tabla,$datos){
		
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET titulo = :titulo WHERE id = :id");

		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt -> bindParam(":titulo", $datos["titulo"], PDO::PARAM_STR);
	
		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

	}

	/*=============================================
	Limpiar la tabla import
	=============================================*/

	static public function mdlLimpiarTablaImport(){
		
		$stmt = Conexion::conectar()->prepare("DELETE FROM import");
	
		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

	}

	/*=============================================
	ELIMINAR LOS ESPACIOS
	=============================================*/

	static public function mdlEliminarEspacios(){
		
		$stmt = Conexion::conectar()->prepare("DELETE FROM import WHERE subcategoria=''");
	
		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

	}

	/*=============================================
	MOSTRAR TOTAL PRODUCTOS TABLA IMPORT
	=============================================*/	

	static public function mdlMostrarTotalImport($tabla){
	
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt-> close();

		$stmt = null;

	}

	/*=============================================
	Cargar exceL
	=============================================*/	

	static public function mdlExcelCarga($tabla,$ruta){

		// $csvfile = 'D:\sitios\tmp\listado2.csv'

		$csvfile = $ruta.'vistas/archivos/listado.csv';
		$fieldseparator = ";"; 
		$lineseparator = "\n";
		$_SERVER['HTTP_HOST'];
		echo '<pre>'; print_r($_SERVER['HTTP_HOST']); echo '</pre>';
		
  		
  		try{
    
    		$pdo = new PDO(
                  "mysql:host=localhost;dbname=abril","root","",
                  array
                  (
                    PDO::MYSQL_ATTR_LOCAL_INFILE => true,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                  ));
 		} 

		catch (PDOException $e){
		    die("database connection failed: ".$e->getMessage());
		}

		  $affectedRows = $pdo->exec
		  (
		    "LOAD DATA LOCAL INFILE "
		    .$pdo->quote($csvfile)
		    ." INTO TABLE `import` FIELDS TERMINATED BY "
		    .$pdo->quote($fieldseparator)
		    ."LINES TERMINATED BY "
		    .$pdo->quote($lineseparator)
		  );

  		echo "Loaded a total of $affectedRows records from this csv file.\n";

	}

	/*=============================================
	MOSTRAR TOTAL PRODUCTOS TABLA IMPORT
	=============================================*/	

	static public function mdlProductosTotales($tabla,$tipo){
	
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla where vista=:tipo");

		$stmt -> bindParam(":tipo", $tipo, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt-> close();

		$stmt = null;

	}
	
	/*=============================================
	ELIMO LOS PRODUCTOS DE LA RUTA
	=============================================*/	

	static public function mdlEliminarCombo($tabla,$id){
	
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id=:id");

		$stmt -> bindParam(":id", $id, PDO::PARAM_INT);
	
		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}


	}

	/*=============================================
	EDITAR LOS COMBOS
	=============================================*/

	static public function mdlModificarPrecioCombo($tabla,$datosProducto){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET precio = :precio, stock = :stock WHERE id = :id");

		$stmt -> bindParam(":id", $datosProducto["id"], PDO::PARAM_INT);
		$stmt -> bindParam(":precio", $datosProducto["idCategoria"], PDO::PARAM_STR);
		$stmt -> bindParam(":stock", $datosProducto["idSubCategoria"], PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;
		
	}
	/*=============================================
	MOSTRAR EL TOTAL DE VENTAS
	=============================================*/	

	static public function mdlModificarImagenTabla($tabla,$id,$ruta){
		
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET imagen_tabla = 'vistas/img/catalogo/".$ruta.".jpg' WHERE id = ".$id);

		
	
		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

	}

}