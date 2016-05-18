CREATE DATABASE vitvarubutik;

use vitvarubutik;

CREATE TABLE `vitvarubutik`.`produkt` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NOT NULL ,
  `desc` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`id`(6))) ENGINE = InnoDB;


CREATE TABLE `vitvarubutik`.`produkt` (
  produkt_id INT(6) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  namn VARCHAR(255) NOT NULL,
  beskrivning VARCHAR(255) NOT NULL,
  bild VARCHAR(255),
  antal INT NOT NULL DEFAULT 0,
  tillverkare VARCHAR(255),
  modell VARCHAR(255),
  energiklass VARCHAR(255),
  garantitid_manader INT(6) UNSIGNED,
  egenskap VARCHAR(255),
  inkopspris DECIMAL(10, 2),
  aktiv TINYINT(1) DEFAULT 1,
  uppdaterad TIMESTAMP ON UPDATE CURRENT_TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO `produkt` (
  `produkt_id`,
  `namn`,
  `beskrivning`,
  `bild`,
  `antal`,
  `tillverkare`,
  `modell`,
  `energiklass`,
  `garantitid_manader`,
  `egenskap`,
  `inkopspris`,
  `aktiv`,
  `uppdaterad`
)
  VALUES (
    NULL,
    'Frys',
    'Fryser',
    'http://ourbestbites.com/wp-content/uploads/2012/06/Freezer.jpg',
    '1',
    'Freeze n Cold',
    'FREEZER X1000',
    'A+++', '36',
    'Fryser saker på under 2 minuter.',
    '1500.99',
    '1',
    CURRENT_TIMESTAMP
  )
