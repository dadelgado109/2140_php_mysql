<?php


	class asadera {

		// Cramos propiedad
		/*
			Public(publica):La propiedad se puede acceder fuera de la clase y es heredable
			Private(privada):La propiedad no puede ser accedidad fuera de la clase y no es heredable
			Protencted(Protegida):Esta propiedad no se puede acceder fuera de la clase y es heredable
		*/	
		
		public $material;

		public $forma;

		private $tamanho;

		public $color; 

		protected $temperatura;

		// En el minuto 21:05 de la clase 2022-07-06 defini los metodos.
	

		public function construct($material, $forma, $tamanho, $color){
			/*
				Este metodo se encarga de construi la clase.
			*/
			$this->material 	= $material;
			$this->forma 		= $forma;
			$this->tamanho		= $tamanho;
			$this->color 		= $color;
			$this->temperatura 	= 20;

		}

		public function obtenerTemperatura(){

			$retorno = $this->temperatura;
			return $retorno;
		} 

		public function calentar(){
			/*
				Este metodo se encarga de subir la temperatura de la asadera
			*/
			$this->temperatura = $this->temperatura + 10;
		}

		public function enfriar(){
			/*
				Este metodo se encarga de bajar la temperatura de la asadera
			*/
			$this->temperatura = $this->temperatura - 10;
		}

	}

	$objAsadera = new asadera();
	$objAsadera->construct("Acero","Rectangulo","20*20","Verde");

	print_r($objAsadera->material);
	echo("<br>");
	print_r($objAsadera->forma);
	echo("<br>");
	//print_r($objAsadera->tamanho);
	echo("<br>");
	print_r($objAsadera->obtenerTemperatura());
	echo("<br>");
	//print_r($objAsadera);

	$objAsadera->forma = "Edificio";
	print_r($objAsadera->forma);
	$objAsadera->calentar();
	echo("<br>");
	print_r("Temperatura:".$objAsadera->obtenerTemperatura());
	$objAsadera->calentar();
	$objAsadera->calentar();
	echo("<br>");
	print_r("Temperatura:".$objAsadera->obtenerTemperatura());
	$objAsadera->enfriar();
	echo("<br>");
	print_r("Temperatura:".$objAsadera->obtenerTemperatura());
?>