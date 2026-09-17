-- ==========================================================
-- SIAFE - Migración: Planes y Suscripciones
-- Ejecutar este script DESPUÉS de tener importada la base
-- de datos principal (siafe_antes_proveedores_compras.sql)
-- ==========================================================

-- --------------------------------------------------------
-- Tabla: planes
-- Catálogo de planes comerciales que se muestran en la
-- página pública y se eligen durante el registro.
-- --------------------------------------------------------

CREATE TABLE `planes` (
  `id_plan` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre_plan` VARCHAR(100) NOT NULL,
  `descripcion_plan` VARCHAR(255) DEFAULT NULL,
  `precio_mensual` DECIMAL(10,2) NOT NULL,
  `precio_anual` DECIMAL(10,2) NOT NULL,
  `max_usuarios` INT(10) UNSIGNED DEFAULT NULL COMMENT 'NULL = usuarios ilimitados',
  `caracteristicas` TEXT NOT NULL COMMENT 'Una característica por línea',
  `destacado` ENUM('Si','No') NOT NULL DEFAULT 'No',
  `orden` INT(10) UNSIGNED NOT NULL DEFAULT 0,
  `estado_plan` ENUM('Activo','Inactivo') NOT NULL DEFAULT 'Activo',
  `fecha_creacion` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_plan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------
-- Tabla: suscripciones
-- Registra qué plan tiene contratado cada empresa y por
-- cuánto tiempo (esto es lo que responde "por el tiempo
-- que quiera" del registro: mensual o anual).
-- --------------------------------------------------------

CREATE TABLE `suscripciones` (
  `id_suscripcion` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_empresa` INT(10) UNSIGNED NOT NULL,
  `id_plan` INT(10) UNSIGNED NOT NULL,
  `ciclo_facturacion` ENUM('Mensual','Anual') NOT NULL,
  `precio_pagado` DECIMAL(10,2) NOT NULL,
  `fecha_inicio` DATE NOT NULL,
  `fecha_fin` DATE NOT NULL,
  `estado_suscripcion` ENUM('Activa','Vencida','Cancelada') NOT NULL DEFAULT 'Activa',
  `fecha_creacion` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_suscripcion`),
  KEY `fk_suscripcion_empresa` (`id_empresa`),
  KEY `fk_suscripcion_plan` (`id_plan`),
  CONSTRAINT `fk_suscripcion_empresa` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id_empresa`),
  CONSTRAINT `fk_suscripcion_plan` FOREIGN KEY (`id_plan`) REFERENCES `planes` (`id_plan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------
-- Planes de ejemplo (ajusta nombres, precios y
-- características a lo que realmente vas a ofrecer)
-- --------------------------------------------------------

INSERT INTO `planes`
    (`nombre_plan`, `descripcion_plan`, `precio_mensual`, `precio_anual`, `max_usuarios`, `caracteristicas`, `destacado`, `orden`, `estado_plan`)
VALUES
(
    'Básico',
    'Para negocios que están empezando a organizar sus ventas y finanzas.',
    49000.00,
    470000.00,
    1,
    'Registro de ventas y clientes\nControl de productos e inventario\nReportes básicos\n1 usuario incluido',
    'No',
    1,
    'Activo'
),
(
    'Profesional',
    'Para empresas que ya necesitan controlar ingresos, gastos y presupuesto.',
    99000.00,
    950000.00,
    5,
    'Todo lo del plan Básico\nControl de ingresos y gastos\nPresupuestos por período\nIndicadores financieros\nHasta 5 usuarios',
    'Si',
    2,
    'Activo'
),
(
    'Empresarial',
    'Para empresas que quieren aprovechar el análisis inteligente de SIAFE.',
    189000.00,
    1810000.00,
    NULL,
    'Todo lo del plan Profesional\nGestión de proveedores\nAnálisis Inteligente (IA) de la empresa\nUsuarios ilimitados\nSoporte prioritario',
    'No',
    3,
    'Activo'
);
