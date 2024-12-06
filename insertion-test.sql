-- Insertion des données dans la table Utilisateur
INSERT INTO Utilisateur (id_Utilisateur, email, mdp, role, token_mdp, date_creation_token)
VALUES
(1, 'admin@example.com', 'hashed_password_1', 'admin', NULL, NULL),
(2, 'user1@example.com', 'hashed_password_2', 'user', 'token123', '2024-12-01 12:00:00'),
(3, 'user2@example.com', 'hashed_password_3', 'user', NULL, NULL);

-- Insertion des données dans la table Joystick
INSERT INTO Joystick (id_Joystick, modele, couleur)
VALUES
(1, 'Joystick1', 'FF5733'),
(2, 'Joystick2', '33FF57');

-- Insertion des données dans la table TMolding
INSERT INTO TMolding (id_TMolding, nom, couleur)
VALUES
(1, 'T-Molding1', '5733FF'),
(2, 'T-Molding2', '33FFF5');

-- Insertion des données dans la table Matiere
INSERT INTO Matiere (id_Matiere, nom, couleur)
VALUES
(1, 'Bois', 'AABBCC'),
(2, 'Metal', 'DDEEFF');

-- Insertion des données dans la table Theme
INSERT INTO Theme (id_Theme, nom)
VALUES
(1, 'Retro'),
(2, 'Futuriste');

-- Insertion des données dans la table Image
INSERT INTO Image (id_Image, chemin)
VALUES
(1, '/images/image1.jpg'),
(2, '/images/image2.jpg');

-- Insertion des données dans la table Faq
INSERT INTO Faq (id_Faq, question, reponse, id_Utilisateur)
VALUES
(1, 'Comment utiliser la borne?', 'Consultez le manuel.', 1),
(2, 'Quels sont les modes disponibles?', 'Arcade et Simulation.', 2);

-- Insertion des données dans la table ArticleBlog
INSERT INTO ArticleBlog (id_ArticleBlog, titre, texte, id_Utilisateur)
VALUES
(1, 'L’histoire des bornes', 'Un texte sur les bornes...', 1),
(2, 'Les meilleures bornes', 'Comparaison des bornes...', 2);

-- Insertion des données dans la table Borne
INSERT INTO Borne (id_Borne, nom, description, prix, id_TMolding, id_Matiere, id_Theme)
VALUES
(1, 'Borne1', 'Description de la Borne 1', 1500.00, 1, 1, 1),
(2, 'Borne2', 'Description de la Borne 2', 2000.00, 2, 2, 2);

-- Insertion des données dans la table BornePerso
INSERT INTO BornePerso (id_BornePerso, prix, id_Borne, id_TMolding, id_Matiere, date_creation, date_modif)
VALUES
(1, 1800.00, 1, 1, 1, '2024-12-01 12:00:00', '2024-12-01 12:00:00'),
(2, 2300.00, 2, 2, 2, '2024-12-02 14:00:00', '2024-12-02 14:00:00');

-- Insertion des données dans la table Option
INSERT INTO Option (id_Option, nom, description, cout, id_Image)
VALUES
(1, 'Option1', 'Description de l’option 1', 50, 1),
(2, 'Option2', 'Description de l’option 2', 100, 2);

-- Insertion des données dans la table Bouton
INSERT INTO Bouton (id_Bouton, modele, forme, couleur, eclairage)
VALUES
(1, 'Bouton1', 'Rond', '123456', TRUE),
(2, 'Bouton2', 'Carré', '654321', FALSE);

-- Insertion des données dans la table Commande
INSERT INTO Commande (id_Commande, date_creation, date_modif, etat, id_BornePerso, id_Utilisateur)
VALUES
(1, '2024-12-03 10:00:00', '2024-12-03 10:00:00', 'En cours', 1, 2),
(2, '2024-12-04 11:00:00', '2024-12-04 11:00:00', 'Livré', 2, 3);

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
