<?php
header('Access-Control-Allow-Origin: *');

// ESTE PHP HACE CONSULTA DE DATOS DEL ARCHIVO A PARTIOD DE SU CODIGO
include('conec.php');

$codDoc = $_POST['codDocPHP'];
$codUsuario = $_POST['codUsuarioPHP'];

// $codDoc = '1.02.03-32-BB-001-V0B';
// $codUsuario = 1;

$datos = mysql_query(
"SELECT documentos.nombreArchivo,
documentos.tituloDoc,
subAreas.nombreSubArea,
disciplinas.nombreDisciplina,
tiposdocumento.nombreTipoDocumento,
versiones.nombreVersion, 
documentos.resumenDoc,
documentos.observacionesDoc,
documentos.palabrasClave,
documentos.fechaSubida,
documentos.codVersion 
FROM documentos, subareas, usuariosrevisanDocumentos, disciplinas, tiposdocumento, versiones
WHERE documentos.EDTSubArea = subAreas.EDTSubArea
AND documentos.codDisciplina = disciplinas.codDisciplina
AND tiposdocumento.codTipoDocumento = documentos.codTipoDocumento
AND documentos.codVersion = versiones.codVersion
AND documentos.codDocumento =  usuariosrevisanDocumentos.codDocumento
AND usuariosrevisanDocumentos.codUsuario = $codUsuario
AND documentos.codDocumento = '$codDoc'");


$arrDatos = array();
while ($rs = mysql_fetch_array($datos)) {
	$arrDatos[] = array_map('utf8_encode', $rs);
}

echo json_encode($arrDatos);

// $json2 = json_encode($arrDatos);
// echo $json2;

//Cierro
mysql_close($conexion);

?>