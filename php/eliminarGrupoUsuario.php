<?php
header('Access-Control-Allow-Origin: *');

// ESTE PHP HACE CONSULTA DE LOS DOCUMENTOS FILTRADOS POR TITULO, PALABRAS CLAVE, DOSCIPLINA, TIPO DOC, USUARIO

include('conec.php');

$codGrupo = $_POST['codGrupoPHP'];

$sql = "DELETE FROM gruposusuario WHERE gruposusuario.codGrupoUsuario = $codGrupo;";

$resultado = mysql_query($sql);

if(!$resultado){
	echo "\n SE HA DETECTADO EL SIGUIENTE ERROR: " . mysql_error();  
}else{
	echo "\n Se ha eliminado el grupo $codGrupo.";
}

//Cierro
mysql_close($conexion);

?>