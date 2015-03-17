<?php
header('Access-Control-Allow-Origin: *');

// ESTE PHP HACE CONSULTA DE LOS DOCUMENTOS FILTRADOS POR TITULO, PALABRAS CLAVE, DOSCIPLINA, TIPO DOC, USUARIO

include('conec.php');

$codDoc = $_POST['codDocPHP'];
//$idDoc = '1.01.05-34-DB-001-V0B';
$sql =
	"SELECT documentos.nombreArchivo
	FROM documentos
	WHERE documentos.codDocumento = '$codDoc'";

$resultado = mysql_query($sql);

$arrDatos = array();

if(!$resultado){
	echo "\n SE HA DETECTADO EL SIGUIENTE ERROR: " . mysql_error();
}else{
	while ($rs = mysql_fetch_array($resultado)) {
		$arrDatos[] = array_map('utf8_encode', $rs);
	}
	echo json_encode($arrDatos);
}

//Cierro
mysql_close($conexion);

?>