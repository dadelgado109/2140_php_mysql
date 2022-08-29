<?php

	require_once("modelos/tiposCursos_modelo.php");

	class controlador_tipos_cursos{

		public static function listarTiposCursos($recibe){

			$pagina = 0;
			if(isset($recibe['pagina']) && $recibe['pagina'] != "" && $recibe['pagina'] >= 1 && is_int($recibe['pagina'])){
				$pagina = $recibe['pagina'] - 1;
			}

			$objTiposCursos = new tiposCursos_modelo();

			$filtros = array("pagina"=>$pagina);
			$listaTiposCursos = $objTiposCursos->listar($filtros);

			return $listaTiposCursos;

		}

		public static function ingresarTiposCursos($recibe){

			$datos = array();
			$datos['id']			= "";
			$datos['nombre'] 		= isset($recibe['nombre'])?$recibe['nombre']:"";
			$datos['descripcion']	= isset($recibe['descripcion'])?$recibe['descripcion']:"";

			$objTCursos = new tiposCursos_modelo();
			$objTCursos->constructor($datos);
			$respuesta = $objTCursos->ingresar();
			
			return $respuesta;

		}

	}


?>