<?PHP

	require_once("modelos/alumnos_modelo.php");
	$rutaPagina = "alumnos";


	$objAlumnos = new alumnos_modelo();

	$respuesta = array();
	if(isset($_POST["accion"]) && $_POST['accion'] == "ingresar" ){

		$datos = array();
		$datos['documento'] 		= isset($_POST['txtDocumento'])?$_POST['txtDocumento']:"";		
		$datos['nombre'] 			= isset($_POST['txtNombre'])?$_POST['txtNombre']:"";
		$datos['apellido']			= isset($_POST['txtApellido'])?$_POST['txtApellido']:"";
		$datos['tipoDocumento'] 	= isset($_POST['txtTipoDocumento'])?$_POST['txtTipoDocumento']:"";
		$datos['fechaNacimiento'] 	= isset($_POST['txtFechaNacimiento'])?$_POST['txtFechaNacimiento']:"";

		$objAlumnos->constructor($datos);
		$respuesta = $objAlumnos->ingresar();


	}	

	if(isset($_POST["accion"]) && $_POST['accion'] == "borrar" && isset($_POST["documento"]) && $_POST['documento'] != ""){

		$documento = $_POST['documento'];
		$objAlumnos->cargar($documento);
		$respuesta = $objAlumnos->borrar();

	}


	// 
	$totalMaximo = $objAlumnos->totalPaginas();
	if(isset($_GET['pagina']) && $_GET['pagina'] != ""){
		// Validados que la pagina siempre sea un numero
		$pagina = (int)$_GET['pagina'];
		
		if($pagina < 1){
			$pagina = 1;
		}elseif($pagina > $totalMaximo){
			$pagina = $totalMaximo;
		}elseif(!is_int($pagina)){
			$pagina = 1;
		}
		$paginaAnterior = $pagina - 1;
		if($paginaAnterior < 1){
			$paginaAnterior = 1;
		}
		$paginaSiguente = $pagina + 1;
		if($paginaSiguente > $totalMaximo){
			$paginaSiguente = $totalMaximo;
		}

	}else{
		$pagina  		= 1;
		$paginaAnterior = 1;
		$paginaSiguente = 2;
	}



	$arrayFiltros = array("pagina"=>$pagina-1);
	$listaAlumnos = $objAlumnos->listar($arrayFiltros);
	$listaPasaporte = $objAlumnos->listaTipoDocumento(); 
?>
<h1>Alumnos</h1>
<div>
	<a class="waves-effect waves-light btn modal-trigger indigo darken-1" href="#modal1">
		<i class="material-icons left">group_add</i>Ingresar
	</a>
</div>
	  <!-- El modal de ingreso -->
<div id="modal1" class="modal modal-fixed-footer">
	<div class="modal-content">
		<h4>Ingresar Alumno</h4>
		<div class="row">
			<form action="index.php?r=<?=$rutaPagina?>" method="POST" class="col s12">
				<div class="row">
					<div class="input-field col s12">
						<input placeholder="Documento" id="documento" type="text" class="validate" name="txtDocumento">
						<label for="documento">Documento</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s6">
						<input placeholder="Nombre" id="nombre" type="text" class="validate" name="txtNombre">
						<label for="nombre">Nombre</label>
					</div>
					<div class="input-field col s6">
						<input placeholder="Apellido" id="apellido" type="text" class="validate" name="txtApellido">
						<label for="apellido">Apellido</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s6">
						<input placeholder="Fecha Nacimiento" id="fechaNacimiento" type="date" class="validate" name="txtFechaNacimiento">
						<label for="fechaNacimiento">Fecha Nacimiento</label>
					</div>
					<div class="input-field col s6">
						<select name="txtTipoDocumento">
							<option value="">Seleccioens una opcion</option>
<?php 				foreach($listaPasaporte as $clave => $valor){

?>
						<option value="<?=$clave?>"><?=$valor?></option>
<?PHP
					}
?>


						</select>
						<label for="apellido">Tipo Documento</label>
					</div>
				</div>			
				<button class="btn waves-effect waves-light" type="submit" name="accion" value="ingresar">Enviar
					<i class="material-icons right">send</i>
				</button>
			</form>
		</div>
	</div>
	<div class="modal-footer">
   		<a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>
	</div>
</div>


<!-- Page Content goes here -->		


<?PHP 
	if(isset($respuesta['codigo']) && $respuesta['codigo'] == "Error"  ){
?>
	<div class="red center-align">	
		<h3><?=$respuesta['mensaje']?></h3>
	</div>
<?PHP
	}
?>
<?PHP 
	if(isset($respuesta['codigo']) && $respuesta['codigo'] == "OK"  ){
?>
	<div class="green center-align">	
		<h3><?=$respuesta['mensaje']?></h3>
	</div>
<?PHP
	}
?>


