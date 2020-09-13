

-- -----------------------------------------------------
-- TURN OFF FK CHECK
-- -----------------------------------------------------

SET FOREIGN_KEY_CHECKS = 0;


-- -----------------------------------------------------
-- Table `pb_db`.`UserRole_ADM`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pb_db`.`UserRole_ADM` ;

-- -----------------------------------------------------
-- Table `pb_db`.`UserRole_ADM`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pb_db`.`UserRole_ADM` ;

CREATE TABLE IF NOT EXISTS `pb_db`.`UserRole_ADM` (
 `RoleID` INT NOT NULL AUTO_INCREMENT,
 `RoleName` VARCHAR(255) NOT NULL,
 `RoleDescription` VARCHAR(255),
 PRIMARY KEY (`RoleID`));
 
-- -----------------------------------------------------
-- Table `pb_db`.`Role_Perm_ADM`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pb_db`.`Role_Perm_ADM`;

CREATE TABLE IF NOT EXISTS `pb_db`.`Role_Perm_ADM` (
 `ID` INT NOT NULL AUTO_INCREMENT,
 `RoleName` VARCHAR(255) NOT NULL,
 `PermissionName` VARCHAR(255),
 PRIMARY KEY (`ID`));
 
-- -----------------------------------------------------
-- TURN OFF FK CHECK
-- -----------------------------------------------------

SET FOREIGN_KEY_CHECKS = 1;