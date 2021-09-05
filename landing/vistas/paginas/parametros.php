<?php

	/*=============================================
	TRAEMOS LAS SUCURSALES
	=============================================*/
	$item = null;
	$valor = null;
	$todasSucursales = ControladorPlantilla::ctrMostrarSucursales($item,$valor);
	
	/*=============================================
	TRAEMOS la sucursal principal
	=============================================*/
	$item = "id";
	$valor = 1;
	$sucursal = ControladorPlantilla::ctrMostrarSucursales($item,$valor);

	$redes = json_decode($sucursal["redes"],true);
	
	/*=============================================
    TRAEMOS la cantidad de suscriptos
    =============================================*/
    $tabla = "suscripcion";
    $item = null;
    $valor = null;
    $suscriptores = ControladorPlantilla::ctrMostrarSuscriptores($tabla,$item,$valor);
  
	
	/*=============================================
    MOSTRAR SLIDE catalogo_slide
    =============================================*/
  
    $item = "nombre";
    $valor = "catalogo_slide";
    $mostrarSlideCatalogo = ControladorPlantilla::ctrMostrarSeccionDatos($item,$valor);
  

	/*=============================================
    MOSTRAR SLIDE productos_slide
    =============================================*/

    $item = "nombre";
    $valor = "productos_slide";
    $mostrarSlideProductos = ControladorPlantilla::ctrMostrarSeccionDatos($item,$valor);

?>