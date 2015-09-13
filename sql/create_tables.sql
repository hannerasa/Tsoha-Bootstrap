-- Lisää CREATE TABLE lauseet tähän tiedostoon

CREATE TABLE Kayttaja(
  kayt_id SERIAL PRIMARY KEY, -- SERIAL tyyppinen pääavain pitää huolen, että tauluun lisätyllä rivillä on aina uniikki pääavain. Kätevää!
  nimi varchar(50) NOT NULL, -- Muista erottaa sarakkeiden määrittelyt pilkulla!
  password varchar(50) NOT NULL,
  rooli varchar(50) NOT NULL
);

CREATE TABLE Astiat(
  as_id SERIAL PRIMARY KEY,
  nimi varchar(50) NOT NULL
  );


CREATE TABLE Brandi(
  bra_id SERIAL PRIMARY KEY,
  nimi varchar(50) NOT NULL
  );


CREATE TABLE Luokittelu(
  vari varchar(50),
  koko varchar(50),
  hinta varchar(50),
  muoto varchar(100),
  malli varchar(50) 
);