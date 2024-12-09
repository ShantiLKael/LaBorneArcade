<?= view('commun/header', ['titre' => $titre]) ?>
<form action="/bornes/<?= isset($borne) ? $borne->id : '' ?>" method="post"> <!-- Formulaire des options choisies -->
<section id="section"  class="container px-5 py-16 mx-auto bg-medium-blue rounded-xl ">
<div class="px-0 md:px-20 mb-16">
	<!-- Séléction du produit principal -->
	<div class="flex flex-col md:flex-row gap-8 items-start">

		<!-- Images du produit -->
		<div class="w-full md:w-1/2 lg:w-7/12">
			<img loading="lazy" src="" alt="Borne Arcade <?= isset($borne) ? $borne->nom : 'Personnalisée' ?>" class="w-full h-auto">
		</div>

		<!-- Informations produit -->
		<div class="flex-1">
			<h1 class="text-3xl md:text-4xl font-bold mb-2">Borne Personnalisée <span class="text-xl text-gray-500"><?= isset($borne) ? '<br> de '.$borne->nom : '' ?></span></h1>
			<p class="text-green-400 text-2xl md:text-3xl font-bold mb-4">1490,00€</p>

			<!-- Contenu de la borne -->
			<div class="bg-gradient-to-r from-dark-blue max-w-100 to-dark-teal p-4 rounded md:mb-2 mb-10">
				<h2 class="text-lg font-bold text-green-400 mb-2">Votre borne contient</h2>
				<ul class="list-disc pl-6 space-y-1">
					<li>8000 Jeux</li>
					<li>Écran plat LCD 19" DELL</li>
					<li>Ordinateur DELL Optiplex</li>
					<li>Son réglable intégré</li>
					<li>2 joysticks haut de gamme Sanwa/Seimitsu</li>
					<li>12 boutons haut de gamme Sanwa OBSF-30</li>
				</ul>
				<p class="mt-4">Livrée sur rendez-vous en 3/4 semaines</p>
			</div>

			<!-- Boutons -->
			<div class="text-center md:flex md:items-center gap-4">
				<a href="" class="bg-green-700 hover:bg-green-600 text-white font-bold py-2 px-6 my-5 rounded-3xl cursor-pointer">Ajouter dans panier</a>
			</div>

			<!-- Infos supplémentaires -->
			<div class="grid grid-cols-2 sm:grid-cols-4 gap-4 p-10 md:p-0 md:mt-5 mt-10">
				<div class="text-center">
					<img loading="lazy" src="fabrique_france_icon.png" alt="Fabriqué en France" class="w-10 mx-auto mb-2">
					<p class="text-sm">Fabriqué en France</p>
				</div>
				<div class="text-center">
					<img loading="lazy" src="garantie_icon.png" alt="Garantie 2 ans" class="w-10 mx-auto mb-2">
					<p class="text-sm">Garantie 2 ans</p>
				</div>
				<div class="text-center">
					<img loading="lazy" src="support_icon.png" alt="Support" class="w-10 mx-auto mb-2">
					<p class="text-sm">Assistance disponible</p>
				</div>
				<div class="text-center">
					<img loading="lazy" src="paiement_icon.png" alt="Paiement sécurisé" class="w-10 mx-auto mb-2">
					<p class="text-sm">Paiement 100% sécurisé</p>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Séléction des options -->
<div class="px-0 md:px-20">
	<h2 class="py-5 md:px-7 px-0 md:mx-10 mx-5 font-bold text-2xl md:text-3xl text-gray-300">Options</h2>
	<div class="flex overflow-x-scroll p-5 hide-scroll-bar space-x-6 rounded-xl bg-light-teal/10">
		<?php foreach($options as $option) : ?>
			<div class="relative min-w-[300px] sm:min-w-[350px] md:min-w-[400px] bg-gray-800 rounded-lg overflow-hidden border-2 border-gray-700 hover:border-green-700 shadow-gray-900 shadow-md hover:shadow-lg ease-in-out flex-shrink-0">
				<input type="checkbox" id="option-<?= $option->id ?>" name="options[]" value="<?= $option->id ?>" class="absolute top-3 right-3 w-6 h-6 cursor-pointer rounded-full border-gray-300 focus:ring-2 focus:ring-green-500 focus:outline-none">
				<img loading="lazy" src="" alt="Option <?= $option->nom ?>" class="w-full h-64 object-cover">
				<div class="p-4">
					<p class="text-green-400 text-xl font-bold mb-2"><?= $option->cout ?> €</p>
					<h3 class="font-bold text-xl text-left mb-2"><?= $option->nom ?></h3>
					<p class="text-left text-sm text-gray-400"><?= $option->description ?>.</p>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>

