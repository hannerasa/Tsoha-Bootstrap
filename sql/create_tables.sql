CREATE TABLE Kayttaja(
  kayt_id SERIAL PRIMARY KEY, 
  nimi varchar(50) NOT NULL,
  password varchar(50) NOT NULL,
  rooli varchar(50) NOT NULL
);

CREATE TABLE Astiat(
  as_id SERIAL PRIMARY KEY,
  nimi varchar(50) NOT NULL,
  vari varchar(50) NOT NULL,
  koko varchar(50) NOT NULL,
  hinta varchar(50) NOT NULL,
  muoto varchar(50) NOT NULL,
  malli varchar(50) NOT NULL,
  om_id INTEGER REFERENCES Omistaja(om_id),
  om_id2 INTEGER REFERENCES Omistaja(om_id2)
  );

CREATE TABLE Brandi(
  bra_id SERIAL PRIMARY KEY,
  nimi varchar(50) NOT NULL
  valmistaja varchar(50) NOT NULL
  maa varchar(50) NOT NULL
  );

CREATE TABLE Omistaja(
  om_id SERIAL PRIMARY KEY,
  nimi varchar(50) NOT NULL
  );

CREATE TABLE Omistaja_Astiat(
    om_id INTEGER REFERENCES Omistaja(om_id),
    as_id INTEGER REFERENCES Astiat(as_id),
  );

