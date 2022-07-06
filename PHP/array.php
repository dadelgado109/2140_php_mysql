<?php


	echo("Soy Array <br>");


	$arrayColoresUno = array("Verde","Naranja","Rojo","Violeta");
	print_r($arrayColoresUno);
	echo("<br>");

	$arrayColoresUno[] = "Amarillo";
	$arrayColoresUno[] = "Marron";
	$arrayColoresUno[6] = "Azul";
	$arrayColoresUno[] = "Rosado";
	$arrayColoresUno[10] = "Gris";
	$arrayColoresUno[] = "Negro";
	$arrayColoresUno[8] = "Turquesa";
	$arrayColoresUno[] = "Cian";
	print_r($arrayColoresUno);

	echo("<br>");
	echo("<hr>");
	
	$arrayColoresDos = array("Amarrilo"=>"#f3fa7f","Rojo"=>"#d3221a","Verde"=>"#18e22d"); 
	print_r($arrayColoresDos);
	$arrayColoresDos['Azul'] = "#0b2383";
	$arrayColoresDos[] = "#a9abb3";
	$arrayColoresDos[] = "#6e4f67";
	$arrayColoresDos['Blanco'] = "#ffffff";
	$arrayColoresDos['Negro'] = "#bb1c97";	
	$arrayColoresDos['Negro'] = "#020001";
	echo("<br>");
	print_r($arrayColoresDos);

	echo("<br>");
	var_dump($arrayColoresDos);
	echo("<br>");
	print_r($arrayColoresDos['Blanco']);	
	if($arrayColoresDos['Negro'] == "#ffffff"){
		echo("Soy el blanco");
	}


	foreach($arrayColoresDos as $valor){

		echo("<br>");
		print_r("Color Hex:".$valor);
		if($valor == "#ffffff"){
			echo("-Soy el blanco");
		}

	}
	echo("<br>");
	echo("<hr>");

	foreach($arrayColoresDos as $clave => $valor){

		echo("<br>");
		print_r("Color:".$clave." Hex:".$valor);
		if($valor == "#ffffff"){
			echo("-Soy el blanco");
		}
	}

// ---------------------------------------------------- \\
// ---------------------------------------------------- \\
// ---------------------------------------------------- \\

	echo("<br>");
	echo("<hr>");


	$arrayDesordenado = array(5,7,2,1,9,3);
	$arrayOrdenados = array();
	$numeroMenor = 0;
	$posicionNumero = 0;

	print_r($arrayDesordenado);
	$totaArray = count($arrayDesordenado);

	for($k=0; $k<$totaArray; $k++){
		for($i=0; $i<$totaArray; $i++){
			print_r("<br>".$arrayDesordenado[$i]);
			if($arrayDesordenado[$i] != null && 
					($arrayDesordenado[$i] < $numeroMenor || $numeroMenor == 0)){
				$numeroMenor = $arrayDesordenado[$i];
				$posicionNumero = $i;
			}
		}
		$arrayOrdenados[] = $numeroMenor;
		$arrayDesordenado[$posicionNumero] = null;
		print_r("<br> Numero menor Obtenido:".$numeroMenor);
		$numeroMenor = 0;
	}

	echo("<br>Mi array Ordenado:");
	print_r($arrayOrdenados);

	echo("<br>");
	echo("<hr>");

// ----------------------------------------------------------------- \\
// ----------------------------------------------------------------- \\
// ----------------------------------------------------------------- \\

	$strTexto = "Soy el texto";
	$arrayTexto = str_split($strTexto);
	$arrayTextoInverso = array();
	$arrayTextoFinal = array();
	$i = 0;

	print_r($strTexto);
	print_r($arrayTexto);

	foreach($arrayTexto as $letra){
		$final = count($arrayTexto) - $i;
		$arrayTextoInverso[$final] = $letra;
		$i++;
	}
	echo("<br> Inverso:");
	print_r($arrayTextoInverso);
	for($k = 0; $k <= count($arrayTextoInverso); $k++){
		$final = $k;
		if(isset($arrayTextoInverso[$final])){
			$arrayTextoFinal[$k] = $arrayTextoInverso[$final];
		}
	}
	echo("<br> Final:");
	print_r($arrayTextoFinal);
	$textoFinal = implode("",$arrayTextoFinal);
	print_r($textoFinal);


// ----------------------------------------------------------------- \\
// ----------------------------------------------------------------- \\
// ----------------------------------------------------------------- \\

?>