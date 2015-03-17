		//////////////////////////////
		//							//
		//		LOGIN				//
		//							//
		//////////////////////////////


		//////////////////////////////
		//							//
		//		RESUMEN				//
		//							//
		//////////////////////////////

function redireccionarSegunTabSeleccionado(){
	$('#btnAgregarDoc').click(function() {
		$.ajax({
			url: 'agregarDoc.php',
			success: function(data){
				$('#container').html(data);
			}
		});
	});
	$('#btnBuscarDoc').click(function() {
		$.ajax({
			url:'buscarDoc.php',
			success: function(data){
				$('#container').html(data);
			}
		});
	});
	$('#btnGruposUsuarios').click(function() {
		$.ajax({
			url:'grupoUsuarios.php',
			success: function(data){
				$('#container').html(data);
			}
		});
	});
	$('#btnLogs').click(function(){
		$.ajax({
			url:'logs.html',
			success: function(data){
				$('#container').html(data);
			}
		});
	});
}