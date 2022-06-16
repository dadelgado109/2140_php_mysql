



CREATE TABLE tiposCursos(
	id INT(5) NOT NULL AUTO_INCREMENT COMMENT 'Es el identificador unico de la tabla', 
	nombre VARCHAR(50) NOT NULL,
	descripcion TEXT,
	PRIMARY KEY(id)	
);

INSERT INTO tiposCursos SET
	nombre = "Programacion",
	descripcion = "Todos los cursos para los programadores y super genios";

INSERT INTO tiposCursos SET
	nombre = "Diseño",
	descripcion = "Curos para los artistas de la vida";

INSERT INTO tiposCursos SET
	nombre = "Offimatica",
	descripcion = "Curos para oficinista";

SELECT * FROM tiposCursos;
