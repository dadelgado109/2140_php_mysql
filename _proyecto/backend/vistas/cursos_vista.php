
<?php

	require_once("modelos/cursos_modelo.php");
	require_once("modelos/profesores_modelo.php");
	require_once("modelos/tiposCursos_modelo.php");

	$objCurso = new cursos_modelos();
	$objProfesores = new profesores_modelo();
	$objTipoCurso = new tiposCursos_modelo();

	$rutaPagina = "cursos";

	if(isset($_POST["accion"]) && $_POST['accion'] == "ingresar"){
		
		$archivo = $objCurso->subirImagen($_FILES['imagen'], "800","600");
		if($archivo){

			$datos = array();
			$datos['codigo']	= "";
			$datos['nombre'] 	= isset($_POST['txtNombre'])?$_POST['txtNombre']:"";
			$datos['anio']		= isset($_POST['txtAnio'])?$_POST['txtAnio']:"";
			$datos['tipoCurso'] = isset($_POST['selTipoCurso'])?$_POST['selTipoCurso']:"";
			$datos['profesor'] 	= isset($_POST['selProfesor'])?$_POST['selProfesor']:"";
			$datos['imagen'] 	= $archivo;
			$objCurso->constructor($datos);
			$respuesta = $objCurso->ingresar();

		}else{
			$respuesta = array();
			$respuesta['codigo'] = "Error";
			$respuesta['mensaje'] = "Error al subir la imagen";
		}

	}

	if(isset($_POST["accion"]) && $_POST['accion'] == "borrar" && isset($_POST["codigo"]) && $_POST['codigo'] != ""){

		$codigo = $_POST['codigo'];
		$objCurso->cargar($codigo);
		$respuesta = $objCurso->borrar();

	}


	if(isset($_POST["accion"]) && $_POST['accion'] == "editar" ){

		print_r($_FILES);
			

		$datos = array();
		$datos['codigo']	= isset($_POST['hidCodigo'])?$_POST['hidCodigo']:"";		
		$datos['nombre'] 	= isset($_POST['txtNombre'])?$_POST['txtNombre']:"";
		$datos['anio']		= isset($_POST['txtAnio'])?$_POST['txtAnio']:"";
		$datos['tipoCurso'] = isset($_POST['selTipoCurso'])?$_POST['selTipoCurso']:"";
		$datos['profesor'] 	= isset($_POST['selProfesor'])?$_POST['selProfesor']:"";


		$archivo = $objCurso->subirImagen($_FILES['imagen'], "800","600");
		if($archivo){
			
			$datos['imagen'] 	= $archivo;
			
		}else{

			$datos['imagen'] 	= "";

		}
		$objCurso->constructor($datos);
		$respuesta = $objCurso->editar();

	}	



	$buscar = isset($_POST['buscador'])?$_POST['buscador']:"";
	if($buscar == "" && isset($_GET['buscador']) && $_GET['buscador'] != ""){
		$buscar = $_GET['buscador'];
	}

	$arrayFiltros = array("buscar"=>$buscar);

	$totalMaximo = $objCurso->totalPaginas($arrayFiltros);
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
	$listaCursos = $objCurso->listar($arrayFiltros);

	$listaProfesores = $objProfesores->listaSelect();
	$listaTipoCurso = $objTipoCurso->listaSelect();
?>

<h1>Cursos</h1>

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


<div>
	<a class="waves-effect waves-light btn modal-trigger indigo darken-1" href="#modal1">
		<i class="material-icons left">group_add</i>Ingresar
	</a>
</div>
	  <!-- El modal de ingreso -->
<div id="modal1" class="modal modal-fixed-footer">
	<div class="modal-content">
		<h4>Modal Header</h4>
		<div class="row">
		<form action="index.php?r=<?=$rutaPagina?>" enctype="multipart/form-data" method="POST" class="container col s10">
			<div class="row">
				<div class="input-field col s6">
					<input placeholder="Codigo" id="codigo" type="text" class="validate" value="" disabled>					
					<label for="codigo">Codigo</label>
				</div>
				<div class="input-field col s6">
					<input placeholder="Nombre" id="nombre" type="text" class="validate" name="txtNombre" value="">
					<label for="nombre">Nombre</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s4">
					<input placeholder="A&#241;o" id="anio" type="text" class="validate" name="txtAnio" value="">
					<label for="anio">A&#241;o</label>
				</div>
				<div class="input-field col s4">
					<select name="selTipoCurso">
						<option value="" disabled selected>Elija un Tipo Curso</option>
<?php
						foreach($listaTipoCurso AS $tipoCurso){
?>
						<option value="<?=$tipoCurso['id']?>"><?=$tipoCurso['nombre']?></option>
<?PHP
						}
?>

					</select>		
					<label for="tipoCurso">Tipo Curso</label>
				</div>
				<div class="input-field col s4">
					<select name="selProfesor">
						<option value="" disabled selected>Elija un profesor</option>
<?php
						foreach($listaProfesores AS $profesor){
?>
						<option value="<?=$profesor['documento']?>" ?>><?=$profesor['nombreCompleto']?></option>
<?PHP
						}
