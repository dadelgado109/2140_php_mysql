<?php

	require_once("PHP/modelos/cursos_modelo.php");
	require_once("PHP/modelos/alumnos_modelo.php");
	require_once("PHP/modelos/alumnosCursos_modelo.php");


	@session_start();

	$objUsuario = new alumnos_modelo();
	if( (isset($_POST['txtDocumento']) && $_POST['txtDocumento'] != "") && (isset($_POST['txtClave']) && $_POST['txtClave'] != "") ){

		print("Login");	
		$documento 	= $_POST['txtDocumento'];
		$clave 		= $_POST['txtClave'];

		$respuesta = $objUsuario->login($documento, $clave );

		if($respuesta){	
			print("Login");		
			$_SESSION['docAlumno'] = $objUsuario->obtenerDocumento();
			$_SESSION['nomAlumno'] = $objUsuario->obtenerNombre()." ".$objUsuario->obtenerApellido();
		}

	}

	$nombreLogin = "";
	if(isset($_SESSION['nomAlumno']) && $_SESSION['nomAlumno'] != ""){
		$nombreLogin = $_SESSION['nomAlumno'];

		
		if((isset($_POST['accion']) && $_POST['accion'] == "anotarme") && (isset($_POST['codCurso']) && $_POST['codCurso'] != "")){
			
			$curso = $_POST['codCurso'];
			$alumno = $_SESSION['docAlumno'];

			$objAlumCurso = new alumnosCursos_modelo();
			$objAlumCurso->constructor("", $curso, $alumno);
			$respuesta = $objAlumCurso->ingresar();
			print_r($respuesta);

		}
	}





	$objCursos = new cursos_modelo();
	$listaCursos = $objCursos->listar();


	


?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<title>Parallax Template - Materialize</title>

	<!-- CSS  -->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
	<link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>

	<style>

		.borderContainer{
			border-left: #5e88ff 5px solid; 
			border-right: #5e88ff 5px solid
		}
		.imgCurso {
			/* cambia estos dos valores para definir el tamaño de tu círculo */
			height: 300px;
			width: 100%;
			/* los siguientes valores son independientes del tamaño del círculo */
			background-repeat: no-repeat;
			background-position: 50%;
			border-radius: 50%;
		    background-size: 100% auto;
		}
	</style>

</head>
<body>
	<nav class="white" role="navigation">
		<div class="nav-wrapper container">
			<a id="logo-container" href="#" class="brand-logo">Logo</a>
			<ul class="right hide-on-med-and-down">
				<li>
					<a href="#">
						<?= $nombreLogin ?>
					</a>
				</li>
				<li><a href="#">Navbar Link</a>

				</li>
<?php
			if($nombreLogin == ""){
?>
				<li>
					<a class="waves-effect waves-light btn modal-trigger" href="#modal1">Login</a>
				</li>
<?php
			}else{
?>
				<li>
					<a class="waves-effect waves-light btn modal-trigger" href="#modal2">Logout</a>
				</li>
<?php
			}
?>
			</ul>

	  <ul id="nav-mobile" class="sidenav">
		<li><a href="#">Navbar Link</a></li>
	  </ul>
	  	<a href="#" data-target="nav-mobile" class="sidenav-trigger">
			<i class="material-icons">menu</i>
		</a>
	</div>
  </nav>
 <!-- Modal Structure -->
	<div id="modal1" class="modal">
		<div class="modal-content">
			<h4>Ingresar Usuario</h4>
			<div class="container">
				<form action="index.php?" method="POST" class="col s12">
					<div class="row">
						<div class="input-field col s12">
							<input placeholder="Documento" id="documento" type="text" class="validate" name="txtDocumento">
							<label for="documento">Documento</label>
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
		</div>
	</div>
	<div id="modal2" class="modal">
		<div class="modal-content">
			<h4>Usted desea salir?</h4>
			<div class="container">
				<form action="logout.php?" method="POST" class="col s12">
					<button class="btn waves-effect waves-light yellow" type="submit" name="accion" value="salir">Salir
						<i class="material-icons right">send</i>
					</button>
					<button class="btn waves-effect waves-light " name="accion" value="nada">Cancelar
						<i class="material-icons right">send</i>
					</button>
				</form>
			</div>
		</div>
	</div>

	<div id="index-banner" class="parallax-container">
		<div class="section no-pad-bot">
			
			<div class="container">
				<!-- 
				<br><br>
				<h1 class="header center teal-text text-lighten-2">Parallax Template</h1>
				<div class="row center">
					<h5 class="header col s12 light">A modern responsive front-end framework based on Material Design</h5>
				
				</div>
				<div class="row center">
					<a href="http://materializecss.com/getting-started.html" id="download-button" class="btn-large waves-effect waves-light teal lighten-1">Get Started</a>
				</div>
				-->
			<br><br>
			</div>
		</div>
		<div class="parallax">
			<img src="imagenes/codigo_parallax_superior.jpg" alt="Unsplashed background img 1">
		</div>
	</div>


	<div class="container">
		<div class="section borderContainer">
			<!--   Icon Section   -->
			<div class="row">
