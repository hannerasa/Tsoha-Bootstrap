-- Kayttaja-taulun testidata
INSERT INTO Kayttaja (nimi, password, rooli) VALUES ('Sonja', 'sala222', '10');
INSERT INTO Kayttaja (nimi, password, rooli) VALUES ('Veikko', 'sala888', '20');

-- Astiat-taulun testidata
INSERT INTO Astiat (nimi, vari, koko, hinta, muoto, malli) VALUES ('Lautanen', 'Harmaa','21 cm',' 15 €','Pyöreä','Matala');
INSERT INTO Astiat (nimi, vari, koko, hinta, muoto, malli) VALUES ('Kuppi', 'Vaalean Harmaa','21 cm', '12 €', 'Pyöreä', 'Syvä');
INSERT INTO Astiat (nimi, vari, koko, hinta, muoto, malli) VALUES ('Peltipurkki', 'Vihreä','49 cm', '12 €', 'Pyöreä','Syvä');
INSERT INTO Astiat (nimi, vari, koko, hinta, muoto, malli) VALUES ('Vati', 'Sininen','49 cm', '55 €', 'Pyöreä','Syvä'); 


-- Astiat-taulun testidata
INSERT INTO Brandi (nimi, valmistaja, maa) VALUES ('Teema', 'Iittala','Suomi');
INSERT INTO Brandi (nimi, valmistaja, maa) VALUES ('Taika''Arabia','Suomi');
INSERT INTO Brandi (nimi, valmistaja, maa) VALUES ('Ostindia''Röstrand','Ruotsi');


-- Brandi_Astiat testidata
INSERT INTO Brandi_Astiat(asbra_id, braas_id) VALUES ((select id from Astiat where nimi='Lautanen'),(select id from Brandi where nimi='Teema'));
INSERT INTO Brandi_Astiat(asbra_id, braas_id) VALUES ((select id from Astiat where nimi='Kuppi'),(select id from Brandi where nimi='Teema'));
INSERT INTO Brandi_Astiat(asbra_id, braas_id) VALUES ((select id from Astiat where nimi='Peltipurkki'),(select id from Brandi where nimi='Taika'));
INSERT INTO Brandi_Astiat(asbra_id, braas_id) VALUES ((select id from Astiat where nimi='Vati'),(select id from Brandi where nimi='Ostindia'));

-- Omistaja-taulun testidata
INSERT INTO Omistaja (nimi, puhelin) VALUES ('Soili', '72665481');
INSERT INTO Omistaja (nimi, puhelin) VALUES ('Ida', '9437878');
INSERT INTO Omistaja (nimi, puhelin) VALUES ('Hannele', '84236642');


-- Omistaja_Astiat testidata
INSERT INTO Omistaja_Astiat(asom_id, omas_id) VALUES ((select id from Astiat where nimi='Lautanen'),(select id from Omistaja where nimi='Hannele'));
INSERT INTO Omistaja_Astiat(asom_id, omas_id) VALUES ((select id from Astiat where nimi='Kuppi'),(select id from Omistaja where nimi='Ida'));
INSERT INTO Omistaja_Astiat(asom_id, omas_id) VALUES ((select id from Astiat where nimi='Peltipurkki'),(select id from Omistaja where nimi='Soili'));
INSERT INTO Omistaja_Astiat(asom_id, omas_id) VALUES ((select id from Astiat where nimi='Vati'),(select id from Omistja where nimi='Soili'));
