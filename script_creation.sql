DROP TABLE IF EXISTS Utilisateur CASCADE;
DROP TABLE IF EXISTS ArticleBlog CASCADE;
DROP TABLE IF EXISTS Faq CASCADE;
DROP TABLE IF EXISTS Joystick CASCADE;
DROP TABLE IF EXISTS TMolding CASCADE;
DROP TABLE IF EXISTS Matiere CASCADE;

DROP TABLE IF EXISTS Image CASCADE;

DROP TABLE IF EXISTS "Option" CASCADE;
DROP TABLE IF EXISTS Bouton CASCADE;
DROP TABLE IF EXISTS Theme CASCADE;
DROP TABLE IF EXISTS Borne CASCADE;
DROP TABLE IF EXISTS BornePerso CASCADE;

DROP TABLE IF EXISTS OptionBorne CASCADE;
DROP TABLE IF EXISTS JoystickBorne CASCADE;
DROP TABLE IF EXISTS BoutonBorne CASCADE;
DROP TABLE IF EXISTS OptionBornePerso CASCADE;
DROP TABLE IF EXISTS JoystickBornePerso CASCADE;
DROP TABLE IF EXISTS BoutonBornePerso CASCADE;

DROP TABLE IF EXISTS ImageArticleBlog CASCADE;
DROP TABLE IF EXISTS ImageBorne CASCADE;

DROP TABLE IF EXISTS Commande CASCADE;
DROP TABLE IF EXISTS Panier CASCADE;

CREATE TABLE Utilisateur(
	id_utilisateur      SERIAL PRIMARY KEY,
	email               VARCHAR(255) UNIQUE NOT NULL,
	mdp                 VARCHAR(255)        NOT NULL,
	role                VARCHAR(50)         NOT NULL,
	token_mdp           VARCHAR(255) UNIQUE,
	date_creation_token TIMESTAMP
);

CREATE TABLE Joystick(
	id_joystick SERIAL PRIMARY KEY,
	modele      VARCHAR(50) NOT NULL,
	couleur     CHAR(7 )    NOT NULL,
	UNIQUE (modele, couleur)
);

CREATE TABLE TMolding(
	id_tmolding SERIAL PRIMARY KEY,
	nom         VARCHAR(50) NOT NULL,
	couleur     CHAR(7)     NOT NULL,
	UNIQUE (nom, couleur)
);

CREATE TABLE Matiere(
	id_matiere SERIAL PRIMARY KEY,
	nom        VARCHAR(50) NOT NULL,
	couleur    CHAR(7)     NOT NULL,
	UNIQUE (nom, couleur)
);

CREATE TABLE Theme(
	id_theme SERIAL PRIMARY KEY,
	nom  VARCHAR(50) UNIQUE NOT NULL
);

CREATE TABLE Image(
	id_image SERIAL PRIMARY KEY,
	chemin   VARCHAR(255) NOT NULL
);

CREATE TABLE Faq(
	id_faq         SERIAL PRIMARY KEY,
	question       VARCHAR(50)                                NOT NULL,
	reponse        VARCHAR(255)                               NOT NULL,
	id_utilisateur INT REFERENCES Utilisateur(id_utilisateur) NOT NULL
);

CREATE TABLE ArticleBlog(
	id_articleblog SERIAL PRIMARY KEY,
	titre          VARCHAR(50)                                NOT NULL,
	texte          TEXT                                       NOT NULL,
	id_utilisateur INT REFERENCES Utilisateur(id_utilisateur) NOT NULL
);

CREATE TABLE Borne(
	id_borne    SERIAL PRIMARY KEY,
	nom         VARCHAR(50)                          NOT NULL,
	description TEXT                                 NOT NULL,
	prix        FLOAT                                NOT NULL,
	id_tmolding INT REFERENCES TMolding(id_tmolding) NOT NULL,
	id_matiere  INT REFERENCES Matiere (id_matiere)  NOT NULL,
	id_theme    INT REFERENCES Theme   (id_theme)    NOT NULL
);

