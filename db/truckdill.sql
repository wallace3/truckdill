CREATE TABLE `users` (
`ID_User` int(11) NOT NULL AUTO_INCREMENT,
`Username` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
`Password` varchar(200) NOT NULL,
`Email` varchar(200) NULL,
`ID_Type` int(11) NULL,
`Status` int(4) NULL,
PRIMARY KEY (`ID_User`) 
)
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;
CREATE TABLE `user_types` (
`ID_Type` int(11) NOT NULL AUTO_INCREMENT,
`Type` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
PRIMARY KEY (`ID_Type`) 
)
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;
CREATE TABLE `suppliers` (
`ID_Supplier` int(11) NOT NULL AUTO_INCREMENT,
`ID_User` int(11) NULL,
`ID_Detail` int(11) NULL,
`ID_Has_Service` int(11) NULL,
PRIMARY KEY (`ID_Supplier`) 
)
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;
CREATE TABLE `detail_supplier` (
`ID_Detail` int(11) NOT NULL AUTO_INCREMENT,
`ID_Supplier` int(11) NULL,
`Supplier` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
`RFC` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
`Legal` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
PRIMARY KEY (`ID_Detail`) 
);
CREATE TABLE `services` (
);
CREATE TABLE `suppliers_has_services` (
`ID_Has_Service` int(11) NOT NULL AUTO_INCREMENT,
`ID_Supplier` int(11) NULL,
`ID_Service` int(11) NULL,
PRIMARY KEY (`ID_Has_Service`) 
);
CREATE TABLE `suppliers_services` (
`ID_Service` int(11) NOT NULL,
`Service` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
PRIMARY KEY (`ID_Service`) 
);
CREATE TABLE `service_products` (
`ID_Service_Products` int(11) NOT NULL AUTO_INCREMENT,
`ID_Service` int(11) NULL,
`Product` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
`Cost` double NULL,
PRIMARY KEY (`ID_Service_Products`) 
);
CREATE TABLE `payments_to_supplier` (
`ID_Payment` int(11) NOT NULL AUTO_INCREMENT,
`ID_Supplier` int(11) NULL,
`ID_Invoice` int(11) NULL,
`Amount` double NULL,
`Date` datetime NULL ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (`ID_Payment`) 
);
CREATE TABLE `invoices` (
`ID_Invoice` int(11) NOT NULL AUTO_INCREMENT,
`Amount` double NULL,
`Date` datetime NULL ON UPDATE CURRENT_TIMESTAMP,
`Status` int(4) NULL,
PRIMARY KEY (`ID_Invoice`) 
);
CREATE TABLE `document` (
`ID_Document` int(11) NOT NULL,
`ID_Supplier` int(11) NULL,
`Date` datetime NULL ON UPDATE CURRENT_TIMESTAMP,
`Url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
PRIMARY KEY (`ID_Document`) 
);

ALTER TABLE `user_types` ADD CONSTRAINT `ID_Type` FOREIGN KEY (`ID_Type`) REFERENCES `users` (`ID_Type`) ON DELETE NO ACTION;
ALTER TABLE `users` ADD CONSTRAINT `Supplier` FOREIGN KEY (`ID_User`) REFERENCES `suppliers` (`ID_User`);
ALTER TABLE `suppliers` ADD CONSTRAINT `detail` FOREIGN KEY (`ID_Detail`) REFERENCES `detail_supplier` (`ID_Supplier`);
ALTER TABLE `suppliers` ADD CONSTRAINT `has_service` FOREIGN KEY (`ID_Has_Service`) REFERENCES `suppliers_has_services` (`ID_Has_Service`);
ALTER TABLE `suppliers_has_services` ADD CONSTRAINT `services` FOREIGN KEY (`ID_Service`) REFERENCES `suppliers_services` (`ID_Service`);
ALTER TABLE `suppliers_services` ADD CONSTRAINT `products` FOREIGN KEY (`ID_Service`) REFERENCES `service_products` (`ID_Service`);
ALTER TABLE `suppliers` ADD CONSTRAINT `payment` FOREIGN KEY (`ID_Supplier`) REFERENCES `payments_to_supplier` (`ID_Supplier`);
ALTER TABLE `payments_to_supplier` ADD CONSTRAINT `paymentd` FOREIGN KEY (`ID_Invoice`) REFERENCES `invoices` (`ID_Invoice`);
ALTER TABLE `suppliers` ADD CONSTRAINT `document` FOREIGN KEY (`ID_Supplier`) REFERENCES `document` (`ID_Supplier`);

