<?php

header('Access-Control-Allow-Origin: *');

include("conec.php");

$ruta="C:/xampp/htdocs/appDocs/docsSubidos/";

//Nombro variables con metodo POST
$codigoDoc = $_POST['codigoDoc'];
$tituloDoc = $_POST['tituloDoc'];
$EDTSubArea = $_POST['EDTSubArea'];
$codDisciplina = $_POST['codDisciplina'];
$codTipoDoc = $_POST['codTipoDoc'];
$codUsuario = $_POST['codUsuario'];
$codVersion = $_POST['codVersion'];
$resumenDoc = $_POST['resumenDoc'];
$observacionesDoc = $_POST['observacionesDoc'];
$palabrasClave = $_POST['palabrasClave'];
$fechaSubida = date('Y-m-d');

// echo "\n codigo Doc: " . $codigoDoc;
// echo "\n titulo doc: " . $tituloDoc;
// echo "\n edt sub area: " . $EDTSubArea;
// echo "\n cod disciplina: " . $codDisciplina;
// echo "\n cod tipo doc: " . $codTipoDoc;
// echo "\n cod usuario: " . $codUsuario[0];
// echo "\n cod version: " . $codVersion;
// echo "\n resumen doc: " . $resumenDoc;
// echo "\n observaciones: " . $observacionesDoc;
// echo "\n palabras clave: " . $palabrasClave;

// $codigoDoc = 'codigoDoc';
// $tituloDoc = 'tituloDoc';
// $EDTSubArea = '1.06.02';
// $codDisciplina = '44';
// $codTipoDoc = 'CA';
// $codUsuario = 2;
// $codVersion = 'V0A';
// $resumenDoc = 'resumenDoc';
// $observacionesDoc = 'observacionesDoc';
// $palabrasClave = 'palabrasClave';
// $fechaSubida = date('Y-m-d');

//Como no sabemos cuantos archivos van a llegar, iteramos la variable $_FILES
foreach ($_FILES as $key) {
	if($key['error'] == UPLOAD_ERR_OK ){//Verificamos si se subio correctamente
		$nombre = $key['name'];//Obtenemos el nombre del archivo
		$temporal = $key['tmp_name']; //Obtenemos el nombre del archivo temporal
		$tamano = ($key['size'] / 1000)."Kb"; //Obtenemos el tamaño en KB

		move_uploaded_file($temporal, $ruta . $nombre); //Movemos el archivo temporal a la ruta especificada
		echo "se cargo el achivo"; //El echo es para que lo reciba jquery
	}
	else{
		echo $key['error']; //Si no se cargo mostramos el error
	}
}

$sql = "INSERT INTO documentos values(
	'$codigoDoc',
	'$tituloDoc',
	'$EDTSubArea',
	'$codDisciplina',
	'$codTipoDoc',
	$codUsuario[0],
	'$codVersion',
	'$resumenDoc',
	'$observacionesDoc',
	'$palabrasClave',
	'$fechaSubida');";

$resultado = mysql_query($sql);

// SI NO HAY ERROR SE EJECUTA
if(!$resultado) {
	//SE EJECUTA LA QUERY
	echo "\nHAS TENIDO EL SIGUIENTE ERROR: " . mysql_error(); 
}


//Cierro
mysql_close($conexion);

?>