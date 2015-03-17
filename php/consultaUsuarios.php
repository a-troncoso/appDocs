<?php
header('Access-Control-Allow-Origin: *');
// ESTE PHP HACE CONSULTA DE

include('conec.php');
$optionSeleccionado = $_POST['optionSeleccionadoPHP'];
//$optionSeleccionado = 'cualquier';

//SI EL SELECT AREA DICE 'CUALQUIER' SE MUESTRAN TODAS LAS SUBAREAS
if($optionSeleccionado == 'cualquier'){
	$datos = mysql_query(
	"SELECT usuarios.codUsuario, usuarios.nombreUsuario
	FROM usuarios, grupousuariousuario
	WHERE usuarios.codUsuario = grupousuariousuario.codUsuario;");
}else{
	$datos = mysql_query(
	"SELECT usuarios.codUsuario, usuarios.nombreUsuario
	FROM usuarios, grupousuariousuario
	WHERE usuarios.codUsuario = grupousuariousuario.codUsuario
	AND grupousuariousuario.codGrupoUsuario = $optionSeleccionado;");
}

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