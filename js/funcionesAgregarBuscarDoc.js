		//////////////////////////////
		//							//
		//		AGREGAR DOC			//
		//							//
		//////////////////////////////

// FUNCION QUE CARGA SOLO LOS SELECT QUE SON DE GRUPOS (AREAS, GRUPO DISCIPLINA, GRUPO TIPO DOC, GRUPO USUARIO)
	function cargarGrupoSelect(rutaPHP, contenedor ){
		$.ajax({
			url: rutaPHP,
			type: 'POST',
			dataType: 'json',
			error: function(jqXHR,text_status,strError){
				alert("No hay coneccion");
			},
			timeout: 60000,
			success: function(data){
				for(var i in data){
					$(contenedor).append("<option value='" + data[i][0] + "'>" + data[i][1] + "</option>");
				}
			}
		});
	};
	//FUNCION QUE CARGA SOLO LOS SELECT QUE SON DE SUB GRUPOS (SUB AREAS, DISCIPLINA, TIPO DOC, USUARIO)
	function cargarSubGrupoSelect(rutaPHP, contenedorGatillante, contenedorActualizado ){
		$(contenedorGatillante).change(function(){
			var optionSeleccionado = $(contenedorGatillante).val();
			$.ajax({
				data: {optionSeleccionadoPHP: optionSeleccionado},
				url: rutaPHP,
				type: 'POST',
				dataType: 'json',
				error: function(jqXHR,text_status,strError){
					alert("Error al carga el subgrupo");
				},
				timeout: 60000,
				success: function(data){
					$(contenedorActualizado).html("");
					for(var i in data){
						$(contenedorActualizado).append("<option value='" + data[i][0] + "'>" + data[i][1] + "</option>");
					}
				}
			});
		});
	};
	function cargarGrupoAreasPaginaAgregarDoc(){
		$.ajax({
			url: 'php/consultaAreas.php',
			type: 'POST',
			dataType: 'json',
			error: function(jqXHR,text_status,strError){
				alert("Error al cargar las areas\n"+ strError);
			},
			timeout: 60000,
			success: function(data){
				$('#selectAreas').append("<option value='seleccine' disabled='disabled' selected='selected'>Seleccione grupo área</option>");
				$('#selectAreas').append("<option value='cualquier'>Cualquier</option>");
				for(var i in data){
					$('#selectAreas').append("<option value='" + data[i][0] + "'>" + data[i][1] + "</option>");
				}
			}
		});
	};
	function cargarSubAreasPaginaAgregarDoc(){
		$('#selectAreas').change(function(){
			var optionSeleccionado = $('#selectAreas').val();
			$.ajax({
				data: {optionSeleccionadoPHP: optionSeleccionado},
				url: 'php/consultaSubAreas.php',
				type: 'POST',
				dataType: 'json',
				error: function(jqXHR,text_status,strError){
					alert("Error al cargar las subareas\n" + strError);
				},
				timeout: 60000,
				success: function(data){
					$('#selectSubAreas').html("");
					$('#selectSubAreas').append("<option value='seleccine' disabled='disabled' selected='selected'>Seleccione sub área</option>");
					for(var i in data){
						$('#selectSubAreas').append("<option value='" + data[i][0] + "'>" + data[i][1] + "</option>");
					}
				}
			});
		});
	};
	function cargarGrupoDisciplinasPaginaAgregarDoc(){
		$.ajax({
			url: 'php/consultaGruposDisciplina.php',
			type: 'POST',
			dataType: 'json',
			error: function(jqXHR,text_status,strError){
				alert("Error al cargar los grupos de disciplinas\n" + strError);
			},
			timeout: 60000,
			success: function(data){
				$('#selectGrupoDisciplina').append("<option value='seleccine' disabled='disabled' selected='selected'>Seleccione grupo disciplina</option>");
				$('#selectGrupoDisciplina').append("<option value='cualquier'>Cualquier</option>");
				for(var i in data){
					$('#selectGrupoDisciplina').append("<option value='" + data[i][0] + "'>" + data[i][1] + "</option>");
				}
			}
		});
	};
	function cargarDisciplinasPaginaAgregarDoc(){
		$('#selectGrupoDisciplina').change(function(){
			var optionSeleccionado = $('#selectGrupoDisciplina').val();
			$.ajax({
				data: {optionSeleccionadoPHP: optionSeleccionado},
				url: 'php/consultaDisciplinas.php',
				type: 'POST',
				dataType: 'json',
				error: function(jqXHR,text_status,strError){
					alert("Error al carga las disciplinas\n" + strError);
				},
				timeout: 60000,
				success: function(data){
					$('#selectDisciplina').html("");
					$('#selectDisciplina').append("<option value='seleccine' disabled='disabled' selected='selected'>Seleccione disciplina</option>");
					for(var i in data){
						$('#selectDisciplina').append("<option value='" + data[i][0] + "'>" + data[i][1] + "</option>");
					}
				}
			});
		});
	};
	function cargarGruposUsuarioPaginaAgregarDoc(){
		$.ajax({
			url: 'php/consultaGruposUsuario.php',
			type: 'POST',
			dataType: 'json',
			error: function(jqXHR,text_status,strError){
				alert("Error al cargar los grupos de usuarios\n" + strError);
			},
			timeout: 60000,
			success: function(data){
				$('#selectGrupoUsuario').append("<option value='seleccine' disabled='disabled' selected='selected'>Seleccione grupo usuario</option>");
				$('#selectGrupoUsuario').append("<option value='cualquier'>Cualquier</option>");
				for(var i in data){
					$('#selectGrupoUsuario').append("<option value='" + data[i][0] + "'>" + data[i][1] + "</option>");
				}
			}
		});
	};
	function cargarUsuariosPaginaAgregarDoc(){
		$('#selectGrupoUsuario').change(function(){
			var optionSeleccionado = $('#selectGrupoUsuario').val();
			//alert(optionSeleccionado);
			$.ajax({
				data: {optionSeleccionadoPHP: optionSeleccionado},
				url: 'php/consultaUsuarios.php',
				type: 'POST',
				dataType: 'json',
				error: function(jqXHR,text_status,strError){
					alert("Error al cargar los usuarios\n" + strError);
				},
				timeout: 60000,
				success: function(data){
					$('#selectUsuario').html("");
					$('#selectUsuario').append("<option value='seleccione' disabled='disabled' selected='selected'>Seleccione usuario</option>");
					for(var i in data){
						$('#selectUsuario').append("<option value='" + data[i][0] + "'>" + data[i][1] + "</option>");
					}
				}
			});
		});
	};
	function cargarGruposTipoDocumentoPaginaAgregarDoc(){
		$.ajax({
			url: 'php/selectGruposTipoDocumento.php',
			type: 'POST',
			dataType: 'json',
			error: function(jqXHR,text_status,strError){
				alert("Error al cargar los grupos tipos documentos\n" + strError);
			},
			timeout: 60000,
			success: function(data){
				$('#selectGrupoTipoDocumento').append("<option value='seleccione' disabled='disabled' selected='selected'>Seleccione grupo tipo documento</option>");
				$('#selectGrupoTipoDocumento').append("<option value='cualquier'>Cualquier</option>");
				for(var i in data){
					$('#selectGrupoTipoDocumento').append("<option value='" + data[i][0] + "'>" + data[i][1] + "</option>");
				}
			}
		});
	};
	function cargarTipoDocumentoPaginaAgregarDoc(){
		$('#selectGrupoTipoDocumento').change(function(){
			var optionSeleccionado = $('#selectGrupoTipoDocumento').val();
			$.ajax({
				data: {optionSeleccionadoPHP: optionSeleccionado},
				url: 'php/selectTiposDocumento.php',
				type: 'POST',
				dataType: 'json',
				error: function(jqXHR,text_status,strError){
					alert("Error al cargar los tipos de documentos\n" + strError);
				},
				timeout: 60000,
				success: function(data){
					$('#selectTipoDocumento').html("");
					$('#selectTipoDocumento').append("<option value='seleccine' disabled='disabled' selected='selected'>Seleccione tipo documento</option>");
					for(var i in data){
						$('#selectTipoDocumento').append("<option value='" + data[i][0] + "'>" + data[i][1] + "</option>");
					}
				}
			});
		});
	};
	var nombreArchivoSeleccionado;
	function nombreArchivo(){
		$('#archivos').change(function(){
			var ruta = $(this).val();
			var arregloRuta = ruta.split('\\');
			nombreArchivoSeleccionado = arregloRuta[arregloRuta.length-1];
		});
	};
	//FUNCION QUE GENERA EL  NUMERO CORRELATIVO SEGUN DISCIPLINA
	var arrayCodigo = [];
	function cargarNumeroCorrelativoSegunDisciplina(){
		$('#selectDisciplina').change(function(){
			var codDisciplina = $('#selectDisciplina').val();
			$.ajax({
				data: {codDisciplinaPHP: codDisciplina},
				url: 'php/consultaNumeroCorrelativoSegunDisciplina.php',
				type: 'POST',
				dataType: 'json',
				error: function(jqXHR,text_status,strError){
					alert("Error al cargar correlativo de la disciplina");
				},
				timeout: 60000,
				success: function(data){
					arrayCodigo[3] = data;
					var strCodigo = arrayCodigo.join('-');
					$('#inpCodigo').val(strCodigo);
				}
			});
		});
	};

	//FUNCION QUE GENERA EL CODIGO DE DOCUMENTO, SIN EL NUMERO CORRELATIVO
	function generaCodigo(contenedor){
		$(contenedor).on('change', function(){
			
		// $(contenedor).change(function(){
			switch (contenedor) {
				case '#selectSubAreas':
					arrayCodigo[0] = $(contenedor).val();
					break;
				case '#selectDisciplina':
					arrayCodigo[1] = $(contenedor).val();
					break;
				case '#selectTipoDocumento':
					arrayCodigo[2] = $(contenedor).val();
					break;
				// case 'input[name=rdVersion]:radio':
				// 	arrayCodigo[4] = $('input[name=rdVersion]:checked').val();
				// 	break;
				case '#idVersionAprovada':
					arrayCodigo[4] = $(contenedor).val();
					break;
				case '#selVersion':
					arrayCodigo[4] = $(contenedor).val();
					break;
			}
			// alert( $(contenedor).val())
			var strCodigo = arrayCodigo.join('-');
			$('#inpCodigo').val(strCodigo);
		});
	};

	function limpiarCamposPaginaAgregarDoc(){
		$("input[type=text], input[type=file], select, textarea").val("");
		$("#rdVersionInterna").prop("checked", false);
		$("#rdVersionClienteRevisor").prop("checked", false);
		$("#idVersionAprovada").prop("checked", false);

		$('#selectSubAreas option').each(function(index, option) {
			$(option).remove();
		});
		$('#selectDisciplina option').each(function(index, option) {
			$(option).remove();
		});
		$('#selectTipoDocumento option').each(function(index, option) {
			$(option).remove();
		});
		$('#selectUsuario option').each(function(index, option) {
			$(option).remove();
		});
	};

	//CUANDO SE MARCA LA VERSION DE DOCUMENTO INTERTNA O APROBADA NO SE PUEDEN ESCOGER PERSONAS
	$("input[name=rdVersion]:radio").change(function () {
		if($('#idVersionAprovada').is(':checked')) {
			$('#selectGrupoUsuario').attr('disabled', true);
			$('#selectUsuario').attr('disabled',true);
			$('#selectUsuario').val(''); // se borra el nombre de usuario seleccionado
			$('#checkNoEnviaCorreo').attr('disabled', true);

			emisionSeleccionada = 'Aprobado'; //si se selecciona el otro rd-> el estado emision serra aprobado
		} else {
			$('#selectGrupoUsuario').attr('disabled', false);
			$('#selectUsuario').attr('disabled', false);
			$('#checkNoEnviaCorreo').attr('disabled', false);
		}
	});
	// A MEDIDIA QUE SE VAN ESCOGIENDO LAS OPCIONES SE VAN DESBLOQUEANDO LOS SIGUENTES CONTROLES
	function irDesbloqueandoCampos(){
		$('#inpTituloDoc').click(function() {
			$('#selectAreas').attr('disabled', false);
		});
		$('#selectAreas').click(function() {
			$('#selectSubAreas').attr('disabled', false);
			$('#btnNuevaSubArea').attr('disabled', false);
		});
		$('#selectSubAreas').click(function() {
			if ($('#selectSubAreas').val() != null) {
				$('#selectGrupoDisciplina').attr('disabled', false);
			};
		});
		$('#selectGrupoDisciplina').click(function() {
			$('#selectDisciplina').attr('disabled', false);
		});
		$('#selectDisciplina').click(function() {
			if ($('#selectDisciplina').val() != null) {
				$('#selectGrupoTipoDocumento').attr('disabled', false);
			};
		});
		$('#selectGrupoTipoDocumento').click(function() {
			$('#selectTipoDocumento').attr('disabled', false);
		});
		$('#selectTipoDocumento').click(function() {
			if ($('#selectTipoDocumento').val() != null) {
				$('#rdVersionInterna').attr('disabled', false);
				$('#rdVersionClienteRevisor').attr('disabled', false);
				$('#idVersionAprovada').attr('disabled', false);
			};
		});
		$('#rdVersionInterna').click(function() {
			$('#txtAreaResumenDoc').attr('disabled', false);
		});
		$('#rdVersionClienteRevisor').click(function() {
			$('#txtAreaResumenDoc').attr('disabled', false);
		});
		$('#idVersionAprovada').click(function() {
			$('#txtAreaResumenDoc').attr('disabled', false);
		});
		$('#txtAreaResumenDoc').click(function() {
			$('#txtAreaObservacionesDoc').attr('disabled', false);
			$('#archivos').attr('disabled', false);
			// alert(emisionSeleccionada);

		});
		$('#archivos').click(function() {
			$('#btnAgregar').attr('disabled', false);
		});
	}
	//funcion que deshabilita todos los inputs y selects
	function deshabilitarControles(){
		$('#selectAreas').attr('disabled', true);
		$('#selectSubAreas').attr('disabled', true);
		$('#btnNuevaSubArea').attr('disabled', true);
		$('#selectGrupoDisciplina').attr('disabled', true);
		$('#selectDisciplina').attr('disabled', true);
		$('#selectGrupoTipoDocumento').attr('disabled', true);
		$('#selectTipoDocumento').attr('disabled', true);
		$('#rdVersionInterna').attr('disabled', true);
		$('#rdVersionClienteRevisor').attr('disabled', true);
		$('#idVersionAprovada').attr('disabled', true);
		$('#txtAreaResumenDoc').attr('disabled', true);
		$('#txtAreaResumenDoc').attr('disabled', true);
		$('#txtAreaResumenDoc').attr('disabled', true);
		$('#txtAreaObservacionesDoc').attr('disabled', true);
		$('#archivos').attr('disabled', true);

		$('#selectGrupoUsuario').attr('disabled', true);
		$('#selectUsuario').attr('disabled', true);
		$('#checkNoEnviaCorreo').attr('disabled', true);
	}

	function cargarAreasModalAgregarSubArea(){
		$.ajax({
			url: 'php/consultaAreas.php',
			type: 'POST',
			dataType: 'json',
			error: function(jqXHR,text_status,strError){
				alert("Error al cargar las areas\n"+ strError);
			},
			timeout: 60000,
			success: function(data){
				$('#selArea').append("<option value='seleccione' selected='selected' disabled='disabled'>Seleccione área</option>");
				for(var i in data){
					$('#selArea').append("<option value='" + data[i][0] + "'>" + data[i][1] + "</option>");
				}
			}
		});
	};

	function agregarSubArea(){
		$('#btnAgregarNuevaSubArea').click(function(){
			if ($('#btnAgregarNuevaSubArea').html() == 'Agregar') {
				if ($('#selArea').val() != 'seleccione' && $('#inpNombreSubArea').val() != '') {
					var EDTArea = $('#selArea').val();
					var nombreSubArea = $('#inpNombreSubArea').val();
					$.ajax({
						data: ({EDTAreaPHP: EDTArea, nombreSubAreaPHP: nombreSubArea}),
						type: "POST",
						url: "php/insertarSubArea.php",
						cache: false,
						dataType: "text",
						success: function(data){
							alert(data);
							$('#inpNombreSubArea').val('');
							cargarSubAreasPaginaAgregarDoc();
						}
					});
				};
				
			};
			if ($('#btnAgregarNuevaSubArea').html() == 'Modificar') {

			};

		});
	}

	function habilitarDeshabilitarRdsModalSubArea(){
		$("#rdNuevaSubArea").click(function(){
			$('#inpNombreSubArea').attr('disabled', false);

			$('#inpNombreNuevoSubArea').attr('disabled', true);
			$('#selSubArea').attr('disabled', true);
			$('#btnEliminarSubArea').attr('disabled', true);

			$('#btnAgregarNuevaSubArea').html('Agregar');
			$( "#btnAgregarNuevaSubArea" ).removeClass('btn-warning' );
			$( "#btnAgregarNuevaSubArea" ).addClass( 'btn-success' );
		});
		$("#rdModSubArea").click(function(){
			$('#inpNombreSubArea').attr('disabled', true);

			$('#inpNombreNuevoSubArea').attr('disabled', false);
			$('#selSubArea').attr('disabled', false);
			$('#btnEliminarSubArea').attr('disabled', false);

			$('#btnAgregarNuevaSubArea').html('Modificar');
			$( "#btnAgregarNuevaSubArea" ).removeClass('btn-success' );
			$( "#btnAgregarNuevaSubArea" ).addClass( 'btn-warning' );
		});
	}

	function cargarSubAreasModalAgregarSubArea(){
		$('#selArea').change(function(){
			var optionSeleccionado = $('#selArea').val();
			$.ajax({
				data: {optionSeleccionadoPHP: optionSeleccionado},
				url: 'php/consultaSubAreas.php',
				type: 'POST',
				dataType: 'json',
				error: function(jqXHR,text_status,strError){
					alert("Error al cargar las subareas\n" + strError);
				},
				timeout: 60000,
				success: function(data){
					$('#selSubArea').html("");
					$('#selSubArea').append("<option value='seleccione' disabled='disabled' selected='selected'>Seleccione sub área</option>");
					for(var i in data){
						$('#selSubArea').append("<option value='" + data[i][0] + "'>" + data[i][1] + "</option>");
					}
				}
			});
		});
	};
	function modificarSubArea(){
		$('#btnAgregarNuevaSubArea').click(function(){
			if ($('#btnAgregarNuevaSubArea').html() == 'Modificar') {
				if ($('#selSubArea').val() != 'seleccione' && $('#inpNombreNuevoSubArea').val() != '') {
					var subAreaAModificar = $('#selSubArea').val();
					var nuevoNombreSubArea = $('#inpNombreNuevoSubArea').val();
					//alert(subAreaAEliminar);
					$.ajax({
						data: ({subAreaAModificarPHP: subAreaAModificar, nuevoNombreSubAreaPHP: nuevoNombreSubArea}),
						url: 'php/modificarSubArea.php',
						type: 'POST',
						dataType: 'text',
						error: function(jqXHR,text_status,strError){
							alert("Error al eliminar la subarea\n" + strError);
						},
						timeout: 60000,
						success: function(data){
							alert(data);
							 $('#inpNombreNuevoSubArea').val('');
						}
					});
				};
			};
		});
	};
	function eliminarSubArea(){
		$('#btnEliminarSubArea').click(function(){
			var subAreaAEliminar = $('#selSubArea').val();
			//alert(subAreaAEliminar);
			$.ajax({
				data: {subAreaAEliminarPHP: subAreaAEliminar},
				url: 'php/eliminarSubArea.php',
				type: 'POST',
				dataType: 'text',
				error: function(jqXHR,text_status,strError){
					alert("Error al eliminar la subarea\n" + strError);
				},
				timeout: 60000,
				success: function(data){
					alert(data);
				}
			});
		});
	};

	function rellenarEDTYNombreSubArea(){
		$('#selSubArea').change(function(){
			$('#inpEDTSubArea').val($('#selSubArea option:selected').val());
			$('#inpNombreNuevoSubArea').val($('#selSubArea option:selected').text());
		});
	}

		//////////////////////////////
		//							//
		//		BUSCAR DOC			//
		//							//
		//////////////////////////////

	function calculaCantidadDocsParaRevisar(){
		$.ajax({
			url: 'php/consultaCantidadDocumentosParaRevision.php',
			type: 'POST',
			dataType: 'text',
			error: function(jqXHR,text_status,strError){
				$('#spanMsgDocsParaRevisar').html('');
				alert("Error al calcular cantidad de documentos para revisar.");
			},
			timeout: 60000,
			success: function(data){
				$('#spanCantidadDocParaRevisar').html('Tiene ' + data + ' documento(s) para revisar')
			}
		});
	};

	function buscarDocumentos(){
		var tituloDoc = $('#inpTituloDoc').val();
		var palabrasClave = $('#inpPalabrasClave').val();
		var codDisciplina = $('#selectDisciplina').val();
		var codTipoDocumento = $('#selectTipoDocumento').val();
		$.ajax({
			data: ({tituloDocPHP: tituloDoc, palabrasClavePHP: palabrasClave, codDisciplinaPHP: codDisciplina, codTipoDocumentoPHP: codTipoDocumento}),
			url: 'php/consultaDocumentos.php',
			type: 'POST',
			dataType: 'json',
			error: function(jqXHR,text_status,strError){
				alert("Error al carga los documentos: \n\n" + strError);
			},
			timeout: 60000,
			success: function(data){
				if ($.isEmptyObject(data)) {
					$('#cuerpoTabla').html('<tr><td></td><td></td><td></td><td><span id = "spanNoArchivosRevision" style = "color:red">No se encontraron documentos</span></td><td></td></tr>');
				}else{
					$('#cuerpoTabla').html("");
					for(var i in data){
						$('#cuerpoTabla').append("<tr id="+data[i][1] + " class = 'filaArchivos'><td>" + data[i][0] +"</td><td>" + data[i][1] +"</td><td>" + data[i][2] + "</td><td>" + data[i][3] + "</td><td>" + data[i][4] + "</td><td>" + data[i][5] + "</td><td>" +data[i][6] + "</td><td><button type='button'id='" + data[i][1] + "' class='btn btn-info btnOpcionArchivo'>Opciones</button></td></tr>");
					}
				}
			}
		});
	};
	function limpiarCamposPaginaBuscarDoc(){
		$("input, select").val("");
	};
	function buscarDocumentosFiltrados(){
		$("#btnBuscar").click(buscarDocumentos);
	};
	// AL HACER CLICK SOBRE BTN BUSCARTODOS SE BLANQUEAN LOS CAMPOS Y CON ESOS PARAMETROS SE BUSCAN LOS DOCS
	function buscarTodosDocumentos(){
		$('#btnBuscarTodos').click(limpiarCamposPaginaBuscarDoc);
		$('#btnBuscarTodos').click(buscarDocumentos);
	};
	// AL HACER CLICK SOBRE BTN DOCS REVISION SE BLANQUEAN LOS CAMPOS Y APARECEN LOS DOCUEMTOS PARA REVISION
	// function buscarDocumentosParaRevisar(){
	// 	$('#btnDocsRevision').click(limpiarCamposPaginaBuscarDoc);
	// 	// $('#btnDocsRevision').click(buscarDocumentosParaRevision);
	// };

	// FUNCION QUE CARGA SOLO LOS SELECT QUE SON DE GRUPOS (AREAS, GRUPO DISCIPLINA, GRUPO TIPO DOC, GRUPO USUARIO)
	function cargarGrupoSelect(rutaPHP, contenedor ){
		$.ajax({
			url: rutaPHP,
			type: 'POST',
			dataType: 'json',
			error: function(jqXHR,text_status,strError){
				alert("No hay coneccion");
			},
			timeout: 60000,
			success: function(data){
				for(var i in data){
					$(contenedor).append("<option value='" + data[i][0] + "'>" + data[i][1] + "</option>");
				}
			}
		});
	};

	//FUNCION QUE CARGA SOLO LOS SELECT QUE SON DE SUB GRUPOS (SUB AREAS, DISCIPLINA, TIPO DOC, USUARIO)
	function cargarSubGrupoSelect(rutaPHP, contenedorGatillante, contenedorActualizado ){
		$(contenedorGatillante).change(function(){
			var optionSeleccionado = $(contenedorGatillante).val();
			$.ajax({
				data: {optionSeleccionadoPHP: optionSeleccionado},
				url: rutaPHP,
				type: 'POST',
				dataType: 'json',
				error: function(jqXHR,text_status,strError){
					alert("Error al carga el subgrupo");
				},
				timeout: 60000,
				success: function(data){
					$(contenedorActualizado).html("");
					for(var i in data){
						$(contenedorActualizado).append("<option value='" + data[i][0] + "'>" + data[i][1] + "</option>");
					}
				}
			});
		});
	};
	function ocultarOpciones(){
		$('#btnOcultarOpciones').click(function(){
			if ($(this).html() == 'Ocultar opciones') {
				$('#contenedorOpciones').css('display', 'none')
				$(this).html('Mostrar opciones')
			}else{
				$('#contenedorOpciones').css('display', 'block')
				$(this).html('Ocultar opciones')
			}
		});
	};