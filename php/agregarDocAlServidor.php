<?php

header('Access-Control-Allow-Origin: *');

include("conec.php");

$ruta="../docsSubidos/";

//Como no sabemos cuantos archivos van a llegar, iteramos la variable $_FILES
foreach ($_FILES as $key) {
	if($key['error'] == UPLOAD_ERR_OK ){//Verificamos si se subio correctamente
		$nombre = $key['name'];//Obtenemos el nombre del archivo y le concatenamos el codigo que genera el programa
		$temporal = $key['tmp_name']; //Obtenemos el nombre del archivo temporal
		$tamano = ($key['size'] / 1000)."Kb"; //Obtenemos el tamaño en KB

		// Reemplazar espacios y signos de puntación del nombre de archivo por guiones bajos
		$nombre= preg_replace('/[^a-z0-9-_\-\.]/i','_', $nombre);

		$trozos = explode(".", $nombre); 
		$extension = end($trozos); 

		// Obtener la extensión del archivo (a veces resulta útil saberlo)
		// $extension = substr($nombre, -4, 4); // mantiene desde -4 a 4 caracteres: .txt

		// Obtener el puro nombre del archivo (sin la extensión)
		//$nombre = substr($nombre, 0, -4); // mantiene desde 0 hasta -4 caracteres: carta_a_los_reyes_magos
		$largoExtension = strlen($extension);
		$nombre = substr($nombre, 0, -($largoExtension+1));

		echo "$nombre\n";
		 

		// Antes de mover el archivo al directorio, prevenir la sobre escritura
		if(file_exists($ruta . $nombre . '.' . $extension)){
			$contador = 1;
			while(file_exists($ruta . $nombre . '_' . $contador . '.' . $extension)) { $contador++;  }
			// Si existe se renombra a con un infijo numérico: carta_a_los_reyes_magos_2.txt
				$nombre = $nombre.'_'.$contador.'.'.$extension;
			}
		// Si no existe, no se renombra y queda tal cual: carta_a_los_reyes_magos.txt
		else{
			$nombre = $nombre.$extension;
		}

		move_uploaded_file($temporal, $ruta . $nombre); //Movemos el archivo temporal a la ruta especificada
		echo "se cargo el achivo '$nombre'"; //El echo es para que lo reciba jquery
	}
	else{
		echo $key['error']; //Si no se cargo mostramos el error
	}
}

?>