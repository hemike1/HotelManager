CREATE TABLE `xcf5_registered` (
	`registeredId` INT NOT NULL AUTO_INCREMENT,
	`registeredFirstName` varchar(50) NOT NULL,
	`registeredLastName` varchar(50) NOT NULL,
	`registeredEmail` varchar(100) NOT NULL,
	`registeredPassword` varchar(255) NOT NULL,
	`registeredPermission` INT(2) NOT NULL,
	PRIMARY KEY (`registeredId`)
);

CREATE TABLE `xcf5_permissions` (
	`permissionId` INT(2) NOT NULL AUTO_INCREMENT,
	`permissionName` varchar(25) NOT NULL,
	PRIMARY KEY (`permissionId`)
);

CREATE TABLE `xcf5_reservations` (
	`reservationId` INT(11) NOT NULL AUTO_INCREMENT,
	`reservationRegisteredId` INT(11) NOT NULL,
	`reservationRoomId` INT(11) NOT NULL,
	`reservationStartingT` DATE NOT NULL,
	`reservationEndT` DATE NOT NULL,
	PRIMARY KEY (`reservationId`)
);

CREATE TABLE `xcf5_rooms` (
	`roomId` INT(11) NOT NULL AUTO_INCREMENT,
	`roomAccomodation` INT(3) NOT NULL,
	`roomSize` varchar(6) NOT NULL,
	`roomFloor` INT(2) NOT NULL,
	`roomNumber` INT(3) NOT NULL,
	`roomImageName` varchar(255) NOT NULL,
	`roomFeatures` INT(2) NOT NULL,
	`roomDescription` varchar(250) NOT NULL,
	PRIMARY KEY (`roomId`)
);

CREATE TABLE `xcf5_invoice` (
	`invoiceId` INT(11) NOT NULL AUTO_INCREMENT,
	`invoiceReservId` INT(11) NOT NULL,
	`invoiceIssueDate` DATE NOT NULL,
	`invoicePaymentDeadline` DATE NOT NULL,
	`invoicePrePaid` BOOLEAN NOT NULL,
	`invoiceSavedLocationId` INT(11) NOT NULL,
	PRIMARY KEY (`invoiceId`)
);

CREATE TABLE `xcf5_cities` (
	`cityId` INT(255) NOT NULL AUTO_INCREMENT,
	`cityPostNum` INT(4) NOT NULL,
	`cityName` varchar(100) NOT NULL,
	PRIMARY KEY (`cityId`)
);

CREATE TABLE `xcf5_savedLocations` (
	`savedLocationId` INT(11) NOT NULL AUTO_INCREMENT,
	`savedLocationregisteredId` INT(11) NOT NULL,
	`savedLocationCityId` INT(11) NOT NULL,
	`savedLocationStrName` varchar(100) NOT NULL,
	`savedLocationHouseNum` varchar(20) NOT NULL,
	PRIMARY KEY (`savedLocationId`)
);

CREATE TABLE `xcf5_features` (
	`featureId` INT(2) NOT NULL,
	`featureIcon` varchar(255) NOT NULL,
	PRIMARY KEY (`featureId`)
);

ALTER TABLE `xcf5_registered` ADD CONSTRAINT `xcf5_registered_fk0` FOREIGN KEY (`registeredPermission`) REFERENCES `xcf5_permissions`(`permissionId`);

ALTER TABLE `xcf5_reservations` ADD CONSTRAINT `xcf5_reservations_fk0` FOREIGN KEY (`reservationRegisteredId`) REFERENCES `xcf5_registered`(`registeredId`);

ALTER TABLE `xcf5_reservations` ADD CONSTRAINT `xcf5_reservations_fk1` FOREIGN KEY (`reservationRoomId`) REFERENCES `xcf5_rooms`(`roomId`);

ALTER TABLE `xcf5_rooms` ADD CONSTRAINT `xcf5_rooms_fk0` FOREIGN KEY (`roomFeatures`) REFERENCES `xcf5_features`(`featureId`);

ALTER TABLE `xcf5_invoice` ADD CONSTRAINT `xcf5_invoice_fk0` FOREIGN KEY (`invoiceReservId`) REFERENCES `xcf5_reservations`(`reservationId`);

ALTER TABLE `xcf5_invoice` ADD CONSTRAINT `xcf5_invoice_fk1` FOREIGN KEY (`invoiceSavedLocationId`) REFERENCES `xcf5_savedLocations`(`savedLocationId`);

ALTER TABLE `xcf5_savedLocations` ADD CONSTRAINT `xcf5_savedLocations_fk0` FOREIGN KEY (`savedLocationregisteredId`) REFERENCES `xcf5_registered`(`registeredId`);

ALTER TABLE `xcf5_savedLocations` ADD CONSTRAINT `xcf5_savedLocations_fk1` FOREIGN KEY (`savedLocationCityId`) REFERENCES `xcf5_cities`(`cityId`);