<?PHP 
	if(isset($_GET['accion']) && $_GET['accion'] == "editar" && isset($_GET['alumno']) && $_GET['alumno'] != ""  ){
		$objAlumnos->cargar($_GET['alumno']);

?>
	<div class="grey lighten-3 center-align">	
		<h3>Editar Alumno</h3>
		<form action="index.php?r=<?=$rutaPagina?>" method="POST" class="container col s10">
			<div class="row">
				<div class="input-field col s12">
					<input placeholder="Documento" id="documento" type="text" class="validate" name="txtDocumento" value="<?=$objAlumnos->obtenerDocumento()?>">
					<label for="documento">Documento</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s6">
					<input placeholder="Nombre" id="nombre" type="text" class="validate" name="txtNombre" value="<?=$objAlumnos->obtenerNombre()?>">
					<label for="nombre">Nombre</label>
				</div>
				<div class="input-field col s6">
					<input placeholder="Apellido" id="apellido" type="text" class="validate" name="txtApellido" value="<?=$objAlumnos->obtenerApellido()?>">
					<label for="apellido">Apellido</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s6">
					<input placeholder="Fecha Nacimiento" id="fechaNacimiento" type="date" class="validate" name="txtFechaNacimiento" value="<?=$objAlumnos->obtenerFechaNacimiento()?>">
					<label for="fechaNacimiento">Fecha Nacimiento</label>
				</div>
				<div class="input-field col s6">
					<select name="txtTipoDocumento">
						<option value="">Seleccioens una opcion</option>
<?php 				foreach($listaPasaporte as $clave => $valor){

?>
					<option value="<?=$clave?>"><?=$valor?></option>
<?PHP
				}
?>


					</select>
					<label for="apellido">Tipo Documento</label>
				</div>
			</div>			
			<button class="btn waves-effect waves-light" type="submit" name="accion" value="ingresar">Enviar
				<i class="material-icons right">send</i>
			</button>
		</form>
	
	</div>
<?php
	}
?>

<?PHP 
	if(isset($_GET['accion']) && $_GET['accion'] == "borrar" && isset($_GET['alumno']) && $_GET['alumno'] != ""  ){
?>
	<div class="grey lighten-3 center-align">	
		<form action="index.php?r=<?=$rutaPagina?>" method="POST" class="col s12">
			<h3>Borrar Alumno</h3>
			<h4>Desa borra al alumno <?=$_GET['alumno']?></h4>
			<input type="hidden" name="documento" value="<?=$_GET['alumno']?>">
			<button class="btn waves-effect waves-light red" type="submit" name="accion" value="borrar">Eliminar
				<i class="material-icons right">deleted</i>
			</button>
			<button class="btn waves-effect waves-light blue" type="submit" name="accion" value="cancelar">Cancelar
				<i class="material-icons right">cancel</i>
			</button>		
		</form>
	</div>
<?php
	}
?>

<table class="striped">
	<thead>
		<tr>
			<th class="center">Documento</th>
			<th class="center">Nombre</th>
			<th class="center">Apellido</th>
			<th class="center">Fecha Nacimiento</th>
			<th class="center">Tipo Documento</th>
			<th class="center" style="width:200px">Botones</th>
		</tr>
	</thead>
	<tbody>
<?php
		foreach($listaAlumnos AS $alumno){

?>
		<tr>
			<td class="center"><?=$alumno['documento']?></td>
			<td class="center"><?=$alumno['nombre']?></td>
			<td class="center"><?=$alumno['apellido']?></td>
			<td class="center"><?=$alumno['fechaNacimiento']?></td>
			<td class="center"><?=$alumno['tipoDocumento']?></td>
			<td>
				<div class="right">
					<a href="index.php?r=<?=$rutaPagina?>&accion=editar&alumno=<?=$alumno['documento']?>" class="waves-effect waves-light btn indigo darken-3">
						<i class="material-icons left">edit</i>
					</a>
					<a href="index.php?r=<?=$rutaPagina?>&accion=borrar&alumno=<?=$alumno['documento']?>" class="waves-effect waves-light btn red">
						<i class="material-icons left">delete</i>
					</a>
				<div>
			</td>
		</tr>
<?php
	}
?>

		<tr class="indigo">
			<td colspan="6">
				<ul class="pagination center">
					<li class="waves-effect">
						<a href="index.php?r=<?=$rutaPagina?>&pagina=1" class="yellow-text">
							<i class="material-icons">arrow_back</i>
						</a>
					</li>
					<li class="waves-effect">
						<a href="index.php?r=<?=$rutaPagina?>&pagina=<?=$paginaAnterior?>" class="yellow-text">
							<i class="material-icons">chevron_left</i>
						</a>
					</li>
					
<?php
					for($i = 1; $i <= $totalMaximo; $i++){
						$class = "waves-effect";
						$classText = "white-text";
						if($i == $pagina){
							$class = "active";
							$classText = "red-text";
						}
?>
					<li class="<?=$class?>" >
						<a href="index.php?r=<?=$rutaPagina?>&pagina=<?=$i?>" class="<?=$classText?>"><?=$i?></a>
					</li>

<?PHP
					}
?>
					<li class="waves-effect" >
						<a href="index.php?r=<?=$rutaPagina?>&pagina=<?=$paginaSiguente?>" class="yellow-text">
							<i class="material-icons">chevron_right</i>
						</a>
					</li>
					<li class="waves-effect">
						<a href="index.php?r=<?=$rutaPagina?>&pagina=<?=$totalMaximo?>" class="yellow-text">
							<i class="material-icons">arrow_forward</i>
						</a>
					</li>
				</ul>
			</td>
		</tr>
	</tbody>
</table>