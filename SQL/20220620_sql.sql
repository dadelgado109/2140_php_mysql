-- Clase 2022-06-20

DROP DATABASES curso_2014;

SHOW TABLES;

CREATE TABLE alumnos(
	documento INT(9),	
	nombre VARCHAR(50),
	apellido VARCHAR(50),
	fechaNacimiento DATE,
	tipoDocumento ENUM("CI","Pasaporte"),
	PRIMARY KEY(documento)
);

CREATE TABLE tiposCursos(
	id INT(5) NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(50),
	descripcion TEXT,
	PRIMARY KEY(id) 
);

CREATE TABLE profesores(
	documento INT(9),
	nombre	VARCHAR(50),
	apellido VARCHAR(50),
	fechaNacimiento DATE,
	PRIMARY KEY (documento)
);

CREATE TABLE cursos(
	codigo INT(10) NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(100),
	anio YEAR,
	tipoCurso INT(5),
	profesor INT(9),
	PRIMARY KEY (codigo),
	KEY cur_tipoCurso (tipoCurso),
	KEY cur_profesor (profesor),
	-- Creo la primera contraints dandonle un nombre "cur_tipoCurso_fk1" y enganchando el campo "tipoCurso" de la 
	-- de la cursos con el campo "id" de la tabla tiposCursos
	CONSTRAINT cur_tipoCurso_fk1 FOREIGN KEY (tipoCurso) REFERENCES tiposCursos(id), 
	CONSTRAINT cur_profesor_fk2 FOREIGN KEY (profesor) REFERENCES profesores(documento)
);

CREATE TABLE alumnos_cursos(
	
	id BIGINT(10) NOT NULL AUTO_INCREMENT,
	codigoCurso INT(10),
	documento INT(9) COMMENT 'Es el documento del alumno',
	PRIMARY KEY (id),
	KEY alcur_codigoCurso (codigoCurso),
	KEY alcur_documento (documento),
	CONSTRAINT alcur_codigoCurso_fk1 FOREIGN KEY (codigoCurso) REFERENCES cursos(codigo),
	CONSTRAINT alcur_documento_fk2 FOREIGN KEY (documento) REFERENCES alumnos(documento) 
);

DROP TABLE personas;


INSERT INTO alumnos SET
	documento 	= "44553128",
	nombre 		= "Damian",
	apellido 	= "Delgado",
	fechaNacimiento = "1987-09-10",
	tipoDocumento = "CI";

INSERT INTO alumnos SET
	documento 	= 6559,
	nombre 		= "Fabian",
	apellido 	= "Maldonado",
	fechaNacimiento = "2013-03-10",
	tipoDocumento = "CI";

INSERT INTO alumnos (documento,nombre,apellido,fechaNacimiento,tipoDocumento) VALUES
	 (235,'Sofia','Delgado','1990-05-10','CI'),
	 (531284,'Antonio','Delgado','1987-09-10','CI'),
	 (2659855,'4512351','Delgado','1890-09-03','CI'),
	 (44553128,'Damian','Delgado','1987-09-10','CI'),
	 (45781215,'Elisa','Tavarez','1950-03-07','Pasaporte'),
	 (65523694,'Anna','Delgado','1890-09-03','CI'),
	 (89715332,'Javier','Tavarez','1950-03-07','CI'),
	 (45412385,'Alfredo','Delgado','1987-09-10','CI'),
	 (456432158,'Camila','Israel','2000-03-07','Pasaporte'),
	 (456434458,'Sofia','Garcia','2001-03-07','Pasaporte');

Data truncation: Out of range value for column 'documento' at row 1
Incorrect integer value: 'AA531284' for column 'documento' at row 1
Duplicate entry '65523694' for key 'PRIMARY'

Data truncation: Data too long for column 'nombre' at row 1
Data truncated for column 'tipoDocumento' at row 1

SELECT * FROM alumnos;

DELETE FROM alumnos;

SELECT * FROM alumnos a WHERE nombre = "DaMIan";

SELECT * FROM alumnos a WHERE apellido = "Delgado";

SELECT * FROM alumnos a WHERE apellido = "Delgado" LIMIT 1;

SELECT * FROM alumnos a WHERE apellido = "Delgado" ORDER BY documento DESC LIMIT 3 ;

SELECT * FROM alumnos a WHERE apellido = "Delgado" ORDER BY nombre DESC LIMIT 3 ;

SELECT * FROM alumnos a WHERE apellido = "Delgado" ORDER BY fechaNacimiento DESC LIMIT 8;

SELECT * FROM alumnos ORDER BY tipoDocumento; 

SELECT * FROM alumnos WHERE nombre LIKE ("%ian");

