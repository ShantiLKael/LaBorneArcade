<?= /** @noinspection PhpUndefinedVariableInspection */
view('commun/header', ['titre' => $titre]) ?>
<!-- Formulaire des options choisies -->
<?= form_open('/borne-perso') ?>
<!-- Section de sélection -->

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
			<h1 class="text-3xl md:text-4xl font-bold mb-2 text-gray-100">Borne Personnalisée <span class="text-xl text-gray-500"><?= isset($borne) ? '<br> de '.$borne->nom : '' ?></span></h1>
			<p  class="text-green-400 text-xl md:text-2xl font-bold mb-4">1490,00€</p>

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
				<?= form_submit('submit', 'Ajouter au panier', "class='bg-green-700 hover:bg-green-600 text-white font-bold py-2 px-6 my-5 mb-8 rounded-3xl cursor-pointer'"); ?>
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
	<h2 class="py-5 md:px-7 px-0 md:mx-10 mx-5 font-bold text-lg md:text-2xl text-gray-300">Options</h2>
	<div class="flex overflow-x-scroll p-5 hide-scroll-bar space-x-6 rounded-xl bg-light-teal/10">
		<?php foreach($options as $option) : ?>
			<div class="relative min-w-[300px] sm:min-w-[350px] md:min-w-[400px] bg-gray-800 rounded-lg overflow-hidden border-2 border-gray-700 hover:border-green-700 shadow-gray-900 shadow-md hover:shadow-lg ease-in-out flex-shrink-0">
				<label>
					<input type="checkbox" id="option-<?= $option->id ?>" name="idOptions[]" value="<?= $option->id ?>" class="absolute top-3 right-3 w-6 h-6 cursor-pointer rounded-full border-gray-300 focus:ring-2 focus:ring-green-500 focus:outline-none">
				</label>
				<img loading="lazy" src="" alt="Option <?= $option->nom ?>" class="w-full h-64 object-cover">
				<div class="p-4">
					<p class="text-green-400 text-lg font-bold mb-2"><?= $option->cout ?> €</p>
					<h3 class="font-bold text-lg text-left mb-2"><?= $option->nom ?></h3>
					<p class="text-left text-sm text-gray-300"><?= $option->description ?>.</p>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>

<!-- Séléction Matière -->
<div class="px-0 md:px-20">
	<h2 class="py-5 md:px-7 px-0 md:mx-10 mx-5 font-bold text-lg md:text-2xl text-gray-300">Matière <span class="text-green-500/30">(*)</span></h2>
	<div class="flex overflow-x-scroll p-5 hide-scroll-bar space-x-6 rounded-xl <?= $bgColor = isset($erreurs['id_matiere']) ? "bg-red-700/30" : "bg-light-teal/10" ?>">
	<?php foreach($matieres as $matiere) : ?>
		<div class="relative w-52 h-52 md:w-72 md:h-72 bg-gray-800 rounded-lg overflow-hidden border-2 border-gray-700 <?= $hoverColor = isset($erreurs['id_matiere']) ? "hover:border-red-800" : "hover:border-green-700" ?> shadow-md shadow-gray-900 ease-in-out">
			<label>
				<input type="checkbox" id="matiere-<?= $matiere->id ?>" name="id_matiere" value="<?= $matiere->id ?>" class="absolute top-3 right-3 w-5 h-5 rounded-full border-gray-300 focus:ring-2 focus:ring-green-500 focus:outline-none">
			</label>
			<img src="" alt="Matière <?= $matiere->nom ?>" class="w-full h-5/6 object-cover" />
			<div style="background-color: #<?= $matiere->couleur ?>;" class="h-1/4"></div>
		</div>
	<?php endforeach; ?>
	</div>
</div>

<!-- Séléction T-Molding -->
<div class="px-0 md:px-20">
	<h2 class="py-5 md:px-7 px-0 md:mx-10 mx-5 font-bold text-lg md:text-2xl text-gray-300">T-Molding <span class="text-green-500/30">(*)</span></h2>
	<div class="flex overflow-x-scroll p-5 hide-scroll-bar space-x-6 rounded-xl <?= $bgColor = isset($erreurs['id_tmolding']) ? "bg-red-700/30" : "bg-light-teal/10" ?>">
	<?php foreach($tmoldings as $tmolding) : ?>
		<div class="relative w-52 h-52 md:w-72 md:h-72 bg-gray-800 rounded-lg overflow-hidden border-2 border-gray-700 <?= $hoverColor = isset($erreurs['id_tmolding']) ? "hover:border-red-800" : "hover:border-green-700" ?> shadow-md shadow-gray-900 ease-in-out">
			<label>
				<input type="checkbox" id="tmodling-<?= $tmolding->id ?>" name="id_tmolding" value="<?= $tmolding->id ?>" class="absolute top-3 right-3 w-5 h-5 rounded-full border-gray-300 focus:ring-2 focus:ring-green-500 focus:outline-none">
			</label>
			<img src="" alt="T-Molding <?= $tmolding->nom ?>" class="w-full h-5/6 object-cover" />
			<div style="background-color: #<?= $tmolding->couleur ?>;" class="h-1/4"></div>
		</div>
	<?php endforeach; ?>
	</div>
