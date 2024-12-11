// ********************
// LA CLASSE FIGURE
// Composé des coordonnées, de la largeur et de la couleur
// des éléments affichés sur le canva
class Figure
{
    static figures = [];

    constructor(x, y, l, forme, couleur, ordre, type) {
        this._x = x;
        this._y = y;
        this._l = l;
        this._forme = forme;
        this._couleur = couleur;
        this._eclairage = false;
        this._focus = false;
        this._ordre = ordre;
        this._type = type;
        Figure.figures.push(this);
    }

    static ecraserFigures() { Figure.figures = []; }

    // Dessin de formes
    // ********
    static dessiner(figure)
    {
        switch (figure.forme)
        {
            case 'triangle':
                Figure.dessinerTriangle(figure.x, figure.y, figure.l, figure.couleur, figure.focus);
                break;
            
            case 'carre':
                Figure.dessinerRect(figure.x - figure.l, figure.y - figure.l, figure.l * 2, figure.l * 2, figure.couleur, figure.focus);
                break;
            
            case 'rond':
                Figure.dessinerCercle(figure.x, figure.y, figure.l, figure.couleur, figure.focus);
                break;
            
            default:
            {
                console.log(`Forme non prise en compte ${figure.forme}.`);
            }
        }
    }

    static dessinerTriangle(x, y, radius, coul, estFocus)
    {
        ctx.strokeStyle = "#d9d9d9"; // Couleur du trait
        ctx.fillStyle = coul; // Couleur du remplissage

        // Triangle 1
        ctx.lineWidth =  (estFocus) ? 5 : 1;
        ctx.beginPath();
        ctx.moveTo(x - radius, y + radius * 0.7);
        ctx.lineTo(x + radius, y + radius * 0.7);
        ctx.lineTo(x, y - radius);
        ctx.lineTo(x - radius, y + radius * 0.7);
        ctx.fill();
        ctx.stroke();

        // Dessiner le symbole "+"
        ctx.lineWidth = 2;
        ctx.strokeStyle = assombrirCouleur(coul, 0.2);
        ctx.beginPath();
        ctx.moveTo(x - radius * 0.2, y);
        ctx.lineTo(x + radius * 0.2, y);
        ctx.moveTo(x, y - radius * 0.2);
        ctx.lineTo(x, y + radius * 0.2);
        ctx.stroke();
    }

    static dessinerCercle(x, y, radius, coul, estFocus)
    {
        ctx.strokeStyle = "#d9d9d9"; // Couleur du trait
        ctx.fillStyle = coul; // Couleur du remplissage

        // Cercle 1
        ctx.lineWidth =  (estFocus) ? 5 : 1;
        ctx.beginPath();
        ctx.arc(x, y, radius, 0, 2 * Math.PI);
        ctx.fill();
        ctx.stroke();

        // Cercle 2 (intérieur)
        ctx.lineWidth = 2;
        ctx.strokeStyle = assombrirCouleur(coul, 0.2);
        ctx.beginPath();
        ctx.arc(x, y, radius * 0.6, 0, 2 * Math.PI);
        ctx.stroke();

        // Dessiner le symbole "+"
        ctx.beginPath();
        ctx.moveTo(x - radius * 0.2, y);
        ctx.lineTo(x + radius * 0.2, y);
        ctx.moveTo(x, y - radius * 0.2);
        ctx.lineTo(x, y + radius * 0.2);
        ctx.stroke();
    }

