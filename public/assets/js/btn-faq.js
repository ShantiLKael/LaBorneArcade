function interrupteurReponse(id) {
    const reponse = document.getElementById(`reponse-${id}`);
    const fleche = document.getElementById(`fleche-${id}`);

    if (reponse.classList.contains('hidden')) {
        reponse.classList.remove('hidden');
        fleche.setAttribute('d', 'm4.5 15.75 7.5-7.5 7.5 7.5'); // Flèche vers le haut
    } else {
        reponse.classList.add('hidden');
        fleche.setAttribute('d', 'm19.5 8.25-7.5 7.5-7.5-7.5'); // Flèche vers le bas
    }
}

function griserDiv(id) {
    const faq = document.getElementById(`div-faq-${id}`);
    faq.classList.add('bg-white/10'); // Ajoute un fond légèrement grisé
}

function degriserDiv(id) {
    const faq = document.getElementById(`div-faq-${id}`);
    faq.classList.remove('bg-white/10'); // Retire le fond grisé
}