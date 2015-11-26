-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`area_informativa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`area_informativa` (
  `id_area_informativa` INT(11) NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(45) NOT NULL,
  `conteudo` VARCHAR(45) NOT NULL,
 `caminho_imagem_informativa` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id_area_informativa`))
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`pessoa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`pessoa` (
  `id_pessoa` INT(11) NOT NULL AUTO_INCREMENT,
  `nome_pessoa` VARCHAR(45) NOT NULL,
  `sobrenome_pessoa` VARCHAR(45) NOT NULL,
  `cidade` VARCHAR(45) NULL DEFAULT NULL,
  `estado` VARCHAR(2) NULL DEFAULT NULL,
  `sexo` VARCHAR(1) NULL DEFAULT NULL,
  `email` VARCHAR(45) NOT NULL,
  `senha` VARCHAR(45) NOT NULL,
  `data_nasc` DATE NULL DEFAULT NULL,
  `cod_dif` INT(11) NOT NULL,
  `num_pessoa` VARCHAR(45) NULL DEFAULT NULL,
  `caminho_imagem` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id_pessoa`))
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`grupo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`grupo` (
  `id_grupo` INT(11) NOT NULL AUTO_INCREMENT,
  `nome_grupo` VARCHAR(45) NOT NULL,
  `pessoa_id_pessoa` INT(11) NOT NULL,
  PRIMARY KEY (`id_grupo`, `pessoa_id_pessoa`),
  INDEX `fk_grupo_pessoa1_idx` (`pessoa_id_pessoa` ASC),
  CONSTRAINT `fk_grupo_pessoa1`
    FOREIGN KEY (`pessoa_id_pessoa`)
    REFERENCES `mydb`.`pessoa` (`id_pessoa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`comentario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`comentario` (
  `id_comentario` INT(11) NOT NULL AUTO_INCREMENT,
  `comentario` VARCHAR(255) NOT NULL,
  `grupo_id_grupo` INT(11) NOT NULL,
  `pessoa_id_pessoa` INT(11) NOT NULL,
  PRIMARY KEY (`id_comentario`, `grupo_id_grupo`, `pessoa_id_pessoa`),
  INDEX `fk_comentario_grupo1_idx` (`grupo_id_grupo` ASC),
  INDEX `fk_comentario_pessoa1_idx` (`pessoa_id_pessoa` ASC),
  CONSTRAINT `fk_comentario_grupo1`
    FOREIGN KEY (`grupo_id_grupo`)
    REFERENCES `mydb`.`grupo` (`id_grupo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comentario_pessoa1`
    FOREIGN KEY (`pessoa_id_pessoa`)
    REFERENCES `mydb`.`pessoa` (`id_pessoa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 9
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`dados`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`dados` (
  `id_dados` INT(11) NOT NULL,
  `data_insercao` DATE NOT NULL,
  `peso` FLOAT NOT NULL,
  `altura` FLOAT NOT NULL,
  `glicose` FLOAT NOT NULL,
  `colesterol` FLOAT NOT NULL,
  `pressao` FLOAT NOT NULL,
  `metros_percorridos` FLOAT NOT NULL,
  `temp_percorrido_min` INT(11) NOT NULL,
  PRIMARY KEY (`id_dados`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`pessoa_has_dados`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`pessoa_has_dados` (
  `pessoa_id_pessoa` INT(11) NOT NULL,
  `dados_id_dados` INT(11) NOT NULL,
  PRIMARY KEY (`pessoa_id_pessoa`, `dados_id_dados`),
  INDEX `fk_pessoa_has_dados_dados1_idx` (`dados_id_dados` ASC),
  INDEX `fk_pessoa_has_dados_pessoa1_idx` (`pessoa_id_pessoa` ASC),
  CONSTRAINT `fk_pessoa_has_dados_dados1`
    FOREIGN KEY (`dados_id_dados`)
    REFERENCES `mydb`.`dados` (`id_dados`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pessoa_has_dados_pessoa1`
    FOREIGN KEY (`pessoa_id_pessoa`)
    REFERENCES `mydb`.`pessoa` (`id_pessoa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`pessoa_has_grupo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`pessoa_has_grupo` (
  `pessoa_id_pessoa` INT(11) NOT NULL,
  `grupo_id_grupo` INT(11) NOT NULL,
  PRIMARY KEY (`pessoa_id_pessoa`, `grupo_id_grupo`),
  INDEX `fk_pessoa_has_grupo_grupo1_idx` (`grupo_id_grupo` ASC),
  INDEX `fk_pessoa_has_grupo_pessoa1_idx` (`pessoa_id_pessoa` ASC),
  CONSTRAINT `fk_pessoa_has_grupo_grupo1`
    FOREIGN KEY (`grupo_id_grupo`)
    REFERENCES `mydb`.`grupo` (`id_grupo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pessoa_has_grupo_pessoa1`
    FOREIGN KEY (`pessoa_id_pessoa`)
    REFERENCES `mydb`.`pessoa` (`id_pessoa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`profissional_saude`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`profissional_saude` (
  `pessoa_id_pessoa` INT(11) NOT NULL,
  `identificacao` VARCHAR(15) NOT NULL,
  `curso` VARCHAR(45) NOT NULL,
  `local_trabalho` VARCHAR(45) NULL DEFAULT NULL,
  `area_informativa_id_area_informativa` INT(11) NOT NULL,
  PRIMARY KEY (`pessoa_id_pessoa`, `area_informativa_id_area_informativa`),
  INDEX `fk_profissional_saude_area_informativa1_idx` (`area_informativa_id_area_informativa` ASC),
  CONSTRAINT `fk_profissional_saude_area_informativa1`
    FOREIGN KEY (`area_informativa_id_area_informativa`)
    REFERENCES `mydb`.`area_informativa` (`id_area_informativa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_profissional_saude_pessoa`
    FOREIGN KEY (`pessoa_id_pessoa`)
    REFERENCES `mydb`.`pessoa` (`id_pessoa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
