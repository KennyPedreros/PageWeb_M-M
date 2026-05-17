-- ============================================
-- Base de datos: Automotriz M & M
-- ============================================

CREATE DATABASE IF NOT EXISTS automotriz_mm
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE automotriz_mm;

-- Tabla para los mensajes del formulario de contacto
CREATE TABLE IF NOT EXISTS contactos (
  id              INT UNSIGNED NOT NULL AUTO_INCREMENT,
  nombre          VARCHAR(100)  NOT NULL,
  telefono        VARCHAR(20)   NOT NULL,
  servicio        VARCHAR(150)  NOT NULL,
  mensaje         TEXT          NOT NULL,
  ip              VARCHAR(45)   DEFAULT NULL,
  fecha_envio     TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  INDEX idx_fecha (fecha_envio)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
