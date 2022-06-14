



-- Listo las bases de datos disponibles
SHOW DATABASES;
-- Listo las tablas disponibles dentro de la base de datos
SHOW tables;
-- Creo la base de datos cursos
CREATE DATABASE curso_2140;
-- Entro la base de datos cursos_2140
USE curso_2140;

-- Nombre    VARCHAR(50) 
-- Apellido  VARCHAR(50)
-- Email	 TINYTEXT() 	
-- Cedula	 INT(8) 	
-- edad / fecha nacimiento DATE()
-- telefono	  VARCHAR(15)	
-- genero	  ENUM("Masculino","Femenino","Otros")
-- domicilio  TEXT
-- pais (country iso 2) char(2) 

-- Para crear una tabla en la base de datos
CREATE TABLE personas(
	nombre VARCHAR(50),
	apellido VARCHAR(50),
	email TINYTEXT,
	cedula INT(8),
	fechaNacimiento DATE,
	telefono VARCHAR(15),
	genero ENUM("Masculino","Femenino","Otros"),
	domicilio TEXT,
	pais CHAR(2),
	PRIMARY KEY(cedula)
)
-- Sentencia para borra la tabla
DROP TABLE personas;

-- 
SHOW CREATE TABLE personas;

CREATE TABLE `personas` (
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `email` tinytext,
  `cedula` int(8) NOT NULL,
  `fechaNacimiento` date DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `genero` enum('Masculino','Femenino','Otros') DEFAULT NULL,
  `domicilio` text,
  `pais` char(2) DEFAULT NULL,
  PRIMARY KEY (`cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1

-- Extraemos datos de la tabla

SELECT * FROM personas;

-- Insertamos registros
INSERT INTO personas (nombre,apellido,email,cedula,fechaNacimiento,telefono,genero,domicilio,pais)
VALUES ("Damian", "Delgado", "damisintesis109@gmail.com",12556632,"1987-09-10","099999999","Masculino","Mi casa que esta adelante de la casa de atras","UY");

-- Esta forma de insetar registros solo funciona en MySQL
INSERT INTO personas SET
	nombre = "Federico",
	apellido = "Halcon",
	email = "aguila@mail.com",
	cedula = 556633221,
	fechaNacimiento = "2000-03-26",
	telefono = "0223366554411",
	genero = "Masculino",
	domicilio = "Madrid muy lejos ",
	pais = "UY";
	
	
INSERT INTO personas SET
	nombre = "Rosario",
	cedula = 3566622,
	fechaNacimiento = "2005-03-26",
	telefono = "tttttt",
	genero = "Femenino",
	domicilio = "Ruta algo camino el repecho",
	pais = "UY";

INSERT INTO personas SET
	nombre = "Rosario",
	cedula = 35662622,
	fechaNacimiento = "2005-03-26",
	telefono = "tttttt",
	genero = NULL,
	domicilio = "Ruta algo camino el repecho",
	pais = "UY";

DELETE FROM personas;

SELECT * FROM personas
	WHERE nombre = "Damian";

SELECT nombre,apellido,cedula FROM personas
	WHERE genero = "Masculino";

















