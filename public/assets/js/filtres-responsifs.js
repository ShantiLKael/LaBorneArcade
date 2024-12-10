document.addEventListener("input", function(e) {
	const target = e.target;
	if ("prix_min" === target.id) {
		const tag = document.querySelector("#prix_max");
		tag.min = target.value || 0;
	}
});

document.querySelector("#submit").addEventListener("click", function() {
	const min = document.querySelector("#prix_min");
	const max = document.querySelector("#prix_max");
	if (typeof min.value === "number" && typeof max.value === "number") {
		if (min.value > max.value)
			max.setCustomValidity("Le prix maximum ne peux pas être inférieur au prix minimum.");
	}
});
