<?php
header('Access-Control-Allow-Origin: *');

//ESTE ESTABLECE LA ZONA HORARIA PARA EL HORARIO DE VERANO
date_default_timezone_set('America/La_Paz');

//servidor local
////$usuario = "root";
//$clave = "";
//$bd = "bddocs";

//hostinger
$servidor = "mysql.hostinger.es";
$usuario = "u703425592_alvar";
$clave = "123456";
$bd = "u703425592_bddoc";

//valysistem
// $servidor = "localhost";
// $usuario = "juaco";
// $clave = "12345";
// $bd = "bddocs";

$conexion = mysql_connect("$servidor", "$usuario", "$clave") or die ("No hay conexión a la base de datos.");

//ESTE ESTABLECE EL JUEGO DE CARACTERES
// mysql_set_charset('utf8');
mysql_set_charset('ISO-8859-1');

mysql_select_db("$bd");
?>