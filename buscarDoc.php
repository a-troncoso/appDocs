<?php session_start(); ?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<!-- <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" /> -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<script src="JQ/jquery.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="bootstrap/js/bootbox.min.js"></script>
	<script src="js/funcionesAgregarBuscarDoc.js"></script>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<title>Buscar documento</title>
	<script>
	$(document).ready(buscarDocumentosFiltrados);
	$(document).ready(buscarTodosDocumentos);
	$(document).ready(cargarGrupoSelect('php/consultaAreas.php', '#selectAreas'));
	$(document).ready(cargarSubGrupoSelect('php/consultaSubAreas.php', '#selectAreas', '#selectSubAreas'));
	$(document).ready(cargarGrupoSelect('php/consultaGruposDisciplina.php', '#selectGrupoDisciplina'));
	$(document).ready(cargarSubGrupoSelect('php/consultaDisciplinas.php', '#selectGrupoDisciplina', '#selectDisciplina'));
	$(document).ready(cargarGrupoSelect('php/selectGruposTipoDocumento.php', '#selectGrupoTipoDocumento'));
	$(document).ready(cargarSubGrupoSelect('php/selectTiposDocumento.php', '#selectGrupoTipoDocumento', '#selectTipoDocumento'));
	$(document).ready(buscarDocumentosParaRevisar);
	$(document).ready(ocultarOpciones);
	$(document).ready(abrirDialogOpcionesArchivoParaRevisar);
	$(document).ready(calcularCantidadDocsParaRevisarCadaXTiempo);
	$(document).ready(abrirDialogOpcionesArchivo);

	//al presionar el boton se buscan los docs q el usuario tiene para revisar
	function buscarDocumentosParaRevisar(){
		$('#btnDocsRevision').click(buscarDocumentosParaRevision);
	}
	// BUSCA LOS DOCUMENTOS QUE TIENE Q REVISAR LA PERSONA LOGEADA
	function buscarDocumentosParaRevision(){
		$.ajax({
			data: ({codUsuarioPHP: <?php echo $_SESSION['codUsuario'] ?>}),
			url: 'php/consultaDocumentosParaRevision.php',
			type: 'POST',
			dataType: 'json',
			error: function(jqXHR,text_status,strError){
				alert("Error al carga los documentos: \n\n" + strError);
			},
			timeout: 60000,
			success: function(data){
				if ($.isEmptyObject(data)) {
					$('#cuerpoTabla').html('<tr><td></td><td></td><td></td><td><span id = "spanNoArchivosRevision" style = "color:red">No se encontraron documentos para revisión</span></td><td></td></tr>');
				}else{
					$('#cuerpoTabla').html("");
					for(var i in data){
						$('#cuerpoTabla').append(
							"<tr id = '" + data[i][1] + "' class = 'filaArchivos'>" +
								"<td>" + data[i][0] +"</td><td>" + data[i][1] + "</td>" +
								"<td>" + data[i][2] + "</td><td>" + data[i][3] + "</td>" +
								"<td>" + data[i][4] + "</td><td>" + data[i][5] + "</td>" +
								"<td>" + data[i][6] + "</td>" +
								"<td><button type='button'id='" + data[i][1] + "' class='btn btn-info btnOpcionArchivoParaRevisar'>Opciones</button></td>" +
							"</tr>"
						);
					}
				}
			}
		});
	};

	// DEFIINO VARIABLES Q CORRESPONDEN A LOS DATOS DEL DOCUMENTO
	var codDoc, codUsuario;
	var tituloDoc, nombreSubArea, nombreDisciplina, nombreTipoDocumento, nombreVersion, resumenDoc, observacionesDoc, fechaSubida, codVersion;
	// FUNCION Q ABRE EL DIALOG Q DA LA OPCION DE APROBAR O DESCARGAR EL DOC
	function abrirDialogOpcionesArchivoParaRevisar(){
		$('#tabla').on('click', '.btnOpcionArchivoParaRevisar', function(){
			// alert(<?php echo $_SESSION['codUsuario'] ?>);
			codDoc = $(this).attr("id");
			codUsuario = <?php echo $_SESSION['codUsuario']; ?>;
			//ESTE AJAX OBTIENE LOS DATOS DEL DOC A REVISAR A PARTIR DE SU CODIGO (EN EL ID) Y EL CODIGO DE LA PERSONA Q DEBE REVISAR (EN LA URL)
			$.ajax({
				data: ({codDocPHP: codDoc, codUsuarioPHP: codUsuario}),
				url: 'php/obtenerDatosDelArchivoAPartirDeSuCodigo.php',
				type: 'POST',
				dataType: 'json',
				error: function(jqXHR,text_status,strError){
					alert("Error al cargar los datos del archivo: \n\n" + strError);
				},
				timeout: 60000,
				success: function(data){
					tituloDoc = data[0][1];
					nombreSubArea = data[0][2];
					nombreDisciplina = data[0][3];
					nombreTipoDocumento = data[0][4];
					nombreVersion = data[0][5];
					resumenDoc = data[0][6];
					observacionesDoc = data[0][7];
					palabrasClave = data[0][8];
					fechaSubida = data[0][9];
					codVersion = data[0][10];
					$('#txtAreaObservacionesDoc').val(observacionesDoc); // se le aplica lo q hay en observacion al text observacion
					$('button[data-bb-handler="aprobarYEnviar"]').attr('disabled', true);//por defecto el boton esta disabled
					//alert(tituloDoc);
					//alert(tituloDoc + ' ' + nombreSubArea + ' ' + nombreDisciplina + ' ' + nombreTipoDocumento + ' ' +
					//	nombreVersion + ' ' + resumenDoc + ' ' + observacionesDoc + ' ' + palabrasClave + ' ' + fechaSubida);

					//AQUI SE LLAMARAN A TODAS LAS FUNCIONES Y LOS SETEOS QUE CONTIENE LA VENTANA DIALOGO
					cargarGrupoSelect('php/consultaGruposUsuario.php', '#selectGrupoUsuario');
					cargarSubGrupoSelect('php/consultaUsuarios.php', '#selectGrupoUsuario', '#selectUsuario');
					if (codVersion == 'V0D') {
						$('#checkAprobarYEnviar').attr('disabled', true);
					};
					$('[name="checkAprobarYEnviar"]').click(function() {
						if($(this).is(':checked')) { // cuando se desmarca el check aprobar y enviar a otro usuario usuario se deshabilitan los controles de usuarios
							$('#selectGrupoUsuario').attr('disabled', false);
							$('#selectUsuario').attr('disabled',false);
							$('button[data-bb-handler="aprobar"]').attr('disabled', true);
							$('button[data-bb-handler="aprobarYEnviar"]').attr('disabled', false);
							//$('button[data-bb-handler="aprobar"]').html('Aprobar y enviar');//se cambia el nombre del boton a aprobar y enviar
							$('#selectGrupoUsuario').val(''); // se blanquea lo q dice inicialmente (para q salga en el listado cualquier y salgan todos lo usuarios)
							$('#selectUsuario').val('');
						} else { // cuando se desmarca el check aprobar y enviar a otro usuario usuario se habilitan los controles de usuarios
							$('#selectGrupoUsuario').attr('disabled', true);
							$('#selectUsuario').attr('disabled', true);
							$('button[data-bb-handler="aprobar"]').attr('disabled',false);
							$('button[data-bb-handler="aprobarYEnviar"]').attr('disabled', true);
							//$('button[data-bb-handler="aprobar"]').html('Aprobar');//se cambia el nombre del boton a aprobar
							$('#selectGrupoUsuario').val(''); // se blanquea lo q dice inicialmente (para q salga en el listado cualquier y salgan todos lo usuarios)
							$('#selectUsuario').val('');
							//se borran todos los usuarios
							$('#selectUsuario option').each(function(index, option) {
								$(option).remove();
							});
						}
					});
				}
			});
			bootbox.dialog({
                title: "Opciones de archivo para revisión",
				message:'<div class="row">  ' +
							'<div class="col-md-12"> ' +
								'<form class="form-horizontal"> ' +
									'<div class="form-group"> ' +
										'<label class="col-md-6 control-label" for="checkAprobarYEnviar">Enviar a otro usuario para que lo apruebe</label> ' +
										'<div class="col-md-6"> ' +
											'<input id="checkAprobarYEnviar" name="checkAprobarYEnviar" type="checkbox"> ' +
										'</div>' +
									'</div>' +

									'<div class="form-group"> ' +
										'<label for="selectGrupoUsuario" class="col-md-6 control-label">Grupo usuario</label>' +
										'<div class="col-md-6"> ' +
											'<select id="selectGrupoUsuario" name="selectGrupoUsuario" class="form-control" disabled="disabled">' +
												'<option value="cualquier">Cualquier</option>' +
											'</select>' +
										'</div>' +
									'</div>' +

									'<div class="form-group"> ' +
										'<label for="selectUsuario" class="col-md-6 control-label">Usuario</label>' +
										'<div class="col-md-6"> ' +
											'<select id="selectUsuario" name="selectUsuario" class="form-control" disabled="disabled">' +
											'</select>' +
										'</div>' +
									'</div>' +

									'<div class="form-group"> ' +
										'<label for="txtAreaObservacionesDoc" class="col-md-6 control-label">Observaciones</label>' +
										'<div class="col-md-6"> ' +
											'<textarea rows="3"  id="txtAreaObservacionesDoc"  class="form-control"></textarea>' +
										'</div>' +
									'</div>' +
								'</form>' +
							'</div></div>',
                buttons: {
					descargar: {
						label: "Descargar",
						className: "btn-primary",
						callback: function() {
							$.ajax({
								data: ({codDocPHP: codDoc}),
								url: 'php/consultaNombreArchivo.php',
								type: 'POST',
								dataType: 'json',
								error: function(jqXHR,text_status,strError){
									alert("Error al cargar el nombre de archivo: \n\n" + strError);
								},
								timeout: 60000,
								success: function(data){
									//alert("codigo doc: " + codDoc + " nombre Archivo: " + String(data[0][0]));
									window.open('php/descargarDocDelServidor.php?nombreArchivoAPHP=' + String(data[0][0]));

									var accionLog = 'Ha descargado el documento ' + codDoc;
									var codUsuarioLog = <?php echo $_SESSION['codUsuario'] ?>;

									// alert('accion:' + accionLog + ' codigo Usuario: ' + codUsuarioLog + ' cod Doc: ' + codDoc);
									$.ajax({
										data: ({accionLogPHP: accionLog, codUsuarioLogPHP: codUsuarioLog}),
										type: "POST",
										url: "php/agregarLog.php",
										cache: false
									});
								}
							});
						}
					},
					aprobar: {
						label: "Aprobar",
						className: "btn-success btnAprobar",
						callback: function() {
							// alert("cod doc: " + codDoc + " user actual:" + codUsuario);
							// codDocAprobado = codDoc.replace("-V0B", "-V00");
							//alert("cod doc aprobado: " + codDocAprobado + " user actual:" + codUsuario);

							$.ajax
							({
								data: ({codDocPHP: codDoc, codUsuarioPHP: codUsuario}),
								type: "POST",
								url: "php/actualizarDatosEstablecerDocAprobado.php",
								cache: false,
								dataType: "text",
								error: function(jqXHR,text_status,strError){
									alert("Error al aprobar el documento: \n\n" + strError);
								},
								success: function(data){
									// alert("Se han actualizado los datos del documentos y se ha aprobado");
									alert(data);

									var accionLog = 'Ha aprobado el documento ' + codDoc;
									var codUsuarioLog = <?php echo $_SESSION['codUsuario'] ?>;

									// alert('accion:' + accionLog + ' codigo Usuario: ' + codUsuarioLog + ' cod Doc: ' + codDoc);
									$.ajax({
										data: ({accionLogPHP: accionLog, codUsuarioLogPHP: codUsuarioLog}),
										type: "POST",
										url: "php/agregarLog.php",
										cache: false
									});
									buscarDocumentosParaRevision();
									calculaCantidadDocsParaRevisar();

								}
							});
						}
					},
					aprobarYEnviar: {
						label: "Enviar a revisión",
						className: "btn-warning",
						callback: function() {
							var codUsuarioEscogido = $('#selectUsuario').val();
							var observacionesDoc = $('#txtAreaObservacionesDoc').val();
							var codUsuarioEmisor = <?php echo $_SESSION['codUsuario'] ?>;
							//alert("user escogido: " + codUsuarioEscogido + " user actual:" + codUsuario + ' ' + observacionesDoc + ' ' + codDoc);
							$.ajax({
								data: ({codUsuarioPHP: codUsuario,
									codUsuarioEscogidoPHP: codUsuarioEscogido,
									observacionesDocPHP: observacionesDoc,
									codDocPHP: codDoc,
									codUsuarioEmisorPHP: codUsuarioEmisor}),
								type: "POST",
								url: "php/actualizarDatosDocParaQueOtroRevise.php",
								cache: false,
								dataType: "text",
								error: function(jqXHR,text_status,strError){
									alert("Error al actualizar los datos del archivo: \n\n" + strError);
								},
								success: function(data){
									alert("Se han actualizado los datos del documentos y se ha enviado al usuario");
									buscarDocumentosParaRevision();
									calculaCantidadDocsParaRevisar();

									var accionLog = 'Ha enviado a revisión el documento ' + codDoc;
									var codUsuarioLog = <?php echo $_SESSION['codUsuario'] ?>;

									// alert('accion:' + accionLog + ' codigo Usuario: ' + codUsuarioLog + ' cod Doc: ' + codDoc);
									$.ajax({
										data: ({accionLogPHP: accionLog, codUsuarioLogPHP: codUsuarioLog}),
										type: "POST",
										url: "php/agregarLog.php",
										cache: false
									});
								}
							});
						}
					}
				}
            });
		});
	};
	//antes de abrir el dialog verifica si la persona pertecene a la disciplina la cual pertene el doc, si es cierto, lo puede eliminar, no no, no
	function abrirDialogOpcionesArchivo(){
		$('#tabla').on('click', '.btnOpcionArchivo', function(){
			codDoc = $(this).attr("id");
			$.ajax({
				data: ({codDisciplinaPHP: codDoc.substring(8, 10)}),
				type: "POST",
				url: "php/consultaSiUsuarioPerteneceADisciplinaDeArchivo.php",
				cache: false,
				dataType: "text",
				error: function(jqXHR,text_status,strError){
					alert("Error al obtener disciplina perteneciente el usuario: \n\n" + strError);
				},
				success: function(data){
					// alert(data);
					// si el usuario pertenece a la disciplina q pertenece el documentos -> retorna 1 -> se puede eliminar el doc
					var pertenezcoADisciplina = data;
					// alert(codDoc.substring(8, 10));
					//SOLO SE PUEDE ELIMINAR EL DOC SI (ES ADMINISTRADR Y ESTA APROBADO) O (PERTENECE A SU DISCIPLINA Y ESTA APROBADO)
					if ((<?php echo $_SESSION['rolAdministrador'] ?> == "1" && codDoc.substring(codDoc.length,codDoc.length-3) == 'V00') || (pertenezcoADisciplina=='1' && codDoc.substring(codDoc.length,codDoc.length-3) == 'V00')) {
						// alert('esta aprobado');
						bootbox.dialog({
							title: "Opciones de archivo",
							message:'¿Qué desea hacer?',
							buttons: {
								descargar: {
									label: "Descargar",
									className: "btn-primary",
									callback: function() {
										$.ajax({
											data: ({codDocPHP: codDoc}),
											url: 'php/consultaNombreArchivo.php',
											type: 'POST',
											dataType: 'json',
											error: function(jqXHR,text_status,strError){
												alert("Error al cargar el nombre de archivo: \n\n" + strError);
											},
											timeout: 60000,
											success: function(data){
												//alert("codigo doc: " + codDoc + " nombre Archivo: " + String(data[0][0]));
												window.open('php/descargarDocDelServidor.php?nombreArchivoAPHP=' + String(data[0][0]));

												var accionLog = 'Ha descargado el documento ' + codDoc;
												var codUsuarioLog = <?php echo $_SESSION['codUsuario'] ?>;

												// alert('accion:' + accionLog + ' codigo Usuario: ' + codUsuarioLog + ' cod Doc: ' + codDoc);
												$.ajax({
													data: ({accionLogPHP: accionLog, codUsuarioLogPHP: codUsuarioLog}),
													type: "POST",
													url: "php/agregarLog.php",
													cache: false
												});
											}
										});
									}
								},
								eliminar2: {
									label: "Eliminar",
									className: "btn-danger",
									callback: function() {
										bootbox.confirm("¿Realmente desea eliminar el documento?", function(result) {
											if(result){
												$.ajax({
													data: ({codDocPHP: codDoc}),
													url: 'php/eliminarDoc.php',
													type: 'POST',
													dataType: 'text',
													error: function(jqXHR,text_status,strError){
														alert("Error al eliminar el documento: \n\n" + strError);
													},
													timeout: 60000,
													success: function(data){
														buscarDocumentos();
														var accionLog = 'Ha eliminado el documento ' + codDoc;
														var codUsuarioLog = <?php echo $_SESSION['codUsuario'] ?>;

														// alert('accion:' + accionLog + ' codigo Usuario: ' + codUsuarioLog + ' cod Doc: ' + codDoc);
														$.ajax({
															data: ({accionLogPHP: accionLog, codUsuarioLogPHP: codUsuarioLog}),
															type: "POST",
															url: "php/agregarLog.php",
															cache: false
														});
													}
												});
											}
										});
									}
								}
							}
						});
					}else{
						//si no pertenece a la disciplina o no es adm o no esta aprobado no se permite eliminar el doc
						bootbox.dialog({
							title: "Opciones de archivo",
							message:'¿Qué desea hacer?',
							buttons: {
								descargar: {
									label: "Descargar",
									className: "btn-primary",
									callback: function() {
										$.ajax({
											data: ({codDocPHP: codDoc}),
											url: 'php/consultaNombreArchivo.php',
											type: 'POST',
											dataType: 'json',
											error: function(jqXHR,text_status,strError){
												alert("Error al cargar el nombre de archivo: \n\n" + strError);
											},
											timeout: 60000,
											success: function(data){
												//alert("codigo doc: " + codDoc + " nombre Archivo: " + String(data[0][0]));
												window.open('php/descargarDocDelServidor.php?nombreArchivoAPHP=' + String(data[0][0]));

												var accionLog = 'Ha descargado el documento ' + codDoc;
												var codUsuarioLog = <?php echo $_SESSION['codUsuario'] ?>;

												// alert('accion:' + accionLog + ' codigo Usuario: ' + codUsuarioLog + ' cod Doc: ' + codDoc);
												$.ajax({
													data: ({accionLogPHP: accionLog, codUsuarioLogPHP: codUsuarioLog}),
													type: "POST",
													url: "php/agregarLog.php",
													cache: false
												});
											}
										});
									}
								}
							}
						});
					}
				}
			});
		});
	};
	//cada 1 minuto se calcula la cantidad de documentos q se tienen para revisar
	function calcularCantidadDocsParaRevisarCadaXTiempo(){
		setInterval('calculaCantidadDocsParaRevisar()', 60000);
	};

	</script>
