<?php

	$a = 15;
	$b = 15;

	if($a > $b){
		echo("<h1>A es mayor que b </h1>");
	}


	if( ($a > $b) || ($a/2 < 3 ) ){

		echo('<h1> $a es mayor que $b o $a divido entre 2 es mayor a 3 </h1>');

	}

	echo("<hr>");

	if( $a > $b ){

		echo('<h1> $a es mayor a $b</h1>');
		echo("<h1> $a es mayor a $b</h1>");

	}else{

		echo('<h1> $b es mayor a $a</h1>');
		echo("<h1> $b es mayor a $a</h1>");

	}


	if( ($a >= $b) && ($a >= 10) ){

		echo('<h1>$a es mayor a $b y $a es meyor a 10</h1>');

	}else{

		echo('<h1>$a es no es mayor a $b o $a es menor a 10</h1>');

	}


	echo("<hr>");
	$a = 15;
	$b = "a";

	if($a > $b){

		echo('<h1> $a es mayor a $b </h1>');
	
	}elseif($a === $b){

		echo('<h1> $a es identico a $b </h1>');

	}elseif($a == $b){

		echo('<h1> $a es igual a $b </h1>');

	}else{

		echo('<h1> $a es menor $b </h1>');

	}

	echo("<hr>");

	$i = "hola";
	switch($i){
		case 0:
			echo('<h1> $i vale 0 </h1>');
			break;
		case 1:
			echo('<h1> $i vale 1 </h1>');
			break;
		case 2:
			echo('<h1> $i vale 2 </h1>');
			break;			
		case 3:
			echo('<h1> $i vale 3 </h1>');
			break;	
		case "hola":
			echo('<h1> $i vale hola </h1>');
			break;
		default: 
			echo('<h1> $i vale mas que 3 </h1>');
	}


	


?>