
--
-- Base de datos: tecnologias_web
--
 CREATE DATABASE tecnologias_web
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_spanish_ci;
-- --------------------------------------------------------

USE tecnologias_web;
--
-- Estructura de tabla para la tabla usuarios
--

CREATE TABLE IF NOT EXISTS usuarios (
  id_usuario int NOT NULL AUTO_INCREMENT,
  nombre varchar(50) NOT NULL,
  apellidos varchar(100) DEFAULT NULL,
  email varchar(140) NOT NULL UNIQUE,
  nick varchar(100) NOT NULL UNIQUE,
  passw varchar(255) NOT NULL,
  created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id_usuario)
)ENGINE=InnoDB;

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellidos`, `email`, `nick`, `passw`, `created_at`) VALUES
(1, 'admin', 'admin', 'admin@admin', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', '2016-06-04 17:08:06');

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla con datos extra para profesores
--

CREATE TABLE IF NOT EXISTS profesores (
  id_profesor int NOT NULL,
  departamento varchar(255) NOT NULL,
  PRIMARY KEY (id_profesor),
  KEY id(id_profesor),
  CONSTRAINT profesores
  FOREIGN KEY (id_profesor) REFERENCES usuarios(id_usuario)
  ON DELETE CASCADE
)ENGINE=InnoDB;

--
-- Estructura de tabla para la tabla recurso
--

CREATE TABLE IF NOT EXISTS recursos (
  id_recurso int NOT NULL AUTO_INCREMENT,
  id_profesor int NOT NULL,
  codigo varchar(50) NOT NULL UNIQUE,
  lugar varchar(255) NOT NULL,
  descripcion text,
  asignatura varchar(255) NOT NULL,
  fecha_ini datetime NOT NULL,
  fecha_fin datetime NOT NULL,
  created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,

  PRIMARY KEY (id_recurso),
  KEY id_profesor(id_profesor),
  CONSTRAINT recursos
  FOREIGN KEY (id_profesor) REFERENCES profesores(id_profesor)
  ON DELETE CASCADE
)ENGINE=InnoDB;


-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla cita
--

CREATE TABLE IF NOT EXISTS citas (
  id_cita int NOT NULL AUTO_INCREMENT,
  id_recurso int NOT NULL,
  codigo varchar(50) NOT NULL UNIQUE,
  nombre varchar(50) NOT NULL,
  apellidos varchar(100) NOT NULL,
  correo varchar(140) NOT NULL,
  dni varchar(11) NOT NULL,
  prioridad int NOT NULL DEFAULT '1',
  created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,

  PRIMARY KEY (id_cita),
  KEY id_recurso(id_recurso),
  CONSTRAINT citas
  FOREIGN KEY (id_recurso) REFERENCES recursos(id_recurso)
  ON DELETE CASCADE
)ENGINE=InnoDB;


-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla rol
--

CREATE TABLE IF NOT EXISTS roles (
  id_rol int NOT NULL AUTO_INCREMENT,
  nombre_rol varchar(20) NOT NULL UNIQUE,
  PRIMARY KEY (id_rol)
)ENGINE=InnoDB;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `nombre_rol`) VALUES
(1, 'administrador'),
(2, 'profesor');
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla rol_usuario
-- Suponiendo que un usuario solo tiene un rolr
-- en caso contrario hay que modificar.
--

CREATE TABLE IF NOT EXISTS rol_usuario (
  id_rol int NOT NULL ,
  id_usuario int NOT NULL,
  PRIMARY KEY (id_usuario),
  KEY id_rol(id_rol),

  CONSTRAINT rol1
  FOREIGN KEY (id_rol) REFERENCES roles(id_rol),

  KEY id_usuario(id_usuario),

  CONSTRAINT usuario1
  FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
  ON DELETE CASCADE
)ENGINE=InnoDB;


INSERT INTO `rol_usuario` (`id_rol`, `id_usuario`) VALUES
(1, 1);



CREATE TABLE IF NOT EXISTS visualizacion (
  id_entrada int NOT NULL AUTO_INCREMENT,
  codigo varchar(50) NOT NULL,
  lugar varchar(255) NOT NULL,
  created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,

  PRIMARY KEY (id_entrada)
) ENGINE=InnoDB;



CREATE TABLE IF NOT EXISTS alertas (
  id_alerta int NOT NULL AUTO_INCREMENT,
  mensaje varchar(255) NOT NULL,
  id_profesor int NOT NULL,
  created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,

  PRIMARY KEY (id_alerta),
  FOREIGN KEY (id_profesor) REFERENCES profesores(id_profesor)
  ON DELETE CASCADE
) ENGINE=InnoDB;




-- --------------------------------------------------------
-- Estructura de tabla para la tabla permiso
--

-- CREATE TABLE IF NOT EXISTS permisos (
--   id int NOT NULL AUTO_INCREMENT,
--   nombre varchar(20) NOT NULL UNIQUE,
--   PRIMARY KEY (id)
-- )ENGINE=InnoDB;


-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla rol_permiso
--

-- CREATE TABLE IF NOT EXISTS rol_permiso (
--  id_rol int NOT NULL ,
--  id_permiso int NOT NULL,
--  PRIMARY KEY (id_rol, id_permiso),
--  KEY id_rol(id_rol),
--  CONSTRAINT rol2
--  FOREIGN KEY (id_rol) REFERENCES roles(id),
--  KEY id_permiso(id_permiso),
--  CONSTRAINT permiso2
--  FOREIGN KEY (id_permiso) REFERENCES permisos(id)
--  ON DELETE CASCADE
-- )ENGINE=InnoDB;

-- --------------------------------------------------------
