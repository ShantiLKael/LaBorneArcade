if (boutonsBorne) {
    boutonCanvaSelect = [];
    boutonJeuCanva    = [];
    for (i = 1; i <= boutonsBorne.length; i++) {
        bouton = boutonsBorne[i -1];
        if (nbJoueur >= 2 && i <= 2) {
            boutonCanvaSelect.push(
                new Figure(0, 0, 0, bouton.forme.toLocaleLowerCase(), `${bouton.couleur}`, i, 'boutonSelect')
            );
            continue;
        }

        boutonJeuCanva.push(
            new Figure(0, 0, 0, bouton.forme.toLocaleLowerCase(), `${bouton.couleur}`, i, 'boutonJeu')
        );
    }

    dessinerElements();
}

if (joysticksBorne) {
    joystickCanva = [];
    for (i = 1; i <= joysticksBorne.length; i++) {
        joystick = joysticksBorne[i -1];

        joystickCanva.push(
            new Figure(0, 0, 0, 'rond', `${joystick.couleur}`, i, 'joystick')
        );
    }

    dessinerElements();
}


document.addEventListener("DOMContentLoaded", () => {
	const radios = document.querySelectorAll('input[type="radio"]'); // Récupération de chaque radios

	radios.forEach((checkbox) => {
		checkbox.addEventListener("change", () => {
			const parentDiv = checkbox.closest("div");
			if (parentDiv)
				parentDiv.classList.toggle("border-green-600");
		});
	});
});

document.addEventListener('DOMContentLoaded', () => {
    const radios = document.querySelectorAll('#liste-boutons input[type="radio"]');

	radios.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            const isAnyChecked = Array.from(radios).some(cb => cb.checked);

            if (isAnyChecked) {
                // Désactive toutes les radios sauf celles déjà cochées
                radios.forEach(cb => {
                    if (!cb.checked) {
                        cb.disabled = true;
                        cb.style.visibility = 'hidden';
                    } else {

                        // Maj du canva du bouton séléctionné
                        for (i = 1; i <= nbBoutonParJoueur * nbJoueur; i++) {
                            let input   = document.getElementById(`btn-jeu-${i}`);
                            console.log(nbJoueur, nbBoutonParJoueur)
                            input.value = cb.value;
                        }

                        Figure.figures.forEach(figure => {
                            if (figure.type === 'boutonJeu') {
                                figure.couleur = cb.getAttribute('data-color');
                                figure.forme   = cb.getAttribute('data-forme').toLocaleLowerCase();
                            }
                        });

                        dessinerElements();
                    }
                });

            } else {
                // Réactive et rend visibles toutes les radios si aucune n'est cochée
                radios.forEach(cb => {
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
    const radios = document.querySelectorAll('#liste-joysticks input[type="radio"]');

    radios.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            const isAnyChecked = Array.from(radios).some(cb => cb.checked);

            if (isAnyChecked) {
                radios.forEach(cb => {
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
                radios.forEach(cb => {
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
    const radios = document.querySelectorAll('input[type="radio"][name="id_matiere"]');

    radios.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            const checkedMatiere = Array.from(radios).filter(cb => cb.checked);

            if (checkedMatiere.length > 0) {
                radios.forEach(cb => {
                    if (!cb.checked) {
                        cb.style.visibility = 'hidden';
                        cb.disabled = true;
                    }
                });
            } else {
                radios.forEach(cb => {
                    cb.style.visibility = 'visible';
                    cb.disabled = false;
                });
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const radios = document.querySelectorAll('input[type="radio"][name="id_tmolding"]');

    radios.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            const checkedMatiere = Array.from(radios).filter(cb => cb.checked);

            if (checkedMatiere.length > 0) {
                radios.forEach(cb => {
                    if (!cb.checked) {
                        cb.style.visibility = 'hidden';
                        cb.disabled = true;
                    }
                });
            } else {
                radios.forEach(cb => {
                    cb.style.visibility = 'visible';
                    cb.disabled = false;
                });
            }
        });
    });
});
