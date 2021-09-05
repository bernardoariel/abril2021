<?php 
#LLAMAR HORARIO DE ARGENTINA
date_default_timezone_set('America/Argentina/Buenos_Aires');

#CONTROLADORES
#-----------------------------------------------------
//LLAMO A LA PlantillaControlador
require_once "landing/controladores/plantilla.controlador.php";
require_once "landing/modelos/plantilla.modelos.php";

require_once "landing/controladores/contadores.controlador.php";
require_once "landing/modelos/contadores.modelos.php";

require_once "landing/modelos/rutas.modelos.php";
#LLAMAR A LA PLANTILLA.
#-------------------------------------

$carpeta ="landing";

$plantilla = new ControladorPlantilla();
$plantilla->plantilla();
