<?php
header('Access-Control-Allow-Origin: *');

// ESTE PHP HACE CONSULTA DE NOMBRE PRODUCTO, VALOR PRODUCTO Y PRECIO PRODUCTO

include('conec.php');
$optionSeleccionado = $_POST['optionSeleccionadoPHP'];

//SI EL SELECT AREA DICE 'CUALQUIER' SE MUESTRAN TODAS LAS SUBAREAS
if($optionSeleccionado == 'cualquier'){
	$datos = mysql_query(
	"SELECT disciplinas.codDisciplina, disciplinas.nombreDisciplina
	FROM disciplinas
	ORDER BY disciplinas.nombreDisciplina ASC");
}else{
	$datos = mysql_query(
	"SELECT disciplinas.codDisciplina, disciplinas.nombreDisciplina
	FROM disciplinas
	WHERE disciplinas.codGrupoDisciplina = $optionSeleccionado
	ORDER BY disciplinas.nombreDisciplina ASC");
}

$arrDatos = array();
while ($rs = mysql_fetch_array($datos)) {
	$arrDatos[] = array_map('utf8_encode', $rs);
}

echo json_encode($arrDatos);

//Cierro
mysql_close($conexion);

?>