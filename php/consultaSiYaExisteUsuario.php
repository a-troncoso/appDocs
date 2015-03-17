<?php
header('Access-Control-Allow-Origin: *');

// ESTE PHP HACE CONSULTA DE LOS DOCUMENTOS FILTRADOS POR TITULO, PALABRAS CLAVE, DOSCIPLINA, TIPO DOC, USUARIO

include('conec.php');
$nombreUsuario =$_POST['nombreUsuario'];

$sql = "SELECT usuarios.nombreUsuario
	FROM usuarios
	WHERE nombreUsuario = '$nombreUsuario'";


$datos = mysql_query($sql)
if(mysql_num_rows($datos) >= 1){
 	echo 1;
}else{
	echo 0;
}

//Cierro
mysql_close($conexion);

?>