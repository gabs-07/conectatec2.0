/*Creacion de la base de datos*/
CREATE DATABASE conectaTec; 

/*Usando la base de datos*/
USE conectaTec;

/*Creacion de la tabla de los usuarios*/
CREATE TABLE usuario(
	id int auto_increment primary key,
    nombre varchar (50) not null,
    apellidoPaterno varchar (50) not null,
    apellidoMaterno varchar (50) not null,
    rol varchar (50),
    correo varchar (50) not null,
    contrasenia varchar (50) not null
);

drop table usuario;
/*Inyecion en la tabla usuario*/
INSERT INTO usuario (nombre, apellidoPaterno, apellidoMaterno, rol, correo, contrasenia)
VALUES 
('Gabriel', 'Ruiz', 'Estrella', 'administrador', 'estrella120801@gmail.com', 'Admin123'),
('María', 'Pérez', 'López', 'editor', 'maria.perez@example.com', 'Editor456'),
('Juan', 'García', 'Hernández', 'lector', 'juan.garcia@example.com', 'Lector789'),
('Ana', 'Torres', 'Martínez', 'lector', 'ana.torres@example.com', 'Sup3rv1sor'),
('Luis', 'Ramírez', 'Castillo', 'lector', 'luis.ramirez@example.com', 'Soporte2024');

drop table usuario;

/*Llamando a los correos de los usuarios*/
select correo, contrasenia, estado from usuario;

/*Ver la existencia de las tablas*/
SHOW TABLES;

ALTER USER 'root'@'localhost' IDENTIFIED BY 'admin';
FLUSH PRIVILEGES;


SELECT * FROM usuario WHERE correo = 'estrella120801@gmail.com' AND contrasenia = 'Admin123';

drop database conectaTec;

drop table comentarios;
CREATE TABLE comentarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(255) NOT NULL, -- Aquí puedes usar el nombre o correo del usuario
    comentario TEXT NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE comentariosWEB(
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(255) NOT NULL, -- Aquí puedes usar el nombre o correo del usuario
    comentario TEXT NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE comentariosCS(
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(255) NOT NULL, -- Aquí puedes usar el nombre o correo del usuario
    comentario TEXT NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE comentariosNB(
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(255) NOT NULL, -- Aquí puedes usar el nombre o correo del usuario
    comentario TEXT NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE comentariosBD(
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(255) NOT NULL, -- Aquí puedes usar el nombre o correo del usuario
    comentario TEXT NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);