?>

					</select>
					<label for="profesor">Pofesor</label>
				</div>
				
			</div>
			<div class="file-field input-field">
				<div class="btn">
					<span>Imagen</span>
					<input type="file" name="imagen" multiple>
				</div>
				<div class="file-path-wrapper">
					<input class="file-path validate" type="text" placeholder="Subir un archivo">
				</div>
		    </div>			
			<button class="btn waves-effect waves-light" type="submit" name="accion" value="ingresar">Ingresar
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
	if(isset($_GET['accion']) && $_GET['accion'] == "editar" && isset($_GET['curso']) && $_GET['curso'] != ""  ){
		$objCurso->cargar($_GET['curso']);

?>
	<div class="grey lighten-3 center-align">	
		<h3>Editar Curso</h3>
		<form action="index.php?r=<?=$rutaPagina?>" enctype="multipart/form-data" method="POST" class="container col s10">
			<div class="row">
				<div class="input-field col s6">
					<input placeholder="Codigo" id="codigo" type="text" class="validate" value="<?=$objCurso->obtenerCodigo()?>" disabled>
					<input type="hidden" name="hidCodigo" value="<?=$objCurso->obtenerCodigo()?>">
					<label for="codigo">Codigo</label>
				</div>
				<div class="input-field col s6">
					<input placeholder="Nombre" id="nombre" type="text" class="validate" name="txtNombre" value="<?=$objCurso->obtenerNombre()?>">
					<label for="nombre">Nombre</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s4">
					<input placeholder="A&#241;o" id="anio" type="text" class="validate" name="txtAnio" value="<?=$objCurso->obtenerAnio()?>">
					<label for="anio">A&#241;o</label>
				</div>
				<div class="input-field col s4">
					<select name="selTipoCurso">
						<option value="" disabled selected>Elija un Tipo Curso</option>
<?php
						foreach($listaTipoCurso AS $tipoCurso){
?>
						<option value="<?=$tipoCurso['id']?>" <?php if($tipoCurso['id'] == $objCurso->obtenerTipoCurso()){ echo("selected");} ?> ><?=$tipoCurso['nombre']?></option>
<?PHP
						}
?>

					</select>		
					<label for="tipoCurso">Tipo Curso</label>
				</div>
				<div class="input-field col s4">
					<select name="selProfesor">
						<option value="" disabled selected>Elija un profesor</option>
<?php
						foreach($listaProfesores AS $profesor){
?>
						<option value="<?=$profesor['documento']?>" <?php if($profesor['documento']== $objCurso->obtenerProfesor()){ echo("selected");} ?>><?=$profesor['nombreCompleto']?></option>
<?PHP
						}
?>

					</select>
					<label for="profesor">Pofesor</label>
				</div>
				<div class="file-field input-field">
					<div class="btn">
						<span>Imagen</span>
						<input type="file" name="imagen" multiple>
					</div>
					<div class="file-path-wrapper">
						<input class="file-path validate" type="text" placeholder="Ingrese un archivo">
					</div>
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
	if(isset($_GET['accion']) && $_GET['accion'] == "borrar" && isset($_GET['curso']) && $_GET['curso'] != ""  ){
?>
	<div class="grey lighten-3 center-align">	
		<form action="index.php?r=<?=$rutaPagina?>" method="POST" class="col s12">
			<h3>Borrar Cursos</h3>
			<h4>Desa borra al Cursos <?=$_GET['curso']?></h4>
			<input type="hidden" name="codigo" value="<?=$_GET['curso']?>">
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
<!-- Page Content goes here -->							
<table class="striped">
	<thead>
		<tr>
			<th class="center">Codigo</th>
			<th class="center">Nombre</th>
			<th class="center">A&#241;o</th>
			<th class="center">Tipo Curso</th>
			<th class="center">Profesor</th>
			<th class="center">Imagnes</th>
			<th class="center" style="width:200px">Botones</th>
		</tr>
	</thead>
	<tbody>
<?php
		foreach($listaCursos AS $cursos){
?>
		<tr>
			<td class="center"><?=$cursos['codigo']?></td>
			<td class="center"><?=$cursos['nombre']?></td>
			<td class="center"><?=$cursos['anio']?></td>
			<td class="center"><?=$cursos['nomTipoCurso']?></td>
			<td class="center"><?=$cursos['nomProfesor']?></td>
			<td class="center">
				<img src="archivos/imagenes/<?=$cursos['imagen']?>" style="width:200px">
			</td>
			<td>
				<div class="right">
					<a href="index.php?r=<?=$rutaPagina?>&accion=editar&curso=<?=$cursos['codigo']?>" class="waves-effect waves-light btn indigo darken-3">
						<i class="material-icons left">edit</i>
					</a>
					<a href="index.php?r=<?=$rutaPagina?>&accion=borrar&curso=<?=$cursos['codigo']?>" class="waves-effect waves-light btn red">
						<i class="material-icons left">delete</i>
					</a>
				<div>
			</td>
		</tr>
<?php
		}
?>

		<tr class="indigo">
			<td colspan="8">
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