SELECT * FROM alumnos WHERE nombre LIKE ("%ia%");

SELECT * FROM alumnos WHERE nombre LIKE ("S%ia%");

SELECT * FROM alumnos WHERE fechaNacimiento > "1990-01-01";

SELECT * FROM alumnos WHERE fechaNacimiento > "1987-01-01" AND apellido = "delgado";

SELECT * FROM alumnos WHERE fechaNacimiento > "1985-01-01" AND fechaNacimiento < "2000-06-16";

SELECT * FROM alumnos a WHERE fechaNacimiento BETWEEN "1985-01-01" AND "2010-06-16";

SELECT * FROM alumnos a WHERE fechaNacimiento 
		BETWEEN "1985-01-01" AND "2010-06-16"
		ORDER BY fechaNacimiento ASC;

SELECT * FROM alumnos a WHERE fechaNacimiento 
		BETWEEN "1985-01-01" AND "2010-06-16"
		ORDER BY apellido ASC;
	
SELECT * FROM alumnos a WHERE fechaNacimiento 
		BETWEEN "1985-01-01" AND "2010-06-16"
		ORDER BY apellido DESC,nombre ASC;

	
SELECT documento, nombre, apellido FROM alumnos a;
	
SELECT documento AS numero_documento, nombre, apellido FROM alumnos a;
	
SELECT tipoDocumento FROM alumnos a GROUP BY tipoDocumento;
	
SELECT apellido FROM alumnos a GROUP BY apellido;	

SELECT nombre,apellido FROM alumnos a GROUP BY apellido,nombre;	

SELECT * FROM alumnos;

SELECT count(*) AS total FROM alumnos;

SELECT * FROM alumnos WHERE apellido LIKE ("%del%");

SELECT count(*) AS total FROM alumnos WHERE apellido LIKE ("%del%");

SELECT count(nombre) AS total FROM alumnos WHERE apellido LIKE ("%del%");

SELECT tipoDocumento, count(tipoDocumento) AS total 
		FROM alumnos a 
		GROUP BY tipoDocumento;

SELECT * FROM alumnos WHERE fechaNacimiento like ("1987%");	
	
SELECT * FROM alumnos;	

UPDATE; alumnos SET
	nombre = "Jimena"
	WHERE documento = 2659855;

UPDATE alumnos SET
	nombre = "Jimena",
	apellido = "Gonzalez"
	WHERE documento = 2659855;

DELETE; FROM alumnos WHERE documento = 2659855;

TRUNCATE; TABLE alumnos;


SELECT * FROM alumnos a WHERE apellido != "delgado";

SELECT * FROM alumnos a WHERE apellido NOT LIKE "%ado";

SELECT * FROM alumnos a WHERE apellido = "tavarez" OR apellido = "Maldonado";

SELECT * FROM alumnos a WHERE apellido != "tavarez" AND apellido != "Maldonado";

SELECT * FROM alumnos WHERE apellido IN ("tavarez","MAldonado","delgado");

SELECT * FROM alumnos WHERE apellido NOT IN ("tavarez","MAldonado","delgado");


-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


SELECT [Campos] 
	FROM [tabla]
	JOIN [tabla]
	WHERE [Condiociones]
	ORDER BY [campo]
	LIMIT [Punto de salida, cantidad de registro]
	HAVING [Filtros despues del resultado de los campos]


-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


SELECT * FROM tiposCursos t; 

INSERT INTO tiposCursos SET
	nombre = "Progamacion",
	descripcion  = "Cursos papa capos";

INSERT INTO tiposCursos SET
	nombre = "Offina",
	descripcion  = "Cursos para manejo de herramientas offimatica";
	
INSERT INTO tiposCursos SET
	nombre = "Adultos",
	descripcion  = "Cursos gente adulta";
	
INSERT INTO tiposCursos SET
	nombre = "Niños",
	descripcion  = "Cursos para niños";

INSERT INTO tiposCursos SET
	nombre = "Diseño",
	descripcion  = "Cursos para a diseñar";

DELETE FROM tiposcursos WHERE id IN (6,7);

INSERT INTO tiposCursos SET
	nombre = "Fotografia",
	descripcion  = "Cursos para sacar foto";

SELECT count(*) FROM tiposcursos t; 

INSERT INTO profesores (documento,nombre,apellido,fechaNacimiento) VALUES
	 (4562321,'Sofia','Delgado','1990-05-10'),
	 (4561231,'Antonio','Gozalez','1987-09-10'),
	 (8123152,'Bruno','Perez','1890-09-03'),
	 (5456811,'Damian','Delgado','1987-09-10'),
	 (45781215,'Elisa','Tavarez','1950-03-07'),
	 (65645613,'Anna','Delgado','1890-09-03');

	INSERT INTO profesores (documento,nombre,apellido,fechaNacimiento) VALUES
	 (96655441,'Ana Lina','Garcia','2000-05-10');
	 
