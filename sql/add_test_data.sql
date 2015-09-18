-- Lisää INSERT INTO lauseet tähän tiedostoon

-- Kayttaja-taulun testidata
INSERT INTO Kayttaja (nimi, password, rooli) VALUES ('Hannele', 'sala123', '10');
INSERT INTO Kayttaja (nimi, password, rooli) VALUES ('Pekka', 'sala456', '20');

-- Astiat-taulun testidata
INSERT INTO Astiat (nimi) VALUES ('Lautanen');
INSERT INTO Astiat (nimi) VALUES ('Kuppi');

-- Astiat-taulun testidata
INSERT INTO Brandi (nimi) VALUES ('Teema');
INSERT INTO Brandi (nimi) VALUES ('Taika');


-- Luokittelu taulun testidata
INSERT INTO Luokittelu (nimi, arvo) VALUES ('väri', 'Harmaa');
INSERT INTO Luokittelu (nimi, arvo) VALUES ('koko', '21 cm');
INSERT INTO Luokittelu (nimi, arvo) VALUES ('hinta', '15 €');
INSERT INTO Luokittelu (nimi, arvo) VALUES ('muoto', 'pyöreä');
INSERT INTO Luokittelu (nimi, arvo) VALUES ('malli', 'syvä');