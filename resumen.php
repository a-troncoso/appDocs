<?php session_start(); ?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<!-- <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" /> -->
	<script src="JQ/jquery.min.js"></script>
	<script href="bootstrap/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="icon" type="image/png" href="img/favicon.png">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>Sistema Control Documental</title>
	<script src="js/funcionesLoginResumen.js"></script>
	<script>
	$(document).ready(redireccionarSegunTabSeleccionado);
	$(document).ready(cargarBuscarDocAlInicio);
	function cargarBuscarDocAlInicio(){
		if (<?php echo $_SESSION['permisoBuscarVerDoc'] ?> == "1") {
			// alert(<?php echo $_SESSION['permisoBuscarVerDoc'] ?>);
			$('#container').load('buscarDoc.php');
		};
	};
	<?php
	switch ($_SESSION['rolAdministrador']) {
		case "0":
			$visibilidadLiGruposUsuarios = 'none';
			break;
		case "1":
			$visibilidadLiGruposUsuarios = 'block';
			break;
		default:
			$visibilidadLiGruposUsuarios = 'none';
			break;
	};
	switch ($_SESSION['rolAdministrador']) {
		case "0":
			$visibilidadLiLogs = 'none';
			break;
		case "1":
			$visibilidadLiLogs = 'block';
			break;
		default:
			$visibilidadLiLogs = 'none';
			break;
	};
	switch ($_SESSION['permisoAgregarDoc']) {
		case "0":
			$visibilidadAgregarDocs = 'none';
			break;
		case "1":
			$visibilidadAgregarDocs = 'block';
			break;
		default:
			$visibilidadAgregarDocs = 'none';
			break;
	};
	switch ($_SESSION['permisoBuscarVerDoc']) {
		case "0":
			$visibilidadBuscarDocs = 'none';
			break;
		case "1":
			$visibilidadBuscarDocs = 'block';
			break;
		default:
			$visibilidadBuscarDocs = 'none';
			break;
	} ?>

	</script>
	<style>
	#liGruposUsuarios{
		display: <?php echo $visibilidadLiGruposUsuarios; ?>;
	}
	#liLogs{
		display: <?php echo $visibilidadLiLogs; ?>;
	}
	#liAgregarDoc{
		display: <?php echo $visibilidadAgregarDocs; ?>;
	}
	#liBuscarDoc{
		display: <?php echo $visibilidadBuscarDocs; ?>;
	}
	</style>
</head>
<body  style="background-color: #F1F5F9">
	<div class="row" >
		<div class="col-md-12" >
			<nav class="navbar navbar-default">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
						<span class="sr-only"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a href="" class="navbar-brand">Control Documental</a>
				</div>
				<div class="collapse navbar-collapse navbar-ex1-collapse">
					<ul class="nav navbar-nav">
						<li id="liAgregarDoc"><a href="#" id="btnAgregarDoc">Agregar documento</a></li>
						<li id="liBuscarDoc"><a href="#" id="btnBuscarDoc">Buscar Documento</a></li>
						<li id="liGruposUsuarios"><a href="#" id="btnGruposUsuarios">Grupos/Usuarios</a></li>
						<li id="liLogs"><a href="#" id="btnLogs">Logs</a></li>
						<li><a href="php/cerrarSesion.php" id="btnSalir">Salir</a></li>
					</ul>
					<span style = 'position: absolute; right:7px; color: gray; font-size: 18px;'>Bienvenido, <?php echo $_SESSION['nombreUsuario'] ?></span>
					<span id = 'spanCantidadDocParaRevisar' style = 'position: absolute; right:7px; top: 30px;color: red'>Tiene <?php echo $_SESSION['cantidadDocsParaRevisar'] ?> documento(s) para revisar</span>
				</div>
			</nav>
		</div>
	</div>
	<div class="container" id="container"></div>
</body>
</html>

