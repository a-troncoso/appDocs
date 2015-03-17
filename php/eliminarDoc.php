<?php
header('Access-Control-Allow-Origin: *');

include("conec.php");

$codDoc = $_POST['codDocPHP'];

$sql = "DELETE FROM `bddocs`.`documentos`
WHERE `documentos`.`codDocumento` = '$codDoc'";

$resultado = mysql_query($sql);

//SI NO HAY ERROR SE EJECUTA
if(!$resultado) {
	//SE EJECUTA LA QUERY
	echo "\nSE HA DETECTADO EL SIGUIENTE ERROR AL ELIMINAR EL DOCUMENTO: " . mysql_error(); 
}else{
	echo "\nSe ha eliminado el documento.";
}

//Cierro
mysql_close($conexion);

?>