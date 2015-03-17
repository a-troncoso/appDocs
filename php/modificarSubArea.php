<?php
header('Access-Control-Allow-Origin: *');

// ESTE PHP HACE CONSULTA DE LOS DOCUMENTOS FILTRADOS POR TITULO, PALABRAS CLAVE, DOSCIPLINA, TIPO DOC, USUARIO

include('conec.php');

$subAreaAModificar = $_POST['subAreaAModificarPHP'];
$nuevoNombreSubArea = $_POST['nuevoNombreSubAreaPHP'];

$sql = 
"UPDATE subareas SET nombreSubArea = '$nuevoNombreSubArea' WHERE subareas.EDTSubArea = '$subAreaAModificar';";

$resultado = mysql_query($sql);

if(!$resultado){
	echo "\n SE HA DETECTADO EL SIGUIENTE ERROR AL MODIFICAR LA SUB AREA: " . mysql_error();  
}else{
	echo "Se ha modificado la sub area";
}

//Cierro
mysql_close($conexion);

?>