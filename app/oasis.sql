SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `oasis` ;
CREATE SCHEMA IF NOT EXISTS `oasis` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `oasis` ;

-- -----------------------------------------------------
-- Table `oasis`.`roles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `oasis`.`roles` ;

CREATE  TABLE IF NOT EXISTS `oasis`.`roles` (
  `id` BIGINT NOT NULL AUTO_INCREMENT ,
  `nom_role` VARCHAR(255) NOT NULL ,
  `description_role` TEXT NOT NULL ,
  `creee_a` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `modifiee_a` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_roles_UNIQUE` (`id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oasis`.`etats`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `oasis`.`etats` ;

CREATE  TABLE IF NOT EXISTS `oasis`.`etats` (
  `id` BIGINT NOT NULL AUTO_INCREMENT ,
  `nom_etat` VARCHAR(255) NOT NULL ,
  `description_etat` TEXT NULL ,
  `creee_a` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `modifiee_a` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_etats_UNIQUE` (`id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oasis`.`utilisateurs`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `oasis`.`utilisateurs` ;

CREATE  TABLE IF NOT EXISTS `oasis`.`utilisateurs` (
  `id` BIGINT NOT NULL AUTO_INCREMENT ,
  `prenom` VARCHAR(255) NOT NULL ,
  `nom` VARCHAR(255) NULL ,
  `post_nom` VARCHAR(255) NULL ,
  `email` VARCHAR(255) NULL ,
  `telephone` VARCHAR(45) NULL ,
  `sexe` VARCHAR(45) NULL ,
  `date_de_naissance` DATE NULL ,
  `mot_de_passe` TEXT NULL ,
  `avatar_url` TEXT NULL ,
  `creee_a` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `modifiee_a` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `id_role` BIGINT NULL ,
  `id_etat` BIGINT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_utilisateurs_UNIQUE` (`id` ASC) ,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) ,
  UNIQUE INDEX `telephone_UNIQUE` (`telephone` ASC) ,
  INDEX `fk_utilisateurs_roles_idx` (`id_role` ASC) ,
  INDEX `fk_utilisateurs_etats_idx` (`id_etat` ASC) ,
  CONSTRAINT `fk_utilisateurs_roles`
    FOREIGN KEY (`id_role` )
    REFERENCES `oasis`.`roles` (`id` )
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `fk_utilisateurs_etats`
    FOREIGN KEY (`id_etat` )
    REFERENCES `oasis`.`etats` (`id` )
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oasis`.`evenements`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `oasis`.`evenements` ;

CREATE  TABLE IF NOT EXISTS `oasis`.`evenements` (
  `id` BIGINT NOT NULL AUTO_INCREMENT ,
  `nom_evenement` VARCHAR(255) NOT NULL ,
  `prix_acompte` DECIMAL(9,2) NULL ,
  `prix_total` DECIMAL(9,2) NULL ,
  `creee_a` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `modifiee_a` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `id_etat` BIGINT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_evenements_UNIQUE` (`id` ASC) ,
  INDEX `fk_evenements_etats_idx` (`id_etat` ASC) ,
  CONSTRAINT `fk_evenements_etats`
    FOREIGN KEY (`id_etat` )
    REFERENCES `oasis`.`etats` (`id` )
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oasis`.`reservations`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `oasis`.`reservations` ;

CREATE  TABLE IF NOT EXISTS `oasis`.`reservations` (
  `id` BIGINT NOT NULL AUTO_INCREMENT ,
  `id_utilisateur` BIGINT NOT NULL ,
  `id_evenement` BIGINT NOT NULL ,
  `date` DATE NOT NULL ,
  `heure_debut` TIME NOT NULL ,
  `heure_fin` TIME NOT NULL ,
  `creee_a` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `modifiee_a` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `id_etat` BIGINT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_reservations_UNIQUE` (`id` ASC) ,
  INDEX `fk_reservations_utilisateurs_idx` (`id_utilisateur` ASC) ,
  INDEX `fk_reservations_evenements_idx` (`id_evenement` ASC) ,
  INDEX `fk_reservations_etats_idx` (`id_etat` ASC) ,
  CONSTRAINT `fk_reservations_utilisateurs`
    FOREIGN KEY (`id_utilisateur` )
    REFERENCES `oasis`.`utilisateurs` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_reservations_evenements`
    FOREIGN KEY (`id_evenement` )
    REFERENCES `oasis`.`evenements` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_reservations_etats`
    FOREIGN KEY (`id_etat` )
    REFERENCES `oasis`.`etats` (`id` )
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `oasis`.`paiements`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `oasis`.`paiements` ;

CREATE  TABLE IF NOT EXISTS `oasis`.`paiements` (
  `id` BIGINT NOT NULL AUTO_INCREMENT ,
  `reference` VARCHAR(45) NULL ,
  `reference_fournisseur` VARCHAR(45) NULL ,
  `numero_commande` TEXT NULL ,
  `montant` DECIMAL(9,2) NULL ,
  `montant_client` DECIMAL(9,2) NULL ,
  `monnaie` VARCHAR(45) NULL ,
  `canal` VARCHAR(45) NULL ,
  `creee_a` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `modifiee_a` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `id_utilisateur` BIGINT NULL ,
  `id_reservation` BIGINT NULL ,
  `id_etat` BIGINT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_paiements_UNIQUE` (`id` ASC) ,
  INDEX `fk_paiements_utilisateurs_idx` (`id_utilisateur` ASC) ,
  INDEX `fk_paiements_reservations_idx` (`id_reservation` ASC) ,
  INDEX `fk_paiements_etats_idx` (`id_etat` ASC) ,
  CONSTRAINT `fk_paiements_utilisateurs`
    FOREIGN KEY (`id_utilisateur` )
    REFERENCES `oasis`.`utilisateurs` (`id` )
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `fk_paiements_reservations`
    FOREIGN KEY (`id_reservation` )
    REFERENCES `oasis`.`reservations` (`id` )
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `fk_paiements_etats`
    FOREIGN KEY (`id_etat` )
    REFERENCES `oasis`.`etats` (`id` )
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB;

USE `oasis` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
