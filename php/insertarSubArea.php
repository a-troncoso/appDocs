<?php

// ESTE PHP HACE EL INGRESO DE MESERO
include('conec.php');

$EDTArea = $_POST['EDTAreaPHP'];
$nombreSubArea = $_POST['nombreSubAreaPHP'];
// $EDTArea = '1.08';
// $nombreSubArea = 'asd';

$sql1 =
"SELECT max(EDTSubArea) from subareas where EDTArea='$EDTArea';";

$resultado = mysql_query($sql1);

if(!$resultado){
	echo "SE HA DETECTADO EL SIGUIENTE ERROR AL CONSULTAR ULTIMO NUMERO DE SUB AREA: \n" . mysql_error();
}else{
	while ($rs = mysql_fetch_array($resultado)) {
		$arrDatos[] = array_map('utf8_encode', $rs);
	}
}

// intval 
$ultimaSubArea = substr($arrDatos[0][0], -2);
$subAreaAgregar = (intval($ultimaSubArea) + 1);
if (intval($subAreaAgregar) < 10) {
	$subAreaAgregar = '0' . $subAreaAgregar;
}
$EDTSubAreaAgregar = $EDTArea . '.' . ($subAreaAgregar);

// echo 'maxima sub area: ' . $arrDatos[0][0];
// echo ' ultima sub area: ' .$ultimaSubArea;
// echo ' sub area agregar: ' . $subAreaAgregar;
// echo ' a agregar: ' . $EDTSubAreaAgregar;

$sql2=
"INSERT INTO `subareas` (`EDTSubArea`, `nombreSubArea`, `EDTArea`) VALUES ('$EDTSubAreaAgregar', '$nombreSubArea', '$EDTArea');";

$resultado2 = mysql_query(utf8_decode($sql2));

if (!$resultado2) {
	echo "Ocurrio un error con la base de datos al ingresar la sub área: \n" + mysql_error();
}else{
	echo 'Se ha agregado la sub área: ' . $EDTSubAreaAgregar;
}

//Cierro
mysql_close($conexion);
?>
