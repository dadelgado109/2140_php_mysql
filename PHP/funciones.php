<?php

	//include("funciones_externas.php");
	
	//include_once("funciones_externas.php");

	//require("funciones_externassss.php");
	
	require_once("funciones_externas.php");	

	function  miFuncion($texto, $fecha = "No trajo Fecha", $colores = array() ){

		echo($texto."<br>");
		echo("Fecha:".$fecha."<br>");
		var_dump($colores);

	}

	function suma($valorA, $valorB){

		if (is_numeric($valorA) && is_numeric($valorB)) {
			$respuesta = $valorA + $valorB;
		}else{
			$respuesta = "Algunas de las entradas no es un numero";
		}
		return $respuesta;
	}


	$strTexto = "Hola yo viajo por parametro";

	$fecha = date("d-m-Y");

	$varTexto = "Texto que estoy escribiendo";

	miFuncion($strTexto, $strTexto);


	$varNumA = 10;
	$varNumB = 5;	

	$respuesta = suma($varNumA, $varNumB);
	
	print_r("<br>Total es:".$respuesta);

	$respuesta = suma($varNumA, "7");
	
	print_r("<br>Total es:".$respuesta);

	print_r("<br><hr>");
	$varTexto = "Soy el textoooooo";
	print_r($varTexto);
	$texto = darVueltaTexto($varTexto);
	print_r("<br>".$texto);

	print_r("<br><hr>");
	$varTexto = "Vamos que falta menos";
	print_r($varTexto);
	$texto = darVueltaTexto($varTexto);
	print_r("<br>".$texto);

	print_r("<br><hr>");
	$varEn = base64_encode("Hola");
	print_r("<br>".$varEn);
	$varDe = base64_decode($varEn); 
	print_r("<br>".$varDe);



?>