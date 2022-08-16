
<?php

class generico_modelo{


    public function traerListado($sql, $arrayData = array()){
		/*
			$sql = Es la consulta contra la base de datos
			$arrayDatos = son los datos que van por parametro en la consulta
		*/
		include("configuracion/configuracion.php");

		$host 		= $BDMYSQL['host'];
		$dbName 	= $BDMYSQL['dbName'];
		$user 		= $BDMYSQL['user'];
		$password 	= $BDMYSQL['password'];
		$options = [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_CASE => PDO::CASE_NATURAL,
			PDO::ATTR_ORACLE_NULLS => PDO::NULL_EMPTY_STRING
		];

		$objConexion = new PDO("mysql:localhost=".$host.";dbname=".$dbName."",$user,$password,$options);

		$preparo = $objConexion->prepare($sql);
		$preparo->execute($arrayData);
		$lista = $preparo->fetchAll();

		return $lista;

	} 

	public function ejecutarConsulta($sql, $arrayData = array()){
		/*
			$sql = Es la consulta contra la base de datos
			$arrayDatos = son los datos que van por parametro en la consulta
		*/
		include("configuracion/configuracion.php");

		$host 		= $BDMYSQL['host'];
		$dbName 	= $BDMYSQL['dbName'];
		$user 		= $BDMYSQL['user'];
		$password 	= $BDMYSQL['password'];
		$options = [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_CASE => PDO::CASE_NATURAL,
			PDO::ATTR_ORACLE_NULLS => PDO::NULL_EMPTY_STRING
		];

		$objConexion = new PDO("mysql:localhost=".$host.";dbname=".$dbName."",$user,$password,$options);

		try{

			$preparo = $objConexion->prepare($sql);
			$retorno = $preparo->execute($arrayData);

		}catch(Exception $e){
			// En caso que de error imprimimos en pantalla el error 
			// Y retornamos un false
			print_r($e->getMessage());				
			$retorno = false;

		}catch(PDOException $ePDO){
			// En caso que de error imprimimos en pantalla el error 
			// Y retornamos un false
			print_r($ePDO->getMessage());
			$retorno = false;
		}
		
		return $retorno;

	} 


	public function subirImagen($rArchivo,$rAlto,$rAncho){
			//$rArchivo = $_FILE[(Y el name de input file)];
			$archivo = $rArchivo;
			$rutaTMP = $rArchivo['tmp_name'];

			if($rArchivo['tmp_name'] == ""){
				return false;
			}	

			$tipos =  $rArchivo['type'];
			switch ($tipos){
					case "image/png":
						$tipo = "png";
						break;
					case "image/jpeg":
						$tipo = "jpg";
						break;
					case "image/jpg":
						$tipo = "jpg";
						break;
					case "image/PNG":
						$tipo = "PNG";
						break;
					case "image/JPEG":
						$tipo = "jpg";
						break;
					case "image/JPG":
						$tipo = "JPG";
						break;						
				}
			$nombre			= uniqid().".".$tipo;
			$rutaTMPlocal 	= "tmp/".$nombre;
			$rutaFinal		= "archivos/imagenes/".$nombre;

			if(copy($rutaTMP, $rutaTMPlocal)){

				//Cargo en memoria la imagen que quiero redimensionar
				// antes de cargar verifico si la imagen es png  
				if($tipo == "png" || $tipo == "PNG"){
					$imagen_original = imagecreatefrompng($rutaTMPlocal);
				}else{
					$imagen_original = imagecreatefromjpeg($rutaTMPlocal);
				}
				//Obtengo el ancho de la imagen quecargue
				$ancho_original = imagesx($imagen_original);
				//Obtengo el alto de la imagen que cargue
				$alto_original = imagesy($imagen_original);
				//Va el alto y el ancho con que el que queda la foto
				$alto_final = $rAlto;
				$ancho_final = $rAncho;
				//Creo una imagen vacia, con el alto y el ancho que tendrla imagen redimensionada
				$imagen_redimensionada = imagecreatetruecolor($ancho_final, $alto_final);
				//Copio la imagen original con las nuevas dimensiones a la imagen en blanco que creamos en la linea anterior
				imagecopyresampled($imagen_redimensionada, $imagen_original, 0, 0, 0, 0, $ancho_final, $alto_final, $ancho_original, $alto_original);
				//Guardo la imagen ya redimensionada
				// antes de guardar la imagen valido si la misma es png
				if($tipo == "png" || $tipo == "PNG"){
					imagepng($imagen_redimensionada,$rutaFinal);
				}else{
					imagejpeg($imagen_redimensionada,$rutaFinal);
				}
				//Libero recursos, destruyendo las imagenes que estaban en memoria
				imagedestroy($imagen_original);
				imagedestroy($imagen_redimensionada);
				//Borramos la primera imagen subida al servidor
				unlink($rutaTMPlocal );
				return $nombre; 

			}else{
				return false;
			}
					
	}

}





?>



