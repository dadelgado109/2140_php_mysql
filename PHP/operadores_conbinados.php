<?php

	echo("<h1>Operadores Conbinados </h1>");

	$numUno = 4;
	$numDos = 6;
	$numTres = 9;
	$numCuatro = 4;
	$textUno = "4";


	echo("<hr>");
	$resultado = ($numUno == $numDos) || ($numCuatro === $textUno);
	var_dump($resultado);

	echo("<hr>");
	$resultado = ($numTres != $numDos) && ($numCuatro === $numUno);
	var_dump($resultado);




?>