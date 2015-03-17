<?php session_start(); ?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<!-- <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" /> -->
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<script href="bootstrap/js/bootstrap.min.js"></script>
	<script href="JQ/jquery.min.js"></script>
	<script src="js/funcionesAgregarBuscarDoc.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>Agregar documento</title>
	<script>
	var emisionSeleccionada;
	$(document).ready(agregarDoc);
	$(document).ready(cargarGrupoAreasPaginaAgregarDoc);
	$(document).ready(cargarSubAreasPaginaAgregarDoc);
	$(document).ready(cargarGrupoDisciplinasPaginaAgregarDoc);
	$(document).ready(cargarDisciplinasPaginaAgregarDoc);
	$(document).ready(cargarGruposTipoDocumentoPaginaAgregarDoc);
	$(document).ready(cargarTipoDocumentoPaginaAgregarDoc);
	$(document).ready(cargarGruposUsuarioPaginaAgregarDoc);
	$(document).ready(cargarUsuariosPaginaAgregarDoc);

	$(document).ready(generaCodigo('#selectSubAreas'));
	$(document).ready(generaCodigo('#selectDisciplina'));
	$(document).ready(generaCodigo('#selectTipoDocumento'));
	$(document).ready(generaCodigo('#idVersionAprovada'));
	$(document).ready(generaCodigo('#selVersion'));

	$(document).ready(cargarNumeroCorrelativoSegunDisciplina);
	$(document).ready(nombreArchivo);
	$(document).ready(limpiarCamposPaginaAgregarDoc);
	$(document).ready(irDesbloqueandoCampos);
	$(document).ready(abrirDialogEstadoEmisionArchivo);
	$(document).ready(definirEstadoEmision);

	$(document).ready(abrirDialogNuevaSubAera);
	$(document).ready(cargarAreasModalAgregarSubArea);
	$(document).ready(agregarSubArea);
	$(document).ready(habilitarDeshabilitarRdsModalSubArea);
	$(document).ready(cargarSubAreasModalAgregarSubArea);
	$(document).ready(eliminarSubArea);
	$(document).ready(modificarSubArea);
	$(document).ready(rellenarEDTYNombreSubArea);


	function anadirDatosArchivo(){
		var nombreArchivo = nombreArchivoSeleccionado;
		var codigoDoc = $('#inpCodigo').val();
		var tituloDoc = $('#inpTituloDoc').val();
		var EDTSubArea =  $('#selectSubAreas').val();
		var codDisciplina =  $('#selectDisciplina').val();
		var codTipoDoc =  $('#selectTipoDocumento').val();
		// A PHP SE ENVIA UN ARRAY DE LOS SELECT MULTIPLES SELECCIONADOS
		var codUsuario = $('#selectUsuario').val();
		var codUsuarioEmisor = <?php echo $_SESSION['codUsuario'] ?>;
		// var codVersion = $( "input:radio[name=rdVersion]:checked" ).val();
		if ($("#idVersionAprovada:radio").is(':checked')) {
			var codVersion = 'V00';
		}else{
			var codVersion = $('#selVersion').val();
		}
		var resumenDoc = $('#txtAreaResumenDoc').val();
		var observacionesDoc = $('#txtAreaObservacionesDoc').val();
		var palabrasClave = $('#inpPalabrasClave').val();
		switch(emisionSeleccionada) {
			case 'Aprobacion':
				emisionSeleccionada = 'Aprobación';
				break;
			case 'Revision':
				emisionSeleccionada ='Revisión';
				break;
			case 'Informacion':
				emisionSeleccionada ='Información';
				break;
			default:
				emisionSeleccionada = 'Aprobado';
		};
		// alert(emisionSeleccionada);
		$.ajax({
			data: ({nombreArchivoPHP: nombreArchivo, codigoDocPHP: codigoDoc, tituloDocPHP: tituloDoc, EDTSubAreaPHP: EDTSubArea,
				codDisciplinaPHP: codDisciplina, codTipoDocPHP: codTipoDoc, codUsuarioPHP: codUsuario, codVersionPHP: codVersion,
				resumenDocPHP: resumenDoc, observacionesDocPHP: observacionesDoc, palabrasClavePHP: palabrasClave,
				correlativoPHP: arrayCodigo[3], emisionSeleccionadaPHP: emisionSeleccionada, codUsuarioEmisorPHP: codUsuarioEmisor}),
			type: "POST",
			url: "php/agregarDatosDoc.php",
			cache: false,
			dataType: "text",
			success: function(data){
				alert(data);
				limpiarCamposPaginaAgregarDoc();
				arrayCodigo.length=0; //SE LIMPIA EL ARRAY QUE CONTIENE EL CODIGO
			}
		});
		// alert(codVersion);
	};
	function seleccionado(){
		var archivos = document.getElementById("archivos");//Damos el valor del input tipo file
		var archivo = archivos.files; //Obtenemos el valor del input (los archivos) en modo de arreglos

		//El objeto FormData nos permite crear un formulario pasandole clave/valor para poder enviarlo,
		//este tipo de objeto ya tiene la propiedad multipart/form-data para poder subir archivos
		var data = new FormData();
		//Agregamos el identificador del archivo y su nombre a la variable data
		data.append('archivo0', archivo[0]);

		$.ajax({
			url:'php/agregarDocAlServidor.php', //Url a donde la enviaremos
			type: 'POST', //Metodo que usaremos
			contentType: false, //Debe estar en false para que pase el objeto sin procesar
			data: data, //Le pasamos el objeto que creamos con los archivos
			processData: false, //Debe estar en false para que JQuery no procese los datos a enviar
			cache: false, //Para que el formulario no guarde cache
			success: function(data){
				alert(data);
			}
		});
	};

	var correoUsuarioSeleccionado;
	//TRAER Y ENVIAR CORREO DEL USUARIO SELECCIONADO
	function consultaEnviaCorreoUsuarioSeleccionado(){
		//$('#selectUsuario').change(function() {
		var codUsuarioSeleccionado = $('#selectUsuario').val();
		$.ajax({
			data: {codUsuarioSeleccionadoPHP: codUsuarioSeleccionado},
			url: 'php/consultaCorreoUsuarioSeleccionado.php',
			type: 'POST',
			dataType: 'text',
			error: function(jqXHR,text_status,strError){
				alert("Error al cargar correo del usuario.");
			},
			timeout: 60000,
			success: function(data){
				//data contiene el correo del usuario
				data= data.replace("\"", "");
				//Vuelvo a hacer la operacion porq la primera solo cambia la primera coincidencia
				data= data.replace("\"", "");
				// alert("Llegue al succes de la consulta correo, correo de user seleccionado: " + data + " primera letra: " + data.charAt(0));
				correoUsuarioSeleccionado = data;
				var observacionesDoc = $('#txtAreaObservacionesDoc').val();
				var tituloDoc = $('#inpTituloDoc').val();
				var nombreUsuarioSeleccionado = $("#selectUsuario option:selected").text();
				var nombreUsuarioEnviadorDoc = <?php echo "'" . $_SESSION['nombreUsuario'] . "'"?> ;
				// alert(emisionSeleccionada);
				$.ajax({
					data: ({mailUsuarioPHP: correoUsuarioSeleccionado, observacionesDocPHP: observacionesDoc, tituloDocPHP: tituloDoc,
						nombreUsuarioSeleccionadoPHP: nombreUsuarioSeleccionado, nombreUsuarioEnviadorDocPHP: nombreUsuarioEnviadorDoc,
						emisionSeleccionadaPHP: emisionSeleccionada}),
					url: 'php/enviarMailUsuarioRecuerdaRevisarDoc.php',
					type: 'POST',
					dataType: 'text',
					error: function(jqXHR,text_status,strError){
						alert("Error al enviar el correo recordando que el usuario tiene un documento.");
					},
					timeout: 60000,
					success: function(data){
						alert(data);
					}
				});
			}
		});
	};

	// AL APRETAR EL BOTON AGREGAR SE LLAMA LA FUNCION QUE AGREGA EL DOC AL SERVER Y LA FUNCION QUE AGREGA LOS DATOS DEL DOC A LA BD
	function agregarDoc(){
		$("#btnAgregar").click(function(){
			if ( $('#inpCodigo').val().length > 20
				&& $('#inpTituloDoc').val() != ''
				&& $('#selectSubAreas').val() != null
				&& $('#selectDisciplina').val() != null
				&& $('#selectTipoDocumento').val() != null
				&& $('#txtAreaResumenDoc').val() != ''
				&& $('#txtAreaObservacionesDoc').val() != ''
				&& nombreArchivoSeleccionado != null )
			{
				//SI SE MARCO UN USUARIO ENVIA EL MAIL
				if ($('#selectUsuario').val() != null) {
					//SI ESTA DESMARCADO EL CHECK 'NO ENVIAR CORREO' -> SE ENVIA CORREO
					if (!($('#checkNoEnviaCorreo').is(':checked'))) {
						consultaEnviaCorreoUsuarioSeleccionado();
					};
				};
				seleccionado();
				anadirDatosArchivo();
				agregarLogPaginaAgregarDoc();
				deshabilitarControles();
				irDesbloqueandoCampos();
				$("#checkNoEnviaCorreo").prop('checked', false);
			}else{
				alert('FALTAN DATOS POR SELECCIONAR.');
			}
		});
	};
	function agregarLogPaginaAgregarDoc(){
		var accionLog = 'Ha agregado el documento ' + $('#inpCodigo').val();
		var codUsuarioLog = <?php echo $_SESSION['codUsuario'] ?>;
		// alert('accion:' + accion + ' codigo Usuario: ' + codUsuario)
		$.ajax({
			data: ({accionLogPHP: accionLog, codUsuarioLogPHP: codUsuarioLog}),
			type: "POST",
			url: "php/agregarLog.php",
			cache: false
		});
	};

	function abrirDialogEstadoEmisionArchivo(){
		$('#rdVersionClienteRevisor').click(function() {
			$('#modalEstadoEmision').modal('show');
		});
	};
	function definirEstadoEmision(){
		$('#btnAceptarEstadoEmision').click(function(){
			if ($('#rdEstadoRevision').is(':checked')) {
				emisionSeleccionada = $('#rdEstadoRevision').val();
			};
			if ($('#rdEstadoAprobacion').is(':checked')) {
				emisionSeleccionada = $('#rdEstadoAprobacion').val();
			};
			if ($('#rdEstadoInformacion').is(':checked')) {
				emisionSeleccionada = $('#rdEstadoInformacion').val();
			};
			// alert(emisionSeleccionada);
		});
	};
	function abrirDialogNuevaSubAera(){
		$('#btnNuevaSubArea').click(function() {
			$('#modalNuevaSubArea').modal('show');
		});
	};
	</script>
