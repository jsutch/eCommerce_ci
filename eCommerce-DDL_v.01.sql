-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema eCommerce_MVC
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema eCommerce_MVC
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `eCommerce_MVC` DEFAULT CHARACTER SET utf8 ;
USE `eCommerce_MVC` ;

-- -----------------------------------------------------
-- Table `eCommerce_MVC`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `eCommerce_MVC`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  `first_name` VARCHAR(45) NULL,
  `last_name` VARCHAR(45) NULL,
  `email` VARCHAR(128) NULL,
  `password` VARCHAR(128) NULL,
  `address` VARCHAR(255) NULL,
  `credit card` VARCHAR(64) NULL,
  `is_admin` TINYINT(1) NULL,
  `secret` VARCHAR(45) NULL,
  `visits` INT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `eCommerce_MVC`.`products`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `eCommerce_MVC`.`products` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `created_at` DATETIME NULL,
  `updated_at` VARCHAR(45) NULL,
  `name` VARCHAR(255) NULL,
  `description` VARCHAR(255) NULL,
  `price` VARCHAR(45) NULL,
  `quantity` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `eCommerce_MVC`.`cart`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `eCommerce_MVC`.`cart` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  `product_id` INT NOT NULL,
  `user_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Cart_Products_idx` (`product_id` ASC),
  INDEX `fk_Cart_users1_idx` (`user_id` ASC),
  CONSTRAINT `fk_Cart_Products`
    FOREIGN KEY (`product_id`)
    REFERENCES `eCommerce_MVC`.`products` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Cart_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `eCommerce_MVC`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
