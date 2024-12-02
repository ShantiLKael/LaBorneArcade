DROP TABLE IF EXISTS Utilisateur CASCADE;
DROP TABLE IF EXISTS ArticleBlog CASCADE;
DROP TABLE IF EXISTS Faq CASCADE;
DROP TABLE IF EXISTS Joystick CASCADE;
DROP TABLE IF EXISTS TMolding CASCADE;
DROP TABLE IF EXISTS Matiere CASCADE;

DROP TABLE IF EXISTS Image CASCADE;

DROP TABLE IF EXISTS Option CASCADE;
DROP TABLE IF EXISTS Bouton CASCADE;
DROP TABLE IF EXISTS Theme CASCADE;
DROP TABLE IF EXISTS Borne CASCADE;

DROP TABLE IF EXISTS OptionBorne CASCADE;
DROP TABLE IF EXISTS JoystickBorne CASCADE;
DROP TABLE IF EXISTS BoutonBorne CASCADE;

DROP TABLE IF EXISTS ImageArticleBlog CASCADE;
DROP TABLE IF EXISTS ImageBorne CASCADE;

DROP TABLE IF EXISTS Commande CASCADE;
DROP TABLE IF EXISTS Panier CASCADE;

CREATE TABLE Utilisateur(
	id_Utilisateur      SERIAL PRIMARY KEY,
	email               VARCHAR(255) UNIQUE NOT NULL,
	mdp                 VARCHAR(255) NOT NULL,
	role                VARCHAR(50 ) NOT NULL,
	token_mdp           VARCHAR(255) UNIQUE,
	date_creation_token TIMESTAMP
);

CREATE TABLE Joystick(
	id_Joystick SERIAL PRIMARY KEY,
	modele      VARCHAR(50) NOT NULL,
	couleur     CHAR   (6 ) NOT NULL,
	UNIQUE     (modele,couleur)
);

CREATE TABLE TMolding(
	id_TMolding SERIAL PRIMARY KEY,
	nom         VARCHAR(50) NOT NULL,
	couleur     CHAR   (6 ) NOT NULL,
	UNIQUE      (nom,couleur)
);

CREATE TABLE Matiere(
	id_Matiere SERIAL PRIMARY KEY,
	nom    VARCHAR(50) NOT NULL,
	couleur    CHAR   (6 ) NOT NULL,
	UNIQUE(nom,couleur)
);

CREATE TABLE Theme(
	id_Theme SERIAL PRIMARY KEY,
	nom  VARCHAR(50) UNIQUE NOT NULL
);

CREATE TABLE Image(
	id_Image SERIAL PRIMARY KEY,
	chemin   VARCHAR(255) NOT NULL
);

CREATE TABLE Faq(
	id_Faq         SERIAL PRIMARY KEY,
	question       VARCHAR(50 ) NOT NULL,
	reponse        VARCHAR(255) NOT NULL,
	id_Utilisateur INT REFERENCES Utilisateur(id_Utilisateur) NOT NULL
);

CREATE TABLE ArticleBlog(
	id_ArticleBlog SERIAL PRIMARY KEY,
	titre          VARCHAR(50) NOT NULL,
	texte          TEXT        NOT NULL,
	id_Utilisateur INT REFERENCES Utilisateur(id_Utilisateur) NOT NULL
);

CREATE TABLE Borne(
	id_Borne    SERIAL PRIMARY KEY,
	nom     VARCHAR(50)  NOT NULL,
	description TEXT         NOT NULL,
	prix        INT          NOT NULL,
	id_TMolding INT REFERENCES TMolding(id_TMolding) NOT NULL,
	id_Matiere  INT REFERENCES Matiere (id_Matiere ) NOT NULL,
	id_Image    INT REFERENCES Image   (id_Image   ) NOT NULL,
	id_Theme    INT REFERENCES Theme   (id_Theme   ) NOT NULL
);

CREATE TABLE BornePerso(
	date_creation TIMESTAMP NOT NULL
) INHERITS (Borne);

CREATE TABLE Option(
	id_Option   SERIAL PRIMARY KEY,
	nom         VARCHAR(50) UNIQUE NOT NULL,
	description VARCHAR(255) NOT NULL,
	cout        INT NOT NULL,
	id_Image    INT REFERENCES Image(id_Image) NOT NULL
);

CREATE TABLE Bouton(
	id_Bouton SERIAL PRIMARY KEY,
	modele    VARCHAR(50) NOT NULL,
	forme     VARCHAR(50) NOT NULL, /* TODO Group in */
	couleur   CHAR(6) NOT NULL,
	eclairage BOOLEAN NOT NULL,
	UNIQUE  (modele,couleur,eclairage)
);

CREATE TABLE Commande(
	id_Commande       SERIAL PRIMARY KEY,
	date_creation     TIMESTAMP   NOT NULL,
	date_modif        TIMESTAMP   NOT NULL,
	etat              VARCHAR(50) NOT NULL, /* TODO Group in */
	id_Borne          INT REFERENCES Borne(id_Borne) NOT NULL,
	id_Utilisateur    INT REFERENCES Utilisateur(id_Utilisateur) NOT NULL
);

CREATE TABLE Panier(
	id_Utilisateur INT REFERENCES Utilisateur(id_Utilisateur) NOT NULL,
	id_Borne       INT REFERENCES Borne      (id_Borne      ) NOT NULL,
	PRIMARY KEY(id_Borne, id_Utilisateur)
);

CREATE TABLE OptionBorne(
	id_Borne  INT REFERENCES Borne (id_Borne ) NOT NULL,
	id_Option INT REFERENCES Option(id_Option) NOT NULL,
	PRIMARY KEY(id_Borne, id_Option)
);

CREATE TABLE JoystickBorne(
	id_Borne    INT REFERENCES Borne   (id_Borne   ) NOT NULL,
	id_Joystick INT REFERENCES Joystick(id_Joystick) NOT NULL,
	PRIMARY KEY(id_Borne, id_Joystick)
);

CREATE TABLE BoutonBorne(
	id_Borne  INT REFERENCES Borne (id_Borne ) NOT NULL,
	id_Bouton INT REFERENCES Bouton(id_Bouton) NOT NULL,
	PRIMARY KEY(id_Borne, id_Bouton)
);

CREATE TABLE ImageArticleBlog(
	id_ArticleBlog INT REFERENCES ArticleBlog(id_ArticleBlog) NOT NULL,
	id_Image       INT REFERENCES Image      (id_Image      ) NOT NULL,
	PRIMARY KEY(id_Image, id_ArticleBlog)
);

CREATE TABLE ImageBorne(
	id_Image INT REFERENCES Image(id_Image) NOT NULL,
	id_Borne INT REFERENCES Borne(id_Borne) NOT NULL,
	PRIMARY KEY(id_Image, id_Borne)
);