<!-- Séléction des joysticks -->
<div class="px-0 md:px-20">
	<div class="flex items-center justify-between">
	<!-- Nom du modèle -->
	<h2 class="py-5 md:px-7 px-0 md:mx-10 mx-5 font-bold text-2xl md:text-3xl text-gray-400">Joystick</h2>
	<!-- Sélecteur du modèle -->
	<div class="w-full max-w-sm min-w-[200px]">      
		<div class="relative">
			<select id="selection-joysticks" class="w-full bg-transparent placeholder:text-slate-400 text-slate-500 text-sm border-b border-slate-400 pl-3 py-2 transition duration-300 ease focus:border-b focus:border-slate-500 hover:border-slate-200 shadow-sm focus:shadow-md appearance-none cursor-pointer">
				<option class="bg-deep-blue" value="Tous" selected>Tous les joysticks</option>
			</select>
			<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.2" stroke="currentColor" class="h-5 w-5 ml-1 absolute top-2.5 right-2.5 text-slate-500">
				<path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
			</svg>
		</div>
	</div>
	</div>

	<!-- Liste des joysticks -->
	<div id="liste-joysticks" class="flex overflow-x-scroll p-5 hide-scroll-bar space-x-6 rounded-xl bg-light-teal/10">
		<?php foreach($joysticks as $joystick) : ?>
		<div class="relative w-52 h-52 md:w-72 md:h-72 bg-gray-800 rounded-lg overflow-hidden border-2 border-gray-700 hover:border-green-700 shadow-md shadow-gray-900 ease-in-out flex-shrink-0">
			<!-- Checkbox -->
			<input type="checkbox" id="joystick-<?= $joystick->id ?>" data-model="<?= $joystick->modele ?>" name="joysticks[]" value="<?= $joystick->id ?>" class="absolute top-3 right-3 w-5 h-5 cursor-pointer rounded-full border-gray-300 focus:ring-2 focus:ring-green-500 focus:outline-none">
			
			<!-- Image -->
			<img loading="lazy" src="" alt="Joystick <?= htmlspecialchars($joystick->modele) ?>" class="w-full h-4/6 md:h-5/6 object-cover">

			<!-- Nom et couleur -->
			<div class="p-4 flex items-center justify-between">
				<!-- Nom du modèle -->
				<h3 class="font-bold text-base text-white"><?= $joystick->modele ?></h3>
				
				<!-- Rond de couleur -->
				<div 
					style="background-color: #<?= $joystick->couleur ?>;" 
					class="w-6 h-6 rounded-full border border-gray-300">
				</div>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
</div>

