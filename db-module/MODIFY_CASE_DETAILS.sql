-- -----------------------------------------------------
-- Table  `pb_db`.`CaseDetails_PROD`
-- -----------------------------------------------------

DROP TABLE IF EXISTS  `pb_db`.`CaseDetails_PROD` ;

CREATE TABLE IF NOT EXISTS  `pb_db`.`CaseDetails_PROD`(
 `CaseCode` VARCHAR(255) NOT NULL,
 `CaseName` VARCHAR(255) NOT NULL,
 `BrandId` INT NOT NULL,,
 `CasePhoto` VARCHAR(255) NULL,
 `PurchasePrice` INT NOT NULL,
 `SupplierId` VARCHAR(255) NOT NULL,
 PRIMARY KEY (`CaseCode`), 
 INDEX `SupplierId_idx` (`SupplierId` ASC), 
 INDEX `BrandId_idx` (`BrandId` ASC),
 CONSTRAINT `SupplierId_CD`
 FOREIGN KEY (`SupplierId`)
 REFERENCES `pb_db`.`SupplierInfo_PROD` (`SupplierId`)
 ON DELETE CASCADE
 ON UPDATE CASCADE,
 CONSTRAINT `BrandId_CD`
 FOREIGN KEY (`BrandId`)
 REFERENCES `pb_db`.`SupplierInfo_PROD` (`BrandId`)
 ON DELETE CASCADE
 ON UPDATE CASCADE);
 
-- -----------------------------------------------------
-- CHANGE COLUMN NAME
-- -----------------------------------------------------

 ALTER TABLE  `pb_db`.`CaseDetails_PROD` CHANGE `BrandName` `BrandId` INT NOT NULL;
 
-- -----------------------------------------------------
-- add index, constraint and foreign_key
-- ----------------------------------------------------- 
ALTER TABLE  `pb_db`.`CaseDetails_PROD`
ADD INDEX `BrandId_idx` (`BrandId` ASC),
ADD CONSTRAINT `BrandId_CD`
	FOREIGN KEY (`BrandId`)
		REFERENCES `pb_db`.`ProductBrand_PROD` (`BrandId`)
			ON DELETE CASCADE
				ON UPDATE CASCADE;
				
		
-- -----------------------------------------------------
-- Change Column Datatype and  enable NULL
-- -----------------------------------------------------		

ALTER TABLE  `pb_db`.`CaseDetails_PROD` CHANGE COLUMN `CasePhoto` `CasePhoto` VARCHAR(255) NULL;

-- -----------------------------------------------------
-- Verify Changes
-- -----------------------------------------------------
show create table `pb_db`.`CaseDetails_PROD`;
  