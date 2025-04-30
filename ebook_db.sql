-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema ebook_db
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema ebook_db
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `ebook_db` DEFAULT CHARACTER SET utf8 ;
USE `ebook_db` ;

-- -----------------------------------------------------
-- Table `ebook_db`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ebook_db`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `password` VARCHAR(200) NOT NULL,
  `role` INT NOT NULL,
  `created_at` DATETIME NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ebook_db`.`ebooks`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ebook_db`.`ebooks` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(50) NOT NULL,
  `author` VARCHAR(50) NOT NULL,
  `price` DECIMAL NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ebook_db`.`reviews`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ebook_db`.`reviews` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `message` VARCHAR(250) NOT NULL,
  `idebooks` INT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