<?php

			foreach($listaCursos as $cursos){;
?>

				<div class="col s12 m4">
					<div class="card">
						<div class="waves-effect waves-block waves-light">
							<img class="imgCurso" src="http://localhost/_taller_informatica/2140_php_mysql/clase_php/_proyecto/backend/archivos/imagenes/<?=$cursos['imagen']?>">
						</div>
						<div class="card-content">
							<span class="card-title activator grey-text text-darken-4"><?=$cursos['nombre']?>
								<i class="material-icons right">more_vert</i>
							</span>
							<p><a href="#">This is a link</a></p>
						</div>
						<div class="card-reveal">
							<span class="card-title grey-text text-darken-4"><i class="material-icons right">close</i></span>
							<p>
								<h3><?=$cursos['nombre']?></h3>
								<h5>* Categoria: <?= $cursos['nomTipoCurso']?></h5>
								<h5>* Profesor: <?= $cursos['nomProfesor']?></h5>
								<h5>* Descripcion:</h5>
									<?= $cursos['descripcionTipo']?> 
								<h5>
									<a class="waves-effect waves-light btn modal-trigger" href="#modalIngresar" onclick="confimarCurso('<?=$cursos['nombre']?>','<?=$cursos['codigo']?>')">Anotarme
										<i class="material-icons right">add</i>
									</a>
								</h5>	
							</p>
						</div>
					</div>
				</div>
				<div id="modal_<?= $cursos['codigo']?>" class="modal">
					<div class="modal-content">
					<h4>Confirmar Inscripcion:<?= $cursos['codigo']?></h4>
						<form action="index.php?" method="POST" class="col s12">
							<button class="btn waves-effect waves-light" type="submit" name="accion" value="salir">Aceptar
								<i class="material-icons right">send</i>
							</button>
							<button class="btn waves-effect waves-light " name="accion" value="nada">Salir
								<i class="material-icons right">send</i>
							</button>
						</form>
					</div>
				</div>
<?php
			}
?>
			</div>
		</div>
	</div>

  <!-- Modal Structure -->
	<div id="modalIngresar" class="modal">
		<div class="modal-content">
		<h4>Confirmar Inscripcion:<span id="nomCurso"> </span></h4>
			<form action="index.php?" method="POST" class="col s12">
				<input type="hidden" name="codCurso" id="codCurso" value=""> 
				<button class="btn waves-effect waves-light" type="submit" name="accion" value="anotarme">Aceptar
					<i class="material-icons right">send</i>
				</button>
				<button class="btn waves-effect waves-light " name="accion" value="nada">Salir
					<i class="material-icons right">send</i>
				</button>
			</form>
		</div>
	</div>
          

  <div class="parallax-container valign-wrapper">
	<div class="section no-pad-bot">
	  <div class="container">
		<div class="row center">
		  <h5 class="header col s12 light">A modern responsive front-end framework based on Material Design</h5>
		</div>
	  </div>
	</div>
	<div class="parallax"><img src="imagenes/codigo_parallax_medio.jpg" alt="Unsplashed background img 2"></div>
  </div>

  <div class="container">
	<div class="section">

	  <div class="row">
		<div class="col s12 center">
		  <h3><i class="mdi-content-send brown-text"></i></h3>
		  <h4>Contact Us</h4>
		  <p class="left-align light">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque id nunc nec volutpat. Etiam pellentesque tristique arcu, non consequat magna fermentum ac. Cras ut ultricies eros. Maecenas eros justo, ullamcorper a sapien id, viverra ultrices eros. Morbi sem neque, posuere et pretium eget, bibendum sollicitudin lacus. Aliquam eleifend sollicitudin diam, eu mattis nisl maximus sed. Nulla imperdiet semper molestie. Morbi massa odio, condimentum sed ipsum ac, gravida ultrices erat. Nullam eget dignissim mauris, non tristique erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</p>
		</div>
	  </div>

	</div>
  </div>



  <footer class="page-footer teal">
	<div class="container">
	  <div class="row">
		<div class="col l6 s12">
		  <h5 class="white-text">Company Bio</h5>
		  <p class="grey-text text-lighten-4">We are a team of college students working on this project like it's our full time job. Any amount would help support and continue development on this project and is greatly appreciated.</p>


		</div>
		<div class="col l3 s12">
		  <h5 class="white-text">Settings</h5>
		  <ul>
			<li><a class="white-text" href="#!">Link 1</a></li>
			<li><a class="white-text" href="#!">Link 2</a></li>
			<li><a class="white-text" href="#!">Link 3</a></li>
			<li><a class="white-text" href="#!">Link 4</a></li>
		  </ul>
		</div>
		<div class="col l3 s12">
		  <h5 class="white-text">Connect</h5>
		  <ul>
			<li><a class="white-text" href="#!">Link 1</a></li>
			<li><a class="white-text" href="#!">Link 2</a></li>
			<li><a class="white-text" href="#!">Link 3</a></li>
			<li><a class="white-text" href="#!">Link 4</a></li>
		  </ul>
		</div>
	  </div>
	</div>
	<div class="footer-copyright">
	  <div class="container">
	  Made by <a class="brown-text text-lighten-3" href="http://materializecss.com">Materialize</a>
	  </div>
	</div>
  </footer>


  <!--  Scripts-->
		<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script src="js/materialize.js"></script>
		<script src="js/init.js"></script>
		<script>			
			document.addEventListener('DOMContentLoaded', function() {
				M.AutoInit();
				var elems = document.querySelectorAll('.datepicker');
    			var instances = M.Datepicker.init(elems, options);
			});
		</script>
		<script>	
			
			function confimarCurso(nombre, codigo){

				document.getElementById('nomCurso').innerHTML = nombre;
				document.getElementById('codCurso').value = codigo;

			}

		</script>	
	</body>
</html>
