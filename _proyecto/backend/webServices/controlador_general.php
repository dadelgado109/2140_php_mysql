<?php


	require_once("webServices/controlador_alumnos.php");
	require_once("webServices/controlador_tipos_cursos.php");

	$recibeJson = file_get_contents('php://input');
	$recibe = json_decode($recibeJson, true);


	//print_r($recibe);
	$respuetas = array("Error" => "noAccion", "mensaje"=>"No se envio una accion correcta" );
	if(isset($recibe['accion'])){

		if($recibe['accion'] == "litarAlumnos"){
		
			$respuetas = controlador_alumnos::listarAlumnos($recibe);
			//print_r($respuetas);

		}  
		if($recibe['accion'] == "litarTiposCursos"){
		
			$respuetas = controlador_tipos_cursos::listarTiposCursos($recibe);
			//print_r($respuetas);

		}  
		if($recibe['accion'] == "ingresarTiposCursos"){
		
			$respuetas = controlador_tipos_cursos::ingresarTiposCursos($recibe);
			//print_r($respuetas);

		}  

	}

	$jsonRespuesta = json_encode($respuetas);
	print_r($jsonRespuesta);



	/*
	if(isset($_GET['nombre']) && isset($_GET['apellido'])){

		print_r($_GET);

	}
	if(isset($_POST['nombre'])){

		print_r($_POST);

	}
	echo("HOLA Test");
	*/
	




?>
