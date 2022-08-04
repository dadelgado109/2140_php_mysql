<?php


	require_once("modelos/generico_modelo.php");
	
	class cursos_modelos extends generico_modelo{

		protected $codigo;

		protected $nombre;

		protected $anio;

		protected $tipoCurso;

		protected $profesor;

		protected $estado;

		private $totalEnLista = 5;

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

		public function cargar($codigo){

			$sql = "SELECT * FROM cursos WHERE codigo = :codigo";
			$arraySQL = array("codigo" => $codigo);
			$respuesta = $this->traerListado($sql, $arraySQL);
			
			if(isset($respuesta[0]['codigo'])){

				$this->codigo 		= $respuesta[0]['codigo'];
				$this->nombre 		= $respuesta[0]['nombre'];
				$this->anio 		= $respuesta[0]['anio'];
				$this->tipoCurso 	= $respuesta[0]['tipoCurso'];
				$this->profesor 	= $respuesta[0]['profesor'];

			}
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
			$arraySQL = array("codigo" => $this->codigo);
			$respuesta = $this->ejecutarConsulta($sql, $arraySQL);

			if($respuesta){
				$arrayRespuesta['codigo'] = "OK";
				$arrayRespuesta['mensaje'] = "Se borro el curso correctamente";
			}else{
				$arrayRespuesta['codigo'] = "Error";
				$arrayRespuesta['mensaje'] = "Error al borrar el curso";
			}
			return $arrayRespuesta;

		}

		public function editar(){

			$sql = "UPDATE cursos SET
						nombre  = :nombre,
						anio	= :anio,
						tipoCurso = :tipoCurso,
						profesor = :profesor
					WHERE codigo = :codigo;";
			$arrarSQL = array(
				"codigo" 	=> $this->codigo,
				"nombre" 	=> $this->nombre,
				"anio" 		=> $this->anio,
				"tipoCurso" => $this->tipoCurso,
				"profesor" 	=> $this->profesor,
			);	
			$respuesta = $this->ejecutarConsulta($sql, $arrarSQL);

			if($respuesta){
				$arrayRespuesta['codigo'] = "OK";
				$arrayRespuesta['mensaje'] = "Se edito el curso correctamente";
			}else{
				$arrayRespuesta['codigo'] = "Error";
				$arrayRespuesta['mensaje'] = "Error la editar el curso";
			}
			return $arrayRespuesta;	
		}

		
		public function listar($filtros = array()){

			$sql = "SELECT 	cur.codigo, 
							cur.nombre,
							cur.anio,
							cur.tipoCurso,
							tc.nombre AS nomTipoCurso,
							cur.profesor,
							CONCAT(pr.nombre, ' ', pr.apellido) AS nomProfesor
						FROM cursos cur
					INNER JOIN tiposcursos tc ON tc.id = cur.tipoCurso
					INNER JOIN profesores pr ON pr.documento = cur.profesor
						WHERE cur.estado = 1
						AND tc.estado = 1";

			$arraySQL = array();

			if(isset($filtros['pagina']) && $filtros['pagina'] != ""){
				$pagina = $filtros['pagina'] * $this->totalEnLista;
				$sql .= " LIMIT ".$pagina.",".$this->totalEnLista."";
			}else{
				$sql .= " LIMIT 0,".$this->totalEnLista;
			}

			$respuesta = $this->traerListado($sql, $arraySQL);
			
			return $respuesta;
		}


		public function totalPaginas($filtros = array()){

			$sql = "SELECT count(*) total FROM cursos 
						WHERE estado = 1 ";

			$lista = $this->traerListado($sql);
			$totalRegistros = $lista[0]['total'];
			$totalPaginas = ceil($totalRegistros/$this->totalEnLista);
			return $totalPaginas;

		}

	}


?>