create DATABASE project_db-- Tabla de postulantes
-- Tabla de postulantes
-- Crear la base de datos si no existe
CREATE DATABASE IF NOT EXISTS project_db;
USE project_db;

-- Tabla de postulantes
CREATE TABLE IF NOT EXISTS postulante (
    cedula INT PRIMARY KEY NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    contrasena VARCHAR(255) NOT NULL, -- Contraseña encriptada
    fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de reclutadores
CREATE TABLE IF NOT EXISTS reclutador (
    cedula INT PRIMARY KEY NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    contrasena VARCHAR(255) NOT NULL, -- Contraseña encriptada
    fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de administradores
CREATE TABLE IF NOT EXISTS administrador (
    cedula INT PRIMARY KEY NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    contrasena VARCHAR(255) NOT NULL, -- Contraseña encriptada
    fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de currículums subidos por postulantes
CREATE TABLE IF NOT EXISTS curriculums (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_postulante INT NOT NULL,
    archivo_cv TEXT NOT NULL, -- Ruta o nombre del archivo
    descripcion TEXT,
    fecha_subida DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_postulante) REFERENCES postulante(cedula)
);

-- Tabla de ofertas de trabajo publicadas por reclutadores
CREATE TABLE IF NOT EXISTS ofertas_trabajo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_reclutador INT NOT NULL,
    titulo VARCHAR(150) NOT NULL,
    descripcion TEXT,
    ubicacion VARCHAR(100),
    fecha_publicacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    requisitos TEXT NULL,
    salario_min DECIMAL(10,2) NULL,
    salario_max DECIMAL(10,2) NULL;
    FOREIGN KEY (id_reclutador) REFERENCES reclutador(cedula)
);

-- Tabla de postulaciones a las ofertas de trabajo
CREATE TABLE IF NOT EXISTS postulaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_postulante INT NOT NULL,
    id_oferta INT NOT NULL,
    fecha_postulacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    estado ENUM('enviada', 'vista', 'rechazada', 'aceptada') DEFAULT 'enviada',
    FOREIGN KEY (id_postulante) REFERENCES postulante(cedula),
    FOREIGN KEY (id_oferta) REFERENCES ofertas_trabajo(id)
);


--------------------------------------------------
-- Esto es de Brahiam, Rolando cuando organice la base de datos intente ingresar esto de postulacion para que funcione 
USE project_db;
DROP TABLE IF EXISTS postulaciones;

CREATE TABLE postulaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(100) NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    cv VARCHAR(255) NOT NULL,
    mensaje TEXT NOT NULL,
    fecha_postulacion DATETIME DEFAULT CURRENT_TIMESTAMP
);

--Todo esto es para que no de error al agregar nuevas columnas para el funcionamiento de la pagina

-- Agregar columna de nivel de experiencia a la tabla ofertas_trabajo para que no de error
USE project_db;
ALTER TABLE ofertas_trabajo
ADD COLUMN modalidad VARCHAR(50) DEFAULT 'No definida',
ADD COLUMN nivel VARCHAR(50) DEFAULT 'No indicado';


USE project_db;

ALTER TABLE postulaciones
ADD COLUMN estado ENUM('enviada', 'vista', 'rechazada', 'aceptada') DEFAULT 'enviada' AFTER fecha_postulacion;
USE project_db;

ALTER TABLE postulaciones
ADD COLUMN id_oferta INT NOT NULL AFTER id;

-- Agregar columna estado a la tabla postulaciones
