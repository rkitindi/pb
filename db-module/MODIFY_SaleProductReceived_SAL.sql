-- -----------------------------------------------------
-- Table `pb_db`.`SaleProductReceived_SAL`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pb_db`.`SaleProductReceived_SAL` ;

CREATE TABLE IF NOT EXISTS `pb_db`.`SaleProductReceived_SAL` (
 `SalesRef` INT NOT NULL AUTO_INCREMENT,
 `ProductReceiptId` INT NOT NULL,
 `Quantity` INT NOT NULL,
 `UnitPrice` INT NOT NULL,
 `SalesDate` DATETIME NOT NULL,
 `PaymentMethod` VARCHAR(255) NOT NULL,
 `CustomerID` VARCHAR(255),
 `RecordInsertDate` DATETIME NOT NULL,
 PRIMARY KEY (`SalesRef`), 
 INDEX `ProductReceiptId_idx` (`ProductReceiptId` ASC), 
 INDEX `CustomerID_idx` (`CustomerID` ASC),
 CONSTRAINT `ProductReceiptId_SPR`
 FOREIGN KEY (`ProductReceiptId`)
 REFERENCES `pb_db`.`ProductReceived_SAL` (`ProductReceiptId`)
 ON DELETE CASCADE
 ON UPDATE CASCADE,
 CONSTRAINT `CustomerID_SPR`
 FOREIGN KEY (`CustomerID`)
 REFERENCES `pb_db`.`CustomerDetails_SAL` (`CustomerID`)
 ON DELETE SET NULL
 ON UPDATE SET NULL);
 
-- -----------------------------------------------------
-- CHANGE COLUMN NAME
-- -----------------------------------------------------
ALTER TABLE SaleProductReceived_SAL ADD COLUMN `RecordInsertDate` DATETIME NOT NULL AFTER CustomerID;


-- -----------------------------------------------------
-- TURN OFF FK CHECK
-- -----------------------------------------------------
SET FOREIGN_KEY_CHECKS = 0;


-- -----------------------------------------------------
-- add index, constraint and foreign_key
-- ----------------------------------------------------- 
ALTER TABLE SaleProductReceived_SAL
ADD FOREIGN KEY (name_id) REFERENCES names (id) 
  ON DELETE SET NULL ON UPDATE CASCADE; 
				
		


-- -----------------------------------------------------
-- Verify Changes
-- -----------------------------------------------------
show create table ProductInfo_PROD;


-- -----------------------------------------------------
-- TURN OFF FK CHECK
-- -----------------------------------------------------
SET FOREIGN_KEY_CHECKS = 1;
  