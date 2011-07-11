SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

DROP SCHEMA IF EXISTS `subastas` ;
CREATE SCHEMA IF NOT EXISTS `subastas` DEFAULT CHARACTER SET utf8 ;
USE `subastas` ;

-- -----------------------------------------------------
-- Table `subastas`.`tipo_subastas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `subastas`.`tipo_subastas` ;

CREATE  TABLE IF NOT EXISTS `subastas`.`tipo_subastas` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NULL ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `subastas`.`estados_subastas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `subastas`.`estados_subastas` ;

CREATE  TABLE IF NOT EXISTS `subastas`.`estados_subastas` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NOT NULL ,
  `created` DATETIME NULL ,
  `udpated` DATETIME NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;

CREATE UNIQUE INDEX `nombre_UNIQUE` ON `subastas`.`estados_subastas` (`nombre` ASC) ;


-- -----------------------------------------------------
-- Table `subastas`.`subastas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `subastas`.`subastas` ;

CREATE  TABLE IF NOT EXISTS `subastas`.`subastas` (
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
    REFERENCES `subastas`.`tipo_subastas` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_subastas_estados_subastas1`
    FOREIGN KEY (`estados_subasta_id` )
    REFERENCES `subastas`.`estados_subastas` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_subastas_tipo_subastas_INDEX` ON `subastas`.`subastas` (`tipo_subasta_id` ASC) ;

CREATE INDEX `fk_subastas_estados_subastas_INDEX` ON `subastas`.`subastas` (`estados_subasta_id` ASC) ;


-- -----------------------------------------------------
-- Table `subastas`.`roles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `subastas`.`roles` ;

CREATE  TABLE IF NOT EXISTS `subastas`.`roles` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `subastas`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `subastas`.`users` ;

CREATE  TABLE IF NOT EXISTS `subastas`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `role_id` INT(11) NOT NULL DEFAULT 2 ,
  `username` VARCHAR(45) NOT NULL ,
  `password` VARCHAR(45) NOT NULL ,
  `email` VARCHAR(45) NOT NULL ,
  `creditos` INT NOT NULL DEFAULT 0 ,
  `bonos` INT NOT NULL DEFAULT 0 ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_users_roles1`
    FOREIGN KEY (`role_id` )
    REFERENCES `subastas`.`roles` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_users_roles_INDEX` ON `subastas`.`users` (`role_id` ASC) ;

CREATE UNIQUE INDEX `id_UNIQUE` ON `subastas`.`users` (`id` ASC) ;

CREATE UNIQUE INDEX `email_UNIQUE` ON `subastas`.`users` (`email` ASC) ;


-- -----------------------------------------------------
-- Table `subastas`.`ofertas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `subastas`.`ofertas` ;

CREATE  TABLE IF NOT EXISTS `subastas`.`ofertas` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `subasta_id` INT NULL ,
  `user_id` INT NULL ,
  `creditos_descontados` INT NULL ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `ofertadelasubasta`
    FOREIGN KEY (`subasta_id` )
    REFERENCES `subastas`.`subastas` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `ofertadelusuario`
    FOREIGN KEY (`user_id` )
    REFERENCES `subastas`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `ofertadelasubasta_INDEX` ON `subastas`.`ofertas` (`subasta_id` ASC) ;

CREATE INDEX `ofertadelusuario_INDEX` ON `subastas`.`ofertas` (`user_id` ASC) ;


-- -----------------------------------------------------
-- Table `subastas`.`estados_ventas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `subastas`.`estados_ventas` ;

CREATE  TABLE IF NOT EXISTS `subastas`.`estados_ventas` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NOT NULL ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;

CREATE UNIQUE INDEX `nombre_UNIQUE` ON `subastas`.`estados_ventas` (`nombre` ASC) ;


