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
                    }
                });
            } else {
                // Réactive et rend visibles toutes les checkboxes si aucune n'est cochée
                checkboxes.forEach(cb => {
                    cb.disabled = false;
                    cb.style.visibility = 'visible';
					// TODO Changer les formes et couleurs des Figure.figures
					// TODO dessinerElements();
                });
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
                    }
                });
            } else {
                checkboxes.forEach(cb => {
                    cb.disabled = false;
                    cb.style.visibility = 'visible';
                });
            }
        });
    });
});


document.addEventListener('DOMContentLoaded', () => {
    const checkboxes = document.querySelectorAll('input[type="checkbox"][name="matieres[]"]');

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
    const checkboxes = document.querySelectorAll('input[type="checkbox"][name="tmoldings[]"]');

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
