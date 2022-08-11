<?php

	/*
		Es el enrutador generico

	*/

	require_once("consola/cursos_cosola.php"); 
	require_once("consola/instalador.php"); 

	if(isset($_SERVER['argv'][1]) && $_SERVER['argv'][1] != ""){

		if($_SERVER['argv'][1] == "listadoCursos"){

			$objCursos = new cursos_cosola();
			$retorno = $objCursos->arrancar();

		}

		if($_SERVER['argv'][1] == "instalar"){

			$objInstlador = new instalador();
			$retorno = $objInstlador->arrancar();

		}

	}


	


?>