<?php
header('Access-Control-Allow-Origin: *');

// ESTE PHP HACE CONSULTA DE LOS DOCUMENTOS FILTRADOS POR TITULO, PALABRAS CLAVE, DOSCIPLINA, TIPO DOC, USUARIO

include('conec.php');
$codUsuarioSeleccionado = $_POST['codUsuarioSeleccionadoPHP'];
// $codUsuarioSeleccionado = 4;

$sql ="SELECT usuarios.mailpersona
FROM usuarios
WHERE usuarios.codUsuario = $codUsuarioSeleccionado";

$resultado = mysql_query($sql);

$arrDatos = array();

if(!$resultado){
	echo "SE HA DETECTADO EL SIGUIENTE ERROR AL CONSULTAR EL CORREO DEL USUARIO: \n" . mysql_error();
}else{
	while ($rs = mysql_fetch_array($resultado)) {
		$arrDatos[] = array_map('utf8_encode', $rs);
	}
	echo json_encode($arrDatos[0][0]);
}

//Cierro
mysql_close($conexion);

?>