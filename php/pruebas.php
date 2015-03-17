<?php
/* By http://php-estudios.blogspot.com */

//Se incluye la clase phpmailer
require("class.phpmailer.php");

$resultado = "";
if (isset($_POST["email"])){

  $nombre = $_POST["nombre"];
  $destinatario = $_POST["destinatario"];
  $asunto = $_POST["asunto"];
  $mensaje = $_POST["mensaje"];
  $adjunto = $_FILES["file"]["tmp_name"];
  $nombre_adjunto = $_FILES["file"]["name"];
  $size_adjunto = $_FILES["file"]["size"];

  $mail = new PHPMailer(); // Se crea el objeto

  $mail->Host = "localhost"; // Se indica el host desde el cual se envía el email

  $mail->From = "postmaster@localhost"; //Remitente

  $mail->FromName = "Administrador control documental"; //Nombre del remitente

  $mail->Subject = $asunto; //Asunto del email

  $mail->AddAddress($destinatario, $nombre); //Destinatario

  $mail->MsgHTML($mensaje); //Mensaje en HTML

  /*Si el tamaño del fichero es mayor que 0, es decir, que existe*/
  if ($size_adjunto > 0){
    $mail->AddAttachment($adjunto, $nombre_adjunto);//adjuntar un archivo al email
  }

  if($mail->Send()){
    $resultado = "Enhorabuena el mensaje ha sido enviado con éxito a $destinatario";
  }
  else{
    $resultado = "Lo siento ha habido un error al enviar el mensaje a $destinatario";
  }
}
?>

<!DOCTYPE HTML>
<html>
<head>
<title>Email con Mercury Mail(XAMPP) y phpmailer</title>
</head>
<body>
<h3>Email con Mercury Mail(XAMPP) y phpmailer</h3>
<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">

<b><?php echo $resultado; ?></b>

<table border="0">
<tr>
<td>Nombre del destinatario:</td>
<td><input type="text" name="nombre"></td>
</tr>
<tr>
<td>Email del destinatario:</td>
<td><input type="text" name="destinatario"></td>
</tr>
<tr>
<td>Asunto:</td>
<td><input type="text" name="asunto"></td>
</tr>
<tr>
<td>Archivo adjunto:</td>
<td><input type="file" name="file"></td>
</tr>
<tr>
<td>Mensaje:</td>
<td><textarea cols="50" rows="15" name="mensaje"></textarea></td>
</tr>
<tr>
<td></td><td><input type="submit" value="Enviar"></td>
</tr>
</table>
<input type="hidden" name="email">
</form>
</body>
</html>