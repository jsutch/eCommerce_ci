-- MySQL Script generated by MySQL Workbench
-- Thu Feb 23 16:32:23 2017
-- Model: New Model    Version: 1.0
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
  `first_name` VARCHAR(64) NULL,
  `last_name` VARCHAR(128) NULL,
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
  `updated_at` DATETIME NULL,
  `name` VARCHAR(255) NULL,
  `description` VARCHAR(1024) NULL,
  `price` DECIMAL(19,4) NULL,
  `quantity` INT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `eCommerce_MVC`.`orders`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `eCommerce_MVC`.`orders` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  `users_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_orders_users1_idx` (`users_id` ASC),
  CONSTRAINT `fk_orders_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `eCommerce_MVC`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `eCommerce_MVC`.`orders_products`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `eCommerce_MVC`.`orders_products` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  `products_id` INT NOT NULL,
  `orders_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_orders_basket_products_idx` (`products_id` ASC),
  INDEX `fk_orders_products_orders1_idx` (`orders_id` ASC),
  CONSTRAINT `fk_orders_basket_products`
    FOREIGN KEY (`products_id`)
    REFERENCES `eCommerce_MVC`.`products` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_orders_products_orders1`
    FOREIGN KEY (`orders_id`)
    REFERENCES `eCommerce_MVC`.`orders` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
