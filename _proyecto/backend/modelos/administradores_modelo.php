<?php

	require_once("modelos/generico_modelo.php");
	class administradores_modelo extends generico_modelo{

		protected $id;

		protected $nombre;

		protected $mail;

		protected $clave;

		protected $estado;

		private $totalEnLista = 6;


		public function obtenerId(){
			return $this->id;	
		}
		public function obtenerNombre(){
			return $this->nombre;	
		}
		public function obtenerMail(){
			return $this->mail;	
		}

		public function constructor($data = array()){

			$this->id 		= $data['id'];
			$this->nombre 	= $data['nombre'];
			$this->clave 	= $data['clave'];
			$this->mail 	= $data['mail'];

		}


		public function ingresar(){


		}

		public function cargar($id){
			

			$sql = "SELECT * FROM administradores WHERE id = :id";
			$arrayDatos = array("id" => $id);
			$lista = $this->traerListado($sql, $arrayDatos);

			if(isset($lista[0])){
				$this->id 		= $lista[0]['id'];
				$this->nombre 	= $lista[0]['nombre'];
				$this->mail		= $lista[0]['mail'];
				$this->estado 	= $lista[0]['estado'];	
			}

		}


		public function borrar(){
			
		}

		public function editar(){

		}


		public function listar($filtros = array()){
			
		
		}

		public function totalPaginas($filtros = array()){

		}

		public function login($nombre, $clave){

			$sql = "SELECT * FROM administradores 
							WHERE nombre = :nombre
								AND clave = :clave";
			$nombreMinuscula = strtolower($nombre);
			$claveMD5 = md5($clave);
			$arraySQL = array("nombre" =>$nombreMinuscula, "clave"=>$claveMD5);
			
			$administrador = $this->traerListado($sql, $arraySQL);
			if(isset($administrador[0])){
				return true;
			}	
			return false;
		}

	}






?>







