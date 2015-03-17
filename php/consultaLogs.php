<?php
header('Access-Control-Allow-Origin: *');

// ESTE PHP HACE CONSULTA

include('conec.php');

$codUsuario = $_POST['codUsuarioPHP'];
$fechaInicio = $_POST['fechaInicioPHP'];
$fechaFin = $_POST['fechaFinPHP'];

// $codUsuario = '1';
// $fechaInicio = '2014-10-10';
// $fechaFin = '2014-10-28';

if ( ($codUsuario == 'cualquier' || $codUsuario == null)) {
	$codUsuario = '%%';
}
if ($fechaInicio == '' || $fechaFin == '') {
	$ag = '';
}
if ($fechaInicio != '' && $fechaFin != '') {
	$ag = "AND logsusuarios.fechaAccion >= '$fechaInicio'
	AND logsusuarios.fechaAccion <='$fechaFin'";
}

$sql =
"SELECT usuarios.nombreUsuario, logsusuarios.accion,  DATE_FORMAT(logsusuarios.fechaAccion, '%d-%m-%Y %H:%i:%s')
FROM usuarios, logsusuarios
WHERE usuarios.codUsuario = logsusuarios.codUsuario
AND logsusuarios.codUsuario like '$codUsuario' " . $ag . "
ORDER BY logsusuarios.fechaAccion DESC";

$resultado = mysql_query($sql);

$arrDatos = array();

if(!$resultado){
	echo "SE HA DETECTADO EL SIGUIENTE ERROR: " . mysql_error();
	echo "<br><br><br>" . $sql;
}else{
	while ($rs = mysql_fetch_array($resultado)) {
		$arrDatos[] = array_map('utf8_encode', $rs);
	}
	echo json_encode($arrDatos);
}

//Cierro
mysql_close($conexion);

?>