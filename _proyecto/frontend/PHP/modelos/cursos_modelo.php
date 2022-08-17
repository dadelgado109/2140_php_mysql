<?php


	require_once("PHP/modelos/generico_modelo.php");
	
	class cursos_modelo extends generico_modelo{

		protected $codigo;

		protected $nombre;

		protected $anio;

		protected $tipoCurso;

		protected $profesor;

		protected $imagen;

		protected $img;

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
		public function obtenerImagen(){
			return $this->imagen; 
		} 
		public function obtenerImg(){
			return $this->img; 
		} 

		public function constructor($dato = array()){

			$this->codigo 		= $dato['codigo'];
			$this->nombre 		= $dato['nombre'];
			$this->anio 		= $dato['anio'];
			$this->tipoCurso 	= $dato['tipoCurso'];
			$this->profesor 	= $dato['profesor'];
			$this->imagen 		= $dato['imagen'];
			$this->img 			= $dato['img'];
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
				$this->imagen 		= $respuesta[0]['imagen'];
				$this->img 			= $respuesta[0]['img'];
			}
		}

		
		
		public function listar($filtros = array()){

			$fecha = date("Y");
			$sql = "SELECT 	cur.codigo, 
							cur.nombre,
							cur.anio,
							cur.tipoCurso,
							tc.nombre AS nomTipoCurso,
							cur.profesor,
							CONCAT(pr.nombre, ' ', pr.apellido) AS nomProfesor,
							tc.descripcion AS descripcionTipo,
							imagen,
							img
						FROM cursos cur
					INNER JOIN tiposcursos tc ON tc.id = cur.tipoCurso
					INNER JOIN profesores pr ON pr.documento = cur.profesor
						WHERE cur.estado = 1
						AND tc.estado = 1
						AND anio >= '".$fecha."' ";
			$arraySQL = array();

	
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