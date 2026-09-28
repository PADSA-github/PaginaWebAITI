-- ==========================================================
-- ESTRUCTURA Y CATÁLOGO DE EVALUACIONES TÉCNICAS MULTI-LENGUAJE
-- Proyecto: PaginaWebAITI / Módulo Examen Técnico
-- ==========================================================

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------------------------------------
-- 1. TABLA: lenguajes_examen
-- ----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `lenguajes_examen` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `clave` VARCHAR(50) UNIQUE NOT NULL,
  `nombre` VARCHAR(100) NOT NULL,
  `descripcion` TEXT,
  `icono` VARCHAR(100) DEFAULT 'bi-code-slash',
  `color` VARCHAR(20) DEFAULT '#073E63',
  `badge` VARCHAR(50) DEFAULT 'Tecnología',
  `activo` TINYINT(1) DEFAULT 1,
  `fecha_creacion` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `lenguajes_examen` (`clave`, `nombre`, `descripcion`, `icono`, `color`, `badge`, `activo`) VALUES
('java', 'Java (Core, JVM & Spring)', 'Evaluación de Core Java, Programación Orientada a Objetos, Colecciones, Concurrencia, Memoria JVM y Arquitectura.', 'bi-cup-hot-fill', '#E76F00', 'Backend & Enterprise', 1),
('react', 'React.js & Modern Frontend', 'Evaluación técnica de Hooks, Reconciliación Virtual DOM, Gestión de Estado, Server Components y Performance.', 'bi-atom', '#087ea4', 'Frontend & Web', 1),
('cobol', 'COBOL & Mainframe Systems', 'Evaluación de Divisiones, Cláusulas PIC, Manejo de Archivos VSAM, Monitores CICS, DB2 SQL y Optimización MIPS.', 'bi-terminal-fill', '#073E63', 'Mainframe & Legacy', 1)
ON DUPLICATE KEY UPDATE nombre=VALUES(nombre), descripcion=VALUES(descripcion);

-- ----------------------------------------------------------
-- 2. TABLA: preguntas_examen
-- ----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `preguntas_examen` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `lenguaje` VARCHAR(50) NOT NULL,
  `pregunta` TEXT NOT NULL,
  `opcion_a` TEXT NOT NULL,
  `opcion_b` TEXT NOT NULL,
  `opcion_c` TEXT NOT NULL,
  `opcion_d` TEXT NOT NULL,
  `respuesta_correcta` CHAR(1) NOT NULL,
  `complejidad` ENUM('Junior', 'Semi-Senior', 'Senior', 'Experto') NOT NULL,
  `explicacion` TEXT NULL,
  `activo` TINYINT(1) DEFAULT 1,
  `fecha_creacion` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX `idx_lenguaje_complejidad` (`lenguaje`, `complejidad`, `activo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Nota: Para poblar o regenerar las 300 preguntas automáticamente con codificación limpia UTF-8,
-- ejecutar directamente en el navegador o consola: php examen/instalar_db.php
SET FOREIGN_KEY_CHECKS = 1;
