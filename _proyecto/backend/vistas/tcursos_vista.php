<?php

	require_once("modelos/tiposCursos_modelo.php");
	$rutaPagina = "tcursos";

	$objTCursos = new tiposCursos_modelo();

	$respuesta = array();
	if(isset($_POST["accion"]) && $_POST['accion'] == "ingresar" ){

		$datos = array();
		$datos['id']			= "";
		$datos['nombre'] 		= isset($_POST['txtNombre'])?$_POST['txtNombre']:"";
		$datos['descripcion']	= isset($_POST['txtDescripcion'])?$_POST['txtDescripcion']:"";

		$objTCursos->constructor($datos);
		$respuesta = $objTCursos->ingresar();

	}	

	if(isset($_POST["accion"]) && $_POST['accion'] == "editar" ){

		$datos = array();
		$datos['id'] 			= isset($_POST['txtId'])?$_POST['txtId']:"";		
		$datos['nombre'] 		= isset($_POST['txtNombre'])?$_POST['txtNombre']:"";
		$datos['descripcion']	= isset($_POST['txtDescripcion'])?$_POST['txtDescripcion']:"";
		
		$objTCursos->constructor($datos);
		$respuesta = $objTCursos->editar();

	}	


	if(isset($_POST["accion"]) && $_POST['accion'] == "borrar" && isset($_POST["id"]) && $_POST['id'] != ""){

		$id = $_POST['id'];
		$objTCursos->cargar($id);
		$respuesta = $objTCursos->borrar();

	}
	

	// 
	$buscar = isset($_POST['buscador'])?$_POST['buscador']:"";
	if($buscar == "" && isset($_GET['buscador']) && $_GET['buscador'] != ""){
		$buscar = $_GET['buscador'];
	}

	$arrayFiltros = array("buscar"=>$buscar);

	$totalMaximo = $objTCursos->totalPaginas($arrayFiltros);
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

	
	$arrayFiltros['pagina'] = $pagina - 1;
	$listaTCuros = $objTCursos->listar($arrayFiltros);

	

?>

<h1>Tipós Cursos</h1>

	  <!-- El modal de ingreso -->
<div id="modal1" class="modal modal-fixed-footer">
	<div class="modal-content">
		<h4>Ingresar Tipo Curso</h4>
		<div class="row">
			<form action="index.php?r=<?=$rutaPagina?>" method="POST" class="col s12">
				<div class="row">
					<div class="input-field col s12">
						<input id="nombre" type="text" class="validate" name="txtNombre">
						<label for="nombre">Nombre</label>
					</div>
				</div>	
				<div class="row">
					<div class="input-field col s12">
						<textarea id="descripcion" class="materialize-textarea" name="txtDescripcion"></textarea>
						<label for="descripcion">Descripcion</label>
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
	if(isset($_GET['accion']) && $_GET['accion'] == "editar" && isset($_GET['i']) && $_GET['i'] != ""  ){
		$objTCursos->cargar($_GET['i']);

?>
	<div class="grey lighten-3 center-align">	
		<h3>Editar Alumno</h3>
		<form action="index.php?r=<?=$rutaPagina?>" method="POST" class="container col s10">
			<div class="row">
				<div class="input-field col s12">
					<input placeholder="id" id="id" type="text" class="validate" value="<?=$objTCursos->obtenerID()?>" disabled>
					<input type="hidden" name="txtId" value="<?=$objTCursos->obtenerID()?>">
					<label for="id">id</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input id="nombre" type="text" class="validate" name="txtNombre" value="<?=$objTCursos->obtenerNombre()?>">
					<label for="nombre">Nombre</label>
				</div>
			</div>	
			<div class="row">
				<div class="input-field col s12">
					<textarea id="descripcion" class="materialize-textarea" name="txtDescripcion"><?=$objTCursos->obtenerDescripcion()?></textarea>
					<label for="descripcion">Descripcion</label>
				</div>
			</div>	
			<button class="btn waves-effect waves-light" type="submit" name="accion" value="editar">Enviar
				<i class="material-icons right">send</i>
			</button>
		</form>
	
	</div>
<?php
	}
?>


<?PHP 
	if(isset($_GET['accion']) && $_GET['accion'] == "borrar" && isset($_GET['i']) && $_GET['i'] != ""  ){
?>
	<div class="grey lighten-3 center-align">	
		<form action="index.php?r=<?=$rutaPagina?>" method="POST" class="col s12">
			<h3>Borrar el Tipo Curso</h3>
			<h4>Desa borra el Tipo Curso <?=$_GET['i']?></h4>
			<input type="hidden" name="id" value="<?=$_GET['i']?>">
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
			<th class="" colspan=3>
				<div class="left">
					<a class="waves-effect waves-light btn modal-trigger indigo darken-1" href="#modal1">
						<i class="material-icons left">group_add</i>Ingresar
					</a>
				</div>
				<div class="right">
					<a class="waves-effect waves-light btn modal-trigger indigo darken-1" href="index.php?r=<?=$rutaPagina?>">
						<i class="material-icons left">restore</i>Reset
					</a>
				</div>
			</th>
			<th class="center" colspan=2>
				<nav>
					<div class="nav-wrapper indigo">
						<form action="index.php?r=<?=$rutaPagina?>" method="POST" >
							<div class="input-field">
								<input id="search" type="search" name="buscador" required>
								<label class="label-icon" for="search">
									<i class="material-icons">search</i>
								</label>
								<i class="material-icons">close</i>
							</div>
						</form>
				    </div>
				</nav>
			</th>
		</tr>
		<tr>
			<th class="center">id</th>
			<th class="center">Nombre</th>
			<th class="center">Descripcion</th>
			<th class="center" style="width:200px">Botones</th>
		</tr>
	</thead>
	<tbody>
<?php
		foreach($listaTCuros AS $tCuros){

?>
		<tr>
			<td class="center"><?=$tCuros['id']?></td>
			<td class="center"><?=$tCuros['nombre']?></td>
			<td class="center"><?=$tCuros['descripcion']?></td>
			<td>
				<div class="right">
					<a href="index.php?r=<?=$rutaPagina?>&accion=editar&i=<?=$tCuros['id']?>" class="waves-effect waves-light btn indigo darken-3">
						<i class="material-icons left">edit</i>
					</a>
					<a href="index.php?r=<?=$rutaPagina?>&accion=borrar&i=<?=$tCuros['id']?>" class="waves-effect waves-light btn red">
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
						<a href="index.php?r=<?=$rutaPagina?>&pagina=1&buscador=<?=$buscar?>" class="yellow-text">
							<i class="material-icons">arrow_back</i>
						</a>
					</li>
					<li class="waves-effect">
						<a href="index.php?r=<?=$rutaPagina?>&pagina=<?=$paginaAnterior?>&buscador=<?=$buscar?>" class="yellow-text">
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
						<a href="index.php?r=<?=$rutaPagina?>&pagina=<?=$i?>&buscador=<?=$buscar?>" class="<?=$classText?>"><?=$i?></a>
					</li>

<?PHP
					}
?>
					<li class="waves-effect" >
						<a href="index.php?r=<?=$rutaPagina?>&pagina=<?=$paginaSiguente?>&buscador=<?=$buscar?>" class="yellow-text">
							<i class="material-icons">chevron_right</i>
						</a>
					</li>
					<li class="waves-effect">
						<a href="index.php?r=<?=$rutaPagina?>&pagina=<?=$totalMaximo?>&buscador=<?=$buscar?>" class="yellow-text">
							<i class="material-icons">arrow_forward</i>
						</a>
					</li>
				</ul>
			</td>
		</tr>
	</tbody>
</table>


