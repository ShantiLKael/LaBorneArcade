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
DROP TABLE IF EXISTS ArticleImage CASCADE;
DROP TABLE IF EXISTS BorneImage CASCADE;
DROP TABLE IF EXISTS Commande CASCADE;
DROP TABLE IF EXISTS Panier CASCADE;

CREATE TABLE Utilisateur(
	id_Utilisateur SERIAL PRIMARY KEY,
	email VARCHAR(255) UNIQUE NOT NULL,
	mdp   VARCHAR(255) NOT NULL,
	role  VARCHAR(50) NOT NULL,
	token_mdp VARCHAR(255),
	creation_token_mdp DATE
);
CREATE TABLE Joystick(
	id_Joystick SERIAL PRIMARY KEY,
	modele  VARCHAR(50) NOT NULL,
	couleur VARCHAR(50) NOT NULL
);
CREATE TABLE TMolding(
	id_TMolding SERIAL PRIMARY KEY,
	modele  VARCHAR(50) NOT NULL,
	couleur VARCHAR(50) NOT NULL
);
CREATE TABLE Matiere(
	id_Matiere SERIAL PRIMARY KEY,
	libelle VARCHAR(50) NOT NULL,
	couleur VARCHAR(50) NOT NULL
);
CREATE TABLE Theme(
	id_Theme SERIAL PRIMARY KEY,
	libelle VARCHAR(50) UNIQUE NOT NULL
);
CREATE TABLE Image(
	id_Image SERIAL PRIMARY KEY,
	chemin VARCHAR(255) NOT NULL
);
CREATE TABLE Faq(
	id_Faq SERIAL PRIMARY KEY,
	question VARCHAR(50) NOT NULL,
	reponse  VARCHAR(255) NOT NULL,
	id_Utilisateur INT REFERENCES Utilisateur(id_Utilisateur)
);
CREATE TABLE ArticleBlog(
	id_ArticleBlog SERIAL PRIMARY KEY,
	titre VARCHAR(50) NOT NULL,
	texte VARCHAR(50) NOT NULL,
	id_Utilisateur INT REFERENCES Utilisateur(id_Utilisateur)
);
CREATE TABLE Borne(
	id_Borne SERIAL PRIMARY KEY,
	libelle VARCHAR(50) NOT NULL,
	description VARCHAR(255) NOT NULL,
	prix INT NOT NULL,
	id_TMolding INT REFERENCES TMolding(id_TMolding),
	id_Matiere INT REFERENCES Matiere(id_Matiere),
	id_Theme INT REFERENCES Theme(id_Theme)
);
CREATE TABLE Option(
	id_Option SERIAL PRIMARY KEY,
	libelle VARCHAR(50) UNIQUE NOT NULL,
	description VARCHAR(255) NOT NULL,
	cout INT NOT NULL,
	id_Image INT REFERENCES Image(id_Image)
);
CREATE TABLE Bouton(
	id_Bouton SERIAL PRIMARY KEY,
	modele  VARCHAR(50) NOT NULL,
	forme   VARCHAR(50) NOT NULL,
	couleur VARCHAR(50) NOT NULL,
	eclairage BOOLEAN NOT NULL,
	id_Image INT REFERENCES Image(id_Image)
);
CREATE TABLE BornePersonalise(
	creation_borne DATE NOT NULL
) INHERITS (Borne);
CREATE TABLE Commande(
	id_Commande SERIAL PRIMARY KEY,
	creation_commande DATE NOT NULL,
	commande_modiff DATE NOT NULL,
	etat VARCHAR(50) NOT NULL,
	id_Borne INT REFERENCES Borne(id_Borne),
	id_Utilisateur INT REFERENCES Utilisateur(id_Utilisateur)
);
CREATE TABLE Panier(
	id_Utilisateur INT REFERENCES Utilisateur(id_Utilisateur),
	id_Borne INT REFERENCES Borne(id_Borne),
	PRIMARY KEY(id_Borne, id_Utilisateur)
);
CREATE TABLE OptionBorne(
	id_Borne INT REFERENCES Borne(id_Borne),
	id_Option INT REFERENCES Option(id_Option),
	PRIMARY KEY(id_Borne, id_Option)
);
CREATE TABLE JoystickBorne(
	id_Borne INT REFERENCES Borne(id_Borne),
	id_Joystick INT REFERENCES Joystick(id_Joystick),
	PRIMARY KEY(id_Borne, id_Joystick)
);
CREATE TABLE BoutonBorne(
	id_Borne INT REFERENCES Borne(id_Borne),
	id_Bouton INT REFERENCES Bouton(id_Bouton),
	PRIMARY KEY(id_Borne, id_Bouton)
);
CREATE TABLE ArticleImage(
	id_Image INT REFERENCES Image(id_Image),
	id_ArticleBlog INT REFERENCES ArticleBlog(id_ArticleBlog),
	PRIMARY KEY(id_Image, id_ArticleBlog)
);
CREATE TABLE BorneImage(
	id_Image INT REFERENCES Image(id_Image),
	id_Borne INT REFERENCES Borne(id_Borne),
	PRIMARY KEY(id_Image, id_Borne)
);


