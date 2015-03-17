<?php
header('Access-Control-Allow-Origin: *');

// ESTE PHP HACE CONSULTA DE LOS DOCUMENTOS FILTRADOS POR TITULO, PALABRAS CLAVE, DOSCIPLINA, TIPO DOC, USUARIO

include('conec.php');
$cod = $_POST['codDisciplinaPHP'];
// $cod = '92';
// $codUsuarioSeleccionado = 4;

$sql = "SELECT usuariosdisciplina.codUsuario FROM `usuariosdisciplina` WHERE `codDisciplina` = '$cod'";

$resultado = mysql_query($sql);

$arrDatos = array();

if(!$resultado){
	echo "SE HA DETECTADO EL SIGUIENTE ERROR AL CONSULTAR POR LA DISCIPLINA DEL USUARIO: \n" . mysql_error();
}else{
	while ($rs = mysql_fetch_array($resultado)) {
		$arrDatos[] = array_map('utf8_encode', $rs);
	}
}
if (count($arrDatos) >= 1) {
	echo '1';
}else{
	echo '0';
}

//Cierro
mysql_close($conexion);

?>