CREATE TABLE BornePerso(
	id_borneperso SERIAL PRIMARY KEY,
	prix          FLOAT                                NOT NULL,
	id_borne      INT REFERENCES Borne   (id_borne),
	id_tmolding   INT REFERENCES TMolding(id_tmolding) NOT NULL,
	id_matiere    INT REFERENCES Matiere (id_matiere)  NOT NULL,
	date_creation TIMESTAMP                            NOT NULL,
	date_modif    TIMESTAMP                            NOT NULL
);

CREATE TABLE "Option"(
	id_option   SERIAL PRIMARY KEY,
	nom         VARCHAR(50 ) UNIQUE NOT NULL,
	description VARCHAR(255) NOT NULL,
	cout        INT NOT NULL,
	id_image    INT REFERENCES Image(id_image) NOT NULL
);

CREATE TABLE Bouton(
	id_bouton SERIAL PRIMARY KEY,
	modele    VARCHAR(50) NOT NULL,
	forme     VARCHAR(50) NOT NULL, /* TODO Group in */
	couleur   CHAR(7)     NOT NULL,
	eclairage BOOLEAN     NOT NULL,
	UNIQUE  (modele, couleur, forme)
);

CREATE TABLE Commande(
	id_commande       SERIAL PRIMARY KEY,
	date_creation     TIMESTAMP   NOT NULL,
	date_modif        TIMESTAMP   NOT NULL,
	etat              VARCHAR(50) NOT NULL, /* TODO Group in */
	id_borneperso     INT REFERENCES BornePerso (id_borneperso)  NOT NULL,
	id_utilisateur    INT REFERENCES Utilisateur(id_utilisateur) NOT NULL
);

CREATE TABLE Panier(
	id_utilisateur INT REFERENCES Utilisateur(id_utilisateur) NOT NULL,
	id_borneperso  INT REFERENCES BornePerso (id_borneperso)  NOT NULL,
	PRIMARY KEY(id_borneperso, id_utilisateur)
);

CREATE TABLE OptionBornePerso(
	id_BornePerso INT REFERENCES BornePerso(id_borneperso) NOT NULL,
	id_Option     INT REFERENCES "Option"  (id_option)     NOT NULL,
	PRIMARY KEY(id_BornePerso, id_Option)
);

CREATE TABLE OptionBorne(
	id_borne  INT REFERENCES Borne   (id_borne)  NOT NULL,
	id_option INT REFERENCES "Option"(id_option) NOT NULL,
	PRIMARY KEY(id_borne, id_option)
);

CREATE TABLE JoystickBornePerso(
	id_bornePerso INT REFERENCES BornePerso(id_borneperso) NOT NULL,
	id_joystick   INT REFERENCES Joystick  (id_joystick)   NOT NULL,
	ordre         INT                                      NOT NULL,
	PRIMARY KEY(id_bornePerso, id_joystick)
);

CREATE TABLE JoystickBorne(
	id_borne    INT REFERENCES Borne   (id_borne)    NOT NULL,
	id_joystick INT REFERENCES Joystick(id_joystick) NOT NULL,
	ordre       INT                                  NOT NULL,
	PRIMARY KEY(id_borne, id_joystick)
);

CREATE TABLE BoutonBornePerso(
	id_borneperso INT REFERENCES BornePerso(id_borneperso) NOT NULL,
	id_bouton     INT REFERENCES Bouton    (id_bouton)     NOT NULL,
	ordre         INT                                      NOT NULL,
	PRIMARY KEY(id_borneperso, id_bouton, ordre)
);

CREATE TABLE BoutonBorne(
	id_borne  INT REFERENCES Borne (id_borne)  NOT NULL,
	id_bouton INT REFERENCES Bouton(id_bouton) NOT NULL,
	ordre     INT                              NOT NULL,
	PRIMARY KEY(id_borne, id_bouton, ordre)
);

CREATE TABLE ImageArticleBlog(
	id_articleblog INT REFERENCES ArticleBlog(id_articleblog) NOT NULL,
	id_image       INT REFERENCES Image      (id_image)       NOT NULL,
	PRIMARY KEY(id_image, id_articleblog)
);

CREATE TABLE ImageBorne(
	id_image INT REFERENCES Image(id_image) NOT NULL,
	id_borne INT REFERENCES Borne(id_borne) NOT NULL,
	PRIMARY KEY(id_image, id_borne)
);