    static dessinerRect(x, y, width, height, coul, estFocus)
    {
        ctx.strokeStyle = "#d9d9d9"; // Couleur du trait
        ctx.fillStyle = coul; // Couleur du remplissage

        // Rectangle 1
        ctx.lineWidth =  (estFocus) ? 5 : 1;
        ctx.beginPath();
        ctx.fillRect(x, y, width, height);
        ctx.rect(x, y, width, height);
        ctx.stroke();

        // Rectangle 2
        ctx.lineWidth = 2;
        ctx.strokeStyle = assombrirCouleur(coul, 0.2);
        ctx.beginPath();
        ctx.rect(x + (width * 0.4) /2, y + (height * 0.4) /2, width * 0.6, height * 0.6);
        ctx.stroke();

        // Dessiner le symbole "+"
        ctx.beginPath();
        ctx.moveTo(x + width * 0.4, y + height * 0.5);
        ctx.lineTo(x + width * 0.6, y + height * 0.5);
        ctx.moveTo(x + width * 0.5, y + height * 0.4);
        ctx.lineTo(x + width * 0.5, y + height * 0.6);
        ctx.stroke();
    }

    // Setter
    set forme(forme) { this._forme   = forme; }
    set x(x) { this._x = x; }
    set y(y) { this._y = y;  }
    set l(l) { this._l = l;  }

    set couleur  (coul ) { this._couleur = coul; }
    set ordre    (num  ) { this._ordre   = num;  }
    set type     (type ) { this._type    = type; }

    set eclairage(bool)  { this._eclairage = bool; }
    set focus    (bool)  { this._focus     = bool; }
    
    // Getter
    get forme() { return this._forme; }
    get x    () { return this._x; }
    get y    () { return this._y; }
    get l    () { return this._l; }

    get couleur  () { return this._couleur; }
    get focus    () { return this._focus; }
    get eclairage() { return this._eclairage; }
    get eclairage() { return this._eclairage; }
    get ordre    () { return this._ordre; }
    get type     () { return this._type; }
}

function assombrirCouleur(hexColor, magnitude)
{
    let color = hexColor.slice(1);
    let r = parseInt(color.substring(0, 2), 16);
    let g = parseInt(color.substring(2, 4), 16);
    let b = parseInt(color.substring(4, 6), 16);

    r = Math.max(0, Math.floor(r * (1 - magnitude)));
    g = Math.max(0, Math.floor(g * (1 - magnitude)));
    b = Math.max(0, Math.floor(b * (1 - magnitude)));

    let darkenedColor =
        "#" +
        r.toString(16).padStart(2, "0") +
        g.toString(16).padStart(2, "0") +
        b.toString(16).padStart(2, "0");

    return darkenedColor;
}

// ******************************
// Initialisation des composants
// ********************

// Canva
const canvas = document.getElementById('persoBorne');
const ctx = canvas.getContext('2d');

// Listes des différents composants
let boutonCanvaSelect = [];
let boutonJeuCanva = [];
let joystickCanva  = [];
let decalage = 1;

// Création des inputs cachées de bouton-borneperso

let container = document.getElementById('bouton-borneperso');
if (!affichageUniquement) {
    if (nbJoueur > 2)
        for (i = 1; i <= nbJoueur; i++)
        {
            // Creation input
            const input = document.createElement('input');
            input.type = 'hidden';
            input.id = `btn-select-${i}`;
            input.name = 'idBoutons[]';
            input.value = 0;
    
            // Ajoute le nouvel input dans le div
            container.appendChild(input);
        }
    
    for (i = 1; i <= nbBoutonParJoueur *nbJoueur; i++)
    {
        // Creation input
        const input = document.createElement('input');
        input.type = 'hidden';
        input.id = `btn-jeu-${i}`;
        input.name = 'idBoutons[]';
        input.value = 0;
    
        // Ajoute le nouvel input dans le div
        container.appendChild(input);
    }
    
    for (i = 1; i <= nbJoueur; i++)
    {
        // Creation input
        const input = document.createElement('input');
        input.type = 'hidden';
        input.id = `js-${i}`;
        input.name = 'idJoysticks[]';
        input.value = 0;
    
        // Ajoute le nouvel input dans le div
        container.appendChild(input);
    }
}

