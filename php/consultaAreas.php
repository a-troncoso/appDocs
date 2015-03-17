<?php
header('Access-Control-Allow-Origin: *');

// ESTE PHP HACE CONSULTA DE NOMBRE PRODUCTO, VALOR PRODUCTO Y PRECIO PRODUCTO

include('conec.php');

$datos = mysql_query(
	"SELECT areas.EDTArea, areas.nombreArea
	FROM areas");

$arrDatos = array();
while ($rs = mysql_fetch_array($datos)) {
	$arrDatos[] = array_map('utf8_encode', $rs);
}

echo json_encode($arrDatos);

//Cierro
mysql_close($conexion);

?>