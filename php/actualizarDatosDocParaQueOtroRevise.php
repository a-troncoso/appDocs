<?php
header('Access-Control-Allow-Origin: *');

include("conec.php");

$codUsuario = $_POST['codUsuarioPHP'];
$codUsuarioEscogido = $_POST['codUsuarioEscogidoPHP'];
$observacionesDoc = $_POST['observacionesDocPHP'];
$codDoc = $_POST['codDocPHP'];
$codUsuarioEmisor = $_POST['codUsuarioEmisorPHP'];

// $codUsuario = 1;
// $codUsuarioEscogido = 1;
// $observacionesDoc = 'observacion dada por php ahora';
// $codDoc = '1.01.05-21-CC-001-V0B';

$sql1 = "SELECT documentos.codVersion FROM documentos WHERE documentos.codDocumento = '$codDoc';";
$resultado1 = mysql_query($sql1);

$arrDatos = array();
if(!$resultado1){
	echo "SE HA DETECTADO EL SIGUIENTE ERROR AL CONSULTAR EL CODIGO DE VERSION DEL DOCUMENTO: \n" . mysql_error();
}else{
	while ($rs = mysql_fetch_array($resultado1)) {
		$arrDatos[] = array_map('utf8_encode', $rs);
	}
	$codVersionDoc =  $arrDatos[0][0];
};
// echo '<br>'.$codVersionDoc;
switch ($codVersionDoc) {
    case 'V0B':
        $nuevoCodVersionDoc = "V0C";
        break;
    case 'V0C':
        $nuevoCodVersionDoc = "V0D";
        break;
    case 'V0D':
        $nuevoCodVersionDoc = "V00";
        break;
}

$nuevoCodDoc = substr($codDoc, 0, -3);
$nuevoCodDoc = $nuevoCodDoc . $nuevoCodVersionDoc;

$sql = "UPDATE `bddocs`.`documentos`
SET `codDocumento` = '$nuevoCodDoc',
`codVersion` = '$nuevoCodVersionDoc',
`observacionesDoc` = '$observacionesDoc'
WHERE `documentos`.`codDocumento` = '$codDoc';";

$sql2 = "UPDATE `bddocs`.`usuariosrevisandocumentos`
SET `codDocumento` = '$nuevoCodDoc',
`codUsuario` = '$codUsuarioEscogido',
`codUsuarioEmisor` = '$codUsuarioEmisor'
WHERE `usuariosrevisandocumentos`.`codDocumento` = '$codDoc'
AND `usuariosrevisandocumentos`.`codUsuario` = $codUsuario;";

$resultado = mysql_query($sql);
$resultado2 = mysql_query($sql2);
$resultado3 = $resultado and $resultado2;

//SI NO HAY ERROR SE EJECUTA
if(!$resultado3) {
	//SE EJECUTA LA QUERY
	echo "\nSE HA DETECTADO EL SIGUIENTE ERROR AL ACTUALIZAR LOS DATOS: " . mysql_error();
}else{
	echo "\nSe han actualizado los datos del documento.";
}

//Cierro
mysql_close($conexion);

?>