-- -----------------------------------------------------
-- Table `subastas`.`ventas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `subastas`.`ventas` ;

CREATE  TABLE IF NOT EXISTS `subastas`.`ventas` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `subasta_id` INT NOT NULL ,
  `user_id` INT NOT NULL ,
  `estados_venta_id` INT NOT NULL ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `usuarioquecompra`
    FOREIGN KEY (`user_id` )
    REFERENCES `subastas`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ventas_subastas1`
    FOREIGN KEY (`subasta_id` )
    REFERENCES `subastas`.`subastas` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ventas_estados_ventas1`
    FOREIGN KEY (`estados_venta_id` )
    REFERENCES `subastas`.`estados_ventas` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `usuarioquecompra_INDEX` ON `subastas`.`ventas` (`user_id` ASC) ;

CREATE INDEX `fk_ventas_subastas_INDEX` ON `subastas`.`ventas` (`subasta_id` ASC) ;

CREATE INDEX `fk_ventas_estados_ventas_INDEX` ON `subastas`.`ventas` (`estados_venta_id` ASC) ;


-- -----------------------------------------------------
-- Table `subastas`.`contacts`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `subastas`.`contacts` ;

CREATE  TABLE IF NOT EXISTS `subastas`.`contacts` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `lista_de_correo` TEXT NULL ,
  `contact_id` INT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `subastas`.`contacts_fields`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `subastas`.`contacts_fields` ;

CREATE  TABLE IF NOT EXISTS `subastas`.`contacts_fields` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `contact_id` INT NULL ,
  `nombre` VARCHAR(50) NULL ,
  `tipo` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `perteneceacontact`
    FOREIGN KEY (`contact_id` )
    REFERENCES `subastas`.`contacts` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `contact_fields_contacts_INDEX` ON `subastas`.`contacts_fields` (`contact_id` ASC) ;


-- -----------------------------------------------------
-- Table `subastas`.`options`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `subastas`.`options` ;

CREATE  TABLE IF NOT EXISTS `subastas`.`options` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `contact_field_id` INT NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `contactfieldoption`
    FOREIGN KEY (`contact_field_id` )
    REFERENCES `subastas`.`contacts_fields` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `contactfieldoption_INDEX` ON `subastas`.`options` (`contact_field_id` ASC) ;


-- -----------------------------------------------------
-- Table `subastas`.`testimonios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `subastas`.`testimonios` ;

CREATE  TABLE IF NOT EXISTS `subastas`.`testimonios` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `imagen_path` VARCHAR(100) NULL ,
  `titulo` VARCHAR(45) NULL ,
  `texto` TEXT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `subastas`.`batch_codes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `subastas`.`batch_codes` ;

CREATE  TABLE IF NOT EXISTS `subastas`.`batch_codes` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NULL ,
  `descripcion` TEXT NULL ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `subastas`.`codes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `subastas`.`codes` ;

