-- -----------------------------------------------------
-- Table `pb_db`.`BatchDetails_ACC`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pb_db`.`BatchDetails_ACC` ;

CREATE TABLE IF NOT EXISTS `pb_db`.`BatchDetails_ACC` (
 `BatchId` INT NOT NULL AUTO_INCREMENT,
 `ControlNumber` INT NOT NULL,
 `BatchRangeId` VARCHAR(255) NOT NULL,
 `SupplierId` VARCHAR(255) NOT NULL,
 `RegNumber` VARCHAR(255) NOT NULL,
 `DateDispatched` DATE NOT NULL,
 `DateArrived` DATE NOT NULL,
 `BatchDocument` VARCHAR(255) NOT NULL,
 `RangeCycle` INT NOT NULL,
 PRIMARY KEY (`BatchId`), 
 INDEX `SupplierId_idx` (`SupplierId` ASC), 
 INDEX `RegNumber_idx` (`RegNumber` ASC),
 INDEX `BatchRangeId_idx` (`BatchRangeId` ASC),
 CONSTRAINT `SupplierId_BD`
 FOREIGN KEY (`SupplierId`)
 REFERENCES `pb_db`.`SupplierInfo_PROD` (`SupplierId`)
 ON DELETE RESTRICT
 ON UPDATE RESTRICT,
 CONSTRAINT `RegNumber_BD`
 FOREIGN KEY (`RegNumber`)
 REFERENCES `pb_db`.`TruckInfo_PROD` (`RegNumber`)
 ON DELETE RESTRICT
 ON UPDATE RESTRICT,
 CONSTRAINT `BatchRangeId_BD`
 FOREIGN KEY (`BatchRangeId`)
 REFERENCES `pb_db`.`BatchRange_ACC` (`BatchRangeId`)
 ON DELETE CASCADE
 ON UPDATE CASCADE);
 
-- -----------------------------------------------------
-- ADD COLUMN NAME
-- -----------------------------------------------------

 ALTER TABLE `pb_db`.`BatchDetails_ACC` ADD COLUMN `BatchId` INT NOT NULL FIRST;
 ALTER TABLE `pb_db`.`BatchDetails_ACC` ADD COLUMN `BatchRangeId` VARCHAR(255) NOT NULL AFTER `ControlNumber`;
 ALTER TABLE `pb_db`.`BatchDetails_ACC` ADD COLUMN `RangeCycle` INT NOT NULL AFTER `BatchDocument`;
 
-- -----------------------------------------------------
-- CHANGE COLUMN NAME
-- -----------------------------------------------------

 ALTER TABLE `pb_db`.`BatchDetails_ACC` CHANGE COLUMN `BatchId` `BatchId` INT NOT NULL AUTO_INCREMENT;
 ALTER TABLE `pb_db`.`BatchDetails_ACC` CHANGE COLUMN `Quality` `QualityId` INT NOT NULL;
 ALTER TABLE `pb_db`.`BatchDetails_ACC` CHANGE COLUMN `ProductPhoto` `ProductPhoto` VARCHAR(255) NULL;
 
-- -----------------------------------------------------
-- add index, constraint and foreign_key
-- ----------------------------------------------------- 
	
ALTER TABLE `pb_db`.`BatchDetails_ACC`
ADD INDEX `BrandId_idx` (`BrandId` ASC),
ADD CONSTRAINT `BrandId_PI`
	FOREIGN KEY (`BrandId`)
		REFERENCES `pb_db`.`ProductBrand_PROD` (`BrandId`)
			ON DELETE CASCADE
				ON UPDATE CASCADE;
				
ALTER TABLE `pb_db`.`BatchDetails_ACC`				
ADD INDEX `QualityId_idx` (`QualityId` ASC),
ADD CONSTRAINT `QualityId_PI`
	FOREIGN KEY (`QualityId`)
		REFERENCES `pb_db`.`ProductQuality_PROD` (`QualityId`)
			ON DELETE CASCADE
			ON UPDATE CASCADE;
			
-- -----------------------------------------------------
-- Verify Changes
-- -----------------------------------------------------		
ALTER TABLE `pb_db`.`BatchDetails_ACC` CHANGE COLUMN `ProductPhoto` `ProductPhoto` BLOB NULL;

ALTER TABLE `pb_db`.`BatchDetails_ACC` CHANGE COLUMN `ProductPhoto` `ProductPhoto` MEDIUMBLOB NULL;

-- -----------------------------------------------------
-- Verify Changes
-- -----------------------------------------------------
show create table `pb_db`.`BatchDetails_ACC`;
  