</div>

<!-- Séléction des joysticks -->
<div class="px-0 md:px-20">
	<div class="flex items-center justify-between">
	<!-- Nom du modèle -->
	<h2 class="py-5 md:px-7 px-0 md:mx-10 mx-5 font-bold text-lg md:text-2xl text-gray-300">Joystick <span class="text-green-500/30">(*)</span></h2>
	<!-- Sélecteur du modèle -->
	<div class="w-full max-w-sm min-w-[200px]">
		<div class="relative">
			<label>
				<select id="selection-joysticks" class="w-full bg-transparent placeholder:text-slate-400 text-slate-500 text-sm border-b border-slate-400 pl-3 py-2 transition duration-300 ease focus:border-b focus:border-slate-500 hover:border-slate-200 shadow-sm focus:shadow-md appearance-none cursor-pointer">
					<option class="bg-deep-blue" value="Tous" selected>Tous les joysticks</option>
				</select>
			</label>
			<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.2" stroke="currentColor" class="h-5 w-5 ml-1 absolute top-2.5 right-2.5 text-slate-500">
				<path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
			</svg>
		</div>
	</div>
	</div>

	<!-- Liste des joysticks -->
	<div id="liste-joysticks" class="flex overflow-x-scroll p-5 hide-scroll-bar space-x-6 rounded-xl <?= $bgColor = isset($erreurs['joystick']) ? "bg-red-700/30" : "bg-light-teal/10" ?>">
		<?php foreach($joysticks as $joystick) : ?>
		<div class="relative w-52 h-52 md:w-72 md:h-72 bg-gray-800 rounded-lg overflow-hidden border-2 border-gray-700 <?= $hoverColor = isset($erreurs['joystick']) ? "hover:border-red-800" : "hover:border-green-700" ?> shadow-md shadow-gray-900 ease-in-out flex-shrink-0">
			<!-- Checkbox -->
			<label>
				<input type="checkbox" id="joystick-<?= $joystick->id ?>" data-model="<?= $joystick->modele ?>" data-color="#<?= $joystick->couleur ?>" name="joystick" value="<?= $joystick->id ?>" class="absolute top-3 right-3 w-5 h-5 cursor-pointer rounded-full border-gray-300 focus:ring-2 focus:ring-green-500 focus:outline-none">
			</label>
			
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
		<h2 class="py-5 md:px-7 px-0 md:mx-10 mx-5 font-bold text-lg md:text-2xl text-gray-300">Bouton <span class="text-green-500/30">(*)</span></h2>
		<!-- Sélecteur du modèle -->
		<div class="w-full max-w-sm min-w-[200px]">
			<div class="relative">
				<label>
					<select id="selection-boutons" class="w-full bg-transparent placeholder:text-slate-400 text-slate-500 text-sm border-b border-slate-400 pl-3 py-2 transition duration-300 ease focus:border-b focus:border-slate-500 hover:border-slate-200 shadow-sm focus:shadow-md appearance-none cursor-pointer">
						<option class="bg-deep-blue" value="Tous" selected>Tous les boutons</option>
					</select>
				</label>
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.2" stroke="currentColor" class="h-5 w-5 ml-1 absolute top-2.5 right-2.5 text-slate-500">
					<path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
				</svg>
			</div>
		</div>
	</div>
	<div id="liste-boutons" class="flex overflow-x-scroll p-5 hide-scroll-bar space-x-6 rounded-xl <?= $bgColor = isset($erreurs['bouton']) ? "bg-red-700/30" : "bg-light-teal/10" ?>">
	<?php foreach($boutons as $bouton) : ?>
		<div class="relative w-52 h-52 md:w-72 md:h-72 bg-gray-800 rounded-lg overflow-hidden border-2 border-gray-700 <?= $hoverColor = isset($erreurs['bouton']) ? "hover:border-red-800" : "hover:border-green-700" ?> shadow-md shadow-gray-900 ease-in-out">
			<label>
				<input type="checkbox" id="bouton-<?= $bouton->id ?>" data-forme="<?= $bouton->forme ?>" data-model="<?= $bouton->modele ?>" data-color="#<?= $bouton->couleur ?>" name="bouton" value="<?= $bouton->id ?>" class="absolute top-3 right-3 w-5 h-5 rounded-full border-gray-300 focus:ring-2 focus:ring-green-500 focus:outline-none">
			</label>
			<img src="" alt="Boutons <?= $bouton->modele ?>" class="w-full h-5/6 object-cover" />
			<div style="background-color: #<?= $bouton->couleur ?>;" class="h-1/4"></div>
		</div>
	<?php endforeach; ?>
	</div>
