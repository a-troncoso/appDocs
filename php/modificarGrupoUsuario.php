<?php
header('Access-Control-Allow-Origin: *');

// ESTE PHP HACE CONSULTA DE LOS DOCUMENTOS FILTRADOS POR TITULO, PALABRAS CLAVE, DOSCIPLINA, TIPO DOC, USUARIO

include('conec.php');

$nuevoNombreGrupo = $_POST['nuevoNombreGrupoPHP'];
$codGrupo = $_POST['codGrupoPHP'];

$sql = 
"UPDATE gruposusuario SET nombreGrupoUsuario = '$nuevoNombreGrupo' WHERE gruposusuario.codGrupoUsuario = $codGrupo;";

$resultado = mysql_query($sql);

if(!$resultado){
	echo "\n SE HA DETECTADO EL SIGUIENTE ERROR: " . mysql_error();  
}

//Cierro
mysql_close($conexion);

?>