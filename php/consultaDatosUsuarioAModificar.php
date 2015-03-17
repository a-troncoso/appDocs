<?php
header('Access-Control-Allow-Origin: *');

// ESTE PHP HACE CONSULTA DE

include('conec.php');

$codUsuario = $_POST['codUsuarioSeleccionadoAEditarPHP'];
// $codUsuario = 3;

$datos = mysql_query(
	"SELECT usuarios.nombreUsuario, usuarios.nombrePersona, usuarios.apellidoPersona, usuarios.mailPersona, usuarios.clave,
	usuarios.rolAdministrador, usuarios.permisoAgregarDoc, usuarios.permisoBuscarVerDoc,
	usuarios.estado, gruposusuario.codgrupousuario
	FROM usuarios, gruposusuario, grupousuariousuario
	WHERE usuarios.codUsuario = $codUsuario
	AND grupousuariousuario.codUsuario = $codUsuario
	AND gruposusuario.codgrupousuario = grupousuariousuario.codgrupousuario;");

$arrDatos = array();
while ($rs = mysql_fetch_array($datos)) {
	$arrDatos[] = array_map('utf8_encode', $rs);
}

echo json_encode($arrDatos);

//Cierro
mysql_close($conexion);

?>