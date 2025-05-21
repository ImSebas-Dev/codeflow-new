DROP DATABASE IF EXISTS codeflowbd;
CREATE DATABASE codeflowbd;
USE codeflowbd;

-- BLOQUE 1: AUTENTICACIÓN Y CONTROL DE ACCESO

CREATE TABLE IF NOT EXISTS Roles (
    id_rol INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) UNIQUE NOT NULL,
    descripcion TEXT
) ENGINE=InnoDB;

INSERT INTO Roles(nombre, descripcion) 
VALUES 
('freelancer', 'Usuario freelance que se postula a proyectos'),
('empresa', 'Usuario que publica proyectos para freelancers'),
('admin', 'Administrador encargado del correcto funcionamiento de la web')
ON DUPLICATE KEY UPDATE nombre = nombre;

CREATE TABLE IF NOT EXISTS Permisos (
    id_permiso INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) UNIQUE NOT NULL,
    descripcion TEXT
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS Roles_Permisos (
    id_rol INT NOT NULL,
    id_permiso INT NOT NULL,
    PRIMARY KEY (id_rol, id_permiso),
    FOREIGN KEY (id_rol) REFERENCES Roles(id_rol) ON DELETE CASCADE,
    FOREIGN KEY (id_permiso) REFERENCES Permisos(id_permiso) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS Usuarios (
    id_usuario BIGINT PRIMARY KEY AUTO_INCREMENT,
    correo VARCHAR(255) UNIQUE NOT NULL,
    contra VARCHAR(255) NOT NULL, -- La contraseña debe estar hasheada con bcrypt o similar
    id_rol INT NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_rol) REFERENCES Roles(id_rol) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS Empleados (
    id_empleado BIGINT PRIMARY KEY AUTO_INCREMENT,
    id_usuario BIGINT UNIQUE NOT NULL,
    cargo VARCHAR(100),
    fecha_contratacion DATE,
    FOREIGN KEY (id_usuario) REFERENCES Usuarios(id_usuario) ON DELETE CASCADE
) ENGINE=InnoDB;

-- BLOQUE FREELANCERS

CREATE TABLE IF NOT EXISTS Freelancers (
    id_freelancer BIGINT PRIMARY KEY AUTO_INCREMENT,
    id_usuario BIGINT UNIQUE NOT NULL,
    nombre VARCHAR(100),
    apellido VARCHAR(100),
    correo VARCHAR(255) UNIQUE NOT NULL,
    telefono VARCHAR(20),
    descripcion_freelancer TEXT,
    titulo VARCHAR(100),
    habilidades TEXT,
    genero ENUM('masculino', 'femenino', 'otro'),
    FOREIGN KEY (id_usuario) REFERENCES Usuarios(id_usuario) ON DELETE CASCADE
) ENGINE=InnoDB;

-- BLOQUE EMPRESAS

CREATE TABLE IF NOT EXISTS Empresas (
    id_empresa BIGINT PRIMARY KEY AUTO_INCREMENT,
    id_usuario BIGINT UNIQUE NOT NULL,
    nombre_empresa VARCHAR(255) NOT NULL,
    nit VARCHAR(30) UNIQUE,
    correo_corporativo VARCHAR(255),
    telefono VARCHAR(20),
    sitio_web VARCHAR(255),
    industria VARCHAR(100),
    descripcion TEXT,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES Usuarios(id_usuario) ON DELETE CASCADE
) ENGINE=InnoDB;

-- BLOQUE 3: PROYECTOS

CREATE TABLE IF NOT EXISTS Proyectos (
    id_proyecto BIGINT PRIMARY KEY AUTO_INCREMENT,
    id_empresa BIGINT NOT NULL,
    id_freelancer BIGINT,
    titulo VARCHAR(255) NOT NULL,
    descripcion TEXT,
    estado ENUM('Abierto', 'En progreso', 'Finalizado') DEFAULT 'Abierto' NOT NULL,
    monto DECIMAL(10,2) NOT NULL,
    fecha_finalizacion DATE,
    comentarios TEXT,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_empresa) REFERENCES Empresas(id_empresa) ON DELETE CASCADE,
    FOREIGN KEY (id_freelancer) REFERENCES Freelancers(id_freelancer) ON DELETE CASCADE
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS Historial_Proyectos (
    id_historial BIGINT PRIMARY KEY AUTO_INCREMENT,
    id_proyecto BIGINT NOT NULL,
    id_freelancer BIGINT NOT NULL,
    fecha_historial TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_proyecto) REFERENCES Proyectos(id_proyecto) ON DELETE CASCADE,
    FOREIGN KEY (id_freelancer) REFERENCES Freelancers(id_freelancer) ON DELETE CASCADE
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS Proyectos_Freelancer (
    id_proyecto_freelancer BIGINT PRIMARY KEY AUTO_INCREMENT,
    id_proyecto BIGINT NOT NULL,
    id_freelancer BIGINT NOT NULL,
    FOREIGN KEY (id_proyecto) REFERENCES Proyectos(id_proyecto) ON DELETE CASCADE,
    FOREIGN KEY (id_freelancer) REFERENCES Freelancers(id_freelancer) ON DELETE CASCADE
) ENGINE = InnoDB;

-- BLOQUE 4: POSTULACIONES

CREATE TABLE IF NOT EXISTS Estado_Postulacion (
    id_estado_postulacion BIGINT PRIMARY KEY AUTO_INCREMENT,
    estado ENUM('pendiente', 'aceptada', 'rechazada') DEFAULT 'pendiente' NOT NULL,
    fecha_estado TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS Postulaciones (
    id_postulacion BIGINT PRIMARY KEY AUTO_INCREMENT,
    id_freelancer BIGINT NOT NULL,
    id_proyecto BIGINT NOT NULL,
    id_estado_postulacion BIGINT NOT NULL,
    fecha_postulacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_freelancer) REFERENCES Freelancers(id_freelancer) ON DELETE CASCADE,
    FOREIGN KEY (id_proyecto) REFERENCES Proyectos(id_proyecto) ON DELETE CASCADE,
    FOREIGN KEY (id_estado_postulacion) REFERENCES Estado_Postulacion(id_estado_postulacion) ON DELETE CASCADE
) ENGINE = InnoDB;

-- BLOQUE 5: PAGOS

CREATE TABLE IF NOT EXISTS Estado_Pago (
    id_estado_pago BIGINT PRIMARY KEY AUTO_INCREMENT,
    estado ENUM('pendiente', 'completado', 'fallido') DEFAULT 'pendiente' NOT NULL
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS Pagos (
    id_pago BIGINT PRIMARY KEY AUTO_INCREMENT,
    id_usuario BIGINT NOT NULL,
    numero_tarjeta VARCHAR(255) NOT NULL,
    propietario_tarjeta VARCHAR(255) NOT NULL,
    monto DECIMAL(10,2) NOT NULL,
    cvc INT NOT NULL,
    fecha_expiracion VARCHAR(255) NOT NULL,
    fecha_pago TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES Usuarios(id_usuario) ON DELETE CASCADE
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS Historial_Pagos (
    id_historial BIGINT PRIMARY KEY AUTO_INCREMENT,
    id_pago BIGINT NOT NULL,
    id_estado_pago BIGINT NOT NULL,
    fecha_historial TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_estado_pago) REFERENCES Estado_Pago(id_estado_pago) ON DELETE CASCADE,
    FOREIGN KEY (id_pago) REFERENCES Pagos(id_pago) ON DELETE CASCADE
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS Contratos (
    id_contrato BIGINT PRIMARY KEY AUTO_INCREMENT,
    id_proyecto BIGINT NOT NULL,
    id_freelancer BIGINT NOT NULL,
    id_empresa BIGINT NOT NULL,
    terminos TEXT,
    fecha_inicio DATE,
    fecha_fin DATE,
    firma_empresa BOOLEAN DEFAULT FALSE,
    firma_freelancer BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (id_proyecto) REFERENCES Proyectos(id_proyecto),
    FOREIGN KEY (id_freelancer) REFERENCES Freelancers(id_freelancer),
    FOREIGN KEY (id_empresa) REFERENCES Empresas(id_empresa)
) ENGINE = InnoDB;

-- BLOQUE 6: TAREAS Y CALIFICACIONES

CREATE TABLE IF NOT EXISTS Tareas (
    id_tarea BIGINT PRIMARY KEY AUTO_INCREMENT,
    id_proyecto BIGINT NOT NULL,
    titulo VARCHAR(255) NOT NULL,
    descripcion TEXT,
    estado ENUM('pendiente', 'en progreso', 'finalizada', 'cancelada') DEFAULT 'pendiente',
    repositorio VARCHAR(255), -- URL del repositorio en GitHub
    comentarios TEXT,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_entrega DATE,
    FOREIGN KEY (id_proyecto) REFERENCES Proyectos(id_proyecto) ON DELETE CASCADE
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS Tareas_Freelancer (
    id_tarea_freelancer BIGINT PRIMARY KEY AUTO_INCREMENT,
    id_tarea BIGINT NOT NULL,
    id_freelancer BIGINT NOT NULL,
    fecha_asignacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_tarea) REFERENCES Tareas(id_tarea) ON DELETE CASCADE,
    FOREIGN KEY (id_freelancer) REFERENCES Freelancers(id_freelancer) ON DELETE CASCADE
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS Calificaciones (
    id_calificacion BIGINT PRIMARY KEY AUTO_INCREMENT,
    id_tarea BIGINT NOT NULL,
    id_empresa BIGINT NOT NULL,
    calificacion INT NOT NULL CHECK (calificacion BETWEEN 1 AND 5),
    comentario TEXT,
    fecha_calificacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_tarea) REFERENCES Tareas(id_tarea) ON DELETE CASCADE,
    FOREIGN KEY (id_empresa) REFERENCES Empresas(id_empresa) ON DELETE CASCADE
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS Evaluaciones_Empresa (
    id_evaluacion BIGINT PRIMARY KEY AUTO_INCREMENT,
    id_empresa BIGINT NOT NULL,
    id_freelancer BIGINT NOT NULL,
    calificacion INT CHECK (calificacion BETWEEN 1 AND 5),
    comentario TEXT,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_empresa) REFERENCES Empresas(id_empresa) ON DELETE CASCADE,
    FOREIGN KEY (id_freelancer) REFERENCES Freelancers(id_freelancer) ON DELETE CASCADE
) ENGINE=InnoDB;

-- BLOQUE 7: COMUNICACIÓN Y NOTIFICACIONES

CREATE TABLE IF NOT EXISTS Estado_Mensajes (
    id_estado_mensaje BIGINT PRIMARY KEY AUTO_INCREMENT,
    estado ENUM('leído', 'no leído') DEFAULT 'no leído'
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS Mensajes (
    id_mensaje BIGINT PRIMARY KEY AUTO_INCREMENT,
    id_emisor BIGINT NOT NULL,
    id_receptor BIGINT NOT NULL,
    id_estado_mensaje BIGINT NOT NULL,
    tipo_emisor ENUM('freelancer', 'empresa', 'admin'),
    tipo_receptor ENUM('freelancer', 'empresa', 'admin'),
    asunto VARCHAR(255) NOT NULL,
    contenido TEXT,
    fecha_envio TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_estado_mensaje) REFERENCES Estado_Mensajes(id_estado_mensaje) ON DELETE CASCADE,
    FOREIGN KEY (id_emisor) REFERENCES Usuarios(id_usuario) ON DELETE CASCADE,
    FOREIGN KEY (id_receptor) REFERENCES Usuarios(id_usuario) ON DELETE CASCADE
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS Notificaciones (
    id_notificacion BIGINT PRIMARY KEY AUTO_INCREMENT,
    id_usuario BIGINT NOT NULL,
    tipo VARCHAR(100) NOT NULL,
    titulo VARCHAR(255),
    mensaje TEXT NOT NULL,
    leido BOOLEAN DEFAULT FALSE,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES Usuarios(id_usuario) ON DELETE CASCADE
) ENGINE = InnoDB;

-- BLOQUE 8: BLOQUE DE SUSCRIPCIONES

CREATE TABLE IF NOT EXISTS Suscripciones (
    id_suscripcion BIGINT PRIMARY KEY AUTO_INCREMENT,
    id_usuario BIGINT NOT NULL,
    id_pago BIGINT NOT NULL,
    tipo_suscripcion ENUM('Básica', 'Profesional', 'Empresa') DEFAULT 'Básica' NOT NULL,
    valor DECIMAL(10,2) NOT NULL,
    fecha_fin DATE,
    fecha_inicio TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_pago) REFERENCES Pagos(id_pago) ON DELETE CASCADE,
    FOREIGN KEY (id_usuario) REFERENCES Usuarios(id_usuario) ON DELETE CASCADE
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS Tokens_Recuperacion (
    id_token BIGINT PRIMARY KEY AUTO_INCREMENT,
    id_usuario BIGINT NOT NULL,
    token VARCHAR(255) NOT NULL,
    expiracion DATETIME NOT NULL,
    utilizado BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (id_usuario) REFERENCES Usuarios(id_usuario) ON DELETE CASCADE
) ENGINE = InnoDB;

-- INDICES DE OPTIMIZACIÓN
CREATE INDEX idx_proyectos_titulo ON Proyectos(titulo);
CREATE INDEX idx_proyectos_estado ON Proyectos(estado);
CREATE INDEX idx_freelancers_nombre ON Freelancers(nombre, apellido);