<!-- Séléction Boutons -->
<div class="px-0 md:px-20">
	<div class="flex items-center justify-between">
		<!-- Nom du modèle -->
		<h2 class="py-5 md:px-7 px-0 md:mx-10 mx-5 font-bold text-2xl md:text-3xl text-gray-400">Bouton</h2>
		<!-- Sélecteur du modèle -->
		<div class="w-full max-w-sm min-w-[200px]">
			<div class="relative">
				<select id="selection-boutons" class="w-full bg-transparent placeholder:text-slate-400 text-slate-500 text-sm border-b border-slate-400 pl-3 py-2 transition duration-300 ease focus:border-b focus:border-slate-500 hover:border-slate-200 shadow-sm focus:shadow-md appearance-none cursor-pointer">
					<option class="bg-deep-blue" value="Tous" selected>Tous les boutons</option>
				</select>
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.2" stroke="currentColor" class="h-5 w-5 ml-1 absolute top-2.5 right-2.5 text-slate-500">
					<path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
				</svg>
			</div>
		</div>
	</div>
	<div id="liste-boutons" class="flex overflow-x-scroll p-5 hide-scroll-bar space-x-6 rounded-xl bg-light-teal/10">
	<?php foreach($boutons as $bouton) : ?>
		<div class="relative w-52 h-52 md:w-72 md:h-72 bg-gray-800 rounded-lg overflow-hidden border-2 border-gray-700 hover:border-green-700 shadow-md shadow-gray-900 ease-in-out">
			<input type="checkbox" id="bouton-<?= $bouton->id ?>" data-model="<?= $bouton->modele ?>" name="boutons[]" value="<?= $bouton->id ?>" class="absolute top-3 right-3 w-5 h-5 rounded-full border-gray-300 focus:ring-2 focus:ring-green-500 focus:outline-none">
			<img src="" alt="Boutons <?= $bouton->modele ?>" class="w-full h-5/6 object-cover" />
			<div style="background-color: #<?= $bouton->couleur ?>;" class="h-1/4"></div>
		</div>
	<?php endforeach; ?>
	</div>
</div>

<!-- Séléction T-Molding -->
<div class="px-0 md:px-20">
	<h2 class="py-5 md:px-7 px-0 md:mx-10 mx-5 font-bold text-2xl md:text-3xl text-gray-400">T-Molding</h2>
	<div class="flex overflow-x-scroll p-5 hide-scroll-bar space-x-6 rounded-xl bg-light-teal/10">
	<?php foreach($tmoldings as $tmolding) : ?>
		<div class="relative w-52 h-52 md:w-72 md:h-72 bg-gray-800 rounded-lg overflow-hidden border-2 border-gray-700 hover:border-green-700 shadow-md shadow-gray-900 ease-in-out">
			<input type="checkbox" id="tmodling-<?= $tmolding->id ?>" name="tmoldings[]" value="<?= $tmolding->id ?>" class="absolute top-3 right-3 w-5 h-5 rounded-full border-gray-300 focus:ring-2 focus:ring-green-500 focus:outline-none">
			<img src="" alt="T-Molding <?= $tmolding->nom ?>" class="w-full h-5/6 object-cover" />
			<div style="background-color: #<?= $tmolding->couleur ?>;" class="h-1/4"></div>
		</div>
	<?php endforeach; ?>
	
		<!-- "Ajouter t-molding" -->
		<div class="relative flex items-center justify-center w-52 h-52 md:w-72 md:h-72 bg-gray-800 rounded-lg overflow-hidden shadow-md border-dotted border-2 border-gray-500">
			<div class="flex items-center justify-center w-24 h-24 bg-gray-600 hover:bg-green-600 text-white text-5xl font-bold rounded-full shadow-md transition duration-300 ease-in-out cursor-pointer">
				<svg class="w-24 h-24 text-gray-400 hover:text-gray-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
					<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
				</svg>
			</div>
		</div>
	</div>
</div>

<!-- Séléction Matière -->
<div class="px-0 md:px-20">
	<h2 class="py-5 md:px-7 px-0 md:mx-10 mx-5 font-bold text-2xl md:text-3xl text-gray-400">Matière</h2>
	<div class="flex overflow-x-scroll p-5 hide-scroll-bar space-x-6 rounded-xl bg-light-teal/10">
	<?php foreach($matieres as $matiere) : ?>
		<div class="relative w-52 h-52 md:w-72 md:h-72 bg-gray-800 rounded-lg overflow-hidden border-2 border-gray-700 hover:border-green-700 shadow-md shadow-gray-900 ease-in-out">
			<input type="checkbox" id="matiere-<?= $matiere->id ?>" name="matieres[]" value="<?= $matiere->id ?>" class="absolute top-3 right-3 w-5 h-5 rounded-full border-gray-300 focus:ring-2 focus:ring-green-500 focus:outline-none">
			<img src="" alt="Matière <?= $matiere->nom ?>" class="w-full h-5/6 object-cover" />
			<div style="background-color: #<?= $matiere->couleur ?>;" class="h-1/4"></div>
		</div>
	<?php endforeach; ?> 
	</div>
