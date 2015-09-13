-- Lisää INSERT INTO lauseet tähän tiedostoon

-- Kayttaja-taulun testidata
INSERT INTO Kayttaja (nimi, password) VALUES ('Hannele', 'sala123'); -- Koska id-sarakkeen tietotyyppi on SERIAL, se asetetaan automaattisesti
INSERT INTO Kayttäja (name, password) VALUES ('Pekka', 'sala456');
-- Luokittelu taulun testidata
INSERT INTO Luokittelu (vari, koko, hinta, muoto, malli) VALUES ('Harmaa', '2 dl', '15 €', 'Pyöreä', '__');
INSERT INTO Luokittelu (vari, koko, hinta, muoto, malli) VALUES ('Vihreä', '15 cm', '25 €', 'Pyöreä', 'Syvä');
INSERT INTO Luokittelu (vari, koko, hinta, muoto, malli) VALUES ('Vaalean harmaa', '26 cm', '29 €', 'Pyöreä', 'Matala');