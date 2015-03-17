<?php
session_start();

header('Access-Control-Allow-Origin: *');

include("conec.php");

//Nombro variables con metodo POST
$nombreArchivo = $_POST['nombreArchivoPHP'];
$codigoDoc = $_POST['codigoDocPHP'];
$tituloDoc = $_POST['tituloDocPHP'];
$EDTSubArea = $_POST['EDTSubAreaPHP'];
$codDisciplina = $_POST['codDisciplinaPHP'];
$codTipoDoc = $_POST['codTipoDocPHP'];
$codUsuario = $_POST['codUsuarioPHP'];
$codUsuarioEmisor = $_POST['codUsuarioEmisorPHP'];
$codVersion = $_POST['codVersionPHP'];
$resumenDoc = $_POST['resumenDocPHP'];
$observacionesDoc = $_POST['observacionesDocPHP'];
$palabrasClave = $_POST['palabrasClavePHP'];
$fechaSubida = date('Y-m-d');
$correlativo = $_POST['correlativoPHP'];
$correlativo = (int)$correlativo;

$emisionSeleccionada = $_POST['emisionSeleccionadaPHP'];

// echo "\n codigo Doc: " . $codigoDoc;
// echo "\n titulo doc: " . $tituloDoc;
// echo "\n edt sub area: " . $EDTSubArea;
// echo "\n cod disciplina: " . $codDisciplina;
// echo "\n cod tipo doc: " . $codTipoDoc;
// echo "\n cod usuario: " . $codUsuario[0];
// echo "\n cod version: " . $codVersion;
// echo "\n resumen doc: " . $resumenDoc;
// echo "\n observaciones: " . $observacionesDoc;
// echo "\n palabras clave: " . $palabrasClave;

// $codigoDoc = 'codigoDoc';
// $tituloDoc = 'tituloDoc';
// $EDTSubArea = '1.06.02';
// $codDisciplina = '44';
// $codTipoDoc = 'CA';
// $codUsuario = 2;
// $codVersion = 'V0A';
// $resumenDoc = 'resumenDoc';
// $observacionesDoc = 'observacionesDoc';
// $palabrasClave = 'palabrasClave';
// $fechaSubida = date('Y-m-d');

$resultado2 = true;

// $sql = "INSERT INTO documentos values(
// 		'$codigoDoc',
// 		'$nombreArchivo',
// 		'$tituloDoc',
// 		'$EDTSubArea',
// 		'$codDisciplina',
// 		'$codTipoDoc',
// 		'$codVersion',
// 		'$emisionSeleccionada'
// 		'$resumenDoc',
// 		'$observacionesDoc',
// 		'$palabrasClave',
// 		CURRENT_TIMESTAMP);";

$sql = "INSERT INTO `bddocs`.`documentos`(`codDocumento`, `nombreArchivo`, `tituloDoc`, `EDTSubArea`, `codDisciplina`, `codTipoDocumento`,
	`codVersion`, `estadoEmision`, `resumenDoc`, `observacionesDoc`, `palabrasClave`, `fechaSubida`)
VALUES ('$codigoDoc', '$nombreArchivo', '$tituloDoc', '$EDTSubArea', '$codDisciplina', '$codTipoDoc', '$codVersion',
	'$emisionSeleccionada', '$resumenDoc', '$observacionesDoc', '$palabrasClave', CURRENT_TIMESTAMP);";

$resultado = mysql_query(utf8_decode($sql));

// foreach ($codUsuario as $valor) {
//     $sql2 = "INSERT INTO usuariosRevisanDocumentos values('$codigoDoc', $valor)";
//     $resultado2 = $resultado2 and mysql_query($sql2);
// }

if ($codUsuario != '') {
	$sql2 = "INSERT INTO usuariosrevisandocumentos values('$codigoDoc', $codUsuario, $codUsuarioEmisor)";
	$resultado2 = $resultado2 and mysql_query($sql2);
}

$sql3 = "INSERT INTO correlativodisciplina VALUES ($correlativo, '$codDisciplina');";

$resultado3 = $resultado2 and mysql_query($sql3);

// SI NO HAY ERROR SE EJECUTA
if(!$resultado and !$resultado2 and !$resultado3) {
	//SE EJECUTA LA QUERY
	echo "\nSE HA DETECTADO EL SIGUIENTE ERROR: " . mysql_error();
}else{
	echo "\nSe han guardado los datos del documento.\n\n" ;
}

//Cierro
mysql_close($conexion);

?>