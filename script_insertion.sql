# noinspection SqlResolveForFile

INSERT INTO Utilisateur (email, mdp, role) VALUES
    ('admin@arcadeworld.com', 'password123', 'admin'),
    ('buyer@arcadeworld.com', 'securepass',  'acheteur');


INSERT INTO ArticleBlog (titre, texte, id_Utilisateur) VALUES
	(
	'Les Précurseurs des Bornes d''Arcade',
	'Les bornes d''arcade modernes trouvent leurs racines dans les premiers jeux électromécaniques des années 60. Des jeux comme "Pong", conçu par Atari en 1972, ont marqué le début d''une révolution. Ces premiers systèmes, bien que simples, posaient les bases d''un nouveau type de divertissement interactif. À mesure que la technologie progressait, des entreprises comme Sega et Namco ont introduit des concepts plus complexes, donnant naissance à une industrie florissante.',
	1
	),
	(
	'Les Années Dorées des Salles d''Arcade',
    'Les années 80 sont souvent considérées comme l''âge d''or des salles d''arcade. Ces lieux étaient bien plus que des endroits pour jouer : ils étaient des centres sociaux où les gens se réunissaient pour partager leur passion. Des jeux emblématiques comme Donkey Kong et Space Invaders ont attiré des foules, créant une culture unique qui persiste encore aujourd''hui. C''était l''époque où chaque nouvelle borne captivait l''imagination des joueurs.',
    1
	),
	(
    'Les Jeux d''Arcade les Plus Rares',
    'Saviez-vous que certaines bornes d''arcade sont aujourd''hui considérées comme de véritables trésors ? Des jeux comme "Polybius" sont entourés de mystères et de légendes urbaines. D''autres, comme "Quantum" d''Atari ou "Primal Rage II", n''ont été produits qu''en très petites quantités. Ces bornes sont très recherchées par les collectionneurs et peuvent atteindre des prix exorbitants sur le marché, renforçant leur aura mythique.',
    1
	),
	(
    'L''Expérience Sociale des Bornes d''Arcade',
    'Jouer sur une borne d''arcade est bien plus qu''une expérience individuelle : c''est un événement social. La compétition amicale pour battre un score ou les encouragements des spectateurs autour d''une partie créent une ambiance unique. Cette dynamique sociale est l''une des raisons pour lesquelles les bornes d''arcade restent populaires, même à l''ère du gaming en ligne, car elles offrent une interaction humaine directe qui est incomparable.',
    1
	),
	(
    'Les Bornes d''Arcade dans le Cinéma',
    'Les bornes d''arcade ne se limitent pas aux salles de jeu : elles ont également laissé une empreinte indélébile dans le cinéma. Des films comme "Tron" ou "The Last Starfighter" ont capturé l''essence de cette époque, en intégrant des éléments de jeux vidéo dans leurs intrigues. Ces représentations ont renforcé l''image des bornes d''arcade comme des symboles de technologie et de créativité, tout en inspirant une nouvelle génération de cinéastes et de joueurs.',
    1
	),
	(
    'Pourquoi Restaurer une Borne d''Arcade ?',
    'Restaurer une borne d''arcade ancienne est une véritable passion pour les amateurs de rétro gaming. C''est une activité qui allie bricolage, électronique et amour du jeu vidéo. Chaque restauration est une opportunité de redonner vie à une pièce d''histoire. Ces bornes sont non seulement des objets de collection, mais aussi des témoignages d''une époque où le jeu vidéo commençait à conquérir le monde. Leur restauration est une façon de préserver ce patrimoine.',
    1
	),
	(
    'Les Bornes d''Arcade et la Réalité Virtuelle',
    'La réalité virtuelle (VR) a ouvert une nouvelle ère pour les bornes d''arcade. Aujourd''hui, certaines bornes offrent des expériences immersives où les joueurs peuvent interagir avec des mondes virtuels grâce à des casques VR. Cela ajoute une nouvelle dimension au jeu, combinant la nostalgie des arcades classiques avec des technologies modernes. Ces bornes VR attirent de nouveaux publics tout en gardant vivante l''essence des jeux d''arcade.',
    1
	),
	(
    'Les Bornes d''Arcade : Un Investissement Rentable ?',
    'Pour les amateurs de rétro gaming, acheter une borne d''arcade peut être un investissement passionnant, mais rentable ? Tout dépend de l''approche. Les modèles rares et en bon état peuvent se vendre à prix d''or sur le marché des collectionneurs. D''autre part, les bornes modernes attirent des joueurs dans les bars et les cafés, générant des revenus constants. Investir dans une borne peut donc être rentable à la fois pour les collectionneurs et les entrepreneurs.',
    1
	);