SELECT * FROM profesores p ;

ALTER TABLE profesores ADD tipoDocumento VARCHAR(15);

ALTER TABLE profesores DROP tipoDocumento;


-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

SHOW CREATE TABLE cursos;

SELECT * FROM tiposcursos t; 

SELECT * FROM cursos c; 

	INSERT INTO cursos SET
		nombre = "Programacion PHP",
		anio   = "2021",
		tipoCurso = 1,
		profesor  = 65645613;

	SELECT * FROM cursos c ORDER BY codigo LIMIT 5;
	
	SELECT * FROM cursos c ORDER BY codigo LIMIT 0,5;

	SELECT * FROM cursos c ORDER BY codigo LIMIT 3,5;

	SELECT * FROM cursos c ORDER BY codigo LIMIT 5,5;

	SELECT * FROM cursos c ORDER BY codigo LIMIT 10,5;

	SELECT * FROM cursos c ORDER BY c.codigo LIMIT 15,5;

	SELECT c.codigo, c.nombre FROM cursos c ORDER BY c.codigo LIMIT 15,5;


	SELECT *
		FROM cursos AS cur
		INNER JOIN profesores AS pro ON pro.documento = cur.profesor 
	WHERE pro.nombre = "Damian"		
	ORDER BY cur.codigo; 

	
	SELECT cur.codigo, cur.nombre, cur.anio, cur.tipoCurso,
			cur.profesor AS docProfesor, CONCAT(pro.nombre," ",pro.apellido) AS nomProfesor
		FROM cursos AS cur
		INNER JOIN profesores AS pro ON pro.documento = cur.profesor 
	WHERE pro.nombre = "Damian"		
	ORDER BY cur.codigo; 


	SELECT 	cur.codigo, 
			cur.nombre, 
			cur.anio, 
			cur.tipoCurso,
			tc.nombre AS nombreTC,
			cur.profesor AS docProfesor, 
			CONCAT(pro.nombre," ",pro.apellido) AS nomProfesor
		FROM cursos AS cur
		INNER JOIN profesores AS pro ON pro.documento = cur.profesor
		INNER JOIN tiposCursos AS tc ON tc.id = cur.tipoCurso  
	WHERE pro.nombre IN ("Elisa","Antonio")		
	ORDER BY cur.codigo; 


	SELECT 	cur.codigo, 
			cur.nombre, 
			cur.anio, 
			cur.tipoCurso,
			tc.nombre AS nombreTC,
			cur.profesor AS docProfesor, 
			CONCAT(pro.nombre," ",pro.apellido) AS nomProfesor
		FROM cursos AS cur
		INNER JOIN profesores AS pro ON pro.documento = cur.profesor
		INNER JOIN tiposCursos AS tc ON tc.id = cur.tipoCurso  
	WHERE (pro.nombre = "Elisa" OR (pro.nombre = "Antonio" AND cur.tipoCurso = 1) )		
	ORDER BY cur.codigo; 

	
	SELECT 	cur.tipoCurso ,count(cur.profesor)
		FROM cursos AS cur
		INNER JOIN profesores AS pro ON pro.documento = cur.profesor
		group by cur.tipoCurso;

	
	SELECT tc.nombre, COUNT(cur.profesor), GROUP_CONCAT(pro.nombre," ",pro.apellido) 
		FROM cursos AS cur
		INNER JOIN profesores AS pro ON pro.documento = cur.profesor
		INNER JOIN tiposCursos AS tc ON tc.id = cur.tipoCurso  
	GROUP BY cur.tipoCurso, cur.profesor ; 

	
	SELECT tipoCursos,COUNT(totalProfesor), GROUP_CONCAT(nombre," ",apellido)  FROM 
		(
			SELECT tc.nombre AS tipoCursos, COUNT(cur.profesor) AS totalProfesor, pro.nombre,pro.apellido, group_concat(cur.nombre,"-",codigo)  
				FROM cursos AS cur
				INNER JOIN profesores AS pro ON pro.documento = cur.profesor
				INNER JOIN tiposCursos AS tc ON tc.id = cur.tipoCurso  
			GROUP BY cur.tipoCurso, cur.profesor
		)  tablaNueva		
	GROUP BY tipoCursos; 


SELECT * FROM 
	cursos c 
	WHERE profesor IN (SELECT documento FROM profesores p WHERE fechaNacimiento < "1980-06-22")

			
	SELECT * 
		FROM cursos c
		RIGHT JOIN profesores p ON p.documento = c.profesor 
		