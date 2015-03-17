<?php
header('Access-Control-Allow-Origin: *');

// ESTE PHP HACE CONSULTA DE 

include('conec.php');

$codUsuario = $_POST['codUsuarioPHP'];
// $codUsuario = 4;

$datos = mysql_query(
"SELECT permisoBuscarVerDoc FROM usuarios WHERE codUsuario = $codUsuario");


$arrDatos = array();
while ($rs = mysql_fetch_array($datos)) {
	$arrDatos[] = array_map('utf8_encode', $rs);
}

echo json_encode($arrDatos[0][0]);

//Cierro
mysql_close($conexion);

?>