<?php

	echo("Soy la conexion a la base de datos");

	// PDO
	// PDO("String conexion",)
	
	$host = "localhost";
	$dbName = "curso_2140";
	$user = "root";
	$password = "";
	$options = [
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_CASE => PDO::CASE_NATURAL,
		PDO::ATTR_ORACLE_NULLS => PDO::NULL_EMPTY_STRING
	];

	$objConexion = new PDO("mysql:localhost=".$host.";dbname=".$dbName."",$user,$password,$options);

	$sql = "SELECT * FROM profesores";

	$preparo = $objConexion->prepare($sql);
	$preparo->execute(array());

	$lista = $preparo->fetchAll();

	print_r($lista);


?>