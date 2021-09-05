<?php
  
// Valores enviados desde el formulario
if ( !isset($_POST["nombre"]) || !isset($_POST["email"]) ) {
    die ("Es necesario completar todos los datos del formulario");
}

$to = "pagina@c1311867.ferozo.com";
$subject = "Pagina Web";
$contenido = "Nombre: ".$_POST["nombre"]."\n";
$contenido .= "Email: ".$_POST["email"]."\n\n";
$contenido .= "Mensaje: ".$_POST["mensaje"]."\n\n";
$header = "From: pagina@c1311867.ferozo.com\nReply-To:".$_POST["email"]."\n";
$header .= "Mime-Version: 1.0\n";
$header .= "Content-Type: text/plain";


if(mail($to, $subject, $contenido ,$header)){

    echo "El correo fue enviado correctamente.";

} else {

    echo "Ocurrió un error inesperado.";

}
