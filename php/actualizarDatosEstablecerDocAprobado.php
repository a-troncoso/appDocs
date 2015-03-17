<?php
header('Access-Control-Allow-Origin: *');

include("conec.php");

$codUsuario = $_POST['codUsuarioPHP'];
$codDoc = $_POST['codDocPHP'];
// $codDocAprobado = $_POST['codDocAprobadoPHP'];

//$codUsuario = 1;
//$codUsuarioEscogido = 2;
// $observacionesDoc = 'observacion dada por php ahora';
//$codDoc = '1.02.03-32-BB-001-V0B';

$nuevoCodDoc = substr($codDoc, 0, -3);
$nuevoCodDoc = $nuevoCodDoc . 'V00';

$sql = "UPDATE `bddocs`.`documentos`
SET `codDocumento` = '$nuevoCodDoc', `codVersion` = 'V00'
WHERE `documentos`.`codDocumento` = '$codDoc';";

$sql2 = "DELETE FROM `bddocs`.`usuariosrevisandocumentos`
WHERE `usuariosrevisandocumentos`.`codDocumento` = '$codDoc'
AND `usuariosrevisandocumentos`.`codUsuario` = $codUsuario";

$sql3 = "INSERT INTO `bddocs`.`usuariosaprobarondocumentos`
VALUES ('$codDoc', '$codUsuario');";

$resultado = mysql_query($sql);
$resultado2 = mysql_query($sql2);
$resultado3 = mysql_query($sql3);

$resultado4 = $resultado and $resultado2 and $resultado3;

//SI NO HAY ERROR SE EJECUTA
if(!$resultado4) {
	//SE EJECUTA LA QUERY
	echo "\nSE HA DETECTADO EL SIGUIENTE ERROR AL APROBAR  EL DOCUMENTO: " . mysql_error();
}else{
	echo "\nSe ha aprobado el documento.";
}

//Cierro
mysql_close($conexion);

?>