<?php
header('Access-Control-Allow-Origin: *');

// ESTE PHP HACE CONSULTA DE LOS DOCUMENTOS FILTRADOS POR TITULO, PALABRAS CLAVE, DOSCIPLINA, TIPO DOC, USUARIO

include('conec.php');
$codUsuario =$_POST['codUsuarioPHP'];

// $datos = mysql_query(
// 	"SELECT documentos.tituloDoc, documentos.codDocumento, documentos.nombreArchivo, versiones.nombreVersion,
// 	documentos.estadoemision, DATE_FORMAT(documentos.fechaSubida, '%d-%m-%Y %H:%i:%s'), documentos.resumenDoc
// 	FROM documentos, versiones, usuariosrevisandocumentos
// 	WHERE documentos.codVersion = versiones.codVersion
// 	AND documentos.codDocumento = usuariosrevisandocumentos.codDocumento
// 	AND usuariosrevisandocumentos.codUsuario = $codUsuario;");

$datos = mysql_query(
	"SELECT documentos.tituloDoc, documentos.codDocumento, usuarios.nombreUsuario, versiones.nombreVersion,
	documentos.estadoemision, DATE_FORMAT(documentos.fechaSubida, '%d-%m-%Y %H:%i:%s'), documentos.resumenDoc
	FROM documentos, versiones, usuariosrevisandocumentos, usuarios
	WHERE documentos.codVersion = versiones.codVersion
	AND documentos.codDocumento = usuariosrevisandocumentos.codDocumento
	AND usuariosrevisandocumentos.codUsuarioEmisor = usuarios.codUsuario
	AND usuariosrevisandocumentos.codUsuario = $codUsuario;");


$arrDatos = array();
while ($rs = mysql_fetch_array($datos)) {
	$arrDatos[] = array_map('utf8_encode', $rs);
}

echo json_encode($arrDatos);

//Cierro
mysql_close($conexion);

?>