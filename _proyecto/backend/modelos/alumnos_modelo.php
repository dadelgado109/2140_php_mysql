<?php


	class alumnos_modelo {

		protected $documnto;

		protected $nombre;

		protected $apellido;

		protected $tipoDocumento;

		protected $fechaNacimiento;
	

		public function __constructor(){

			$this->documnto 		= "";
			$this->nombre 			= "";
			$this->apellido 		= "";
			$this->tipoDocumento 	= "";
			$this->fechaNacimiento 	= "";

		}


		public function listar($filtros = array()){
			$totalRegistro = 3;
			$sql = "SELECT * FROM alumnos";

			// SELECT * FROM alumnos LIMIT 0,3
			// SELECT * FROM alumnos LIMIT 3,3
			// SELECT * FROM alumnos LIMIT 6,3
			if(isset($filtros['pagina']) && $filtros['pagina'] != ""){
				$pagina = $filtros['pagina'] * $totalRegistro;
				$sql .= " LIMIT ".$pagina.",".$totalRegistro."";
			}else{
				$sql .= " LIMIT 0,".$totalRegistro;
			}


			$lista = $this->traerListado($sql);
			
			return $lista;

		}






		public function traerListado($sql, $arrayData = array()){
			/*
				$sql = Es la consulta contra la base de datos
				$arrayDatos = son los datos que van por parametro en la consulta
			*/
			include("configuracion/configuracion.php");

			$host 		= $BDMYSQL['host'];
			$dbName 	= $BDMYSQL['dbName'];
			$user 		= $BDMYSQL['user'];
			$password 	= $BDMYSQL['password'];
			$options = [
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_CASE => PDO::CASE_NATURAL,
				PDO::ATTR_ORACLE_NULLS => PDO::NULL_EMPTY_STRING
			];

			$objConexion = new PDO("mysql:localhost=".$host.";dbname=".$dbName."",$user,$password,$options);

			$preparo = $objConexion->prepare($sql);
			$preparo->execute($arrayData);
			$lista = $preparo->fetchAll();

			return $lista;

		} 



	}






?>







