-- Insertion des données dans la table Utilisateur
INSERT INTO Utilisateur (email, mdp, role, token_mdp, date_creation_token)
VALUES
('admin@example.com', 'hashed_password_1', 'admin', NULL, NULL),
('user1@example.com', 'hashed_password_2', 'user', 'token123', '2024-12-01 12:00:00'),
('user2@example.com', 'hashed_password_3', 'user', NULL, NULL);

-- Insertion des données dans la table Joystick
INSERT INTO Joystick (modele, couleur)
VALUES
('Joystick1', 'FF5733'),
('Joystick2', '33FF57');

-- Insertion des données dans la table TMolding
INSERT INTO TMolding (nom, couleur)
VALUES
('T-Molding1', '5733FF'),
('T-Molding2', '33FFF5');

-- Insertion des données dans la table Matiere
INSERT INTO Matiere (nom, couleur)
VALUES
('Bois', 'AABBCC'),
('Metal', 'DDEEFF');

-- Insertion des données dans la table Theme
INSERT INTO Theme (nom)
VALUES
('Retro'),
('Futuriste');

-- Insertion des données dans la table Image
INSERT INTO Image (chemin)
VALUES
('/images/image1.jpg'),
('/images/image2.jpg');

-- Insertion des données dans la table Faq
INSERT INTO Faq (question, reponse, id_Utilisateur)
VALUES
('Comment utiliser la borne?', 'Consultez le manuel.', 1),
('Quels sont les modes disponibles?', 'Arcade et Simulation.', 2);

-- Insertion des données dans la table ArticleBlog
INSERT INTO ArticleBlog (titre, texte, id_Utilisateur)
VALUES
('L''histoire des bornes', 'Un texte sur les bornes...', 1),
('Les meilleures bornes', 'Comparaison des bornes...', 2);

-- Insertion des données dans la table Borne
INSERT INTO Borne (nom, description, prix, id_TMolding, id_Matiere, id_Theme)
VALUES
('Borne1', 'Description de la Borne 1', 1500.00, 1, 1, 1),
('Borne2', 'Description de la Borne 2', 2000.00, 2, 2, 2),
('Borne3', 'Description de la Borne 2', 2000.00, 2, 2, 2),
('Borne4', 'Description de la Borne 2', 2000.00, 2, 2, 2),
('Borne5', 'Description de la Borne 2', 2000.00, 2, 2, 2),
('Borne6', 'Description de la Borne 2', 2000.00, 2, 2, 2),
('Borne7', 'Description de la Borne 2', 2000.00, 2, 2, 2),
('Borne8', 'Description de la Borne 2', 2000.00, 2, 2, 2),
('Borne9', 'Description de la Borne 2', 2000.00, 2, 2, 2),
('Borne10', 'Description de la Borne 2', 2000.00, 2, 2, 2),
('Borne11', 'Description de la Borne 2', 2000.00, 2, 2, 2),
('Borne12', 'Description de la Borne 2', 2000.00, 2, 2, 2),
('Borne13', 'Description de la Borne 2', 2000.00, 2, 2, 2),
('Borne14', 'Description de la Borne 2', 2000.00, 2, 2, 2),
('Borne51', 'Description de la Borne 2', 2000.00, 2, 2, 2),
('Borne16', 'Description de la Borne 2', 2000.00, 2, 2, 2),
('Borne17', 'Description de la Borne 2', 2000.00, 2, 2, 2);

-- Insertion des données dans la table BornePerso
INSERT INTO BornePerso (prix, id_Borne, id_TMolding, id_Matiere, date_creation, date_modif)
VALUES
(1800.00, 1, 1, 1, '2024-12-01 12:00:00', '2024-12-01 12:00:00'),
(2300.00, 2, 2, 2, '2024-12-02 14:00:00', '2024-12-02 14:00:00');

-- Insertion des données dans la table Option
INSERT INTO Option (nom, description, cout, id_Image)
VALUES
('Option1', 'Description de l''option 1', 50, 1),
('Option2', 'Description de l''option 2', 100, 2);

-- Insertion des données dans la table Bouton
INSERT INTO Bouton (modele, forme, couleur, eclairage)
VALUES
('Bouton1', 'Rond', '123456', TRUE),
('Bouton2', 'Carré', '654321', FALSE);

-- Insertion des données dans la table Commande
INSERT INTO Commande (date_creation, date_modif, etat, id_BornePerso, id_Utilisateur)
VALUES
('2024-12-03 10:00:00', '2024-12-03 10:00:00', 'En cours', 1, 2),
('2024-12-04 11:00:00', '2024-12-04 11:00:00', 'Livré', 2, 3);

-- Insertion des données dans la table Panier
INSERT INTO Panier (id_Utilisateur, id_BornePerso)
VALUES
(2, 1),
(3, 2);

-- Insertion des données dans la table OptionBornePerso
INSERT INTO OptionBornePerso (id_BornePerso, id_Option)
VALUES
(1, 1),
(2, 2);

-- Insertion des données dans la table OptionBorne
INSERT INTO OptionBorne (id_Borne, id_Option)
VALUES
(1, 1),
(2, 2);

-- Insertion des données dans la table JoystickBornePerso
INSERT INTO JoystickBornePerso (id_BornePerso, id_Joystick)
VALUES
(1, 1),
(2, 2);

-- Insertion des données dans la table JoystickBorne
INSERT INTO JoystickBorne (id_Borne, id_Joystick)
VALUES
(1, 1),
(2, 2);

-- Insertion des données dans la table BoutonBornePerso
INSERT INTO BoutonBornePerso (id_BornePerso, id_Bouton)
VALUES
(1, 1),
(2, 2);

-- Insertion des données dans la table BoutonBorne
INSERT INTO BoutonBorne (id_Borne, id_Bouton)
VALUES
(1, 1),
(2, 2);

-- Insertion des données dans la table ImageArticleBlog
INSERT INTO ImageArticleBlog (id_ArticleBlog, id_Image)
VALUES
(1, 1),
(2, 2);

-- Insertion des données dans la table ImageBorne
INSERT INTO ImageBorne (id_Image, id_Borne)
VALUES
(1, 1),
(2, 2);
