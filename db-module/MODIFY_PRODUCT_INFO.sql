-- -----------------------------------------------------
-- Table `pb_db`.`ProductInfo_PROD`
-- -----------------------------------------------------

DROP TABLE IF EXISTS `pb_db`.`ProductInfo_PROD` ;

CREATE TABLE IF NOT EXISTS `pb_db`.`ProductInfo_PROD` (
 `ProductCode` VARCHAR(255) NOT NULL,
 `BrandId` INT NOT NULL,
 `QualityId` INT NOT NULL,
 `ProductPhoto` VARCHAR(255),
 `SellingPrice` INT NOT NULL,
 `SupplierId` VARCHAR(255) NOT NULL,
 PRIMARY KEY (`ProductCode`), 
 INDEX `SupplierId_idx` (`SupplierId` ASC), 
 INDEX `BrandId_idx` (`BrandId` ASC),
 INDEX `QualityId_idx` (`QualityId` ASC),
 CONSTRAINT `SupplierId_PI`
 FOREIGN KEY (`SupplierId`)
 REFERENCES `pb_db`.`SupplierInfo_PROD` (`SupplierId`)
 ON DELETE RESTRICT
 ON UPDATE RESTRICT,
 CONSTRAINT `BrandId_PI`
 FOREIGN KEY (`BrandId`)
 REFERENCES `pb_db`.`ProductBrand_PROD` (`BrandId`)
 ON DELETE CASCADE
 ON UPDATE CASCADE,
 CONSTRAINT `QualityId_PI`
 FOREIGN KEY (`QualityId`)
 REFERENCES `pb_db`.`ProductQuality_PROD` (`QualityId`)
 ON DELETE CASCADE
 ON UPDATE CASCADE);
 
-- -----------------------------------------------------
-- CHANGE COLUMN NAME
-- -----------------------------------------------------

 ALTER TABLE `pb_db`.`ProductInfo_PROD` CHANGE `BrandName` `BrandId` INT NOT NULL;
 ALTER TABLE `pb_db`.`ProductInfo_PROD` CHANGE `Quality` `QualityId` INT NOT NULL;
 ALTER TABLE `pb_db`.`ProductInfo_PROD` CHANGE `ProductPhoto` `ProductPhoto` VARCHAR(255) NULL;
 
-- -----------------------------------------------------
-- add index, constraint and foreign_key
-- ----------------------------------------------------- 
ALTER TABLE `pb_db`.`ProductInfo_PROD`
ADD INDEX `BrandId_idx` (`BrandId` ASC),
ADD CONSTRAINT `BrandId_PI`
	FOREIGN KEY (`BrandId`)
		REFERENCES `pb_db`.`ProductBrand_PROD` (`BrandId`)
			ON DELETE CASCADE
				ON UPDATE CASCADE;
				
ALTER TABLE `pb_db`.`ProductInfo_PROD`				
ADD INDEX `QualityId_idx` (`QualityId` ASC),
ADD CONSTRAINT `QualityId_PI`
	FOREIGN KEY (`QualityId`)
		REFERENCES `pb_db`.`ProductQuality_PROD` (`QualityId`)
			ON DELETE CASCADE
			ON UPDATE CASCADE;
			
-- -----------------------------------------------------
-- Verify Changes
-- -----------------------------------------------------		
ALTER TABLE `pb_db`.`ProductInfo_PROD` CHANGE COLUMN `ProductPhoto` `ProductPhoto` BLOB NULL;

ALTER TABLE `pb_db`.`ProductInfo_PROD` CHANGE COLUMN `ProductPhoto` `ProductPhoto` MEDIUMBLOB NULL;

-- -----------------------------------------------------
-- Verify Changes
-- -----------------------------------------------------
show create table ProductInfo_PROD;
  