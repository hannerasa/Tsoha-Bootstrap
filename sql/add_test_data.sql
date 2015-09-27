-- Kayttaja-taulun testidata
INSERT INTO Kayttaja (nimi, password, rooli) VALUES ('Hannele', 'sala123', '10');
INSERT INTO Kayttaja (nimi, password, rooli) VALUES ('Pekka', 'sala456', '20');

-- Astiat-taulun testidata
INSERT INTO Astiat (nimi, vari, koko, hinta, muoto, malli) VALUES ('Lautanen', 'Harmaa','21 cm',' 15 €','Pyöreä','Syvä');
INSERT INTO Astiat (nimi, vari, koko, hinta, muoto, malli) VALUES ('Kuppi', 'Vaalean Harmaa','21 cm', '12 €', 'Pyöreä', 'Syvä');

INSERT INTO Astiat (nimi, vari, koko, hinta, muoto,malli) VALUES ('Kuppi', 'Vihreä','2 dl', '12 €', 'Pyöreä','Syvä'); 

-- Astiat-taulun testidata
INSERT INTO Brandi (nimi) VALUES ('Teema');
INSERT INTO Brandi (nimi) VALUES ('Taika');

-- Luokittelu taulun testidata
INSERT INTO Luokittelu (nimi, arvo) VALUES ('vari', 'Harmaa');
INSERT INTO Luokittelu (nimi, arvo) VALUES ('koko', '21 cm');
INSERT INTO Luokittelu (nimi, arvo) VALUES ('hinta', '15 cm');
INSERT INTO Luokittelu (nimi, arvo) VALUES ('muoto', 'pyöreä');
INSERT INTO Luokittelu (nimi, arvo) VALUES ('malli', 'syvä');