function interrupteurReponse(id) {
    const reponse = document.getElementById(`detail-${id}`);
    const fleche = document.getElementById(`fleche-${id}`);

    if (reponse.classList.contains('hidden')) {
        reponse.classList.remove('hidden');
        fleche.setAttribute('d', 'm4.5 15.75 7.5-7.5 7.5 7.5'); // Flèche vers le haut
    } else {
        reponse.classList.add('hidden');
        fleche.setAttribute('d', 'm19.5 8.25-7.5 7.5-7.5-7.5'); // Flèche vers le bas
    }
}