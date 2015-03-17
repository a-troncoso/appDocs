<?php

header('Access-Control-Allow-Origin: *');

// ESTE PHP HACE CONSULTA DE LOS DOCUMENTOS FILTRADOS POR TITULO, PALABRAS CLAVE, DOSCIPLINA, TIPO DOC, USUARIO

include('conec.php');

$nombreUsuario = $_POST['nombreUsuarioPHP'];
$nombrePersona = $_POST['nombrePersonaPHP'];
$apellidoPersona = $_POST['apellidoPersonaPHP'];
$emailPersona = $_POST['emailPersonaPHP'];
$claveUsuario = $_POST['claveUsuarioPHP'];
$grupoUsuarioAsignado = $_POST['grupoUsuarioAsignadoPHP'];
$rolAdministrador = $_POST['rolAdmPHP'];
$permisoAgregarDoc = $_POST['permisoAgregarDocPHP'];
$permisoBuscarVerDoc = $_POST['permisoBuscarVerDocPHP'];
$permisoEditarDoc = 1;
$estado = 1;
// $disciplinasSeleccionadas es un array que contiene los codigos de las disciplinas seleccionadas
$disciplinasSeleccionadas = $_POST['disciplinasSeleccionadasPHP'];
$resultado4 = true;

// $nombreUsuario = 'manchas1';
// $nombrePersona = 'manacho';
// $apellidoPersona = 'namc';
// $emailPersona = 'mano@';
// $claveUsuario = 'ddf';
// $grupoUsuarioAsignado = 1;
// $permisoAgregarDoc = 1;
// $permisoBuscarVerDoc = 1;
// $permisoEditarDoc = 1;
// $estado = 1;
// $disciplinasSeleccionadas = [34,43,3];


$sql = "INSERT INTO usuarios values(null, '$nombreUsuario','$nombrePersona', '$apellidoPersona',
	'$emailPersona', '$claveUsuario', $rolAdministrador, '$permisoAgregarDoc', '$permisoBuscarVerDoc', '$permisoEditarDoc', $estado);";
$resultado1 = mysql_query(utf8_decode($sql));

//OBTIENE EL CODIGO DEL USUARIO PARA SABER RELACIONAR EL USUARIO CON SU GRUPO
$sql2 = "SELECT MAX(usuarios.codUsuario) FROM usuarios;";
$resultado2 = mysql_query($sql2);
$arrDatos = array();
while ($rs = mysql_fetch_array($resultado2)) {
	$arrDatos[] = array_map('utf8_encode', $rs);
}
$codUsuario = $arrDatos[0][0];

//SABIENDO QUÉ USUARIO SE INSERTA EN LA TABLA QUE RELACIONA GRUPOS CON USUARIOS
$sql3 = "INSERT INTO `bddocs`.`grupousuariousuario` (`codGrupoUsuario`, `codUsuario`)
VALUES ('$grupoUsuarioAsignado', '$codUsuario');";
$resultado3 = mysql_query($sql3);

foreach ($disciplinasSeleccionadas as $i) {
    $sql4 = "INSERT INTO `bddocs`.`usuariosdisciplina` (`codUsuario`, `codDisciplina`) VALUES ('$codUsuario', '$i');";
    $resultado4 = $resultado4 and mysql_query($sql4);
}

$resultado5 = $resultado1 and $resultado2 and $resultado3 and $resultado4;

if(!$resultado5){
	echo "\n SE HA DETECTADO EL SIGUIENTE ERROR: " . mysql_error();
}else{
	echo "\n SE HA AGREGADO EL USUARIO.";
}

//Cierro
mysql_close($conexion);

?>