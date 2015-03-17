<?php
header('Access-Control-Allow-Origin: *');

// ESTE PHP HACE CONSULTA DE 

include('conec.php');

$datos = mysql_query(
	"SELECT gruposdisciplina.codGrupoDisciplina, gruposdisciplina.nombreGrupoDisciplina
	FROM gruposdisciplina");

if (!$datos) {
	die(mysql_error());
}

$arrDatos = array();
while ($rs = mysql_fetch_array($datos)) {
	$arrDatos[] = array_map('utf8_encode', $rs);
}

echo json_encode($arrDatos);

//Cierro
mysql_close($conexion);

?>