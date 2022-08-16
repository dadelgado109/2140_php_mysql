<?php


		if(isset($_POST['accion']) && $_POST['accion'] == "salir"){

			@session_start();
			unset($_SESSION['docAlumno']);
			unset($_SESSION['nomAlumno']);
			session_destroy();

		}

		header("Location:index.php");



?>