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
	}






?>