// Sélection de la forme et couleur
const formeSelect  = document.getElementById("select-forme-bouton");
const modeleSelect = document.getElementById("select-modele-joystick");
const coulSelectBouton   = document.getElementById("select-couleur-bouton");
let   coulSelectJoystick = document.getElementById('select-couleur-joystick');

// Forme par défault des éléments
let formeDefault = formeOption = "rond";
let modeleOption = "Tous";

// Couleur par défault des éléments
let coulDefaut = boutonOption = joystickOption = "#c0c0c0";

if (!affichageUniquement) {
    const numBoutonsInput = document.getElementById("nbBoutons");
    const numJoueursInput = document.getElementById("nbJoueurs");
    numBoutonsInput.value = nbBoutonParJoueur;
    numJoueursInput.value = nbJoueur;
}
// TODO Bouton pour changer la configure
// const boutonValider = document.getElementById("btn-valid-configure");

// Configureuration par défault
redimensionnerCanva(); 
initElements(nbJoueur, nbBoutonParJoueur);
dessinerElements();

// ****************************
// Création des évènements
// ******************

// Changement de la taille de l'écran
window.addEventListener('resize', redimensionnerCanva, false);
window.addEventListener('resize', dessinerElements,	   false);

function dessinerElements()
{
    // Efface graphiquement tous les éléments
    fond();

    // TODO Si decalage ou nbJoueur modifier 
    // initElements();

    let longueurEcran = canvas.width;
    let largeurEcran  = window.innerHeight -10;
    
    let xJoystick = longueurEcran * 0.05;
    let yJoystick = largeurEcran  * 0.20;
    let largJoystick = largeurEcran  * 0.35;
    let longJoystick = longueurEcran * 0.15 + largJoystick * 0.20;
    let rayonCercleJoystick = longJoystick * 0.18 + largJoystick * 0.18;

    // Dessin du rectangle du Joystick
    dessinerRectAvecCercles(xJoystick, yJoystick, longJoystick, largJoystick, longueurEcran * 0.009);

    // Dessin des boutons
    let rayonCercle = rayonCercleJoystick * 0.55;
    let distBouton  = rayonCercle * 2.5;
    let xBouton = xJoystick + longJoystick;
    let yBouton = yJoystick + largJoystick * 0.3;

    // Figure du Joystick
    for(i = 0; i < joystickCanva.length; i++)
    {	
        joystickCanva[i].x = xJoystick + (longJoystick * 0.5); 
        joystickCanva[i].y = yJoystick + (largJoystick * 0.5);
        joystickCanva[i].l = rayonCercleJoystick;
    }

    // 3 ou 6 Boutons de controle du joueur
    let nbLigne = Math.ceil(boutonJeuCanva.length / 3);
    let nbCol   = Math.ceil(boutonJeuCanva.length / nbLigne);

    for(i = 0; i < nbLigne; i++)
        for(j = 0; j < nbCol && i * nbCol + j < boutonJeuCanva.length; j++)
        {
            decalage = (decalage < j) ? 1 : 0; // Décalage des boutons pour le colonne j

            let x = xBouton + distBouton * (j +1);
            let y = yBouton - (distBouton * 0.2 * decalage) + distBouton * i;

            boutonJeuCanva[i * nbCol + j].x = x;
            boutonJeuCanva[i * nbCol + j].y = y;
            boutonJeuCanva[i * nbCol + j].l = rayonCercle;
        }
    
    // Boutons de 1J - 2J
    if (nbJoueur > 1) {
        rayonCercle = rayonCercleJoystick * 0.60;
        distBouton  = rayonCercle * 1.5;
    
        boutonCanvaSelect[0].x = longueurEcran * 0.7 - rayonCercle * 3;
        boutonCanvaSelect[0].y = rayonCercle * 1.2;
        boutonCanvaSelect[0].l = rayonCercle;
        boutonCanvaSelect[1].x = longueurEcran * 0.7;
        boutonCanvaSelect[1].y = rayonCercle * 1.2;
        boutonCanvaSelect[1].l = rayonCercle;
    }

    joystickCanva    .forEach(bouton => Figure.dessiner(bouton));
    boutonJeuCanva   .forEach(bouton => Figure.dessiner(bouton));
    boutonCanvaSelect.forEach(bouton => Figure.dessiner(bouton));
}