</head>
<body>
	<div class="row" >
		<div class="col-md-12 col-lg-offset-2" >
			<form action="" class="form-horizontal" role="form">
				<div id="contenedorOpciones">
					<div class="form-group">
						<div class="col-xs-2">
							<label for="" class="control-label">Titulo documento</label>
						</div>
						<div class="col-xs-2">
							<input type="text" id = "inpTituloDoc" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<div class="col-xs-2">
							<label for="" class="control-label">Palabra clave</label>
						</div>
						<div class="col-xs-2">
							<input type="text" id="inpPalabrasClave" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<div class="col-xs-2">
							<label for="" class="control-label">Grupo disciplina</label>
						</div>
						<div class="col-xs-2">
							<select id="selectGrupoDisciplina" class="form-control">
								<option value="cualquier">Cualquier</option> <!--  ESTA OPCION MUESTRA TODAS LAS DISCIPLINAS-->
							</select>
						</div>
						<div class="col-xs-2">
							<label for="" class="control-label">Disciplina</label>
						</div>
						<div class="col-xs-2">
							<select id="selectDisciplina" class="form-control"></select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-xs-2">
							<label for="" class="control-label">Grupo tipo documento</label>
						</div>
						<div class="col-xs-2">
							<select id="selectGrupoTipoDocumento" class="form-control">
								<option value="cualquier">Cualquier</option> <!--  ESTA OPCION MUESTRA TODOS LOS TIPOS DE DOCUMENTOS-->
							</select>
						</div>
						<div class="col-xs-2">
							<label for="" class="control-label">Tipo documento</label>
						</div>
						<div class="col-xs-2">
							<select id="selectTipoDocumento" class="form-control"></select>
						</div>
					</div>
				</div>
					<a id="btnBuscar" class="btn btn-primary" href="#" role="button" >Buscar</a>
					<a id="btnBuscarTodos" class="btn btn-primary" href="#" role="button" >Buscar todos</a>
					<a id="btnDocsRevision" class="btn btn-primary" href="#" role="button" >Documentos para revisión</a>
					<a id="btnOcultarOpciones" class="btn btn-warning" href="#" role="button" >Ocultar opciones</a>
			</form>
		</div>
	</div>
	<div class="row" >
		<div id="contenedorTabla" class="col-md-12" style="padding-top: 15px;">
			<table id = "tabla" class="table table-hover">
				<thead>
					<tr>
						<th>TITULO</th>
						<th>CÓDIGO</th>
						<!-- <th>NOMBRE ARCHIVO</th> -->
						<th>USUARIO EMISOR</th>
						<th>VERSIÓN</th>
						<th>ESTADO EMISIÓN</th>
						<th style="width: 136px;">FECHA SUBIDA</th>
						<th>DESCRIPCIÓN</th>
						<th>OPCIONES</th>
					</tr>
				</thead>
				<tbody id="cuerpoTabla">
					<!-- <tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td><span id = "spanNoArchivosRevision" style = "display:none; color:red">No se encontraron archivos para revisión</span></td>
						<td></td>
					</tr> -->
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>