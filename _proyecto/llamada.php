<?php



	echo("Hola LLamada");
	/*
	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_URL => 'http://localhost/_taller_informatica/2140_php_mysql/clase_php/_proyecto/backend/ws_api.php?',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS =>'{
			"accion":"litarTiposCursos",
			"pagina":3
		}',
	CURLOPT_HTTPHEADER => array(
		'Content-Type: application/json'
		),
	));
	$response = curl_exec($curl);
	curl_close($curl);
	*/

	$curl = curl_init();

	$url = "http://localhost/_taller_informatica/2140_php_mysql/clase_php/_proyecto/backend/ws_api.php";
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));	
	$arrayParametros = array("accion"=>"litarTiposCursos","pagina"=>3);
	$jsonParametros = json_encode($arrayParametros);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonParametros);
	
	$response = curl_exec($curl);

	print_r($response);


?>