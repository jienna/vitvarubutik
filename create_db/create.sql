DROP DATABASE IF EXISTS vitvarubutik;

CREATE DATABASE IF NOT EXISTS vitvarubutik CHARACTER SET utf8 COLLATE utf8_general_ci;

USE vitvarubutik;

CREATE TABLE IF NOT EXISTS leverantor (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
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

CREATE TABLE IF NOT EXISTS kampanj (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  namn VARCHAR(100) NOT NULL,
  beskrivning VARCHAR(255),
  rabattprocent INT UNSIGNED DEFAULT NULL,
  startdatum DATE NOT NULL,
  slutdatum DATE NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS grupp (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  namn VARCHAR(100) NOT NULL,
  beskrivning VARCHAR(255),
  PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS kund (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  namn VARCHAR(100) NOT NULL,
  email VARCHAR(50),
  telefonnummer VARCHAR(22),
  gatuadress VARCHAR(100),
  stad VARCHAR(100),
  postnummer VARCHAR(50),
  PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS produkt (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  namn VARCHAR(100) NOT NULL,
  beskrivning VARCHAR(255) NOT NULL,
  bild VARCHAR(255),
  pris DECIMAL(10, 2),
  antal INT NOT NULL DEFAULT 0,
  tillverkare VARCHAR(100),
  modell VARCHAR(100),
  energiklass VARCHAR(10),
  garantitid_manader INT UNSIGNED,
  egenskaper VARCHAR(255),
  inkopspris DECIMAL(10, 2),
  leverantor INT UNSIGNED DEFAULT NULL,
  aktiv TINYINT(1) DEFAULT 1,
  uppdaterad TIMESTAMP ON UPDATE CURRENT_TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  CONSTRAINT fk_leverantor_i_produkt
  FOREIGN KEY (leverantor)
  REFERENCES leverantor(id)
  ON DELETE SET NULL
  ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS kop (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  antal INT NOT NULL,
  datum DATETIME NOT NULL,
  produkt INT UNSIGNED NOT NULL,
  kund INT UNSIGNED NOT NULL,
  PRIMARY KEY (id),
  CONSTRAINT fk_produkt_i_kop
  FOREIGN KEY (produkt)
  REFERENCES produkt(id)
  ON DELETE CASCADE
  ON UPDATE CASCADE,
  CONSTRAINT fk_kund_i_kop
  FOREIGN KEY (kund)
  REFERENCES kund(id)
  ON DELETE CASCADE
  ON UPDATE CASCADE
);


CREATE TABLE IF NOT EXISTS varugrupp (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  namn VARCHAR(100) NOT NULL,
  beskrivning VARCHAR(255),
  varugrupp INT UNSIGNED DEFAULT NULL,
  PRIMARY KEY (id),
  CONSTRAINT fk_varugrupp_i_varugrupp
  FOREIGN KEY (varugrupp)
  REFERENCES varugrupp(id)
  ON DELETE CASCADE
  ON UPDATE CASCADE
);


CREATE TABLE IF NOT EXISTS produkt_grupp
(
  produkt INT UNSIGNED NOT NULL,
  grupp INT UNSIGNED NOT NULL,
  PRIMARY KEY (produkt, grupp),
  CONSTRAINT fk_produkt_i_grupp
  FOREIGN KEY (produkt) REFERENCES produkt(id)
  ON DELETE CASCADE
  ON UPDATE CASCADE,
  CONSTRAINT fk_grupp_i_produkt
  FOREIGN KEY (grupp) REFERENCES grupp(id)
  ON DELETE CASCADE
  ON UPDATE CASCADE
);


CREATE TABLE IF NOT EXISTS produkt_varugrupp
(
  produkt INT UNSIGNED NOT NULL,
  varugrupp INT UNSIGNED NOT NULL,
  PRIMARY KEY (produkt, varugrupp),
  CONSTRAINT fk_produkt_i_varugrupp
  FOREIGN KEY (produkt) REFERENCES produkt(id)
  ON DELETE CASCADE
  ON UPDATE CASCADE,
  CONSTRAINT fk_varugrupp_i_produkt
  FOREIGN KEY (varugrupp) REFERENCES varugrupp(id)
  ON DELETE CASCADE
  ON UPDATE CASCADE
);


CREATE TABLE IF NOT EXISTS kampanj_produkt
(
  kampanj INT UNSIGNED NOT NULL,
  produkt INT UNSIGNED NOT NULL,
  PRIMARY KEY (kampanj, produkt),
  CONSTRAINT fk_kampanj_i_produkt
  FOREIGN KEY (kampanj) REFERENCES kampanj(id)
  ON DELETE CASCADE
  ON UPDATE CASCADE,
  CONSTRAINT fk_produkt_i_kampanj
  FOREIGN KEY (produkt) REFERENCES produkt(id)
  ON DELETE CASCADE
  ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS kampanj_varugrupp
(
  kampanj INT UNSIGNED NOT NULL,
  varugrupp INT UNSIGNED NOT NULL,
  PRIMARY KEY (kampanj, varugrupp),
  CONSTRAINT fk_kampanj_i_varugrupp
  FOREIGN KEY (kampanj) REFERENCES kampanj(id)
  ON DELETE CASCADE
  ON UPDATE CASCADE,
  CONSTRAINT fk_varugrupp_i_kampanj
  FOREIGN KEY (varugrupp) REFERENCES varugrupp(id)
  ON DELETE CASCADE
  ON UPDATE CASCADE
);



INSERT INTO leverantor
(namn, beskrivning, telefonnummer, gatuadress, stad, postnummer, land)
VALUES
('Frans & co', 'Levererar saker', '76543210', 'Vägenochgatan 1A', 'Orten', '12345', 'Sverige'),
('Import AB', 'Importerar saker', '01234567', 'Gatanochvägen 2B', 'Staden', '54321', 'Sverige');

INSERT INTO kampanj
(namn, beskrivning, rabattprocent, startdatum, slutdatum)
VALUES
('SOMMAR SOL', 'Fira sommaren med strålande priser.', 10, '2016-05-20', '2016-07-01');

INSERT INTO kund
(namn, email, telefonnummer, gatuadress, stad, postnummer)
VALUES
('Lisa Johnson', 'lh@g.com', '070125431', 'Delvägen 1', 'Mörtorp', '84655'),
('Klara Form', 'kf@g.com', '076123458', 'Kampgatan 2', 'Sjöbo', '44566');

INSERT INTO produkt
(namn, beskrivning, bild, pris, antal, tillverkare, modell, energiklass, garantitid_manader, egenskaper, inkopspris, leverantor, uppdaterad)
VALUES
('Kyl', 'En sak som kyler', 'http://www.gransbygden.se/nya_bilder/produkter/org/49148958jVQjz95QWYUQho2.jpg', '1499.95', 63, 'Freeze n Cold', 'FRIDGE X5000', 'A++', '24', 'Kyltid: 2 minuter.', '1000', 2, CURRENT_TIMESTAMP),
('Frys', 'En sak som fryser', 'http://ourbestbites.com/wp-content/uploads/2012/06/Freezer.jpg', '1999.95', 45, 'Freeze n Cold', 'FREEZER X1000', 'A+++', '36', 'Frystid: 2 minuter.', '1599.99', 1, CURRENT_TIMESTAMP);

INSERT INTO kop (id, antal, datum, produkt, kund)
VALUES
(NULL, '1', '2016-04-01 09:35:00', '1', '1'),
(NULL, '2', '2016-05-15 13:01:00', '2', '1'),
(NULL, '1', '2016-05-20 10:20:00', '2', '2');

INSERT INTO varugrupp
(namn, beskrivning, varugrupp)
VALUES
('Vitvaror', 'Huvudgrupp', NULL),
('Kylskåp', 'Undergrupp', 1),
('Frysskåp', 'Undergrupp', 1);

INSERT INTO grupp
(namn, beskrivning)
VALUES
('Kyl och frys', 'Köper man en kyl kommer man vilja köpa en frys.');

INSERT INTO produkt_grupp
(produkt, grupp)
VALUES
(1, 1),
(2, 1);

INSERT INTO kampanj_produkt
(kampanj, produkt)
VALUES
(1,2);
