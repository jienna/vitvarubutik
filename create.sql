CREATE DATABASE IF NOT EXISTS vitvarubutik CHARACTER SET utf8 COLLATE utf8_general_ci;

USE vitvarubutik;

CREATE TABLE IF NOT EXISTS leverantor (
  id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  namn VARCHAR(100) NOT NULL,
  beskrivning VARCHAR(255),
  telefonnummer VARCHAR(22),
  gatuadress VARCHAR(100),
  stad VARCHAR(100),
  postnummer VARCHAR(50),
  land VARCHAR(100),
  aktiv TINYINT(1) DEFAULT 1,
  PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS produkt (
  id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  namn VARCHAR(100) NOT NULL,
  beskrivning VARCHAR(255) NOT NULL,
  bild VARCHAR(255),
  pris DECIMAL(10, 2),
  antal INT NOT NULL DEFAULT 0,
  tillverkare VARCHAR(100),
  modell VARCHAR(100),
  energiklass VARCHAR(10),
  garantitid_manader INT(6) UNSIGNED,
  egenskaper VARCHAR(255),
  inkopspris DECIMAL(10, 2),
  leverantor INT(11) UNSIGNED DEFAULT NULL,
  aktiv TINYINT(1) DEFAULT 1,
  uppdaterad TIMESTAMP ON UPDATE CURRENT_TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  CONSTRAINT fk_leverantor_i_produkt
  FOREIGN KEY (leverantor)
  REFERENCES leverantor(id)
  ON DELETE SET NULL
  ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS varugrupp (
  id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  namn VARCHAR(100) NOT NULL,
  beskrivning VARCHAR(255),
  varugrupp INT(11) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (id),
  CONSTRAINT fk_varugrupp_i_varugrupp
  FOREIGN KEY (varugrupp)
  REFERENCES varugrupp(id)
  ON DELETE SET NULL
  ON UPDATE CASCADE
);


INSERT INTO leverantor
(namn, beskrivning, telefonnummer, gatuadress, stad, postnummer, land)
VALUES
('Frans & co', 'Levererar saker', '76543210', 'Vägenochgatan 1A', 'Orten', '12345', 'Sverige'),
('Import AB', 'Importerar saker', '01234567', 'Gatanochvägen 2B', 'Staden', '54321', 'Sverige');


INSERT INTO produkt
(namn, beskrivning, bild, pris, antal, tillverkare, modell, energiklass, garantitid_manader, egenskaper, inkopspris, aktiv, uppdaterad)
VALUES
('Frys', 'En sak som fryser', 'http://ourbestbites.com/wp-content/uploads/2012/06/Freezer.jpg', '1999.95', '100', 'Freeze n Cold', 'FREEZER X1000', 'A+++', '36', 'Frystid: 2 minuter.', '1599.99', '1', CURRENT_TIMESTAMP),
('Kyl', 'En sak som kyler', 'http://www.gransbygden.se/nya_bilder/produkter/org/49148958jVQjz95QWYUQho2.jpg', '1499.95', '50', 'Freeze n Cold', 'FRIDGE X5000', 'A++', '24', 'Kyltid: 2 minuter.', '1000', '1', CURRENT_TIMESTAMP);
