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
  malli varchar(50) NOT NULL
  );

CREATE TABLE Brandi(
  bra_id SERIAL PRIMARY KEY,
  nimi varchar(50) NOT NULL
  );

CREATE TABLE Luokittelu(
  luokit_id SERIAL PRIMARY KEY,
  nimi varchar(50) NOT NULL,
  arvo varchar(50) NOT NULL
  );
