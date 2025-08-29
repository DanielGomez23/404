create DATABASE project_db-- Tabla de postulantes
CREATE TABLE postulante (
    cedula INT PRIMARY KEY NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    contrasena VARCHAR(255) NOT NULL, -- La contraseña se almacena encriptada, solo el usuario la conoce
    fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de reclutadores
CREATE TABLE reclutador (
    cedula INT PRIMARY KEY NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    contrasena VARCHAR(255) NOT NULL, -- La contraseña se almacena encriptada, solo el usuario la conoce
    fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de administradores
CREATE TABLE administrador (
    cedula INT PRIMARY KEY NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    contrasena VARCHAR(255) NOT NULL, -- La contraseña se almacena encriptada, solo el usuario la conoce
    fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de currículums (CVs) subidos por postulantes
CREATE TABLE curriculums (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_postulante INT NOT NULL,
    archivo_cv TEXT NOT NULL, -- nombre o ruta del archivo
    descripcion TEXT,
    fecha_subida DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_postulante) REFERENCES postulante(cedula)
);

-- Tabla de ofertas de trabajo publicadas por reclutadores
CREATE TABLE ofertas_trabajo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_reclutador INT NOT NULL,
    titulo VARCHAR(150) NOT NULL,
    descripcion TEXT,
    ubicacion VARCHAR(100),
    fecha_publicacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_reclutador) REFERENCES reclutador(cedula)
);

-- Tabla de postulaciones a las ofertas de trabajo
CREATE TABLE postulaciones (
    cedula INT PRIMARY KEY NOT NULL,
    id_postulante INT NOT NULL,
    id_oferta INT NOT NULL,
    fecha_postulacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    estado ENUM('enviada', 'vista', 'rechazada', 'aceptada') DEFAULT 'enviada',
    FOREIGN KEY (id_postulante) REFERENCES postulante(cedula),
    FOREIGN KEY (id_oferta) REFERENCES ofertas_trabajo(id)
);