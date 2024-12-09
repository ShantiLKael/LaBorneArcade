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
