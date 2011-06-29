SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

DROP SCHEMA IF EXISTS `llevatelos` ;
CREATE SCHEMA IF NOT EXISTS `llevatelos` DEFAULT CHARACTER SET utf8 ;
USE `llevatelos` ;

-- -----------------------------------------------------
-- Table `llevatelos`.`tipo_subastas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `llevatelos`.`tipo_subastas` ;

CREATE  TABLE IF NOT EXISTS `llevatelos`.`tipo_subastas` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NULL ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `llevatelos`.`estados_subastas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `llevatelos`.`estados_subastas` ;

CREATE  TABLE IF NOT EXISTS `llevatelos`.`estados_subastas` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NOT NULL ,
  `created` DATETIME NULL ,
  `udpated` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `nombre_UNIQUE` (`nombre` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `llevatelos`.`subastas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `llevatelos`.`subastas` ;

CREATE  TABLE IF NOT EXISTS `llevatelos`.`subastas` (
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
  INDEX `fk_subastas_tipo_subastas1` (`tipo_subasta_id` ASC) ,
  INDEX `fk_subastas_estados_subastas1` (`estados_subasta_id` ASC) ,
  CONSTRAINT `fk_subastas_tipo_subastas1`
    FOREIGN KEY (`tipo_subasta_id` )
    REFERENCES `llevatelos`.`tipo_subastas` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_subastas_estados_subastas1`
    FOREIGN KEY (`estados_subasta_id` )
    REFERENCES `llevatelos`.`estados_subastas` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `llevatelos`.`roles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `llevatelos`.`roles` ;

CREATE  TABLE IF NOT EXISTS `llevatelos`.`roles` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `llevatelos`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `llevatelos`.`users` ;

CREATE  TABLE IF NOT EXISTS `llevatelos`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `role_id` INT(11) NOT NULL DEFAULT 2 ,
  `username` VARCHAR(45) NOT NULL ,
  `password` VARCHAR(45) NOT NULL ,
  `email` VARCHAR(45) NOT NULL ,
  `creditos` INT NOT NULL DEFAULT 0 ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_users_roles1` (`role_id` ASC) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) ,
  CONSTRAINT `fk_users_roles1`
    FOREIGN KEY (`role_id` )
    REFERENCES `llevatelos`.`roles` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `llevatelos`.`ofertas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `llevatelos`.`ofertas` ;

CREATE  TABLE IF NOT EXISTS `llevatelos`.`ofertas` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `subasta_id` INT NULL ,
  `user_id` INT NULL ,
  `creditos_descontados` INT NULL ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `ofertadelasubasta` (`subasta_id` ASC) ,
  INDEX `ofertadelusuario` (`user_id` ASC) ,
  CONSTRAINT `ofertadelasubasta`
    FOREIGN KEY (`subasta_id` )
    REFERENCES `llevatelos`.`subastas` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `ofertadelusuario`
    FOREIGN KEY (`user_id` )
    REFERENCES `llevatelos`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `llevatelos`.`estados_ventas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `llevatelos`.`estados_ventas` ;

