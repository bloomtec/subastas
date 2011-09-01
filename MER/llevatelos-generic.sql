SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';


-- -----------------------------------------------------
-- Table `tipo_subastas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tipo_subastas` ;

CREATE  TABLE IF NOT EXISTS `tipo_subastas` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NULL ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `estados_subastas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `estados_subastas` ;

CREATE  TABLE IF NOT EXISTS `estados_subastas` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NOT NULL ,
  `created` DATETIME NULL ,
  `udpated` DATETIME NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;

CREATE UNIQUE INDEX `nombre_UNIQUE` ON `estados_subastas` (`nombre` ASC) ;


-- -----------------------------------------------------
-- Table `subastas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `subastas` ;

CREATE  TABLE IF NOT EXISTS `subastas` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `tipo_subasta_id` INT NOT NULL ,
  `estados_subasta_id` INT NOT NULL ,
  `nombre` VARCHAR(45) NOT NULL ,
  `descripcion` TEXT NOT NULL ,
  `imagen_path` VARCHAR(100) NOT NULL ,
  `valor` VARCHAR(45) NOT NULL ,
  `umbral_minimo_creditos` INT NOT NULL COMMENT 'miimo de creditos para que se venda' ,
  `cantidad_creditos_puja` INT NOT NULL ,
  `precio` INT NOT NULL ,
  `aumento_precio` INT NOT NULL ,
  `dias_espera` INT NOT NULL COMMENT 'dias que se espera para la venta' ,
  `posicion_en_cola` INT NOT NULL ,
  `duracion_inicial` INT NOT NULL ,
  `aumento_duracion` INT NOT NULL ,
  `fecha_de_venta` DATETIME NULL ,
  `contenido_pagina` LONGTEXT NULL COMMENT 'html pagina producto' ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_subastas_tipo_subastas1`
    FOREIGN KEY (`tipo_subasta_id` )
    REFERENCES `tipo_subastas` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_subastas_estados_subastas1`
    FOREIGN KEY (`estados_subasta_id` )
    REFERENCES `estados_subastas` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_subastas_tipo_subastas_INDEX` ON `subastas` (`tipo_subasta_id` ASC) ;

CREATE INDEX `fk_subastas_estados_subastas_INDEX` ON `subastas` (`estados_subasta_id` ASC) ;


-- -----------------------------------------------------
-- Table `roles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `roles` ;

CREATE  TABLE IF NOT EXISTS `roles` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `users` ;

CREATE  TABLE IF NOT EXISTS `users` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `role_id` INT(11) NOT NULL DEFAULT 2 ,
  `username` VARCHAR(45) NOT NULL ,
  `password` VARCHAR(45) NOT NULL ,
  `email` VARCHAR(45) NOT NULL ,
  `creditos` INT NOT NULL DEFAULT 0 ,
  `bonos` INT NOT NULL DEFAULT 0 ,
  `datos_ingresados` TINYINT(1) NOT NULL DEFAULT 0 ,
  `email_validado` TINYINT(1) NOT NULL DEFAULT 0 ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_users_roles1`
    FOREIGN KEY (`role_id` )
    REFERENCES `roles` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_users_roles_INDEX` ON `users` (`role_id` ASC) ;

CREATE UNIQUE INDEX `id_UNIQUE` ON `users` (`id` ASC) ;

CREATE UNIQUE INDEX `email_UNIQUE` ON `users` (`email` ASC) ;


-- -----------------------------------------------------
-- Table `ofertas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ofertas` ;

CREATE  TABLE IF NOT EXISTS `ofertas` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `subasta_id` INT NOT NULL ,
  `user_id` INT NOT NULL ,
  `creditos_descontados` INT NOT NULL ,
  `bonos_descontados` INT NOT NULL ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `ofertadelasubasta`
    FOREIGN KEY (`subasta_id` )
    REFERENCES `subastas` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `ofertadelusuario`
    FOREIGN KEY (`user_id` )
    REFERENCES `users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `ofertadelasubasta_INDEX` ON `ofertas` (`subasta_id` ASC) ;

CREATE INDEX `ofertadelusuario_INDEX` ON `ofertas` (`user_id` ASC) ;


-- -----------------------------------------------------
-- Table `estados_ventas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `estados_ventas` ;

CREATE  TABLE IF NOT EXISTS `estados_ventas` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NOT NULL ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;

CREATE UNIQUE INDEX `nombre_UNIQUE` ON `estados_ventas` (`nombre` ASC) ;


-- -----------------------------------------------------
-- Table `ventas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ventas` ;

