<?php
header('Access-Control-Allow-Origin: *');

// ESTE PHP HACE CONSULTA DEL MAXIMO VALOR CORRELATIVO SEGUN DISCIPLINA

include('conec.php');

$codDisciplina = $_POST['codDisciplinaPHP'];

$datos = mysql_query(
"SELECT max(correlativo)
FROM correlativodisciplina
WHERE codDisciplina = '$codDisciplina'");

$arrDatos = array();

// SI HAY REGISTROS
if(mysql_num_rows($datos) > 0){
	while ($rs = mysql_fetch_array($datos)) {
		$arrDatos[] = array_map('utf8_encode', $rs);
	}
	$correlativoInt = (int)($arrDatos[0][0]) + 1;
	$correlativoStr = (string)$correlativoInt;
	switch ( strlen(utf8_decode($correlativoStr) )) {
	    case 1:
			$correlativoStr = '00' . $correlativoStr;
			break;
		case 2:	
			$correlativoStr = '0' . $correlativoStr;
			break;
	}
	echo json_encode($correlativoStr);
} // SI NO HAY REGISTROS
else{
	echo '001';
}

//Cierro
mysql_close($conexion);

?>