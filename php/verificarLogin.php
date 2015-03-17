<?php
header('Access-Control-Allow-Origin: *');

include("conec.php");

//Nombro variables con metodo POST
$nombreUsuario = $_POST['nombreUsuarioPHP'];
$claveUsuario = $_POST['claveUsuarioPHP'];

// $_SESSION['inpNombreUsuario'] = $_POST['inpNombreUsuario'];


// $nombreUsuario = 'admin';
// $claveUsuario = '123';

$sql = "SELECT usuarios.codUsuario, usuarios.rolAdministrador
FROM usuarios
WHERE usuarios.nombreUsuario = '$nombreUsuario'
AND usuarios.clave = '$claveUsuario'";

$resultado = mysql_query($sql);

$arrDatos = array();

// SI NO HAY ERROR SE EJECUTA
if(!$resultado) {
	//SE EJECUTA LA QUERY
	echo "\nSE HA DETECTADO EL SIGUIENTE ERROR: " . mysql_error(); 
}else{
	while ($rs = mysql_fetch_array($resultado)) {
		$arrDatos[] = array_map('utf8_encode', $rs);
	}
}

$_SESSION['nombreUsuario'] = $nombreUsuario;

echo json_encode($arrDatos);


//Cierro
mysql_close($conexion);

?>