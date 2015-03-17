<?php
header('Access-Control-Allow-Origin: *');

// ESTE PHP HACE CONSULTA DE

include('conec.php');
$optionSeleccionado = $_POST['optionSeleccionadoPHP'];

//SI EL SELECT AREA DICE 'CUALQUIER' SE MUESTRAN TODAS LAS SUBAREAS
if($optionSeleccionado == 'cualquier'){
	$datos = mysql_query(
	"SELECT tiposdocumento.codTipoDocumento, tiposdocumento.nombreTipoDocumento 
	FROM tiposdocumento");
}else{
	$datos = mysql_query(
	"SELECT tiposdocumento.codTipoDocumento, tiposdocumento.nombreTipoDocumento 
	FROM tiposdocumento
	WHERE tiposdocumento.codGrupoTipoDocumento = '$optionSeleccionado'");
}

$arrDatos = array();
while ($rs = mysql_fetch_array($datos)) {
	$arrDatos[] = array_map('utf8_encode', $rs);
}

echo json_encode($arrDatos);

//Cierro
mysql_close($conexion);

?>