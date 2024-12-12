if (boutonsBorne) {
    boutonCanvaSelect = [];
    boutonJeuCanva    = [];
    for (i = 1; i <= boutonsBorne.length; i++) {
        bouton = boutonsBorne[i -1];
        if (nbJoueur >= 2 && i <= 2) {
            boutonCanvaSelect.push(
                new Figure(0, 0, 0, bouton.forme.toLocaleLowerCase(), `#${bouton.couleur}`, i, 'boutonSelect')
            );
            continue;
        }

        boutonJeuCanva.push(
            new Figure(0, 0, 0, bouton.forme.toLocaleLowerCase(), `#${bouton.couleur}`, i, 'boutonJeu')
        );
    }
}

if (joysticksBorne) {
    joystickCanva = [];
    for (i = 1; i <= joysticksBorne.length; i++) {
        joystick = joysticksBorne[i -1];

        joystickCanva.push(
            new Figure(0, 0, 0, 'rond', `#${joystick.couleur}`, i, 'joystick')
        );
    }
}

dessinerElements();

document.addEventListener("DOMContentLoaded", () => {
	const checkboxes = document.querySelectorAll('input[type="checkbox"]'); // Récupération de chaque checkboxes

	checkboxes.forEach((checkbox) => {
		checkbox.addEventListener("change", () => {
			const parentDiv = checkbox.closest("div");
			if (parentDiv)
				parentDiv.classList.toggle("border-green-600");
		});
	});
});

document.addEventListener('DOMContentLoaded', () => {
    const checkboxes = document.querySelectorAll('#liste-boutons input[type="checkbox"]');

	checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            const isAnyChecked = Array.from(checkboxes).some(cb => cb.checked);

            if (isAnyChecked) {
                // Désactive toutes les checkboxes sauf celles déjà cochées
                checkboxes.forEach(cb => {
                    if (!cb.checked) {
                        cb.disabled = true;
                        cb.style.visibility = 'hidden';
                    } else {

                        // Maj du canva du bouton séléctionné
                        for (i = 1; i <= nbBoutonParJoueur *nbJoueur; i++) {
                            let input   = document.getElementById(`btn-jeu-${i}`);
                            console.log(nbJoueur, nbBoutonParJoueur)
                            input.value = cb.value;
                        }

                        Figure.figures.forEach(figure => {
                            if (figure.type === 'boutonJeu') {
                                figure.couleur = cb.getAttribute('data-color');
                                figure.forme = cb.getAttribute('data-forme').toLocaleLowerCase();
                            }
                        });

                        dessinerElements();
                    }
                });

            } else {
                // Réactive et rend visibles toutes les checkboxes si aucune n'est cochée
                checkboxes.forEach(cb => {
                    cb.disabled = false;
                    cb.style.visibility = 'visible';
                });
                

                // Maj du visue du canva par défault
                for (i = 1; i <= nbBoutonParJoueur *nbJoueur; i++) {
                    let input   = document.getElementById(`btn-jeu-${i}`);
                    input.value = 0;
                }

                Figure.figures.forEach(figure => {
                    if (figure.type === 'boutonJeu') {
                        figure.couleur = coulDefaut;
                        figure.forme   = formeDefault;
                    }
                });

                dessinerElements();
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const checkboxes = document.querySelectorAll('#liste-joysticks input[type="checkbox"]');

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            const isAnyChecked = Array.from(checkboxes).some(cb => cb.checked);

            if (isAnyChecked) {
                checkboxes.forEach(cb => {
                    if (!cb.checked) {
                        cb.disabled = true;
                        cb.style.visibility = 'hidden';
                    } else {
                        // Maj du canva du joystick séléctionné
                        for (i = 1; i <= nbJoueur; i++) {
                            let input   = document.getElementById(`js-${i}`);
                            input.value = cb.value;
                        }

                        Figure.figures.forEach(figure => {
                            if (figure.type === 'joystick')
                                figure.couleur = cb.getAttribute('data-color');
                        });

                        dessinerElements();
                    }
                });
            } else {
                checkboxes.forEach(cb => {
                    cb.disabled = false;
                    cb.style.visibility = 'visible';
                });

                // Maj du visue du canva par défault
                for (i = 1; i <= nbJoueur; i++) {
                    let input   = document.getElementById(`js-${i}`);
                    input.value = 0;
                }

                Figure.figures.forEach(figure => {
                    if (figure.type === 'joystick')
                        figure.couleur = coulDefaut;
                });

                dessinerElements();
            }
        });
    });
});


document.addEventListener('DOMContentLoaded', () => {
    const checkboxes = document.querySelectorAll('input[type="checkbox"][name="id_matiere"]');

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            const checkedMatiere = Array.from(checkboxes).filter(cb => cb.checked);

            if (checkedMatiere.length > 0) {
                checkboxes.forEach(cb => {
                    if (!cb.checked) {
                        cb.style.visibility = 'hidden';
                        cb.disabled = true;
                    }
                });
            } else {
                checkboxes.forEach(cb => {
                    cb.style.visibility = 'visible';
                    cb.disabled = false;
                });
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const checkboxes = document.querySelectorAll('input[type="checkbox"][name="id_tmolding"]');

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            const checkedMatiere = Array.from(checkboxes).filter(cb => cb.checked);

            if (checkedMatiere.length > 0) {
                checkboxes.forEach(cb => {
                    if (!cb.checked) {
                        cb.style.visibility = 'hidden';
                        cb.disabled = true;
                    }
                });
            } else {
                checkboxes.forEach(cb => {
                    cb.style.visibility = 'visible';
                    cb.disabled = false;
                });
            }
        });
    });
});
