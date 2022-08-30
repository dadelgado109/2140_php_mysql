<?php

	require_once("consola/consola.php");
	require_once("modelos/cursos_modelo.php");


	class cursos_cosola extends consola{

		public function arrancar(){

			parent::arrancar();

			$this->listadoCursos();

			
			return "ok";
		}

		public function listadoCursos(){

			$objCursos = new cursos_modelos();
			$listaCursos = $objCursos->listar();
			foreach($listaCursos as $cursos){
				$srtCursos = $cursos['codigo']."|".$cursos['nombre']."|";
				$srtCursos .= $cursos['anio']."|".$cursos['nomTipoCurso']."|";
				$srtCursos .= $cursos['nomProfesor']."|".$cursos['imagen']."|";
				print_r($srtCursos."\n");
				
			}
		}

		public function guardarCSV(){
			/*
				1) parametro es el nombre de archivo donde voy a guardar los datos
				2) es tipo de guardado o de lectura 
			*/
			$objCursos = new cursos_modelos();
			$archivo = fopen("archivos/csv/cursos.csv", "w+");
			fwrite($archivo, "codigo|nombre|anio|nomTipoCurso|profesor|imagen");
			
			$listaCursos = $objCursos->listar();
			foreach($listaCursos as $cursos){
				$srtCursos = "\n".$cursos['codigo']."|".$cursos['nombre']."|";
				$srtCursos .= $cursos['anio']."|".$cursos['nomTipoCurso']."|";
				$srtCursos .= $cursos['nomProfesor']."|".$cursos['imagen']."|";
				fwrite($archivo, $srtCursos);				
			}
			fclose($archivo);   

		}

		public function prueba(){
			

		}




	}






?>