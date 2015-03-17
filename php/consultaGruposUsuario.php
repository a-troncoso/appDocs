<?php
header('Access-Control-Allow-Origin: *');

// ESTE PHP HACE CONSULTA DE 

include('conec.php');

$datos = mysql_query(
	"SELECT gruposusuario.codGrupoUsuario, gruposusuario.nombreGrupoUsuario
	FROM gruposusuario");

$arrDatos = array();
while ($rs = mysql_fetch_array($datos)) {
	$arrDatos[] = array_map('utf8_encode', $rs);
}

echo json_encode($arrDatos);

//Cierro
mysql_close($conexion);

?>