DROP DATABASE IF EXISTS `hotel`;

CREATE DATABASE hotel;

USE hotel;

CREATE TABLE kamers (
    kamersID int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    kamerNaam VARCHAR(255) NOT NULL,
    kamerBeschrijving VARCHAR(255),
    beschikbaarheid BOOLEAN NOT NULL
);

CREATE TABLE admin (
    adminID int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    adminEmail VARCHAR(255) NOT NULL,
    
);