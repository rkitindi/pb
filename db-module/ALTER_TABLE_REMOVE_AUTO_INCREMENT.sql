SET FOREIGN_KEY_CHECKS=0;
alter table `SupplierCategory_PROD` modify column CategoryId INT NOT NULL;
SET FOREIGN_KEY_CHECKS=1;


alter table `pb_db`.`DispatchProduct_ACC` modify column `Dispatched` VARCHAR(1) NOT NULL;