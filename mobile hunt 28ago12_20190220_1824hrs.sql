SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `tecnejal_mobileHunt` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
USE `tecnejal_mobileHunt` ;

-- -----------------------------------------------------
-- Table `tecnejal_mobileHunt`.`dbdesigner4`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `tecnejal_mobileHunt`.`dbdesigner4` (
  `idmodel` INT(10) UNSIGNED NOT NULL ,
  `idversion` INT(10) UNSIGNED NOT NULL ,
  `name` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  `version` VARCHAR(20) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  `username` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  `createdate` DATETIME NULL DEFAULT NULL ,
  `iscurrent` INT(1) UNSIGNED NULL DEFAULT NULL ,
  `ischeckedout` INT(1) UNSIGNED NULL DEFAULT NULL ,
  `info` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  `model` MEDIUMTEXT CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  PRIMARY KEY (`idmodel`, `idversion`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `tecnejal_mobileHunt`.`puntos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `tecnejal_mobileHunt`.`puntos` (
  `idpuntos` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `usuarios_idUsuarios` INT(10) UNSIGNED NOT NULL ,
  `latitud` DOUBLE NOT NULL ,
  `longitud` DOUBLE NOT NULL ,
  `fecha` DATETIME NOT NULL ,
  `provider` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  PRIMARY KEY (`idpuntos`) ,
  INDEX `Posiciones_FKIndex1` (`usuarios_idUsuarios` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 4201
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `tecnejal_mobileHunt`.`usuarios`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `tecnejal_mobileHunt`.`usuarios` (
  `idusuarios` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `institucion_idinstitucion` INT(10) UNSIGNED NOT NULL ,
  `usuario` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  `descripcion` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  `muestreo` INT(10) UNSIGNED NOT NULL ,
  `psw_usr` INT(10) UNSIGNED NOT NULL ,
  `mail` VARCHAR(40) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL DEFAULT 'raymundoc.vela@hotmail.com' ,
  `restriccion` LONGTEXT CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL ,
  `puntos_idpuntos` INT(10) UNSIGNED NOT NULL ,
  PRIMARY KEY (`idusuarios`) ,
  INDEX `usuarios_FKIndex1` (`institucion_idinstitucion` ASC) ,
  INDEX `fk_usuarios_puntos1` (`puntos_idpuntos` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 63
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
COMMENT = '02Jul12 agregamos columna restriccion para guardar el javasc';


-- -----------------------------------------------------
-- Table `tecnejal_mobileHunt`.`institucion`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `tecnejal_mobileHunt`.`institucion` (
  `idinstitucion` INT(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  `usuarios_idusuarios` INT(10) UNSIGNED NOT NULL ,
  PRIMARY KEY (`idinstitucion`) ,
  INDEX `fk_institucion_usuarios` (`usuarios_idusuarios` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 18
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
