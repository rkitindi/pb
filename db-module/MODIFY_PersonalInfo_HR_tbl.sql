-- -----------------------------------------------------
-- Table `pb_db`.`PersonalInfo_HR`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pb_db`.`PersonalInfo_HR` ;

CREATE TABLE IF NOT EXISTS `pb_db`.`PersonalInfo_HR` (
 `EmployeeId` VARCHAR(255) NOT NULL,
 `FirstNames` VARCHAR(255) NOT NULL,
 `LastNames` VARCHAR(255) NOT NULL,
 `JoiningDate` DATE NOT NULL,
 `DepartmentId`  INT NOT NULL,
 `PositionTittle` VARCHAR(255) NOT NULL,
 `Gender` VARCHAR(255) NOT NULL,
 `DateofBirth` DATE NOT NULL,
 `EmpTypeId` INT NOT NULL,
 PRIMARY KEY (`EmployeeId`), 
 INDEX `EmpTypeId_idx` (`EmpTypeId` ASC), 
 INDEX `DepartmentId_idx` (`DepartmentId` ASC),
 CONSTRAINT `EmpTypeId_PIH`
 FOREIGN KEY (`EmpTypeId`)
 REFERENCES `pb_db`.`Employmentype_HR` (`EmpTypeId`)
 ON DELETE RESTRICT
 ON UPDATE RESTRICT,
 CONSTRAINT `DepartmentId_PIH`
 FOREIGN KEY (`DepartmentId`)
 REFERENCES `pb_db`.`Department_HR` (`DepartmentId`)
 ON DELETE RESTRICT
 ON UPDATE RESTRICT);

-- -----------------------------------------------------
-- Drop constraint and foreign_key
-- ----------------------------------------------------- 

ALTER TABLE `pb_db`.`PersonalInfo_HR` DROP  FOREIGN KEY (`EmpTypeId`);  
 
-- -----------------------------------------------------
-- add index, constraint and foreign_key
-- ----------------------------------------------------- 
ALTER TABLE `pb_db`.`PersonalInfo_HR`
ADD CONSTRAINT `EmpTypeId_PIH`
	FOREIGN KEY (`EmpTypeId`)
		REFERENCES `pb_db`.`Employmentype_HR` (`EmpTypeId`)
			ON DELETE CASCADE
				ON UPDATE CASCADE;
				
-- -----------------------------------------------------
-- Verify Changes
-- -----------------------------------------------------
show create table `pb_db`.`PersonalInfo_HR`;
  