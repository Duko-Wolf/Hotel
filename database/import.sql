DROP DATABASE IF EXISTS `hotel`;

CREATE DATABASE hotel;

USE hotel;

CREATE TABLE kamers (
    kamersID int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    kamerNaam VARCHAR(255) NOT NULL,
    kamerBeschrijving TEXT,
    prijs int NOT NULL
);

CREATE TABLE admin (
    adminID int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

INSERT INTO
    admin (name, password)
VALUES
    ('admin', 'admin');

INSERT INTO
    kamers (
        kamerNaam,
        kamerBeschrijving,
        prijs
    )
VALUES
    (
        'Comfort Kamer',
        'Onze Comfort Kamer biedt een serene ontsnapping met alle basisvoorzieningen die u nodig heeft. Geniet van een comfortabel bed, een moderne badkamer en een prachtig uitzicht op de stad. Perfect voor een kort verblijf of een zakenreis.',
        100
    ),

(
    'Deluxe Kamer',
    'Voor degenen die net dat beetje extra comfort willen, is onze Deluxe Kamer de perfecte keuze. Deze kamers zijn ruimer en beschikken over luxere voorzieningen, zoals een zithoek en een Nespresso-apparaat. De ideale plek om te ontspannen na een dag vol ontdekkingen in Alkmaar.',
    200
),
(
    'Junior Suite',
    'Onze Junior Suites bieden een ultieme combinatie van ruimte en luxe. Met een aparte woonkamer, een ruime badkamer en een balkon met een adembenemend uitzicht, is deze kamer perfect voor een romantisch uitje of een speciale gelegenheid.',
    350
),

(
    'Familie Suite',
    'Speciaal ontworpen voor gezinnen, biedt onze Familie Suite voldoende ruimte en comfort voor iedereen. Deze suites beschikken over twee aparte slaapkamers, een ruime woonkamer en extra voorzieningen zoals een kitchenette en speelhoek voor de kinderen. De perfecte thuisbasis voor een onvergetelijke familievakantie.',
    500
),

(
    'Bruidssuite',
    'Onze Bruidssuite is de ultieme romantische ontsnapping voor pasgetrouwde stellen. Deze luxueuze suite biedt een ruime slaapkamer met een kingsize bed, een stijlvolle woonkamer en een eigen balkon met een prachtig uitzicht op Alkmaar. Geniet van extras zoals een bubbelbad, rozenblaadjes op het bed en een fles champagne om uw speciale gelegenheid te vieren in stijl.',
    1000
);