</div>

<div class="px-0 md:px-20 mx-auto my-16">
	<div type="hidden" id="bouton-borneperso">
	</div>
	<h2 class="py-5 md:px-7 px-0 md:mx-10 mx-5 font-bold text-2xl md:text-3xl text-gray-400">Aperçu des boutons</h2>
	<div class="grid grid-cols-1 gap-6 md:grid-cols-3 my-5 md:gap-8">
		<div>
			<h2 class="py-5 md:px-7 px-0 md:mx-10 mx-5 font-bold text-xl md:text-2xl text-gray-400">Boutons</h2>
		</div>
		
		<!-- Sélecteur de couleurs des boutons -->
		<div>
			<label for="select-couleur-bouton" class="block text-lg font-medium text-slate-600 mb-2">Couleurs</label>
			<select
				class="w-full bg-transparent placeholder:text-slate-400 text-slate-500 text-sm border-b border-slate-400 pl-3 py-2 transition duration-300 ease-in-out focus:border-slate-500 hover:border-slate-200 shadow-sm focus:shadow-md md:max-w-md"
				name="couleurs"
				id="select-couleur-bouton"
			>
			</select>
		</div>

		<!-- Sélecteur de formes des boutons -->
		<div>
			<label for="select-forme-bouton" class="block text-lg font-medium text-slate-600 mb-2">Formes</label>
			<select
				class="w-full bg-transparent placeholder:text-slate-400 text-slate-500 text-sm border-b border-slate-400 pl-3 py-2 transition duration-300 ease-in-out focus:border-slate-500 hover:border-slate-200 shadow-sm focus:shadow-md md:max-w-md"
				name="formes"
				id="select-forme-bouton"
			>
				<option class="bg-deep-blue" value="rond">Rond</option>
				<option class="bg-deep-blue" value="triangle">Triangle</option>
				<option class="bg-deep-blue" value="carre">Carré</option>
			</select>
		</div>
		
		<div>
			<h2 class="py-5 md:px-7 px-0 md:mx-10 mx-5 font-bold text-xl md:text-2xl text-gray-400">Joysticks</h2>
		</div>
		
		<!-- Sélecteur de couleurs de joysticks -->
		<div>
			<label for="select-couleur-joystick" class="block text-lg font-medium text-slate-600 mb-2">Couleurs</label>
			<select
				class="w-full bg-transparent placeholder:text-slate-400 text-slate-500 text-sm border-b border-slate-400 pl-3 py-2 transition duration-300 ease-in-out focus:border-slate-500 hover:border-slate-200 shadow-sm focus:shadow-md md:max-w-md"
				name="couleurs"
				id="select-couleur-joystick"
			>
			</select>
		</div>

		<!-- Sélecteur de modèles de joysticks -->
		<div>
			<label for="select-modele-joystick" class="block text-lg font-medium text-slate-600 mb-2">Modèles</label>
			<select
				class="w-full bg-transparent placeholder:text-slate-400 text-slate-500 text-sm border-b border-slate-400 pl-3 py-2 transition duration-300 ease-in-out focus:border-slate-500 hover:border-slate-200 shadow-sm focus:shadow-md md:max-w-md"
				name="formes"
				id="select-modele-joystick"
			>
				<option class="bg-deep-blue" value="Tous" selected>Tous les joysticks</option>
			</select>
		</div>
	</div>


	<canvas class="border rounded-md border-deep-blue shadow-lg" id="persoBorne" tabindex="0"></canvas>
	<button class="bg-green-700 hover:bg-green-600 text-white font-bold py-2 px-6 my-5 rounded-3xl cursor-pointer" onclick="convertirEnImage()">
		Télécharger l'image
	</button>
</div> 
</section>
</form>
<script>
	const boutons   = <?php echo json_encode($boutons); ?>;
	const joysticks = <?php echo json_encode($joysticks); ?>;
</script>
<script src="./assets/js/canva-boutons.js"></script>
<script src="./assets/js/filtre-bouton-joystick.js"></script>
<script src="./assets/js/check-option-animation.js"></script>
<?= view('commun/footer') ?>