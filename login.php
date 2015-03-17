<?php session_start(); ?>
<!DOCTYPE html>

<html lang="es">
<head>
	<!-- <meta charset="UTF-8"> -->
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<title>Login SCD</title>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="icon" type="image/png" href="img/favicon.png">
	<script src="js/funcionesLoginResumen.js"></script>
	<style>
	.margin100{
		margin-top: 100px;
	}
	div {
		margin: .4em 0;
	}
	label {
		width: 30%;
		float: left;
	}
	#central{
		position:absolute;
		top:50%;
		left: 50%;
		margin-top: -130px;
		margin-left: -135px;
	}
	</style>
	<script src="JQ/jquery.min.js"></script>
	<script>
	</script>
</head>
<body style="background-color: #F1F5F9">
<div class="container">
	<div>
		<div>
			<div id="central" style=" border-radius:10px; width:270px; height:170px">
				<form action='php/verificarLogin2.php' method="post">
					<legend>Login</legend>
					<div>
						<label for="">Usuario</label>
						<input id = "inpNombreUsuario" type="text" name = "inpNombreUsuario" style="border-radius:5px">
					</div>
					<div>
						<label for="">Password</label>
						<input id = "inpClaveUsuario"  type="password"  name = "inpClaveUsuario" style="border-radius:5px">
					</div>
					<input  id="btnEntrar" type="submit" class="btn btn-primary" value="Entrar" style="position:relative; right: -200px; margin-top:10px">
				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>