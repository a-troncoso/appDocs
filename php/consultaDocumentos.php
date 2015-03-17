<?php
header('Access-Control-Allow-Origin: *');

// ESTE PHP HACE CONSULTA DE LOS DOCUMENTOS FILTRADOS POR TITULO, PALABRAS CLAVE, DOSCIPLINA, TIPO DOC, USUARIO

include('conec.php');

$tituloDoc = $_POST['tituloDocPHP'];
$palabrasClave = $_POST['palabrasClavePHP'];
$codDisciplina = $_POST['codDisciplinaPHP'];
$codTipoDocumento = $_POST['codTipoDocumentoPHP'];

// $tituloDoc = '%%';
// $palabrasClave ='%%';
// $codDisciplina ='%%';
// $codTipoDocumento = '%%';

if($tituloDoc == '') {$tituloDoc = '%%';}else{$tituloDoc = '%' . $tituloDoc . '%';}
if($palabrasClave == '') {$palabrasClave = '%%';} else{$palabrasClave = '%' . $palabrasClave . '%';}
if($codDisciplina == '') {$codDisciplina = '%%';}
if($codTipoDocumento == '') {$codTipoDocumento = '%%';}

$datos = mysql_query(
	"SELECT documentos.tituloDoc, documentos.codDocumento, documentos.nombreArchivo, versiones.nombreVersion,
	documentos.estadoemision, DATE_FORMAT(documentos.fechaSubida, '%d-%m-%Y %H:%i:%s'), documentos.resumenDoc
	FROM documentos, versiones
	WHERE documentos.tituloDoc like '$tituloDoc'
	and documentos.palabrasClave like '$palabrasClave'
	and documentos.codDisciplina like '$codDisciplina'
	and documentos.codTipoDocumento like '$codTipoDocumento'
	and documentos.codVersion = versiones.codVersion");

//NOTA: RECORTAR EL NOMBRE DEL ARCHIVO HASTA EL CARACTER 28
$arrDatos = array();
while ($rs = mysql_fetch_array($datos)) {
	if (strlen($rs['nombreArchivo']) >= 35) {
		//acorta el nombre del archivo
		$rs['nombreArchivo'] = substr($rs['nombreArchivo'], 0, 25) . "(...)".substr($rs['nombreArchivo'], -4) ;
		$rs[2] = substr($rs[2], 0, 25) . "(...)".substr($rs[2], -4) ;
	}
	// echo $rs['nombreArchivo']."</br>";
	$arrDatos[] = array_map('utf8_encode', $rs);
}

echo json_encode($arrDatos);

//Cierro
mysql_close($conexion);

?>