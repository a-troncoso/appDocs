<?php session_start(); ?>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>


<?php
header('Access-Control-Allow-Origin: *');

include("conec.php");

//Nombro variables con metodo POST
$nombreUsuario = $_POST['inpNombreUsuario'];
$claveUsuario = $_POST['inpClaveUsuario'];
// $nombreUsuario = 'admin';
// $claveUsuario = '123';

$sql = "SELECT usuarios.codUsuario, usuarios.nombreUsuario
FROM usuarios
WHERE usuarios.nombreUsuario = '$nombreUsuario'
AND usuarios.clave = '$claveUsuario'";

$resultado = mysql_query($sql);

$arrDatos = array();

// SI NO HAY ERROR SE EJECUTA
if(!$resultado) {
	//SE EJECUTA LA QUERY
	echo "\nSE HA DETECTADO EL SIGUIENTE ERROR: " . mysql_error();
}

while ($rs = mysql_fetch_array($resultado)) {
	$arrDatos[] = array_map('utf8_encode', $rs);
}

if (mysql_num_rows($resultado)) {
	$_SESSION['codUsuario'] = $arrDatos[0][0];
	$_SESSION['nombreUsuario'] = $arrDatos[0][1];

	// echo $arrDatos[0][0]; //codigo de usuario
	// echo $arrDatos[0][1]; //nombre de usuario

	//Consulta cuantos documentos tiene para revisar
	$resultado2 = mysql_query(
		"SELECT documentos.tituloDoc, documentos.codDocumento, documentos.nombreArchivo,
		versiones.nombreVersion, documentos.fechaSubida, documentos.resumenDoc
		FROM documentos, versiones, usuariosrevisandocumentos
		WHERE documentos.codVersion = versiones.codVersion
		AND documentos.codDocumento = usuariosrevisandocumentos.codDocumento
		AND usuariosrevisandocumentos.codUsuario = " . $arrDatos[0][0] . ";");

	$cantidadDocsParaRevisar = mysql_num_rows($resultado2);
	$_SESSION['cantidadDocsParaRevisar'] = $cantidadDocsParaRevisar;

	//consulta si es administrador
	$resultado3 = mysql_query(
	"SELECT rolAdministrador FROM usuarios WHERE codUsuario = " . $arrDatos[0][0] . ";");

	$arrDatos2 = array();
	while ($rs = mysql_fetch_array($resultado3)) {
		$arrDatos2[] = array_map('utf8_encode', $rs);
	}
	$_SESSION['rolAdministrador'] = $arrDatos2[0][0];

	//Consulta si tiene permiso para agregar documentos
	$resultado4 = mysql_query(
	"SELECT permisoAgregarDoc FROM usuarios WHERE codUsuario = " . $arrDatos[0][0] . ";");

	$arrDatos3 = array();
	while ($rs = mysql_fetch_array($resultado4)) {
		$arrDatos3[] = array_map('utf8_encode', $rs);
	}
	$_SESSION['permisoAgregarDoc'] = $arrDatos3[0][0];

	//Consulta si tiene permiso para buscar y ver documentos
	$resultado5 = mysql_query(
	"SELECT permisoBuscarVerDoc FROM usuarios WHERE codUsuario = " . $arrDatos[0][0] . ";");

	$arrDatos4 = array();
	while ($rs = mysql_fetch_array($resultado5)) {
		$arrDatos4[] = array_map('utf8_encode', $rs);
	}
	$_SESSION['permisoBuscarVerDoc'] = $arrDatos4[0][0];

	//Consulta email del usuario
	$resultado6 = mysql_query(
	"SELECT mailPersona FROM usuarios WHERE codUsuario = " . $arrDatos[0][0] . ";");

	$arrDatos5 = array();
	while ($rs = mysql_fetch_array($resultado6)) {
		$arrDatos5[] = array_map('utf8_encode', $rs);
	}
	$_SESSION['mailUsuario'] = $arrDatos5[0][0];


	echo 'Login verificado...cargando';
	echo "<script>
	<!--
	window.location='../resumen.php';
	//-->
	</script>";
}else{
	echo 'Usuario o contraseña incorrectos.';
}


//Cierro
mysql_close($conexion);

?>