<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";
require_once "../controladores/correcciones.controlador.php";
require_once "../modelos/correcciones.modelo.php";
require_once "../controladores/importar.controlador.php";
require_once "../modelos/importar.modelo.php";
require_once "../controladores/subcategorias.controlador.php";
require_once "../modelos/subcategorias.modelo.php";

class AjaxCorrecciones{

	/*=============================================
	CORRECCIONES
	=============================================*/

  	public function ajaxCorreccionProducto(){

  		$ordenar = "id";
        $productos = ControladorProductos::ctrMostrarTotalProductos($ordenar);
       
        foreach ($productos as $key => $value) {

        	$tabla = "productos";
			$titulo = str_replace("/", " ", $value["titulo"]);
			echo '<pre>'; print_r($titulo); echo '</pre>';
			$datos = array("id" => $value["id"],	
					      "titulo" => $titulo);
			 $modificarProductos = ControladorCorrecciones::ctrCorreccionEspacios($tabla,$datos);
			 echo '<pre>'; print_r($modificarProductos); echo '</pre>';
			
        }
  		
  		return  $productos;

	}
	/*=============================================
	CORRECCIONES
	=============================================*/

  	public function ajaxCorreccionStockCero(){
	
        $productos = ControladorProductos::ctrMostrarStockCero();
        
  		echo  $productos;

	}

	/*=============================================
	ACTUALIZAR PRODUCTOS
	=============================================*/

  	public function ajaxActualizarProductos(){

  		#recorro los items de la tabla import
		
		$item = null;
		$valor = null;

        $productos_importados = ControladorImportar::ctrMostrarDatosImportados($item, $valor);
        $act = 0;
        $nuevos = 0;
        $arrayProductos = array();
        $arrayRepetidos = array();
        $arrayNuevos = array();

        foreach ($productos_importados as $key => $value) {
        	

        	// primero consulto si existe
        	$item = "ruta";
        	$valor = $value["codigo"];
        	$existeProducto = ModeloProductos::mdlMostrarProductos2("productos",$item,$valor);
        	

        	if(!empty($existeProducto)){

        		if($existeProducto["vista"]=="productos"){

        			if (in_array($value["codigo"], $arrayProductos)){

	        			$stock = $value["stock"] + $existeProducto["stock"];
	        			#si esta repetido actualiza precio y stock
		        		$datos = array("ruta" => $value["codigo"],	
							       	   "stock" => $stock,
							   	       "precio" => $value["importe"]);
	        	
        				$productosTablaProductos = ControladorProductos::ctrActualizarStockyPrecio($datos);
	    				
	    				array_push ($arrayRepetidos , $value["codigo"]);

					}else{

						#si esta repetido actualiza precio y stock
		        		$datos = array("ruta" => $value["codigo"],	
							       "stock" => $value["stock"],
							   	   "precio" => $value["importe"]);
	        	
        				$productosTablaProductos = ControladorProductos::ctrActualizarStockyPrecio($datos);
        		

						array_push ($arrayProductos , $value["codigo"]);
					}

	        		
        			$act++;

	        		

				}

			}else{

				array_push ($arrayNuevos , $value["codigo"]);

				$nuevos ++;
				
				$tabla="subcategorias";
				$item = "subcategoria";
				$valor = strtolower($value["subcategoria"]);
					
				$consultaSubcategoria = ModeloSubCategorias::mdlMostrar1SubCategoria($tabla, $item, $valor);

				
				if(empty($consultaSubcategoria)){//si esta vacio
					
					#CREO UNA NUEVA
					$datos2 = array("subcategoria"=>$valor,
								   "idCategoria"=>0,
								   "ruta"=>str_replace(' ', '-', $valor),
								   "estado"=> 2,
								   "oferta"=>0,
								   "precioOferta"=>0,
								   "descuentoOferta"=>0,
								   "imgOferta"=>"",								   
								   "finOferta"=>"");

					#GUARDAMOS EN LISTADO
					$respuesta = ModeloSubCategorias::mdlIngresarSubCategoria($tabla, $datos2);

					$tabla="subcategorias";
					$item = "subcategoria";
					$valor = strtolower($value["subcategoria"]);
					
					$modSubcategoria = ModeloSubCategorias::mdlMostrar1SubCategoria($tabla, $item, $valor);	
					
					#ENTREGO LO QUE EXISTE
					$id_subcategoria = $modSubcategoria["id"];
					$id_categoria = $modSubcategoria["id_categoria"];

				}else{

					#ENTREGO LO QUE EXISTE
					$id_subcategoria = $consultaSubcategoria["id"];
					$id_categoria = $consultaSubcategoria["id_categoria"];

				}

				$datos =array(	"id_categoria"=>$id_categoria,
	                            "id_subcategoria"=>$id_subcategoria,
	                            "tipo"=>"fisico",
	                            "vista"=>"productos",
	                            "ruta"=>$value["codigo"],
	                            "codigo"=>$value["codigo"],
	                            "estado"=>2,
	                            "titulo"=>$value["subcategoria"]." ".$value["descripcion1"]." ".$value["descripcion2"]." ".$value["marca"],
	                            "titular"=>$value["subcategoria"]." ".$value["descripcion1"]." ".$value["descripcion2"]." ".$value["marca"],
	                            "descripcion"=>$value["subcategoria"]." ".$value["descripcion1"]." ".$value["descripcion2"],
	                            "marca"=>$value["marca"],
	                            "stock"=>$value["stock"],
	                            "multimedia"=>'[{"foto":"vistas/img/productos/default/default.jpg"}]',
	                            "detalles"=>$value["subcategoria"]." ".$value["descripcion1"]." ".$value["descripcion2"]." ".$value["marca"],
	                            "precio"=>$value["importe"],
	                            "portada"=>"vistas/img/productos/default/default.jpg",
	                            "imagen_tabla"=>null,
	                            "vistas"=>0,
	                            "ventas"=>0,
	                            "vistasGratis"=>0,
	                            "ventasGratis"=>0,
	                            "ofertadoPorCategoria"=>0,
	                            "ofertadoPorSubCategoria"=>0,
	                            "oferta"=>0,
	                            "precioOferta"=>0,
	                            "descuentoOferta"=>0,
	                            "imgOferta"=>"",                             
	                            "peso"=>25,
	                            "entrega"=>25);

                

					
				#GUARDAMOS EN LISTADO
				$respuesta = ModeloProductos::mdlCrearProductoNuevoExcel("productos", $datos);

			}

        }

        echo "LOS ARTICULOS ACTUALIZADO ".$act."<br>";
        echo "LOS ARTICULOS NUEVVOS ".$nuevos."<br>";

        echo '<pre>'; print_r($arrayRepetidos); echo '</pre>';
        echo '<pre>'; print_r($arrayNuevos); echo '</pre>';
        

	}


}

/*=============================================
ACTUALIZAR PROCESO DE ENVÍO
=============================================*/
if(isset($_POST["correccion"])){


	$envioVenta = new AjaxCorrecciones();
	$envioVenta -> ajaxCorreccionProducto();

}

/*=============================================
ACTUALIZAR STOCK A CERO
=============================================*/
if(isset($_POST["stockcero"])){

	$envioVenta = new AjaxCorrecciones();
	$envioVenta -> ajaxCorreccionStockCero();

}

/*=============================================
ACTUALIZAR PRODUCTOS
=============================================*/
if(isset($_POST["actualizarProductos"])){

	$envioVenta = new AjaxCorrecciones();
	$envioVenta -> ajaxActualizarProductos();

}
