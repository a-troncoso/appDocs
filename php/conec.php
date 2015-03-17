<?php
header('Access-Control-Allow-Origin: *');

//ESTE ESTABLECE LA ZONA HORARIA PARA EL HORARIO DE VERANO
date_default_timezone_set('America/La_Paz');

$servidor = "localhost";
//$servidor = "mysql.hostinger.es";
//$servidor = "valsystem.cl/204.93.172.128:8443";
$usuario = "root";
//$usuario = "u695684602_alvar";
$clave = "";
//$clave = "123456";
$bd = "bddocs";
//$bd = "u695684602_bddoc";

$conexion = mysql_connect("$servidor", "$usuario", "$clave") or die ("No hay conexión a la base de datos.");

//ESTE ESTABLECE EL JUEGO DE CARACTERES
// mysql_set_charset('utf8');
mysql_set_charset('ISO-8859-1');

mysql_select_db("$bd");

?>