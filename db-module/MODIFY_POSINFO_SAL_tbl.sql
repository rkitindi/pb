

-- -----------------------------------------------------
-- TURN OFF FK CHECK
-- -----------------------------------------------------

SET FOREIGN_KEY_CHECKS = 0;

-- -----------------------------------------------------
-- REMOVE PRIMARY KEY
-- -----------------------------------------------------
ALTER TABLE `pb_db`.`POSInfo_SAL`
DROP PRIMARY KEY,
CHANGE POSId POSId INT NOT NULL,
ADD PRIMARY KEY (POSId);


-- -----------------------------------------------------
-- TURN ON FK CHECK
-- -----------------------------------------------------
SET FOREIGN_KEY_CHECKS = 1;


