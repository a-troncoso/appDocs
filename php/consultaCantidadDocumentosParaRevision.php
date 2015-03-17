<?php 
session_start();
header('Access-Control-Allow-Origin: *');

// ESTE PHP HACE CONSULTA DE

include('conec.php');

$datos = mysql_query(
	"SELECT documentos.tituloDoc, documentos.codDocumento, documentos.nombreArchivo,
	versiones.nombreVersion, documentos.fechaSubida, documentos.resumenDoc
	FROM documentos, versiones, usuariosrevisandocumentos
	WHERE documentos.codVersion = versiones.codVersion
	AND documentos.codDocumento = usuariosrevisandocumentos.codDocumento
	AND usuariosrevisandocumentos.codUsuario = " . $_SESSION['codUsuario'] . ";");

$cantidadDocsParaRevidar = mysql_num_rows($datos);
echo $cantidadDocsParaRevidar;

//Cierro
mysql_close($conexion); 
?>