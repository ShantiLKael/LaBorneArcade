document.addEventListener("DOMContentLoaded", () => {
const checkboxes = document.querySelectorAll('input[type="checkbox"]'); // Récupération de chaque checkboxes

checkboxes.forEach((checkbox) => {
	checkbox.addEventListener("change", (event) => {
		const parentDiv = checkbox.closest("div");
		if (checkbox.checked) {
			parentDiv.classList.add("border-green-600");
			console.log(parentDiv);
		} else {
			parentDiv.classList.remove("border-green-600");
			console.log(parentDiv);
			}
		});
	});
});