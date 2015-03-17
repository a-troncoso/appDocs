<?php

header("Content-Type: text/html; charset=UTF-8");

//Se incluye la clase phpmailer
require("class.phpmailer.php");

$resultado = "";

$nombre = "Usuario";
$destinatario = $_POST["mailUsuarioPHP"];
$observacionesDoc = $_POST["observacionesDocPHP"];
$tituloDoc = $_POST["tituloDocPHP"];
$nombreUsuarioSeleccionado = $_POST["nombreUsuarioSeleccionadoPHP"];
$nombreUsuarioEnviadorDoc = $_POST["nombreUsuarioEnviadorDocPHP"];
$emisionSeleccionada = $_POST["emisionSeleccionadaPHP"];
// $destinatario = "alvaro.mc2@gmail.com";

$asunto = "$nombreUsuarioSeleccionado, tiene un documento para revisar.";

$mensaje = "Estimado <strong>$nombreUsuarioSeleccionado</strong>,<br><br>";
$mensaje .= "<strong>$nombreUsuarioEnviadorDoc</strong> le ha enviado un nuevo documento para $emisionSeleccionada.<br><br>";
$mensaje .= "<strong>Titulo documento:</strong> $tituloDoc. <br>";
$mensaje .= "<strong>Obsevaciones:</strong> $observacionesDoc.";

$mail = new PHPMailer(); // Se crea el objeto
$mail->Host = "localhost"; // Se indica el host desde el cual se envía el email
$mail->From = "postmaster@localhost"; //Remitente
$mail->FromName = "Administrador control documental"; //Nombre del remitente
$mail->Subject = $asunto; //Asunto del email
$mail->AddAddress($destinatario, $nombre); //Destinatario
$mail->IsHTML(true);
$mail->MsgHTML($mensaje); //Mensaje en HTML

if($mail->Send()){
	$resultado = "El mensaje ha sido enviado con éxito a $destinatario";
}
else{
	$resultado = "Lo siento ha habido un error al enviar el mensaje a $destinatario \n\n" . $mail->ErrorInfo;
}

echo $resultado;
?>
