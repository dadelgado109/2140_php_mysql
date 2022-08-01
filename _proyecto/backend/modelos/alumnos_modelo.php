<?php

	require_once("modelos/generico_modelo.php");
	class alumnos_modelo extends generico_modelo{

		protected $documento;

		protected $nombre;

		protected $apellido;

		protected $tipoDocumento;

		protected $fechaNacimiento;
	
		protected $estado;

		private $totalEnLista = 6;


		public function obtenerDocumento(){
			return $this->documento;	
		}
		public function obtenerNombre(){
			return $this->nombre;	
		}
		public function obtenerApellido(){
			return $this->apellido;	
		}
		public function obtenerFechaNacimiento(){
			return $this->fechaNacimiento;	
		}
		public function obtenerTipoDocumento(){
			return $this->tipoDocumento;	
		}


		public function constructor($data = array()){

			$this->documento 		= $data['documento'];
			$this->nombre 			= $data['nombre'];
			$this->apellido 		= $data['apellido'];
			$this->tipoDocumento 	= $data['tipoDocumento'];
			$this->fechaNacimiento 	= $data['fechaNacimiento'];

		}


		public function ingresar(){

			$arrayRespuesta = array("codigo"=>"", "mensaje"=>"");
			$sqlDuplicado = "SELECT count(*) AS total FROM alumnos WHERE documento = :documento";
			$arrayDuplicado = array("documento" => $this->documento);
			$lista = $this->traerListado($sqlDuplicado, $arrayDuplicado);
			$totalRegistros = $lista[0]['total'];
			
			if($totalRegistros > 0){
				$arrayRespuesta['codigo'] = "Error";
				$arrayRespuesta['mensaje'] = "Error el documento ya se encuentra registrado";
				return $arrayRespuesta;
			}

			if(strlen($this->documento) < 5 || strlen($this->documento) > 10){
				$arrayRespuesta['codigo'] = "Error";
				$arrayRespuesta['mensaje'] = "El documento tiene que ser mayor a 5 digitos y menos a 10 digitos";
				return $arrayRespuesta;
			}



			$sql = "INSERT INTO alumnos SET
						documento 	= :documento,
						nombre 		= :nombre,
						apellido	= :apellido,
						fechaNacimiento = :fechaNacimiento,
						tipoDocumento = :tipoDocumento,
						estado 		= 1;";
			$arrayDatos = array(

				"documento" 	=> $this->documento,
				"nombre" 		=> $this->nombre,
				"apellido" 		=> $this->apellido,
				"fechaNacimiento" => $this->fechaNacimiento,
				"tipoDocumento" => $this->tipoDocumento,

			);
			$respuesta = $this->ejecutarConsulta($sql, $arrayDatos);

			
			if($respuesta){
				$arrayRespuesta['codigo'] = "OK";
				$arrayRespuesta['mensaje'] = "Se ingreso el Alumno correctamente";
			}else{
				$arrayRespuesta['codigo'] = "Error";
				$arrayRespuesta['mensaje'] = "Error al ingresar el Alumno";
			}
			return $arrayRespuesta;


		}

		public function cargar($documento){
			

			$sql = "SELECT * FROM alumnos WHERE documento = :documento";
			$arrayDatos = array("documento" => $documento);
			$lista = $this->traerListado($sql, $arrayDatos);

			if(isset($lista[0])){
				$this->documento 		= $lista[0]['documento'];
				$this->nombre 			= $lista[0]['nombre'];
				$this->apellido 		= $lista[0]['apellido'];
				$this->tipoDocumento 	= $lista[0]['tipoDocumento'];
				$this->fechaNacimiento 	= $lista[0]['fechaNacimiento'];	
				$this->estado 			= $lista[0]['estado'];	
			}

		}


		public function borrar(){
			
			$sql = "UPDATE alumnos SET estado = 0 WHERE documento = :documento";
			$arrayDatos = array("documento" => $this->documento);
			$respuesta = $this->ejecutarConsulta($sql, $arrayDatos);
			
			if($respuesta){
				$arrayRespuesta['codigo'] = "OK";
				$arrayRespuesta['mensaje'] = "Se borro el Alumno correctamente";
			}else{
				$arrayRespuesta['codigo'] = "Error";
				$arrayRespuesta['mensaje'] = "Error al borrar el Alumno";
			}
			return $arrayRespuesta;

		}

		public function editar(){

			$arrayRespuesta = array("codigo"=>"", "mensaje"=>"");
			$sqlDuplicado = "SELECT count(*) AS total FROM alumnos WHERE documento = :documento";
			$arrayDuplicado = array("documento" => $this->documento);
			$lista = $this->traerListado($sqlDuplicado, $arrayDuplicado);
			$totalRegistros = $lista[0]['total'];
			
			if($totalRegistros == 0){
				$arrayRespuesta['codigo'] = "Error";
				$arrayRespuesta['mensaje'] = "Error el documento no se encuentra registrado";
				return $arrayRespuesta;
			}

			if(strlen($this->documento) < 5 || strlen($this->documento) > 10){
				$arrayRespuesta['codigo'] = "Error";
				$arrayRespuesta['mensaje'] = "El documento tiene que ser mayor a 5 digitos y menos a 10 digitos";
				return $arrayRespuesta;
			}

			$sql = "UPDATE alumnos SET
						nombre 		= :nombre,
						apellido	= :apellido,
						fechaNacimiento = :fechaNacimiento
					WHERE documento = :documento;";
			$arrayDatos = array(				
				"nombre" 		=> $this->nombre,
				"apellido" 		=> $this->apellido,
				"fechaNacimiento" => $this->fechaNacimiento,
				"documento" => $this->documento,
			);
			$respuesta = $this->ejecutarConsulta($sql, $arrayDatos);

			if($respuesta){
				$arrayRespuesta['codigo'] = "OK";
				$arrayRespuesta['mensaje'] = "Se Edito el Alumno correctamente";
			}else{
				$arrayRespuesta['codigo'] = "Error";
				$arrayRespuesta['mensaje'] = "Error al editar el Alumno";
			}
			return $arrayRespuesta;


		}


		public function listar($filtros = array()){
			
			$sql = "SELECT * FROM alumnos WHERE estado = 1 ";

			// SELECT * FROM alumnos LIMIT 0,3
			// SELECT * FROM alumnos LIMIT 3,3
			// SELECT * FROM alumnos LIMIT 6,3
			if(isset($filtros['buscar']) && $filtros['buscar'] != ""){

				$sql .= " AND (nombre LIKE ('%".$filtros['buscar']."%')
							OR apellido LIKE ('%".$filtros['buscar']."%')
							OR documento LIKE ('%".$filtros['buscar']."%')
						)
					";
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

		public function totalPaginas($filtros = array()){

			$sql = "SELECT count(*)  total FROM alumnos 
						WHERE estado = 1 ";

			if(isset($filtros['buscar']) && $filtros['buscar'] != ""){

				$sql .= " AND (nombre LIKE ('%".$filtros['buscar']."%')
							OR apellido LIKE ('%".$filtros['buscar']."%')
							OR documento LIKE ('%".$filtros['buscar']."%')
						)
					";
			}

			$lista = $this->traerListado($sql);
			$totalRegistros = $lista[0]['total'];
			$totalPaginas = ceil($totalRegistros/$this->totalEnLista);
			return $totalPaginas;

		}

		public function listaTipoDocumento(){

			$arrayTipoDocumento = array();
			$arrayTipoDocumento['CI'] = "CI";
			$arrayTipoDocumento['Pasaporte'] = "Pasaporte";
			return $arrayTipoDocumento;

		}


	}






?>