CREATE  TABLE IF NOT EXISTS `ventas` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `subasta_id` INT NOT NULL ,
  `user_id` INT NOT NULL ,
  `estados_venta_id` INT NOT NULL ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `usuarioquecompra`
    FOREIGN KEY (`user_id` )
    REFERENCES `users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ventas_subastas1`
    FOREIGN KEY (`subasta_id` )
    REFERENCES `subastas` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ventas_estados_ventas1`
    FOREIGN KEY (`estados_venta_id` )
    REFERENCES `estados_ventas` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `usuarioquecompra_INDEX` ON `ventas` (`user_id` ASC) ;

CREATE INDEX `fk_ventas_subastas_INDEX` ON `ventas` (`subasta_id` ASC) ;

CREATE INDEX `fk_ventas_estados_ventas_INDEX` ON `ventas` (`estados_venta_id` ASC) ;


-- -----------------------------------------------------
-- Table `contacts`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `contacts` ;

CREATE  TABLE IF NOT EXISTS `contacts` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `lista_de_correo` TEXT NULL ,
  `contact_id` INT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `contacts_fields`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `contacts_fields` ;

CREATE  TABLE IF NOT EXISTS `contacts_fields` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `contact_id` INT NULL ,
  `nombre` VARCHAR(50) NULL ,
  `tipo` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `perteneceacontact`
    FOREIGN KEY (`contact_id` )
    REFERENCES `contacts` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `contact_fields_contacts_INDEX` ON `contacts_fields` (`contact_id` ASC) ;


-- -----------------------------------------------------
-- Table `options`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `options` ;

CREATE  TABLE IF NOT EXISTS `options` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `contact_field_id` INT NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `contactfieldoption`
    FOREIGN KEY (`contact_field_id` )
    REFERENCES `contacts_fields` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `contactfieldoption_INDEX` ON `options` (`contact_field_id` ASC) ;


-- -----------------------------------------------------
-- Table `testimonios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `testimonios` ;

CREATE  TABLE IF NOT EXISTS `testimonios` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `imagen_path` VARCHAR(100) NULL ,
  `titulo` VARCHAR(45) NULL ,
  `texto` TEXT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `batch_codes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `batch_codes` ;

CREATE  TABLE IF NOT EXISTS `batch_codes` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NULL ,
  `descripcion` TEXT NULL ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `codes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `codes` ;

CREATE  TABLE IF NOT EXISTS `codes` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `batch_code_id` INT NOT NULL ,
  `codigo` VARCHAR(40) NOT NULL ,
  `estado` TINYINT(1) NOT NULL COMMENT 'redimino,sin_redimir,vencido' ,
  `fecha_expiracion` DATE NOT NULL ,
  `creditos` INT NOT NULL ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `batch_code`
    FOREIGN KEY (`batch_code_id` )
    REFERENCES `batch_codes` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `batch_code_INDEX` ON `codes` (`batch_code_id` ASC) ;

CREATE UNIQUE INDEX `codigo_UNIQUE` ON `codes` (`codigo` ASC) ;


-- -----------------------------------------------------
-- Table `acos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `acos` ;

CREATE  TABLE IF NOT EXISTS `acos` (
  `id` INT(10) NOT NULL AUTO_INCREMENT ,
  `parent_id` INT(10) NULL DEFAULT NULL ,
  `model` VARCHAR(255) NULL DEFAULT NULL ,
  `foreign_key` INT(10) NULL DEFAULT NULL ,
  `alias` VARCHAR(255) NULL DEFAULT NULL ,
  `lft` INT(10) NULL DEFAULT NULL ,
  `rght` INT(10) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `aros`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `aros` ;

CREATE  TABLE IF NOT EXISTS `aros` (
  `id` INT(10) NOT NULL AUTO_INCREMENT ,
  `parent_id` INT(10) NULL DEFAULT NULL ,
  `model` VARCHAR(255) NULL DEFAULT NULL ,
  `foreign_key` INT(10) NULL DEFAULT NULL ,
  `alias` VARCHAR(255) NULL DEFAULT NULL ,
  `lft` INT(10) NULL DEFAULT NULL ,
  `rght` INT(10) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `aros_acos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `aros_acos` ;

CREATE  TABLE IF NOT EXISTS `aros_acos` (
  `id` INT(10) NOT NULL AUTO_INCREMENT ,
  `aro_id` INT(10) NOT NULL ,
  `aco_id` INT(10) NOT NULL ,
  `_create` VARCHAR(2) NOT NULL DEFAULT '0' ,
  `_read` VARCHAR(2) NOT NULL DEFAULT '0' ,
  `_update` VARCHAR(2) NOT NULL DEFAULT '0' ,
  `_delete` VARCHAR(2) NOT NULL DEFAULT '0' ,
  PRIMARY KEY (`id`) )
ENGINE = MyISAM;

CREATE UNIQUE INDEX `ARO_ACO_KEY` ON `aros_acos` (`aro_id` ASC, `aco_id` ASC) ;