</div>
<?= form_close() ?>
<div class="px-0 md:px-20 mx-auto my-16">
    <div type="hidden" id="bouton-borneperso"></div>

    <!-- Ligne contenant "Aperçu des touches" et le formulaire -->
    <div class="flex flex-wrap md:flex-nowrap items-center justify-between">
        <!-- Titre -->
        <div class="flex items-center">
            <h2 class="py-5 md:px-7 px-0 md:mx-10 mx-5 font-bold text-2xl md:text-3xl text-gray-200">Aperçu des touches</h2>
        </div>

        <!-- Formulaire -->
        <?= form_open('/borne-perso/', ['class' => 'flex flex-col md:flex-row md:items-center md:space-x-4 w-full md:w-auto']) ?>
            <!-- Input pour le nombre de joueurs -->
            <div class="flex flex-col items-start w-full md:w-auto mb-4 md:mb-0">
                <?= form_label('Nombre de joueurs', 'nbJoueurs', ['class' => 'pl-2 md:pl-0 text-sm mb-2 font-medium text-gray-300']); ?>
                <?= form_input([
                    'name'        => 'nbJoueurs',
                    'id'          => 'nbJoueurs',
                    'type'        => 'number',
                    'min'         => 1,
                    'max'         => 2,
                    'class'       => 'text-slate-400 w-full md:w-24 px-3 py-2 border border-gray-600 rounded-md text-gray-200 bg-gray-800 focus:outline-none focus:ring-2 focus:ring-green-400',
                    'value'       => set_value('nbJoueurs', '2'), // Valeur par défaut
                    'placeholder' => '1 - 2',
                    'required'
                ]); ?>
            </div>

            <!-- Input pour le nombre de boutons -->
            <div class="flex flex-col items-start w-full md:w-auto mb-4 md:mb-0">
                <?= form_label('Nombre de boutons', 'nbBoutons', ['class' => 'pl-2 md:pl-0 text-sm mb-2 font-medium text-gray-300']); ?>
                <?= form_input([
                    'name'        => 'nbBoutons',
                    'id'          => 'nbBoutons',
                    'type'        => 'number',
                    'min'         => 0,
                    'max'         => 9,
                    'class'       => 'text-slate-400 w-full md:w-24 px-3 py-2 border border-gray-600 rounded-md text-gray-200 bg-gray-800 focus:outline-none focus:ring-2 focus:ring-green-400',
                    'value'       => set_value('nbBoutons', '6'), // Valeur par défaut
                    'placeholder' => '0 - 9',
                    'required'
                ]); ?>
            </div>

            <!-- Bouton Configurer -->
            <div class="w-full md:w-auto">
                <?= form_submit('submit', 'Configurer la disposition', "class='bg-green-700 hover:bg-green-600 text-white font-bold py-2 px-6 rounded-3xl cursor-pointer w-full md:w-auto'"); ?>
            </div>
    </div>
	<?= form_close() ?>

	<div class="text-lg text-gray-300 flex items-center">
		<p>
			Les dispositions et couleurs des joysticks et boutons seront la même pour les tous les joueurs.
			Pour nos bornes d'arcades à deux joueurs, nous vous ajoutons deux boutons pour choisir le mode ! (1J - 2J)
		</p>
	</div>

    <!-- Espacement entre le haut et le canvas -->
    <div class="mt-10">
        <canvas class="border rounded-md border-deep-blue shadow-lg" id="persoBorne" tabindex="0"></canvas>
    </div>
</div>
</section>
<script>
	const boutons   = <?= json_encode($boutons); ?>;
	const joysticks = <?= json_encode($joysticks); ?>;
	const boutonsBorne   = <?= json_encode(isset($borne) ? $borne->boutons : null); ?>;
	const joysticksBorne = <?= json_encode(isset($borne) ? $borne->joysticks : null); ?>;
	const affichageUniquement = false;

	let nbJoueur = <?= $nbJoueurs ?>;
	let nbBoutonParJoueur = <?= $nbBoutons ?>;
</script>
<script src="/assets/js/canva-boutons.js"></script>
<script src="/assets/js/filtre-bouton-joystick.js"></script>
<script src="/assets/js/check-option-animation.js"></script>
<?= view('commun/footer') ?>

