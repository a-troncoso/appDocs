<?php

header('Access-Control-Allow-Origin: *');

// ESTE PHP HACE CONSULTA DE LOS DOCUMENTOS FILTRADOS POR TITULO, PALABRAS CLAVE, DOSCIPLINA, TIPO DOC, USUARIO

include('conec.php');

$nombreGrupo = $_POST['nombreGrupoPHP'];

$sql = "INSERT INTO gruposusuario values(null, '$nombreGrupo');";

$resultado = mysql_query(utf8_decode($sql));

if(!$resultado){
	echo "\n SE HA DETECTADO EL SIGUIENTE ERROR: " . mysql_error();  
}else{
	echo "\n Se ha agregado el grupo.";
}

//Cierro
mysql_close($conexion);

?>