CREATE  TABLE IF NOT EXISTS `subastas`.`codes` (
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
    REFERENCES `subastas`.`batch_codes` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `batch_code_INDEX` ON `subastas`.`codes` (`batch_code_id` ASC) ;

CREATE UNIQUE INDEX `codigo_UNIQUE` ON `subastas`.`codes` (`codigo` ASC) ;


-- -----------------------------------------------------
-- Table `subastas`.`acos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `subastas`.`acos` ;

CREATE  TABLE IF NOT EXISTS `subastas`.`acos` (
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
-- Table `subastas`.`aros`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `subastas`.`aros` ;

CREATE  TABLE IF NOT EXISTS `subastas`.`aros` (
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
-- Table `subastas`.`aros_acos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `subastas`.`aros_acos` ;

CREATE  TABLE IF NOT EXISTS `subastas`.`aros_acos` (
  `id` INT(10) NOT NULL AUTO_INCREMENT ,
  `aro_id` INT(10) NOT NULL ,
  `aco_id` INT(10) NOT NULL ,
  `_create` VARCHAR(2) NOT NULL DEFAULT '0' ,
  `_read` VARCHAR(2) NOT NULL DEFAULT '0' ,
  `_update` VARCHAR(2) NOT NULL DEFAULT '0' ,
  `_delete` VARCHAR(2) NOT NULL DEFAULT '0' ,
  PRIMARY KEY (`id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1;

CREATE UNIQUE INDEX `ARO_ACO_KEY` ON `subastas`.`aros_acos` (`aro_id` ASC, `aco_id` ASC) ;


-- -----------------------------------------------------
-- Table `subastas`.`pages`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `subastas`.`pages` ;

CREATE  TABLE IF NOT EXISTS `subastas`.`pages` (
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
-- Table `subastas`.`user_fields`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `subastas`.`user_fields` ;

CREATE  TABLE IF NOT EXISTS `subastas`.`user_fields` (
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
  CONSTRAINT `userfileds0`
    FOREIGN KEY (`user_id` )
    REFERENCES `subastas`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

CREATE INDEX `userfileds` ON `subastas`.`user_fields` (`user_id` ASC) ;


-- -----------------------------------------------------
-- Table `subastas`.`configs`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `subastas`.`configs` ;

CREATE  TABLE IF NOT EXISTS `subastas`.`configs` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `tamano_cola` INT NOT NULL ,
  `creditos_recomendados` INT NOT NULL ,
  `congelado` TINYINT(1) NOT NULL ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `subastas`.`lista_correos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `subastas`.`lista_correos` ;

CREATE  TABLE IF NOT EXISTS `subastas`.`lista_correos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `correo` VARCHAR(45) NOT NULL ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;

CREATE UNIQUE INDEX `correo_UNIQUE` ON `subastas`.`lista_correos` (`correo` ASC) ;


-- -----------------------------------------------------
-- Table `subastas`.`paquetes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `subastas`.`paquetes` ;

CREATE  TABLE IF NOT EXISTS `subastas`.`paquetes` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(40) NOT NULL ,
  `estado` TINYINT(1) NOT NULL COMMENT 'redimino,sin_redimir,vencido' ,
  `creditos` INT NOT NULL ,
  `precio` INT NOT NULL ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;

CREATE UNIQUE INDEX `codigo_UNIQUE` ON `subastas`.`paquetes` (`nombre` ASC) ;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `subastas`.`tipo_subastas`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `subastas`;
INSERT INTO `subastas`.`tipo_subastas` (`id`, `nombre`, `created`, `updated`) VALUES (1, 'Venta Fija', NULL, NULL);
INSERT INTO `subastas`.`tipo_subastas` (`id`, `nombre`, `created`, `updated`) VALUES (2, 'Minimo De Creditos', NULL, NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `subastas`.`estados_subastas`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `subastas`;
INSERT INTO `subastas`.`estados_subastas` (`id`, `nombre`, `created`, `udpated`) VALUES (1, 'Esperando Activacion', NULL, NULL);
INSERT INTO `subastas`.`estados_subastas` (`id`, `nombre`, `created`, `udpated`) VALUES (2, 'Activa', NULL, NULL);
INSERT INTO `subastas`.`estados_subastas` (`id`, `nombre`, `created`, `udpated`) VALUES (3, 'Pendiente De Pago', NULL, NULL);
INSERT INTO `subastas`.`estados_subastas` (`id`, `nombre`, `created`, `udpated`) VALUES (4, 'Vencida', NULL, NULL);
INSERT INTO `subastas`.`estados_subastas` (`id`, `nombre`, `created`, `udpated`) VALUES (5, 'Cancelada', NULL, NULL);
INSERT INTO `subastas`.`estados_subastas` (`id`, `nombre`, `created`, `udpated`) VALUES (6, 'Cerrada', NULL, NULL);
INSERT INTO `subastas`.`estados_subastas` (`id`, `nombre`, `created`, `udpated`) VALUES (7, 'Vendida', NULL, NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `subastas`.`roles`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `subastas`;
INSERT INTO `subastas`.`roles` (`id`, `name`) VALUES (1, 'Administrador');
INSERT INTO `subastas`.`roles` (`id`, `name`) VALUES (2, 'Usuario');

COMMIT;

-- -----------------------------------------------------
-- Data for table `subastas`.`users`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `subastas`;
INSERT INTO `subastas`.`users` (`id`, `role_id`, `username`, `password`, `email`, `creditos`, `bonos`, `created`, `updated`) VALUES (1, 1, 'admin', '59071c7c06ccba704236d2e76b5588c8e404160a', 'admin@llevatelos.com', 20000, 500, NULL, NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `subastas`.`estados_ventas`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `subastas`;
INSERT INTO `subastas`.`estados_ventas` (`id`, `nombre`, `created`, `updated`) VALUES (1, 'Pendiente De Pago', NULL, NULL);
INSERT INTO `subastas`.`estados_ventas` (`id`, `nombre`, `created`, `updated`) VALUES (2, 'Realizada', NULL, NULL);
INSERT INTO `subastas`.`estados_ventas` (`id`, `nombre`, `created`, `updated`) VALUES (3, 'No Realizada', NULL, NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `subastas`.`configs`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `subastas`;
INSERT INTO `subastas`.`configs` (`id`, `tamano_cola`, `creditos_recomendados`, `congelado`, `created`, `updated`) VALUES (1, 5, 500, 0, NULL, NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `subastas`.`lista_correos`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `subastas`;
INSERT INTO `subastas`.`lista_correos` (`id`, `correo`, `created`, `updated`) VALUES (1, 'ricardopandales@gmail.com', NULL, NULL);

COMMIT;
