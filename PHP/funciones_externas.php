<?php

    
    
	function darVueltaTexto($varCoding){

		$strTexto = base64_encode($varCoding);

		$arrayTexto = str_split($strTexto);
		$arrayTextoInverso = array();
		$arrayTextoFinal = array();
		$i = 0;
		// Primer for para ordenar las letras por clave decendiente
		foreach($arrayTexto as $letra){
			$final = count($arrayTexto) - $i;
			$arrayTextoInverso[$final] = $letra;
			$i++;
		}
		// Ordemanos en un nuevo array en forma acendente
		for($k = 0; $k <= count($arrayTextoInverso); $k++){
			$final = $k;
			if(isset($arrayTextoInverso[$final])){
				$arrayTextoFinal[$k] = $arrayTextoInverso[$final];
			}
		}
		$textoFinal = implode("",$arrayTextoFinal);
		return $textoFinal;
	}





?>