function initElements(nbJoueur, nbBoutonParJoueur)
{
    Figure.ecraserFigures();
    let longueurEcran = canvas.width;
    let largeurEcran = window.innerHeight -10;
    
    let xJoystick = longueurEcran * 0.15;
    let yJoystick = largeurEcran  * 0.15;
    let longJoystick = longueurEcran * 0.15;
    let largJoystick = largeurEcran  * 0.35;
    let rayonCercleJoystick = longJoystick * 0.15 + largJoystick * 0.15;

    // Boutons de 1J - 2J
    let rayonCercle = rayonCercleJoystick * 0.60;
    let distBouton  = rayonCercle * 1.5;
    if (nbJoueur > 1) {
        boutonCanvaSelect =
        [
            new Figure(longueurEcran * 0.7 - rayonCercle * 3,
                    rayonCercle * 1.2,
                    rayonCercle, formeOption, coulDefaut, 1, 'boutonSelect'),

            new Figure(longueurEcran * 0.7,
                    rayonCercle * 1.2,
                    rayonCercle, formeOption, coulDefaut, 2, 'boutonSelect')
        ];
    }
    
    // Dessin du rectangle du Joystick
    dessinerRectAvecCercles(xJoystick, yJoystick, longJoystick, largJoystick, longueurEcran * 0.009);
    joystickCanva = [
        new Figure(xJoystick + (longJoystick* 0.5), yJoystick + (largJoystick * 0.5), rayonCercleJoystick, formeOption, coulDefaut, 3,'joystick'),
    ];

    // Dessin des boutons joueurs
    rayonCercle = rayonCercleJoystick * 0.6;
    distBouton = rayonCercle * 2.5;
    let xBouton = xJoystick + longJoystick;
    let yBouton = yJoystick + largJoystick * 0.3;

    let nbLigne = Math.ceil(nbBoutonParJoueur / 3);
    let nbCol = Math.ceil(nbBoutonParJoueur / nbLigne);

    for( i = 0; i < nbLigne; i++ )
        for( j = 0; j < nbCol && i * nbCol + j < nbBoutonParJoueur; j++ )
        {
            decalage = (decalage < j) ? 1 : 0; // Décalage des boutons pour le colonne j
            let btn =
            new Figure
            (
                xBouton + distBouton * (j +1),
                yBouton - (distBouton * 0.2 * decalage) + distBouton * i,
                rayonCercle,
                formeOption, coulDefaut, (i * nbCol + j +3),
                'boutonJeu'
            );

            boutonJeuCanva.push(btn);
        }
}

function redimensionnerCanva()
{
    canvas.width  = document.getElementById('section').offsetWidth * 0.85;
    canvas.height = 600;
    fond();
}

function fond()
{
    ctx.fillStyle = "#192033";
    ctx.fillRect(0, 0, canvas.width, canvas.height);
}

function dessinerRectAvecCercles(x, y, width, height, cornerRadius)
{
    // Rectangle principal
    Figure.dessinerRect(x, y, width, height, "#a3a0a2");

    // Cercles aux coins
    Figure.dessinerCercle(x + cornerRadius, y + cornerRadius, cornerRadius * 0.5, coulDefaut, false);
    Figure.dessinerCercle(x + width - cornerRadius, y + cornerRadius, cornerRadius * 0.5, coulDefaut, false);
    Figure.dessinerCercle(x + cornerRadius, y + height - cornerRadius, cornerRadius * 0.5, coulDefaut, false);
    Figure.dessinerCercle(x + width - cornerRadius, y + height - cornerRadius, cornerRadius * 0.5, coulDefaut, false);
}