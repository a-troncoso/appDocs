<?php

// ESTE PHP HACE CONSULTA DE LOS DOCUMENTOS FILTRADOS POR TITULO, PALABRAS CLAVE, DOSCIPLINA, TIPO DOC, USUARIO

include('conec.php');

$sql =
	"SELECT nombreUsuario, nombrePersona, apellidoPersona, mailPersona,
	rolAdministrador, permisoAgregarDoc, PermisoBuscarVerDoc, estado, codUsuario
	FROM usuarios";

$resultado = mysql_query(utf8_decode($sql));

$arrDatos = array();

if(!$resultado){
	echo "\n SE HA DETECTADO EL SIGUIENTE ERROR: " . mysql_error();
}else{
	while ($rs = mysql_fetch_array($resultado)) {
		switch ($rs['rolAdministrador']) {
			case 0:
				$rs['rolAdministrador'] = 'glyphicon glyphicon-remove';
				break;
			case 1:
				$rs['rolAdministrador'] = 'glyphicon glyphicon-ok';
				break;
			default:
				$rs['rolAdministrador'] = 'glyphicon glyphicon-remove';
		}
		switch ($rs['permisoAgregarDoc']) {
			case 0:
				$rs['permisoAgregarDoc'] = 'glyphicon glyphicon-remove';
				break;
			case 1:
				$rs['permisoAgregarDoc'] = 'glyphicon glyphicon-ok';
				break;
			default:
				$rs['permisoAgregarDoc'] = 'glyphicon glyphicon-remove';
		}
		switch ($rs['PermisoBuscarVerDoc']) {
			case 0:
				$rs['PermisoBuscarVerDoc'] = 'glyphicon glyphicon-remove';
				break;
			case 1:
				$rs['PermisoBuscarVerDoc'] = 'glyphicon glyphicon-ok';
				break;
			default:
				$rs['PermisoBuscarVerDoc'] = 'glyphicon glyphicon-remove';
		}
		$arrDatos[] = array_map('utf8_encode', $rs);
	}
	echo json_encode($arrDatos);
}

//Cierro
mysql_close($conexion);

?>