CREATE  TABLE IF NOT EXISTS `llevatelos`.`estados_ventas` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NOT NULL ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `nombre_UNIQUE` (`nombre` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `llevatelos`.`ventas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `llevatelos`.`ventas` ;

CREATE  TABLE IF NOT EXISTS `llevatelos`.`ventas` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `subasta_id` INT NOT NULL ,
  `user_id` INT NOT NULL ,
  `estados_venta_id` INT NOT NULL ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `usuarioquecompra` (`user_id` ASC) ,
  INDEX `fk_ventas_subastas1` (`subasta_id` ASC) ,
  INDEX `fk_ventas_estados_ventas1` (`estados_venta_id` ASC) ,
  CONSTRAINT `usuarioquecompra`
    FOREIGN KEY (`user_id` )
    REFERENCES `llevatelos`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ventas_subastas1`
    FOREIGN KEY (`subasta_id` )
    REFERENCES `llevatelos`.`subastas` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ventas_estados_ventas1`
    FOREIGN KEY (`estados_venta_id` )
    REFERENCES `llevatelos`.`estados_ventas` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `llevatelos`.`contacts`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `llevatelos`.`contacts` ;

CREATE  TABLE IF NOT EXISTS `llevatelos`.`contacts` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `lista_de_correo` TEXT NULL ,
  `contact_id` INT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `llevatelos`.`contacts_fields`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `llevatelos`.`contacts_fields` ;

CREATE  TABLE IF NOT EXISTS `llevatelos`.`contacts_fields` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `contact_id` INT NULL ,
  `nombre` VARCHAR(50) NULL ,
  `tipo` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `perteneceacontact` (`contact_id` ASC) ,
  CONSTRAINT `perteneceacontact`
    FOREIGN KEY (`contact_id` )
    REFERENCES `llevatelos`.`contacts` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `llevatelos`.`options`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `llevatelos`.`options` ;

CREATE  TABLE IF NOT EXISTS `llevatelos`.`options` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `contact_field_id` INT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `contactfieldoption` (`contact_field_id` ASC) ,
  CONSTRAINT `contactfieldoption`
    FOREIGN KEY (`contact_field_id` )
    REFERENCES `llevatelos`.`contacts_fields` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `llevatelos`.`testimonios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `llevatelos`.`testimonios` ;

CREATE  TABLE IF NOT EXISTS `llevatelos`.`testimonios` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `imagen_path` VARCHAR(100) NULL ,
  `titulo` VARCHAR(45) NULL ,
  `texto` TEXT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `llevatelos`.`batch_codes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `llevatelos`.`batch_codes` ;

CREATE  TABLE IF NOT EXISTS `llevatelos`.`batch_codes` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NULL ,
  `descripcion` TEXT NULL ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `llevatelos`.`codes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `llevatelos`.`codes` ;

CREATE  TABLE IF NOT EXISTS `llevatelos`.`codes` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `batch_code_id` INT NOT NULL ,
  `codigo` VARCHAR(40) NOT NULL ,
  `estado` TINYINT(1) NOT NULL COMMENT 'redimino,sin_redimir,vencido' ,
  `fecha_expiracion` DATE NOT NULL ,
  `creditos` INT NOT NULL ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `batch_code` (`batch_code_id` ASC) ,
  UNIQUE INDEX `codigo_UNIQUE` (`codigo` ASC) ,
  CONSTRAINT `batch_code`
    FOREIGN KEY (`batch_code_id` )
    REFERENCES `llevatelos`.`batch_codes` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `llevatelos`.`acos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `llevatelos`.`acos` ;

CREATE  TABLE IF NOT EXISTS `llevatelos`.`acos` (
  `id` INT(10) NOT NULL AUTO_INCREMENT ,
  `parent_id` INT(10) NULL DEFAULT NULL ,
  `model` VARCHAR(255) NULL DEFAULT NULL ,
  `foreign_key` INT(10) NULL DEFAULT NULL ,
  `alias` VARCHAR(255) NULL DEFAULT NULL ,
  `lft` INT(10) NULL DEFAULT NULL ,
  `rght` INT(10) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `llevatelos`.`aros`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `llevatelos`.`aros` ;

CREATE  TABLE IF NOT EXISTS `llevatelos`.`aros` (
  `id` INT(10) NOT NULL AUTO_INCREMENT ,
  `parent_id` INT(10) NULL DEFAULT NULL ,
  `model` VARCHAR(255) NULL DEFAULT NULL ,
  `foreign_key` INT(10) NULL DEFAULT NULL ,
  `alias` VARCHAR(255) NULL DEFAULT NULL ,
  `lft` INT(10) NULL DEFAULT NULL ,
  `rght` INT(10) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `llevatelos`.`aros_acos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `llevatelos`.`aros_acos` ;

CREATE  TABLE IF NOT EXISTS `llevatelos`.`aros_acos` (
  `id` INT(10) NOT NULL AUTO_INCREMENT ,
  `aro_id` INT(10) NOT NULL ,
  `aco_id` INT(10) NOT NULL ,
  `_create` VARCHAR(2) NOT NULL DEFAULT '0' ,
  `_read` VARCHAR(2) NOT NULL DEFAULT '0' ,
  `_update` VARCHAR(2) NOT NULL DEFAULT '0' ,
  `_delete` VARCHAR(2) NOT NULL DEFAULT '0' ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `ARO_ACO_KEY` (`aro_id` ASC, `aco_id` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `llevatelos`.`pages`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `llevatelos`.`pages` ;

CREATE  TABLE IF NOT EXISTS `llevatelos`.`pages` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(45) NULL DEFAULT NULL ,
  `description` VARCHAR(45) NULL DEFAULT NULL ,
  `content` LONGTEXT NULL DEFAULT NULL ,
  `slug` VARCHAR(45) NULL ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `llevatelos`.`user_fields`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `llevatelos`.`user_fields` ;

CREATE  TABLE IF NOT EXISTS `llevatelos`.`user_fields` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `user_id` INT(11) NULL DEFAULT NULL ,
  `nombres` VARCHAR(45) NOT NULL ,
  `apellidos` VARCHAR(45) NOT NULL ,
  `cedula` INT NULL ,
  `fecha_de_nacimiento` DATE NULL ,
  `sexo` VARCHAR(45) NULL ,
  `email` VARCHAR(45) NULL ,
  `direccion` VARCHAR(45) NULL ,
  `ciudad` VARCHAR(45) NULL ,
  `telefono_fijo` INT NULL ,
  `ocupacion` VARCHAR(45) NULL ,
  `lugar_ocupacion` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `userfileds` (`user_id` ASC) ,
  CONSTRAINT `userfileds0`
    FOREIGN KEY (`user_id` )
    REFERENCES `llevatelos`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `llevatelos`.`configs`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `llevatelos`.`configs` ;

CREATE  TABLE IF NOT EXISTS `llevatelos`.`configs` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `tamano_cola` INT NOT NULL ,
  `creditos_recomendados` INT NOT NULL ,
  `congelado` TINYINT(1) NOT NULL ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `llevatelos`.`lista_correos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `llevatelos`.`lista_correos` ;

CREATE  TABLE IF NOT EXISTS `llevatelos`.`lista_correos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `correo` VARCHAR(45) NOT NULL ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `correo_UNIQUE` (`correo` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `llevatelos`.`paquetes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `llevatelos`.`paquetes` ;

CREATE  TABLE IF NOT EXISTS `llevatelos`.`paquetes` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(40) NOT NULL ,
  `estado` TINYINT(1) NOT NULL COMMENT 'redimino,sin_redimir,vencido' ,
  `creditos` INT NOT NULL ,
  `precio` INT NOT NULL ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `codigo_UNIQUE` (`nombre` ASC) )
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `llevatelos`.`tipo_subastas`
-- -----------------------------------------------------
START TRANSACTION;
USE `llevatelos`;
INSERT INTO `llevatelos`.`tipo_subastas` (`id`, `nombre`, `created`, `updated`) VALUES (1, 'Venta Fija', NULL, NULL);
INSERT INTO `llevatelos`.`tipo_subastas` (`id`, `nombre`, `created`, `updated`) VALUES (2, 'Minimo De Creditos', NULL, NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `llevatelos`.`estados_subastas`
-- -----------------------------------------------------
START TRANSACTION;
USE `llevatelos`;
INSERT INTO `llevatelos`.`estados_subastas` (`id`, `nombre`, `created`, `udpated`) VALUES (1, 'Esperando Activacion', NULL, NULL);
INSERT INTO `llevatelos`.`estados_subastas` (`id`, `nombre`, `created`, `udpated`) VALUES (2, 'Activa', NULL, NULL);
INSERT INTO `llevatelos`.`estados_subastas` (`id`, `nombre`, `created`, `udpated`) VALUES (3, 'Pendiente De Pago', NULL, NULL);
INSERT INTO `llevatelos`.`estados_subastas` (`id`, `nombre`, `created`, `udpated`) VALUES (4, 'Vencida', NULL, NULL);
INSERT INTO `llevatelos`.`estados_subastas` (`id`, `nombre`, `created`, `udpated`) VALUES (5, 'Cancelada', NULL, NULL);
INSERT INTO `llevatelos`.`estados_subastas` (`id`, `nombre`, `created`, `udpated`) VALUES (6, 'Cerrada', NULL, NULL);
INSERT INTO `llevatelos`.`estados_subastas` (`id`, `nombre`, `created`, `udpated`) VALUES (7, 'Vendida', NULL, NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `llevatelos`.`roles`
-- -----------------------------------------------------
START TRANSACTION;
USE `llevatelos`;
INSERT INTO `llevatelos`.`roles` (`id`, `name`) VALUES (1, 'Administrador');
INSERT INTO `llevatelos`.`roles` (`id`, `name`) VALUES (2, 'Usuario');

COMMIT;

-- -----------------------------------------------------
-- Data for table `llevatelos`.`users`
-- -----------------------------------------------------
START TRANSACTION;
USE `llevatelos`;
INSERT INTO `llevatelos`.`users` (`id`, `role_id`, `username`, `password`, `email`, `creditos`, `created`, `updated`) VALUES (1, 1, 'admin', '59071c7c06ccba704236d2e76b5588c8e404160a', 'admin@llevatelos.com', 0, NULL, NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `llevatelos`.`estados_ventas`
-- -----------------------------------------------------
START TRANSACTION;
USE `llevatelos`;
INSERT INTO `llevatelos`.`estados_ventas` (`id`, `nombre`, `created`, `updated`) VALUES (1, 'Pendiente De Pago', NULL, NULL);
INSERT INTO `llevatelos`.`estados_ventas` (`id`, `nombre`, `created`, `updated`) VALUES (2, 'Realizada', NULL, NULL);
INSERT INTO `llevatelos`.`estados_ventas` (`id`, `nombre`, `created`, `updated`) VALUES (3, 'No Realizada', NULL, NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `llevatelos`.`configs`
-- -----------------------------------------------------
START TRANSACTION;
USE `llevatelos`;
INSERT INTO `llevatelos`.`configs` (`id`, `tamano_cola`, `creditos_recomendados`, `congelado`, `created`, `updated`) VALUES (1, 5, 500, 0, NULL, NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `llevatelos`.`lista_correos`
-- -----------------------------------------------------
START TRANSACTION;
USE `llevatelos`;
INSERT INTO `llevatelos`.`lista_correos` (`id`, `correo`, `created`, `updated`) VALUES (1, 'ricardopandales@gmail.com', NULL, NULL);

COMMIT;
