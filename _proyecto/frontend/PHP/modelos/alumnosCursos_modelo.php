<?php


require_once("PHP/modelos/generico_modelo.php");

	class alumnosCursos_modelo extends generico_modelo{

		protected $id;

		protected $codigoCurso;

		protected $documento;


		public function constructor($id, $codigo, $documento){

			$this->id 		= $id;
			$this->codigo 	= $codigo;
			$this->documento = $documento;

		}

		public function ingresar(){

			$sql = "INSERT INTO alumnos_cursos SET
						codigoCurso = :codigo,
						documento = :documento;";
			$arraySQL = array("codigo" => $this->codigo, "documento"=>$this->documento);
			$respuesta = $this->ejecutarConsulta($sql, $arrayDatos);

			
			if($respuesta){
				$arrayRespuesta['codigo'] = "OK";
				$arrayRespuesta['mensaje'] = "Se inscribio en el curso correctamente";
			}else{
				$arrayRespuesta['codigo'] = "Error";
				$arrayRespuesta['mensaje'] = "Error al inscibirse al curso";
			}
			return $arrayRespuesta;

		}




	}


?>