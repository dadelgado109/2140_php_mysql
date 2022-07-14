<?php
	//echo("Estoy iniciando mi proyecto");
	//phpinfo();
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
					<li>	
						<a href="index.php?r=cursos" class="tooltipped" data-position="bottom" data-tooltip="Cursos">
							<i class="material-icons">code</i>
						</a>
					</li>
					<li>
						<a href="index.php?r=profesores" class="tooltipped" data-position="bottom" data-tooltip="Profesores">
							<i class="material-icons">person</i>
						</a>
					</li>
					<li>
						<a href="index.php?r=tcursos" class="tooltipped" data-position="bottom" data-tooltip="Tipos Cursos">
							<i class="material-icons">share</i>
						</a>
					</li>
					<li>
						<a href="index.php?r=alumnos" class="tooltipped" data-position="bottom" data-tooltip="Alumnos">
							<i class="material-icons">person_pin</i>
						</a>
					</li>
					<li>
						<a href="index.php">
							<i class="material-icons">menu</i>
						</a>
					</li>
				</ul>
			</div>
		</nav>

		<main>
			<div class="container">
				<?php include("router.php"); ?>
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
			});
		</script>
	</body>
</html>
    