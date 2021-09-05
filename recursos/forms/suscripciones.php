<?php
	
// Valores enviados desde el formulario
if ( !isset($_POST["emailSuscripcion"]) ) {
    die ("Es necesario completar todos los datos del formulario");
}

$to = "suscripciones@c1311867.ferozo.com";
$subject = "Pagina SUSCRIPCIONES";
$contenido = "Nombre: ".$_POST["emailSuscripcion"]."\n";

$header = "From: suscripciones@c1311867.ferozo.com\nReply-To:".$_POST["email"]."\n";
$header .= "Mime-Version: 1.0\n";
$header .= "Content-Type: text/plain";
;

if(mail($to, $subject, $contenido ,$header)){

   // echo "El correo fue enviado correctamente.";
	echo "<script>
			
			window.location = 'http://abrilamoblamientos.com.ar/';

		</script>";

} else {

 echo  "<script>
			
			window.location = 'http://abrilamoblamientos.com.ar/';

		</script>";

}
