<?php
header('Access-Control-Allow-Origin: *');

//ESTE ESTABLECE LA ZONA HORARIA PARA EL HORARIO DE VERANO
date_default_timezone_set('America/La_Paz');

//servidor local
////$usuario = "root";
//$clave = "";
//$bd = "bddocs";

//hostinger
//$servidor = "mysql.hostinger.es";
//$usuario = "u695684602_alvar";
//$clave = "123456";
//$bd = "u695684602_bddoc";

//valysistem

$servidor = "localhost";
$usuario = "juaco";
$clave = "12345";
$bd = "bddocs";

$conexion = mysql_connect("$servidor", "$usuario", "$clave") or die ("No hay conexión a la base de datos.");

//ESTE ESTABLECE EL JUEGO DE CARACTERES
// mysql_set_charset('utf8');
mysql_set_charset('ISO-8859-1');

mysql_select_db("$bd");
?>

<!-- drop table correlativodisciplina;
drop table disciplinas;
drop table gruposdisciplina;
drop table grupostipodocumento;
drop table gruposusuario;
drop table grupousuariousuario; -->