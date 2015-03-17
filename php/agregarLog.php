<?php

header('Access-Control-Allow-Origin: *');

// ESTE PHP AGREGA LA ACCCION REALIZADA A LA TABLA LOG

include('conec.php');

$codUsuarioLog = $_POST['codUsuarioLogPHP'];
$accionLog = $_POST['accionLogPHP'];

$sql = "INSERT INTO logsusuarios values(null, '$codUsuarioLog', '$accionLog', CURRENT_TIMESTAMP);";

$resultado = mysql_query(utf8_decode($sql));

if(!$resultado){
	echo "\n SE HA DETECTADO EL SIGUIENTE ERROR: " . mysql_error();
}else{
	echo "\n Se ha agregado el log.";
}

//Cierro
mysql_close($conexion);

?>