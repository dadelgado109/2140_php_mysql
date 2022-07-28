<?php

	require_once("modelos/generico_modelo.php");

	class tiposCursos_modelo extends generico_modelo{

		protected $id;

		protected $nombre;

		protected $descripcion;
	
		protected $estado;

		private $totalEnLista = 3;


		public function obtenerID(){
			return $this->id;	
		}
		public function obtenerNombre(){
			return $this->nombre;	
		}
		public function obtenerDescripcion(){
			return $this->descripcion;	
		}

		public function constructor($data = array()){

			$this->id 			= $data['id'];
			$this->nombre 		= $data['nombre'];
			$this->descripcion 	= $data['descripcion'];

		}


		public function ingresar(){

			$arrayRespuesta = array("codigo"=>"", "mensaje"=>"");
		
			if(strlen($this->nombre) < 3 || strlen($this->nombre) > 100){
				$arrayRespuesta['codigo'] = "Error";
				$arrayRespuesta['mensaje'] = "El nombre de tipo de curso no es correcto";
				return $arrayRespuesta;
			}

			$sql = "INSERT INTO tiposcursos SET
						nombre 		= :nombre,
						descripcion	= :descripcion,
						estado 		= 1;";
			$arrayDatos = array(
				"nombre" 		=> $this->nombre,
				"descripcion" 	=> $this->descripcion
			);
			$respuesta = $this->ejecutarConsulta($sql, $arrayDatos);
		
			if($respuesta){
				$arrayRespuesta['codigo'] = "OK";
				$arrayRespuesta['mensaje'] = "Se ingreso el tipo de curso correctamente";
			}else{
				$arrayRespuesta['codigo'] = "Error";
				$arrayRespuesta['mensaje'] = "Error al ingresar el tipo de curso";
			}
			return $arrayRespuesta;


		}

		public function cargar($id){
			

			$sql = "SELECT * FROM tiposcursos WHERE id = :id";
			$arrayDatos = array("id" => $id);
			$lista = $this->traerListado($sql, $arrayDatos);
			if(isset($lista[0])){
				$this->id 			= $lista[0]['id'];
				$this->nombre 		= $lista[0]['nombre'];
				$this->descripcion 	= $lista[0]['descripcion'];
				$this->estado 		= $lista[0]['estado'];	
			}

		}


		public function borrar(){
			
			$sql = "UPDATE tiposcursos SET estado = 0 WHERE id = :id";
			$arrayDatos = array("id" => $this->id);
			$respuesta = $this->ejecutarConsulta($sql, $arrayDatos);
			
			if($respuesta){
				$arrayRespuesta['codigo'] = "OK";
				$arrayRespuesta['mensaje'] = "Se borro el tipo curso correctamente";
			}else{
				$arrayRespuesta['codigo'] = "Error";
				$arrayRespuesta['mensaje'] = "Error al  tipo curso el Alumno";
			}
			return $arrayRespuesta;

		}

		public function editar(){

			$arrayRespuesta = array("codigo"=>"", "mensaje"=>"");
			$sqlDuplicado = "SELECT count(*) AS total FROM tiposcursos WHERE id = :id";
			$arrayDuplicado = array("id" => $this->id);
			$lista = $this->traerListado($sqlDuplicado, $arrayDuplicado);
			$totalRegistros = $lista[0]['total'];
			
			if($totalRegistros == 0){
				$arrayRespuesta['codigo'] = "Error";
				$arrayRespuesta['mensaje'] = "Error el id no se encuentra registrado";
				return $arrayRespuesta;
			}

			if(strlen($this->nombre) < 3 || strlen($this->nombre) > 100){
				$arrayRespuesta['codigo'] = "Error";
				$arrayRespuesta['mensaje'] = "El nombre no es correcto";
				return $arrayRespuesta;
			}

			$sql = "UPDATE tiposcursos SET
						nombre 		= :nombre,
						descripcion	= :descripcion
					WHERE id = :id;";
			$arrayDatos = array(				
				"nombre" 		=> $this->nombre,
				"descripcion" 	=> $this->descripcion,
				"id" 			=> $this->id,
			);
			$respuesta = $this->ejecutarConsulta($sql, $arrayDatos);

			if($respuesta){
				$arrayRespuesta['codigo'] = "OK";
				$arrayRespuesta['mensaje'] = "Se Edito el tipo Curso correctamente";
			}else{
				$arrayRespuesta['codigo'] = "Error";
				$arrayRespuesta['mensaje'] = "Error al editar el tipo Curso";
			}
			return $arrayRespuesta;


		}


		public function listar($filtros = array()){
			
			$sql = "SELECT * FROM tiposcursos WHERE estado = 1 ";

			// SELECT * FROM alumnos LIMIT 0,3
			// SELECT * FROM alumnos LIMIT 3,3
			// SELECT * FROM alumnos LIMIT 6,3
			if(isset($filtros['buscar']) && $filtros['buscar'] != ""){

				$sql .= " AND nombre LIKE ('%".$filtros['buscar']."%')";

			}
			if(isset($filtros['pagina']) && $filtros['pagina'] != ""){
				$pagina = $filtros['pagina'] * $this->totalEnLista;
				$sql .= " LIMIT ".$pagina.",".$this->totalEnLista."";
			}else{
				$sql .= " LIMIT 0,".$this->totalEnLista;
			}
			$lista = $this->traerListado($sql);
			return $lista;

		}

		public function totalPaginas(){

			$sql = "SELECT count(*) as total FROM tiposcursos";
			$lista = $this->traerListado($sql);
			$totalRegistros = $lista[0]['total'];
			$totalPaginas = ceil($totalRegistros/$this->totalEnLista);
			return $totalPaginas;

		}


		

	}






?>







