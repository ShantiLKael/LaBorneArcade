let modeleJoysticks = [];

let joystickSelect = document.getElementById('selection-joysticks');
for (i = 0; i < joysticks.length; i++)
{
	joystick = joysticks[i];
	if (Object.keys(modeleJoysticks).includes(joystick.modele)) {
		modeleJoysticks[joystick.modele].push(joystick);	
		continue;
	}

	modeleJoysticks[joystick.modele] = [joystick];
	let option = new Option(joystick.modele, joystick.modele);
	option.className = "bg-deep-blue";
	joystickSelect.add(option);
}

let modeleBoutons = [];

let boutonSelect = document.getElementById('selection-boutons');
for (i = 0; i < boutons.length; i++)
{
	bouton = boutons[i];
	if (Object.keys(modeleBoutons).includes(bouton.modele)) {
		modeleBoutons[bouton.modele].push(bouton);
		continue;
	}

	modeleBoutons[bouton.modele] = [bouton];
	let option = new Option(bouton.modele, bouton.modele);
	option.className = "bg-deep-blue";
	boutonSelect.add(option);
}


let formeBoutons = [];

let coulSelectBouton  = document.getElementById("select-couleur-bouton");
for (i = 0; i < boutons.length; i++)
{
	bouton = boutons[i];
	if (Object.keys(formeBoutons).includes(bouton.forme.toLowerCase())) {
		formeBoutons[bouton.forme.toLowerCase()].push(bouton);
		continue;
	}

	formeBoutons[bouton.forme.toLowerCase()] = [bouton];
	let option = new Option(`${bouton.modele} - Couleur #${bouton.couleur}`, bouton.id);
	option.setAttribute('data-color', `#${bouton.couleur}`);
	option.className = "bg-deep-blue";
	coulSelectBouton.add(option);
}

console.log(formeBoutons);

// Fonction màj select des couleurs de bouton
function majCouleurBoutons(formeSelectionnee) {
	coulSelectBouton.innerHTML = '';

	if (formeSelectionnee && formeBoutons[formeSelectionnee]) {
		formeBoutons[formeSelectionnee].forEach(bouton => {
			let option = new Option(`${bouton.modele} - Couleur #${bouton.couleur}`, bouton.id);
			option.setAttribute('data-color', `#${bouton.couleur}`);
			option.className = "bg-deep-blue";
			coulSelectBouton.add(option);
		});
	}
}

// Changement des joysticks
formeSelect.addEventListener('change', (e) => {
	const formeSelectionnee = e.target.value;
	majCouleurBoutons(formeSelectionnee);
});

// Initialisation
majCouleurBoutons  (formeSelect.value);

// Affichage des boutons, joystick selon le modèle séléctionné
document.addEventListener('DOMContentLoaded', () => {
	const select = document.getElementById('selection-boutons');
	const cards = document.querySelectorAll('#liste-boutons > div');

	select.addEventListener('change', () => {
		const selectedModel = select.value; // Modèle sélectionné

		// Parcourt toutes les cartes
		cards.forEach(card => {
			const checkbox = card.querySelector('input[type="checkbox"]');
			const model = checkbox.getAttribute('data-model'); // Récupère le modèle de la carte

			if (selectedModel === 'Tous' || model === selectedModel) {
				// Affiche les cartes du même modèle sélectionné
				card.style.display = 'block';
			} else {
				// Cache les autres cartes
				card.style.display = 'none';
			}
		});
	});
});

document.addEventListener('DOMContentLoaded', () => {
	const select = document.getElementById('selection-joysticks');
	const cards = document.querySelectorAll('#liste-joysticks > div');

	select.addEventListener('change', () => {
		const selectedModel = select.value; // Modèle sélectionné

		// Parcourt toutes les cartes
		cards.forEach(card => {
			const checkbox = card.querySelector('input[type="checkbox"]');
			const model = checkbox.getAttribute('data-model'); // Récupère le modèle de la carte

			if (selectedModel === 'Tous' || model === selectedModel) {
				// Affiche les cartes du même modèle sélectionné
				card.style.display = 'block';
			} else {
				// Cache les aautres cartes
				card.style.display = 'none';
			}
		});
	});
});