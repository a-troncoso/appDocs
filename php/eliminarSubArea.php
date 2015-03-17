<?php
header('Access-Control-Allow-Origin: *');

// ESTE PHP HACE CONSULTA DE LOS DOCUMENTOS FILTRADOS POR TITULO, PALABRAS CLAVE, DOSCIPLINA, TIPO DOC, USUARIO

include('conec.php');

$subAreaAEliminar = $_POST['subAreaAEliminarPHP'];

$sql = "DELETE FROM subareas WHERE subareas.EDTSubArea = '$subAreaAEliminar';";

$resultado = mysql_query($sql);

if(!$resultado){
	echo "\n SE HA DETECTADO EL SIGUIENTE ERROR AL ELIMINAR LA SUB ÁREA: " . mysql_error();  
}else{
	echo "\n Se ha eliminado la sub área $subAreaAEliminar";
}

//Cierro
mysql_close($conexion);

?>