DROP DATABASE IF EXISTS `menu`;

CREATE DATABASE menu;

USE menu;

CREATE TABLE voorGerechten (
    voorGerechtID int NOT NULL PRIMARY KEY,
    voorGerechtNaam VARCHAR(255) NOT NULL,
    voorGerechtBeschrijving VARCHAR(255),
    voorGerechtPrijs int NOT NULL
);

CREATE TABLE hoofdGerechten (
    hoofdGerechtID int NOT NULL PRIMARY KEY,
    hoofdGerechtNaam VARCHAR(255) NOT NULL,
    hoofdGerechtBeschrijving VARCHAR(255),
    hoofdGerechtPrijs int NOT NULL
);

CREATE TABLE naGerechten (
    naGerechtID int NOT NULL PRIMARY KEY,
    naGerechtNaam VARCHAR(255) NOT NULL,
    naGerechtBeschrijving VARCHAR(255),
    naGerechtPrijs int NOT NULL
);

CREATE TABLE kinderMenu (
    kinderMenuID int NOT NULL PRIMARY KEY,
    kinderGerechtenNaam VARCHAR(255) NOT NULL,
    kinderGerechtenBeschrijving VARCHAR(255),
    kinderGerechtenPrijs int NOT NULL
);