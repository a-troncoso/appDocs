<?php
header('Access-Control-Allow-Origin: *');

// ESTE PHP HACE

include('conec.php');

$codUsuarioAEliminar = $_POST['codUsuarioAEliminarPHP'];
$nombreUsuarioAEliminar = utf8_decode($_POST['nombreUsuarioAEliminarPHP']); // el utf8_decode es para q reconozca tildes y ñ

// $codUsuarioAEliminar = 16;
// $nombreUsuarioAEliminar = 'joaquín';

// $sql = "DELETE FROM `bddocs`.`usuarios`
// WHERE `usuarios`.`codUsuario` = 5
// AND `usuarios`.`nombreUsuario` = \'usuario2\'"

$sql = "DELETE FROM `bddocs`.`usuarios`
WHERE `usuarios`.`codUsuario` = $codUsuarioAEliminar
AND `usuarios`.`nombreUsuario` = '$nombreUsuarioAEliminar'";

$resultado = mysql_query($sql);

if(!$resultado){
	echo "\n SE HA DETECTADO EL SIGUIENTE ERROR AL ELIMIAR LOS DATOS DEL USUARIO: " . mysql_error();
}else{
	echo "\n USUARIO ELIMINADO";
};

//Cierro
mysql_close($conexion);

?>