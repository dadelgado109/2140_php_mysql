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

		if($_SERVER['argv'][1] == "exportarCursosCSV"){

			$objCursos = new cursos_cosola();
			$retorno = $objCursos->guardarCSV();

		}

		if($_SERVER['argv'][1] == "prueba"){
			echo("Empiezo la prueba \n");
			/*
			dam109|mail@mail.com|2022-05-06 10:09:10|ok
			san29|mimail@mail.com|2022-07-06 10:09:10|ok
			car5|elmai@mail.com|2022-05-06 11:09:10|error
			eseoo|tumail@hotmail.com|2022-05-06 10:09:10|ok
			migel|elmai@mail.com|2022-05-06 11:12:10|error
			migel|elmai@mail.com|2022-05-06 11:16:10|error
			migel|elmai@mail.com|2022-05-06 11:18:10|error
			elultimo|souy@hotmail.com|2022-08-06 10:09:10|ok
			*/

			$archivo = fopen("archivos/csv/prueba.csv","r");

			$contador = 0;
			$totalOk = 0;
			$totalError = 0;
			$fechasMasAlta = "";

			$ultimoExito = "";

			while(!feof($archivo)){
				$contador++;
				print_r("--- $contador |");
				$linea = fgets($archivo);
				$arrayLinea = explode("|",$linea);
				print_r($arrayLinea );
				
				if(trim($arrayLinea[3]) == "ok"){
					$totalOk++;
				}
				if(trim($arrayLinea[3]) == "error"){
					$totalError++;
				}

				print_r("\n Fecha UNIX".strtotime($arrayLinea[2])."\n");
				if($fechasMasAlta == ""){
					$fechasMasAlta = $arrayLinea[2];
				}else if(strtotime($fechasMasAlta) < strtotime($arrayLinea[2])){
					$fechasMasAlta = $arrayLinea[2];
				}

				if($ultimoExito == "" && trim($arrayLinea[3]) == "ok"){
					$ultimoExito = $linea;
				}else{
					if($ultimoExito != "" && trim($arrayLinea[3]) == "ok"){

						$arrayUltimoExito = explode("|", $ultimoExito);

						if(strtotime($arrayLinea[2]) > strtotime($arrayUltimoExito[2])){
							$ultimoExito = $linea;
						}

					}

				}


			}

			print_r("\n\n Total de ok:".$totalOk);
			print_r("\nTotal de error:".$totalError);
			print_r("\nFecha mas alta:".$fechasMasAlta);
			print_r("\nUltimo login exitoso:".$ultimoExito);
		}


		if($_SERVER['argv'][1] == "instalar"){

			$objInstlador = new instalador();
			$retorno = $objInstlador->arrancar();

		}

	}


	


?>