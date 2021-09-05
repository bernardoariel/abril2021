<?php

$productos = ControladorProductos::ctrMostrarProductos(null, null);

foreach ($productos as $key => $value) {

    $consultaModificacion= ModeloCorrecciones::mdlModificarImagenTabla("productos",$productos[$key]["id"],$productos[$key]["ruta"]);
}

    echo '<script>alert("listo");</script>';
?>