INSERT INTO Image VALUES
	(1, 'public/assets/image/article/1/borneCote.webp'),
	(2, 'public/assets/image/article/1/borneFace.webp'),
	(3, 'public/assets/image/article/2/borneCoteLoin.webp'),
	(4, 'public/assets/image/article/2/clavier.webp'),
	(5, 'public/assets/image/article/2/telephone.webp');

-- Récupération des ID générés pour les images (à ajuster si nécessaire selon vos IDs réels)
-- Article 1
INSERT INTO ImageArticleBlog (id_Image, id_ArticleBlog) VALUES
	(1, 1),
	(2, 1);

-- Article 2
INSERT INTO ImageArticleBlog (id_Image, id_ArticleBlog) VALUES
	(3, 2),
	(4, 2),
	(5, 2);



INSERT INTO Theme (nom) VALUES
	('pac-man'),
	('jeux vidéo'),
	('goldorak'),
	('blade runner'),
	('film');


INSERT INTO Joystick (modele, couleur) VALUES
	('Sanwa JLF',        '#FF0000'),
	('Sanwa JLF',        '#0000FF'),
	('Happ Competition', '#FFFF00'),
	('Happ Ultimate',    '#00FF00'),
	('Seimitsu LS-32',   '#FFFFFF'),
	('Seimitsu LS-40',   '#000000'),
	('Zippy Classic',    '#FFA500');

INSERT INTO Matiere (nom, couleur) VALUES
	('Bois',            '#8B4513'),
	('Acrylique',       '#FFFFFF'),
	('Métal Noir',      '#000000'),
	('Aluminium',       '#C0C0C0'),
	('Plastique Rouge', '#FF0000'),
	('Plastique Bleu',  '#0000FF'),
	('Plastique Vert',  '#00FF00');

INSERT INTO "Option" (nom, description, cout, id_Image) VALUES
	('Support Casque',       'Support pour casque intégré',       15, 1),
	('Éclairage LED',        'Éclairage LED RGB intégré',         25, 2),
	('Porte-gobelet',        'Ajout d’un porte-gobelet pratique', 10, 3),
	('Marque personnalisée', 'Logo ou texte personnalisé',        20, 4),
	('Bluetooth',            'Connexion sans fil Bluetooth',      50, 5),
	('Chargeur USB',         'Port de charge USB intégré',        30, 2),
	('Haut-parleurs',        'Système audio intégré',             70, 5);

INSERT INTO Bouton (modele, forme, couleur, eclairage) VALUES
	('Sanwa OBSF-30',  'rond',     '#FF0000', TRUE),
	('Sanwa OBSF-30',  'rond',     '#0000FF', FALSE),
	('Happ Standard',  'carre',    '#FFFF00', TRUE),
	('Happ Standard',  'carre',    '#00FF00', FALSE),
	('Seimitsu PS-14', 'rond',     '#FFFFFF', TRUE),
	('Seimitsu PS-14', 'rond',     '#000000', FALSE),
	('Custom Arcade',  'triangle', '#FFA500', TRUE);

INSERT INTO TMolding (nom, couleur) VALUES
('Chrome', '#CCCCCC'),
('Black', '#000000'),
('Red Glossy', '#FF0000'),
('Blue Glossy', '#0000FF'),
('Yellow', '#FFFF00'),
('Green Neon', '#00FF00'),
('Woodgrain', '#A0522D');

INSERT INTO Faq (question, reponse, id_Utilisateur)
VALUES 
    ('Comment commander une borne ?', 'Vous pouvez commander en ligne via notre site ou nous contacter.', 1),
    ('Quels sont les délais de livraison ?', 'Les délais varient entre 2 et 4 semaines selon le produit.', 1),
    ('Puis-je personnaliser ma borne ?', 'Oui, nous proposons des options de personnalisation.', 1),
    ('Quels sont les moyens de paiement acceptés ?', 'Nous acceptons les paiements par carte bancaire et PayPal.', 1),
    ('Comment suivre ma commande ?', 'Un numéro de suivi sera envoyé par email après l’expédition.', 1),
    ('Offrez-vous une garantie ?', 'Oui, toutes nos bornes sont garanties 2 ans.', 1),
    ('Puis-je visiter votre showroom ?', 'Oui, notre showroom est ouvert du lundi au vendredi.', 1),
    ('Proposez-vous une assistance technique ?', 'Oui, une assistance technique est disponible pour tous nos clients.', 1),
    ('Quels jeux sont inclus dans les bornes ?', 'Nos bornes incluent plus de 1000 jeux rétro populaires.', 1),
    ('Faites-vous des remises pour les commandes en gros ?', 'Oui, contactez-nous pour les commandes de plus de 5 bornes.', 1),
    ('Comment annuler ma commande ?', 'Veuillez nous contacter sous 24h après avoir passé commande.', 1);