-- -----------------------------------------------------
-- Table `pages`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pages` ;

CREATE  TABLE IF NOT EXISTS `pages` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(45) NULL DEFAULT NULL ,
  `description` VARCHAR(45) NULL DEFAULT NULL ,
  `content` LONGTEXT NULL DEFAULT NULL ,
  `slug` VARCHAR(45) NULL ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `user_fields`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `user_fields` ;

CREATE  TABLE IF NOT EXISTS `user_fields` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `user_id` INT(11) NULL DEFAULT NULL ,
  `nombres` VARCHAR(45) NOT NULL ,
  `apellidos` VARCHAR(45) NOT NULL ,
  `cedula` INT NULL ,
  `fecha_de_nacimiento` DATE NULL ,
  `sexo` VARCHAR(45) NULL ,
  `direccion` VARCHAR(45) NULL ,
  `ciudad` VARCHAR(45) NULL ,
  `telefono_fijo` INT NULL ,
  `ocupacion` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `userfileds0`
    FOREIGN KEY (`user_id` )
    REFERENCES `users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `userfileds` ON `user_fields` (`user_id` ASC) ;


-- -----------------------------------------------------
-- Table `configs`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `configs` ;

CREATE  TABLE IF NOT EXISTS `configs` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `tamano_cola` INT NOT NULL ,
  `creditos_iniciales` INT NOT NULL ,
  `creditos_recomendados` INT NOT NULL ,
  `congelado` TINYINT(1) NOT NULL ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `lista_correos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `lista_correos` ;

CREATE  TABLE IF NOT EXISTS `lista_correos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `correo` VARCHAR(45) NOT NULL ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;

CREATE UNIQUE INDEX `correo_UNIQUE` ON `lista_correos` (`correo` ASC) ;


-- -----------------------------------------------------
-- Table `paquetes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `paquetes` ;

CREATE  TABLE IF NOT EXISTS `paquetes` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(40) NOT NULL ,
  `estado` TINYINT(1) NOT NULL COMMENT 'redimino,sin_redimir,vencido' ,
  `creditos` INT NOT NULL ,
  `precio` INT NOT NULL ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;

CREATE UNIQUE INDEX `codigo_UNIQUE` ON `paquetes` (`nombre` ASC) ;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `tipo_subastas`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `tipo_subastas` (`id`, `nombre`, `created`, `updated`) VALUES (1, 'Venta Fija', NULL, NULL);
INSERT INTO `tipo_subastas` (`id`, `nombre`, `created`, `updated`) VALUES (2, 'Minimo De Creditos', NULL, NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `estados_subastas`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `estados_subastas` (`id`, `nombre`, `created`, `udpated`) VALUES (1, 'Esperando Activacion', NULL, NULL);
INSERT INTO `estados_subastas` (`id`, `nombre`, `created`, `udpated`) VALUES (2, 'Activa', NULL, NULL);
INSERT INTO `estados_subastas` (`id`, `nombre`, `created`, `udpated`) VALUES (3, 'Pendiente De Pago', NULL, NULL);
INSERT INTO `estados_subastas` (`id`, `nombre`, `created`, `udpated`) VALUES (4, 'Vencida', NULL, NULL);
INSERT INTO `estados_subastas` (`id`, `nombre`, `created`, `udpated`) VALUES (5, 'Cancelada', NULL, NULL);
INSERT INTO `estados_subastas` (`id`, `nombre`, `created`, `udpated`) VALUES (6, 'Cerrada', NULL, NULL);
INSERT INTO `estados_subastas` (`id`, `nombre`, `created`, `udpated`) VALUES (7, 'Vendida', NULL, NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `roles`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `roles` (`id`, `name`) VALUES (1, 'Administrador');
INSERT INTO `roles` (`id`, `name`) VALUES (2, 'Usuario');

COMMIT;

-- -----------------------------------------------------
-- Data for table `users`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `users` (`id`, `role_id`, `username`, `password`, `email`, `creditos`, `bonos`, `datos_ingresados`, `email_validado`, `created`, `updated`) VALUES (1, 1, 'admin', '59071c7c06ccba704236d2e76b5588c8e404160a', 'admin@llevatelos.com', 20000, 500, 0, 1, NULL, NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `estados_ventas`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `estados_ventas` (`id`, `nombre`, `created`, `updated`) VALUES (1, 'Pendiente De Pago', NULL, NULL);
INSERT INTO `estados_ventas` (`id`, `nombre`, `created`, `updated`) VALUES (2, 'Realizada', NULL, NULL);
INSERT INTO `estados_ventas` (`id`, `nombre`, `created`, `updated`) VALUES (3, 'No Realizada', NULL, NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `configs`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `configs` (`id`, `tamano_cola`, `creditos_iniciales`, `creditos_recomendados`, `congelado`, `created`, `updated`) VALUES (1, 5, 10, 500, 0, NULL, NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `lista_correos`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `lista_correos` (`id`, `correo`, `created`, `updated`) VALUES (1, 'ricardopandales@gmail.com', NULL, NULL);

COMMIT;