</head>
<body>
	<!-- VENTANA MODAL -->
	<div class="modal fade" id="modalEstadoEmision" tabindex="-1" role="dialog" aria-labelleby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button typ="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4>Estado de emisión de archivo</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<form class="form-horizontal">

								<div class="form-group">
									<div class="col-xs-2">
										<label for="" class="control-label">Versión</label>
									</div>
									<div class="col-xs-3">
										<select id="selVersion" class="form-control">
											<option value="V0B" selected='selected'>V0B</option>
											<option value="V0C">V0C</option>
											<option value="V0D">V0D</option>
										</select>
									</div>
								</div>

								<div class="form-group">
									<div class="col-xs-4">
										<label class="radio-inline">
											<input type="radio" name="rdEstadoEmision" id="rdEstadoRevision" value="Revision" checked="checked"> <b>Revisión</b>
										</label>
									</div>
									<div class="col-xs-4">
										<label class="radio-inline">
											<input type="radio" name="rdEstadoEmision" id="rdEstadoAprobacion" value="Aprobacion"><b>Aprobación</b>
										</label>
									</div>
									<div class="col-xs-4">
										<label class="radio-inline">
											<input type="radio" name="rdEstadoEmision" id="rdEstadoInformacion" value="Informacion"><b>Información</b>
										</label>
									</div>
								</div>

							</form>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button id="btnAceptarEstadoEmision" class="btn btn-success" data-dismiss="modal">Aceptar</button>
				</div>
			</div>
		</div>
	</div>
	<!-- FIN VENTANA MODAL -->

	<!-- VENTANA MODAL NUEVA SUB AREA-->
	<div class="modal fade" id="modalNuevaSubArea" tabindex="-1" role="dialog" aria-labelleby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button typ="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4>Agregar / Modificar Sub Área</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<form class="form-horizontal">

								<div class="form-group">
									<div class="col-xs-2">
										<label for="" class="control-label">Área</label>
									</div>
									<div class="col-xs-6">
										<select id="selArea" name="" class="form-control"></select>
									</div>
								</div>

								<hr style="color: red">

								<div class="form-group">
									<label class="radio-inline" style="padding-left: 35px;">
										<input type="radio" name="rdSubArea" id="rdNuevaSubArea" value="nueva" checked="checked" > <span style="font-weight: bold";>Nueva</span>
									</label>
								</div>

								<div class="form-group">
									<div class="col-xs-2">
										<label for="" class="control-label">Nombre</label>
									</div>
									<div class="col-xs-6">
										<input id="inpNombreSubArea" type="text" placeholder="Nombre Sub Área" class="form-control">
									</div>
								</div>
								<hr>
								<div class="form-group">
									<label class="radio-inline" style="padding-left: 35px;">
										<input type="radio" name="rdSubArea" id="rdModSubArea" value="mofificar" ><span style="font-weight: bold">Modificar</span>
									</label>
								</div>

								<div class="form-group">
									<div class="col-xs-2">
										<label for="" class="control-label">Sub Área</label>
									</div>
									<div class="col-xs-6">
										<select id="selSubArea" name="" class="form-control" disabled="disabled"></select>
									</div>
									<div class="col-xs-1" style="padding-left: 0px;">
										<button id="btnEliminarSubArea" class="btn btn-danger" data-dismiss="modal" disabled="disabled">Eliminar Sub Área</button>
									</div>
								</div>

								<div class="form-group">
									<div class="col-xs-2">
										<label for="" class="control-label">EDT</label>
									</div>
									<div class="col-xs-6">
										<input id="inpEDTSubArea" type="text" placeholder="" class="form-control" disabled="disabled">
									</div>
								</div>

								<div class="form-group">
									<div class="col-xs-2">
										<label for="" class="control-label">Nuevo Nombre</label>
									</div>
									<div class="col-xs-6">
										<input id="inpNombreNuevoSubArea" type="text" placeholder="Nuevo nombre Sub Área" class="form-control" disabled="disabled">
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button id="btnAgregarNuevaSubArea" class="btn btn-success" data-dismiss="modal">Agregar</button>
				</div>
			</div>
		</div>
	</div>
	<!-- FIN VENTANA MODAL -->

	<div class="row" >
		<div class="col-md-12 col-lg-offset-1" >
			<form enctype="multipart/form-data" class="form-horizontal" role="form" >
				<div class="form-group">
					<fieldset disabled>
						<div class="col-xs-2">
							<label for="" class="control-label">CÓDIGO</label>
						</div>
						<div class="col-xs-3">
							<input type="text" id ="inpCodigo" class="form-control" >
						</div>
					</fieldset>
				</div>
				<div class="form-group">
					<div class="col-xs-2">
						<label for="" class="control-label">Título documento</label>
					</div>
						<div class="col-xs-3">
						<input type="text" id="inpTituloDoc" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-2">
						<label for="" class="control-label">Área</label>
					</div>
					<div class="col-xs-3">
						<select id="selectAreas" class="form-control" disabled="disabled">
							<!-- <option value="cualquier">Cualquier</option>   ESTA OPCION MUESTRA TODAS LAS SUBAREAS -->
						</select>
					</div>
					<div class="col-xs-2">
						<label for="" class=" control-label">Subarea</label>
					</div>
					<div class="col-xs-2">
						<select id="selectSubAreas" class="form-control" disabled="disabled" style="width: 186px;"></select>
					</div>
					<div class="col-xs-1">
						<button id="btnNuevaSubArea" type="button" class="btn btn-primary" disabled="disabled">Agregar</button>
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-2">
						<label for="" class=" control-label">Grupo disciplina</label>
					</div>
					<div class="col-xs-3">
						<select id="selectGrupoDisciplina" class="form-control" disabled="disabled">
							<!-- <option value="cualquier">Cualquier</option>   ESTA OPCION MUESTRA TODAS LAS DISCIPLINAS -->
						</select>
					</div>
					<div class="col-xs-2">
						<label for="" class=" control-label">Disciplina</label>
					</div>
					<div class="col-xs-3">
						<select id="selectDisciplina" class="form-control" disabled="disabled"></select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-2">
						<label for="" class=" control-label">Grupo tipo documento</label>
					</div>
					<div class="col-xs-3">
						<select id="selectGrupoTipoDocumento" class="form-control" disabled="disabled">
							<!-- <option value="cualquier">Cualquier</option>   ESTA OPCION MUESTRA TODOS LOS TIPOS DE DOCUMENTOS -->
						</select>
					</div>
					<div class="col-xs-2">
						<label for="" class=" control-label">Tipo documento</label>
					</div>
					<div class="col-xs-3">
						<select id="selectTipoDocumento" class="form-control" disabled="disabled"></select>
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-2">
						<label for="" class=" control-label">Versión</label>
					</div>
					<div class="col-xs-6">
						<!-- <label class="radio-inline">
							<input type="radio" name="rdVersion" id="rdVersionInterna" value="V0A" disabled="disabled"> Interna
						</label> -->
						<label class="radio-inline">
							<input type="radio" name="rdVersion" id="rdVersionClienteRevisor" value="V0B" disabled="disabled"> Cliente/Revisor
						</label>
						<label class="radio-inline">
							<input type="radio" name="rdVersion" id="idVersionAprovada" value="V00" disabled="disabled"> Versión aprobada
						</label>
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-2">
						<label for="" class=" control-label">Grupo usuario</label>
					</div>
					<div class="col-xs-3">
						<select id="selectGrupoUsuario" class="form-control" disabled="disabled">
							<!-- <option value="cualquier">Cualquier</option>   ESTA OPCION MUESTRA TODOS LOS grupos DE PERSONAS -->
						</select>
					</div>
					<div class="col-xs-2">
						<label for="" class=" control-label">Usuario aprobador</label>
					</div>
					<div class="col-xs-3">
						<select id="selectUsuario" class="form-control" disabled="disabled"></select>
						<span class="help-block"><input id="checkNoEnviaCorreo" type="checkbox" style="width: 18px;height: 18px;" disabled="disabled"> No enviar correo recordatorio al usuario</span>
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-2">
						<label for="" class="control-label" style="text-align: left;">Descripción documento</label>
					</div>
					<div class="col-xs-8">
						<textarea rows="3" id="txtAreaResumenDoc" class="form-control" disabled="disabled"></textarea>
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-2">
						<label for="" class="control-label">Observaciones</label>
					</div>
					<div class="col-xs-8">
						<textarea rows="3"  id="txtAreaObservacionesDoc" class="form-control" disabled="disabled"></textarea>
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-2">
						<label for="" class=" control-label">Palabras clave</label>
					</div>
					<div class="col-xs-8">
						<input type="text" id ="inpPalabrasClave" class="form-control" >
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-2">
						<label for="exampleInputFile" class=" control-label">Examinar</label>
					</div>
					<div class="col-xs-8">
						<input type="file" id="archivos" class="filestyle form-control" name="archivos" disabled="disabled">
					</div>
				</div>
				<div class="col-xs-2">
					<div class="form-group">
						<a id="btnAgregar" class="btn btn-primary" href="#" role="button" disabled="disabled">Agregar</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</body>
</html>