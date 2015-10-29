SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `espaciovivo` ;
CREATE SCHEMA IF NOT EXISTS `espaciovivo` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `espaciovivo` ;

-- -----------------------------------------------------
-- Table `espaciovivo`.`states`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `espaciovivo`.`states` ;

CREATE TABLE IF NOT EXISTS `espaciovivo`.`states` (
  `id` INT NOT NULL,
  `name` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `espaciovivo`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `espaciovivo`.`users` ;

CREATE TABLE IF NOT EXISTS `espaciovivo`.`users` (
  `id` INT NOT NULL,
  `name` VARCHAR(45) NULL,
  `last_name` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  `password` VARCHAR(45) NULL,
  `street` VARCHAR(45) NULL,
  `number_int` VARCHAR(45) NULL,
  `number_ext` VARCHAR(45) NULL,
  `suburb` VARCHAR(45) NULL,
  `notifications` INT NULL,
  `states_id` INT NOT NULL,
  PRIMARY KEY (`id`, `states_id`),
  INDEX `fk_users_states1_idx` (`states_id` ASC),
  CONSTRAINT `fk_users_states1`
    FOREIGN KEY (`states_id`)
    REFERENCES `espaciovivo`.`states` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `espaciovivo`.`favorites`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `espaciovivo`.`favorites` ;

CREATE TABLE IF NOT EXISTS `espaciovivo`.`favorites` (
  `id` INT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `espaciovivo`.`remiders`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `espaciovivo`.`remiders` ;

CREATE TABLE IF NOT EXISTS `espaciovivo`.`remiders` (
  `id` INT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `espaciovivo`.`users_has_remiders`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `espaciovivo`.`users_has_remiders` ;

CREATE TABLE IF NOT EXISTS `espaciovivo`.`users_has_remiders` (
  `users_id` INT NOT NULL,
  PRIMARY KEY (`users_id`),
  INDEX `fk_users_has_remiders_users1_idx` (`users_id` ASC),
  CONSTRAINT `fk_users_has_remiders_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `espaciovivo`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `espaciovivo`.`admin`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `espaciovivo`.`admin` ;

CREATE TABLE IF NOT EXISTS `espaciovivo`.`admin` (
  `id` INT NOT NULL,
  `name` VARCHAR(45) NULL,
  `last_name` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  `password` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `espaciovivo`.`trade_agreements`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `espaciovivo`.`trade_agreements` ;

CREATE TABLE IF NOT EXISTS `espaciovivo`.`trade_agreements` (
  `id` INT NOT NULL,
  `name` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `espaciovivo`.`contracts`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `espaciovivo`.`contracts` ;

CREATE TABLE IF NOT EXISTS `espaciovivo`.`contracts` (
  `id` INT NOT NULL,
  `name` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `espaciovivo`.`immovables_type`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `espaciovivo`.`immovables_type` ;

CREATE TABLE IF NOT EXISTS `espaciovivo`.`immovables_type` (
  `id` INT NOT NULL,
  `name` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `espaciovivo`.`suburbs`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `espaciovivo`.`suburbs` ;

CREATE TABLE IF NOT EXISTS `espaciovivo`.`suburbs` (
  `id` INT NOT NULL,
  `name` VARCHAR(45) NULL,
  `states_id` INT NOT NULL,
  PRIMARY KEY (`id`, `states_id`),
  INDEX `fk_suburbs_states1_idx` (`states_id` ASC),
  CONSTRAINT `fk_suburbs_states1`
    FOREIGN KEY (`states_id`)
    REFERENCES `espaciovivo`.`states` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `espaciovivo`.`immovables`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `espaciovivo`.`immovables` ;

CREATE TABLE IF NOT EXISTS `espaciovivo`.`immovables` (
  `id` INT NOT NULL,
  `title` VARCHAR(45) NULL,
  `street` VARCHAR(45) NULL,
  `number_int` VARCHAR(45) NULL,
  `number_ext` VARCHAR(45) NULL,
  `city` VARCHAR(45) NULL,
  `price` VARCHAR(45) NULL,
  `extra_costs` VARCHAR(45) NULL,
  `concept` VARCHAR(45) NULL,
  `bedroom` VARCHAR(45) NULL,
  `toilet` VARCHAR(45) NULL,
  `parking` INT NULL,
  `kitchen` VARCHAR(45) NULL,
  `description` TEXT NULL,
  `comments` TEXT NULL,
  `published` TIMESTAMP NULL,
  `active` INT NULL,
  `code` VARCHAR(45) NULL,
  `trade_agreements_id` INT NOT NULL,
  `contract_id` INT NOT NULL,
  `states_id` INT NOT NULL,
  `immovables_type_id` INT NOT NULL,
  `suburbs_id` INT NOT NULL,
  PRIMARY KEY (`id`, `trade_agreements_id`, `contract_id`, `states_id`, `immovables_type_id`, `suburbs_id`),
  INDEX `fk_immovables_trade_agreements1_idx` (`trade_agreements_id` ASC),
  INDEX `fk_immovables_contract1_idx` (`contract_id` ASC),
  INDEX `fk_immovables_states1_idx` (`states_id` ASC),
  INDEX `fk_immovables_immovables_type1_idx` (`immovables_type_id` ASC),
  INDEX `fk_immovables_suburbs1_idx` (`suburbs_id` ASC),
  CONSTRAINT `fk_immovables_trade_agreements1`
    FOREIGN KEY (`trade_agreements_id`)
    REFERENCES `espaciovivo`.`trade_agreements` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_immovables_contract1`
    FOREIGN KEY (`contract_id`)
    REFERENCES `espaciovivo`.`contracts` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_immovables_states1`
    FOREIGN KEY (`states_id`)
    REFERENCES `espaciovivo`.`states` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_immovables_immovables_type1`
    FOREIGN KEY (`immovables_type_id`)
    REFERENCES `espaciovivo`.`immovables_type` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_immovables_suburbs1`
    FOREIGN KEY (`suburbs_id`)
    REFERENCES `espaciovivo`.`suburbs` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `espaciovivo`.`users_favorites`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `espaciovivo`.`users_favorites` ;

CREATE TABLE IF NOT EXISTS `espaciovivo`.`users_favorites` (
  `users_id` INT NOT NULL,
  `immovables_id` INT NOT NULL,
  PRIMARY KEY (`users_id`, `immovables_id`),
  INDEX `fk_users_has_immovables_immovables1_idx` (`immovables_id` ASC),
  INDEX `fk_users_has_immovables_users1_idx` (`users_id` ASC),
  CONSTRAINT `fk_users_has_immovables_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `espaciovivo`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_has_immovables_immovables1`
    FOREIGN KEY (`immovables_id`)
    REFERENCES `espaciovivo`.`immovables` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `espaciovivo`.`users_remiders`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `espaciovivo`.`users_remiders` ;

CREATE TABLE IF NOT EXISTS `espaciovivo`.`users_remiders` (
  `users_id` INT NOT NULL,
  `immovables_id` INT NOT NULL,
  PRIMARY KEY (`users_id`, `immovables_id`),
  INDEX `fk_users_has_immovables_immovables2_idx` (`immovables_id` ASC),
  INDEX `fk_users_has_immovables_users2_idx` (`users_id` ASC),
  CONSTRAINT `fk_users_has_immovables_users2`
    FOREIGN KEY (`users_id`)
    REFERENCES `espaciovivo`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_has_immovables_immovables2`
    FOREIGN KEY (`immovables_id`)
    REFERENCES `espaciovivo`.`immovables` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `espaciovivo`.`photos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `espaciovivo`.`photos` ;

CREATE TABLE IF NOT EXISTS `espaciovivo`.`photos` (
  `id` INT NOT NULL,
  `url` VARCHAR(45) NULL,
  `immovables_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_photos_immovables1_idx` (`immovables_id` ASC),
  CONSTRAINT `fk_photos_immovables1`
    FOREIGN KEY (`immovables_id`)
    REFERENCES `espaciovivo`.`immovables` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
