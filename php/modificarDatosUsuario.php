<?php
header('Access-Control-Allow-Origin: *');

// ESTE PHP HACE CONSULTA DE LOS DOCUMENTOS FILTRADOS POR TITULO, PALABRAS CLAVE, DOSCIPLINA, TIPO DOC, USUARIO

include('conec.php');

$codUsuarioSeleccionadoAEditar = $_POST['codUsuarioSeleccionadoAEditarPHP'];
$nombreUsuarioAnterior = $_POST['nombreUsuarioAnteriorPHP'];
$codGrupoUsuarioAnterior = $_POST['codGrupoUsuarioAnteriorPHP'];

$nombreUsuario = $_POST['nombreUsuarioPHP'];
$nombrePersona = $_POST['nombrePersonaPHP'];
$apellidoPersona = $_POST['apellidoPersonaNuevoPHP'];
$emailPersona = $_POST['emailPersonaPHP'];
$claveUsuario = $_POST['claveUsuarioPHP'];
$rolAdm = $_POST['rolAdmNuevoPHP'];
$permisoAgregarDoc = $_POST['permisoAgregarDocNuevoPHP'];
$permisoBuscarVerDoc = $_POST['permisoBuscarVerDocNuevoPHP'];
// $permisoEditarDoc = $_POST['permisoEditarDocNuevoPHP'];
$estado = $_POST['estadoPHP'];

$grupoUsuarioAsignadoNuevo = $_POST['grupoUsuarioAsignadoNuevoPHP'];

// $sql = "UPDATE `bddocs`.`usuarios`
// SET `nombreUsuario` = 'usuario1', `nombrePersona` = 'alvara', `apellidoPersona` = 'troncos0',
// `mailPersona` = 'alvaro@gmail.con', `clave` = '12', `rolAdministrador` = '1',
// `permisoAgregarDoc` = '0', `permisoBuscarVerDoc` = '0', `permisoEditarDoc` = '1', `estado` = '0'
// WHERE `usuarios`.`codUsuario` = 4
// AND `usuarios`.`nombreUsuario` = 'usuari2'";

$sql = "UPDATE `bddocs`.`usuarios`
SET `nombreUsuario` = '$nombreUsuario', `nombrePersona` = '$nombrePersona', `apellidoPersona` = '$apellidoPersona',
`mailPersona` = '$emailPersona', `clave` = '$claveUsuario', `rolAdministrador` = '$rolAdm',
`permisoAgregarDoc` = '$permisoAgregarDoc', `permisoBuscarVerDoc` = '$permisoBuscarVerDoc',
`permisoEditarDoc` = 1, `estado` = '$estado'
WHERE `usuarios`.`codUsuario` = $codUsuarioSeleccionadoAEditar
AND `usuarios`.`nombreUsuario` = '$nombreUsuarioAnterior'";

$sql2 ="UPDATE `bddocs`.`grupousuariousuario`
SET `codGrupoUsuario` = '$grupoUsuarioAsignadoNuevo'
WHERE `grupousuariousuario`.`codGrupoUsuario` = $codGrupoUsuarioAnterior
AND `grupousuariousuario`.`codUsuario` = $codUsuarioSeleccionadoAEditar;";

$resultado = mysql_query(utf8_decode($sql));
$resultado2 = mysql_query($sql2);

if(!$resultado || !$resultado2){
	echo "\n SE HA DETECTADO EL SIGUIENTE ERROR AL MODIFICAR LOS DATOS DEL USUARIO: " . mysql_error() . " " . $sql2 ;
}else{
	echo "\n USUARIO MODIFICADO";
};

//Cierro
mysql_close($conexion);

?>