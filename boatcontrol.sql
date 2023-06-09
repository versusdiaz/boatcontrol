-- MySQL Script generated by MySQL Workbench
-- Sat Apr  1 09:12:55 2023
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema boatcontrol
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema boatcontrol
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `boatcontrol` DEFAULT CHARACTER SET utf8 ;
USE `boatcontrol` ;

-- -----------------------------------------------------
-- Table `boatcontrol`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `boatcontrol`.`usuarios` (
  `idusuario` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `login` VARCHAR(20) NOT NULL,
  `clave` VARCHAR(100) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `img` VARCHAR(45) NULL,
  `condicion` TINYINT NOT NULL DEFAULT 1,
  PRIMARY KEY (`idusuario`),
  UNIQUE INDEX `login_UNIQUE` (`login` ASC) ,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `boatcontrol`.`permisos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `boatcontrol`.`permisos` (
  `idpermisos` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idpermisos`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `boatcontrol`.`usuarios_permisos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `boatcontrol`.`usuarios_permisos` (
  `idusuarios_permisos` INT NOT NULL AUTO_INCREMENT,
  `idusuarios` INT NOT NULL,
  `idpermisos` INT NOT NULL,
  PRIMARY KEY (`idusuarios_permisos`),
  INDEX `fk_usuarios_permisos_usuarios_idx` (`idusuarios` ASC) ,
  INDEX `fk_usuarios_permisos_permisos_idx` (`idpermisos` ASC) ,
  CONSTRAINT `fk_usuarios_permisos_usuarios`
    FOREIGN KEY (`idusuarios`)
    REFERENCES `boatcontrol`.`usuarios` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuarios_permisos_permisos`
    FOREIGN KEY (`idpermisos`)
    REFERENCES `boatcontrol`.`permisos` (`idpermisos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `boatcontrol`.`centro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `boatcontrol`.`centro` (
  `idcentro` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `condicion` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idcentro`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `boatcontrol`.`formatos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `boatcontrol`.`formatos` (
  `idcalidad` INT NOT NULL,
  `titulo` VARCHAR(45) NULL,
  `codigo` VARCHAR(45) NOT NULL,
  `fecha` DATE NOT NULL,
  `revision` TINYINT(2) ZEROFILL NOT NULL,
  PRIMARY KEY (`idcalidad`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `boatcontrol`.`ods_mtto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `boatcontrol`.`ods_mtto` (
  `idods_mtto` INT NOT NULL AUTO_INCREMENT,
  `idcentro` INT NOT NULL,
  `codigo` VARCHAR(45) NOT NULL,
  `com_general` VARCHAR(255) NULL,
  `com_estado` VARCHAR(45) NULL,
  `com_falla` VARCHAR(45) NULL,
  `horas` INT(25) NOT NULL,
  `tipo` TINYINT(2) NOT NULL,
  `sistema` VARCHAR(45) NOT NULL,
  `tiempo_ino` INT(10) NOT NULL,
  `tiempo_mtto` INT(10) NOT NULL,
  `costo` INT NULL,
  `afectaservicio` TINYINT NOT NULL,
  `fecha` DATE NOT NULL,
  `condicion` TINYINT NOT NULL,
  PRIMARY KEY (`idods_mtto`),
  INDEX `fk_idcentro_idx` (`idcentro` ASC) ,
  CONSTRAINT `fk_ods_mtto_centro`
    FOREIGN KEY (`idcentro`)
    REFERENCES `boatcontrol`.`centro` (`idcentro`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `boatcontrol`.`act`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `boatcontrol`.`act` (
  `idact` INT NOT NULL AUTO_INCREMENT,
  `numact` INT NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `horas` INT NOT NULL,
  `tipo` TINYINT(2) NOT NULL,
  `materiales` VARCHAR(45) NULL,
  `repuestos` VARCHAR(45) NULL,
  `severidad` VARCHAR(45) NULL,
  `tolerancia` INT NULL,
  `condicion` TINYINT NOT NULL,
  PRIMARY KEY (`idact`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `boatcontrol`.`act_ods`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `boatcontrol`.`act_ods` (
  `idact_ods` INT NOT NULL AUTO_INCREMENT,
  `idact` INT NOT NULL,
  `idods_mtto` INT NOT NULL,
  `horasprox` VARCHAR(45) NOT NULL,
  `condicion` TINYINT NOT NULL,
  PRIMARY KEY (`idact_ods`),
  INDEX `fk_act_ods_idact_idx` (`idact` ASC) ,
  INDEX `fk_act_ods_ods_mtto_idx` (`idods_mtto` ASC) ,
  CONSTRAINT `fk_act_ods_act`
    FOREIGN KEY (`idact`)
    REFERENCES `boatcontrol`.`act` (`idact`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_act_ods_ods_mtto`
    FOREIGN KEY (`idods_mtto`)
    REFERENCES `boatcontrol`.`ods_mtto` (`idods_mtto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `boatcontrol`.`act_prox_centro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `boatcontrol`.`act_prox_centro` (
  `idact_prox_centro` INT NOT NULL AUTO_INCREMENT,
  `idact` INT NOT NULL,
  `idcentro` INT NOT NULL,
  `horasprox` INT NOT NULL,
  INDEX `fk_act_prox_centro_act_idx` (`idact` ASC) ,
  INDEX `fk_act_prox_centro_centro_idx` (`idcentro` ASC) ,
  PRIMARY KEY (`idact_prox_centro`),
  CONSTRAINT `fk_act_prox_centro_act`
    FOREIGN KEY (`idact`)
    REFERENCES `boatcontrol`.`act` (`idact`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_act_prox_centro_centro`
    FOREIGN KEY (`idcentro`)
    REFERENCES `boatcontrol`.`centro` (`idcentro`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
