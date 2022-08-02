<?php


	require_once("modelos/generico_modelo.php");
	
	class cursos_modelos extends generico_modelo{

		protected $codigo;

		protected $nombre;

		protected $anio;

		protected $tipoCurso;

		protected $profesor;

		protected $estado;

		public function obtenerNombre(){
			return $this->nombre; 
		} 

		public function obtenerCodigo(){
			return $this->codigo; 
		} 

		public function obtenerAnio(){
			return $this->anio; 
		} 

		public function obtenerTipoCurso(){
			return $this->tipoCurso; 
		} 

		public function obtenerProfesor(){
			return $this->profesor; 
		} 

		public function constructor($dato = array()){

			$this->codigo 		= $dato['codigo'];
			$this->nombre 		= $dato['nombre'];
			$this->anio 		= $dato['anio'];
			$this->tipoCurso 	= $dato['tipoCurso'];
			$this->profesor 	= $dato['profesor'];

		} 

		public function ingresar(){
			// Abre Marcel Sierra
			$sqlValidacion = "";


			$sql = "INSERT cursos SET
						nombre  = :nombre,
						anio	= :anio,
						tipoCurso = :tipoCurso,
						profesor = :profesor,
						estado = 1 ";
			$arrarSQL = array(
				"nombre" 	=> $this->nombre,
				"anio" 		=> $this->anio,
				"tipoCurso" => $this->tipoCurso,
				"profesor" 	=> $this->profesor,
			);
			$respuesta = $this->ejecutarConsulta($sql, $arrarSQL);

			if($respuesta){
				$arrayRespuesta['codigo'] = "OK";
				$arrayRespuesta['mensaje'] = "Se ingreso el curso correctamente";
			}else{
				$arrayRespuesta['codigo'] = "Error";
				$arrayRespuesta['mensaje'] = "Error al ingresar el curso";
			}
			return $arrayRespuesta;

		}

		public function borrar(){

			$sql = "UPDATE cursos SET estado = 0 WHERE codigo = :codigo";
			$arratSQL = array("codigo" => $this->codigo);
			$respuesta = $this->ejecutarConsulta($sql, $arrarSQL);

			if($respuesta){
				$arrayRespuesta['codigo'] = "OK";
				$arrayRespuesta['mensaje'] = "Se borro el curso correctamente";
			}else{
				$arrayRespuesta['codigo'] = "Error";
				$arrayRespuesta['mensaje'] = "Error al borrar el curso";
			}
			return $arrayRespuesta;

		}


	}


?>