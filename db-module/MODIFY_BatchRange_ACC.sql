-- -----------------------------------------------------
-- Table `pb_db`.`BatchRange_ACC`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pb_db`.`BatchRange_ACC` ;

CREATE TABLE IF NOT EXISTS `pb_db`.`BatchRange_ACC` (
 `BatchRangeId` VARCHAR(255) NOT NULL,
 `StartingNumber` INT NOT NULL,
 `EndingNumber` INT NOT NULL,
 `SFIndication` VARCHAR(1) NOT NULL,
 `Description` VARCHAR(255),
 PRIMARY KEY (`BatchRangeId`));
 
-- -----------------------------------------------------
-- CHANGE COLUMN NAME
-- -----------------------------------------------------

 ALTER TABLE `pb_db`.`BatchRange_ACC` CHANGE COLUMN `SFIndication`  `SFIndication` VARCHAR(1) NOT NULL;

-- -----------------------------------------------------
-- Verify Changes
-- -----------------------------------------------------
show create table `pb_db`.`BatchRange_ACC`;
  