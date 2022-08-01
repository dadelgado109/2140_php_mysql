<?php

	require_once("modelos/administradores_modelo.php");

	$nombre = isset($_POST['txtNombre'])?$_POST['txtNombre']:"";
	$clave 	= isset($_POST['txtClave'])?$_POST['txtClave']:"";

	if($nombre != "" && $clave != ""){

		$objAdministradores = new administradores_modelo();
		$respuesta = $objAdministradores->login($nombre, $clave);

		echo("Estoy haciendo el login:");
		if($respuesta){
			echo("Login Exitoso");
		}else{
			echo("Error en el login");	
		}

		

	}


?>
<!DOCTYPE html>
<html>
	<head>
		<!--Import Google Icon Font-->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<!--Import materialize.css-->
		<link type="text/css" rel="stylesheet" href="web/css/materialize.min.css"  media="screen,projection"/>
		<!--Let browser know website is optimized for mobile-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

		<style>
			body {
				display: flex;
				min-height: 100vh;
				flex-direction: column;
			}
			main {
				flex: 1 0 auto;
			}
			table.striped > tbody > tr:nth-child(odd) {
				background-color: #c5cae9;
			}
			.pagination li.active {
			  background-color: #bbdefb;
			}

		</style>
	</head>
	<body>
		<!--JavaScript at end of body for optimized loading-->
		<nav>
			<div class="nav-wrapper  indigo">
				<a href="#!" class="brand-logo center"><i class="material-icons">cloud</i><span class="yellow-text text-lighten-1">M</span>i<span class="cyan-text text-accent-1">P</span>anel</a>
				<ul class="right hide-on-med-and-down">
					
				</ul>
			</div>
		</nav>

		<main>
			<div class="container">
				<div class="row">
					<div class="col s3">
					</div>
					<div class="col s6 center-align">
						<div>
							<h3>Login</h3>
						</div>
						<form action="login.php?" method="POST" class="col s12">
							<div class="row">
								<div class="input-field col s12">
									<input placeholder="nombre" id="nombre" type="text" class="validate" name="txtNombre">
									<label for="nombre">Nombre</label>
								</div>
							</div>				
							<div class="row">
								<div class="input-field col s12">
									<input placeholder="Clave" id="clave" type="text" class="validate" name="txtClave">
									<label for="clave">Clave</label>
								</div>
							</div>	
							<button class="btn waves-effect waves-light" type="submit" >Entrar
								<i class="material-icons right">send</i>
							</button>
						</form>
					</div>
					<div class="col s3">
					</div>	
				</div>
			</div>
		</main>
		<footer class="page-footer indigo">
			<div class="footer-copyright">
				<div class="container">
						© 2014 Copyright Text
					<div>
						<a class="grey-text text-lighten-4 right" href="#!">Nosotros</a>
					</div>
					<div>
						&nbsp;
					</div>
					<div>
						<a class="grey-text text-lighten-4 right" href="#!">MiPanel</a>
					</div>
				</div>
			</div>
		</footer>
		<script type="text/javascript" src="web/js/materialize.min.js"></script>
		<script>			
			document.addEventListener('DOMContentLoaded', function() {
				M.AutoInit();
				var elems = document.querySelectorAll('.datepicker');
				var instances = M.Datepicker.init(elems, options);
			});
		</script>
	</body>
</html>
	