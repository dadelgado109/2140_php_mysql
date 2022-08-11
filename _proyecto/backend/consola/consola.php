
<?php

class consola{


    public function arrancar(){

        echo("Estoy Andando \n ");

    }    

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

}


?>



