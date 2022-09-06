<?php

	require_once("consola/consola.php");
	
	class instalador extends consola{

		public function arrancar(){

			parent::arrancar();

			$this->instalar();

			
			return "ok";
		}

		public function instalar(){

			$arraySQL = array();
			$arraySQL[] = "
					SET FOREIGN_KEY_CHECKS=0;
					DROP TABLE alumnos;
					DROP TABLE tiposcursos;
					DROP TABLE profesores;
					DROP TABLE cursos;
					DROP TABLE alumnos_cursos;
					SET FOREIGN_KEY_CHECKS=0;
			";
			$arraySQL[] = "CREATE TABLE `alumnos` (
							  `documento` int(9) NOT NULL,
							  `nombre` varchar(50) DEFAULT NULL,
							  `apellido` varchar(50) DEFAULT NULL,
							  `fechaNacimiento` date DEFAULT NULL,
							  `tipoDocumento` enum('CI','Pasaporte') DEFAULT NULL,
							  `estado` tinyint(1) DEFAULT NULL,
							  PRIMARY KEY (`documento`)
							)
							";

			$arraySQL[] = "CREATE TABLE `profesores` (
						  `documento` int(9) NOT NULL,
						  `nombre` varchar(50) DEFAULT NULL,
						  `apellido` varchar(50) DEFAULT NULL,
						  `fechaNacimiento` date DEFAULT NULL,
						  `estado` tinyint(1) DEFAULT NULL,
						  PRIMARY KEY (`documento`)
						)";

			$arraySQL[] = "CREATE TABLE `tiposcursos` (
							  `id` int(5) NOT NULL AUTO_INCREMENT,
							  `nombre` varchar(50) DEFAULT NULL,
							  `descripcion` text,
							  `estado` tinyint(1) DEFAULT NULL,
							  PRIMARY KEY (`id`)
							) ";

			$arraySQL[] = "CREATE TABLE `cursos` (
					  `codigo` int(10) NOT NULL AUTO_INCREMENT,
					  `nombre` varchar(100) DEFAULT NULL,
					  `anio` year(4) DEFAULT NULL,
					  `tipoCurso` int(5) DEFAULT NULL,
					  `profesor` int(9) DEFAULT NULL,
					  `estado` tinyint(1) DEFAULT NULL,
					  `imagen` char(36) DEFAULT NULL,
					  PRIMARY KEY (`codigo`),
					  KEY `cur_tipoCurso` (`tipoCurso`),
					  KEY `cur_profesor` (`profesor`),
					  CONSTRAINT `cur_profesor_fk2` FOREIGN KEY (`profesor`) REFERENCES `profesores` (`documento`),
					  CONSTRAINT `cur_tipoCurso_fk1` FOREIGN KEY (`tipoCurso`) REFERENCES `tiposcursos` (`id`)
					)";

			$arraySQL[] = "CREATE TABLE `alumnos_cursos` (
							  `id` bigint(10) NOT NULL AUTO_INCREMENT,
							  `codigoCurso` int(10) DEFAULT NULL,
							  `documento` int(9) DEFAULT NULL COMMENT 'Es el documento del alumno',
							  PRIMARY KEY (`id`),
							  KEY `alcur_codigoCurso` (`codigoCurso`),
							  KEY `alcur_documento` (`documento`),
							  CONSTRAINT `alcur_codigoCurso_fk1` FOREIGN KEY (`codigoCurso`) REFERENCES `cursos` (`codigo`),
							  CONSTRAINT `alcur_documento_fk2` FOREIGN KEY (`documento`) REFERENCES `alumnos` (`documento`)
							) ";


			foreach($arraySQL as $sql){

				print_r($sql);
				$this->ejecutarConsulta($sql);	

			}
		}

	}






?>