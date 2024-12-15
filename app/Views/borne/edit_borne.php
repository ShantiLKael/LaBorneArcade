<?= /** @noinspection PhpUndefinedVariableInspection */
view('commun/header', ['titre' => $titre]) ?>
<!-- Formulaire des options choisies -->
<?= form_open('/borne-perso') ?>
<div class="bg-gradient-to-r from-dark-teal max-w-100 to-medium-blue text-center py-10 mb-8">
    <div class="flex items-center px-10 py-10">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-gray-300 invisible md:visible md:mr-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
        </svg>
        <!-- Texte principal -->
        <div>
            <h2 class="text-xl md:text-2xl font-bold lg:mb-0 mb-5">Créez vos propres bornes d'arcade, avec l'assistance de notre graphiste !</h2>
            <p class="text-gray-300 text-sm md:text-base">Personnalisez avec vos logos, idées, couleurs, images. Customisez chaque partie.</p>
        </div>
    </div>
</div>

<!-- Section de sélection -->
<section id="section"  class="container px-5 py-16 mx-auto bg-medium-blue rounded-xl ">

	<div class="px-0 md:px-20 mb-16">
	<!-- Séléction du produit principal -->
		<div class="flex flex-col md:flex-row gap-8 items-start">
	
			<!-- Images du produit -->
			<div class="w-full md:w-1/2 lg:w-7/12">
				<img loading="lazy" src="<?= isset($borne) ? base_url($borne->images[0]->chemin) : base_url('./assets/images/bornes/borne-personnalisee.png') ?>" alt="Borne Arcade <?= isset($borne) ? $borne->nom : 'Personnalisée' ?>" class="w-full h-auto">
			</div>
	
			<!-- Informations produit -->
			<div class="flex-1">
				<h1 class="text-3xl md:text-4xl font-bold mb-2 text-gray-100">Borne Personnalisée <span class="text-xl text-gray-500"><?= isset($borne) ? '<br> de '.$borne->nom : '' ?></span></h1>
				<p  class="text-green-400 text-xl md:text-2xl font-bold mb-4">1690,00€</p>
	
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
				<div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-6">
					<div class="flex flex-col border border-gray-700 p-2 rounded-xl items-center justify-center text-center">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
							<path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z" />
						</svg>
						<p class="text-sm">Fabriqué en France</p>
					</div>
					<div class="flex flex-col border border-gray-700 p-2 rounded-xl items-center justify-center text-center">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mb-2">
							<path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
						</svg>
						<p class="text-sm">Garantie 2 ans</p>
					</div>
					<div class="flex flex-col border border-gray-700 p-2 rounded-xl items-center justify-center text-center">
						<svg class="h-8 w-15" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
							<path stroke-linecap="round" stroke-linejoin="round" d="m15.75 15.75-2.489-2.489m0 0a3.375 3.375 0 1 0-4.773-4.773 3.375 3.375 0 0 0 4.774 4.774ZM21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
						</svg>
						<p class="text-sm">Assistance disponible</p>
					</div>
					<div class="flex flex-col border border-gray-700 p-2 rounded-xl items-center justify-center text-center">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
							<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
						</svg>
						<p class="text-sm">Paiement 100% sécurisé</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!-- Séléction des options -->
	<?php if (!empty($options)) : ?>
	<div class="px-0 md:px-20">
		<h2 class="py-5 md:px-7 px-0 md:mx-10 mx-5 font-bold text-lg md:text-2xl text-gray-300">Options</h2>
		<div class="flex overflow-x-scroll p-5 hide-scroll-bar space-x-6 rounded-xl bg-light-teal/10">
			<?php foreach($options as $option) : ?>
				<div class="relative min-w-[300px] sm:min-w-[350px] md:min-w-[400px] bg-gray-800 rounded-lg overflow-hidden border-2 border-gray-700 hover:border-green-700 shadow-gray-900 shadow-md hover:shadow-lg ease-in-out flex-shrink-0">
					<label>
						<input type="checkbox" id="option-<?= $option->id ?>" name="idOptions[]" value="<?= $option->id ?>" class="absolute top-3 right-3 w-6 h-6 cursor-pointer rounded-full border-gray-300 focus:ring-2 focus:ring-green-500 focus:outline-none">
					</label>
					<img loading="lazy" src="<?= base_url($option->image->chemin) ?>" alt="Option <?= $option->nom ?>" class="w-full h-64 object-cover">
					<div class="p-4">
						<p class="text-green-400 text-lg font-bold mb-2"><?= $option->cout ?> €</p>
						<h3 class="font-bold text-lg text-left mb-2"><?= $option->nom ?></h3>
						<p class="text-left text-sm text-gray-300"><?= $option->description ?>.</p>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	<?php endif; ?>
	
	<!-- Séléction Matière -->
	<div class="px-0 md:px-20">
		<div class="flex items-center justify-between">
			<!-- Nom du modèle -->
			<h2 class="py-5 md:px-7 px-0 md:mx-10 mx-5 font-bold text-lg md:text-2xl text-gray-300">Matière <span class="text-green-500/30">(*)</span></h2>
			<!-- Sélecteur du modèle -->
			<div class="w-full max-w-sm min-w-[200px]">
				<div class="relative">
					<p class="text-red-500"><?= isset($erreurs['id_matiere']) ? $erreurs['id_matiere'] : '' ?></p>
				</div>
			</div>
		</div>
		<div class="flex overflow-x-scroll p-5 hide-scroll-bar space-x-6 rounded-xl <?= $bgColor = isset($erreurs['id_matiere']) ? "bg-red-700/30" : "bg-light-teal/10" ?>">
		<?php foreach($matieres as $matiere) : ?>
			<div class="relative w-52 h-52 md:w-72 md:h-72 bg-gray-800 rounded-lg overflow-hidden border-2 border-gray-700 <?= $hoverColor = isset($erreurs['id_matiere']) ? "hover:border-red-800" : "hover:border-green-700" ?> shadow-md shadow-gray-900 ease-in-out">
				<label>
					<input type="radio" id="matiere-<?= $matiere->id ?>" name="id_matiere" value="<?= $matiere->id ?>" class="absolute top-3 right-3 w-5 h-5 rounded-full border-gray-300 focus:ring-2 focus:ring-green-500 focus:outline-none">
				</label>
				<img src="<?= base_url('assets/images/bornes/matiere.jpg')?>" alt="Matière <?= $matiere->nom ?>" class="w-full h-5/6 object-cover" />
				<div style="background-color: <?= $matiere->couleur ?>;" class="h-1/4"></div>
			</div>
		<?php endforeach; ?>
	
			<!-- Contact Matière -->
			<div class="relative flex items-center justify-center w-52 h-52 md:w-72 md:h-72 bg-gray-800 rounded-lg overflow-hidden shadow-md border-dotted border-2 border-gray-500">
				<div class="absolute flex flex-col items-center justify-center text-center px-4">
					<p class="p-6 text-gray-300 text-sm md:text-base font-medium">
						Vous voulez une matière ou une couleur particulière ? <br>
						<a href="/contact?message=<?= urlencode('Bonjour, je vous contacte pour la personnalisation de la matière de la borne...') ?>" class="text-green-600 hover:text-green-500 underline">Contactez-nous !</a>
					</p>
				</div>
			</div>
		</div>
	</div>
	
	<!-- Séléction T-Molding -->
	<div class="px-0 md:px-20">
		<div class="flex items-center justify-between">
			<!-- Nom du modèle -->
			<h2 class="py-5 md:px-7 px-0 md:mx-10 mx-5 font-bold text-lg md:text-2xl text-gray-300">T-Molding <span class="text-green-500/30">(*)</span></h2>
			<!-- Sélecteur du modèle -->
			<div class="w-full max-w-sm min-w-[200px]">
				<div class="relative">
					<p class="text-red-500"><?= isset($erreurs['id_tmolding']) ? $erreurs['id_tmolding'] : '' ?></p>
				</div>
			</div>
		</div>
		<div class="flex overflow-x-scroll p-5 hide-scroll-bar space-x-6 rounded-xl <?= $bgColor = isset($erreurs['id_tmolding']) ? "bg-red-700/30" : "bg-light-teal/10" ?>">
		<?php foreach($tmoldings as $tmolding) : ?>
			<div class="relative w-52 h-52 md:w-72 md:h-72 bg-gray-800 rounded-lg overflow-hidden border-2 border-gray-700 <?= $hoverColor = isset($erreurs['id_tmolding']) ? "hover:border-red-800" : "hover:border-green-700" ?> shadow-md shadow-gray-900 ease-in-out">
				<label>
					<input type="radio" id="tmodling-<?= $tmolding->id ?>" name="id_tmolding" value="<?= $tmolding->id ?>" class="absolute top-3 right-3 w-5 h-5 rounded-full border-gray-300 focus:ring-2 focus:ring-green-500 focus:outline-none">
				</label>
				<img src="<?= base_url('./assets/images/bornes/tmolding.png') ?>" alt="T-Molding <?= $tmolding->nom ?>" class="w-full h-5/6 object-cover" />
				<div style="background-color: <?= $tmolding->couleur ?>;" class="h-1/4"></div>
			</div>
		<?php endforeach; ?>
	
			<!-- Contact T-Molding -->
			<div class="relative flex items-center justify-center w-52 h-52 md:w-72 md:h-72 bg-gray-800 rounded-lg overflow-hidden shadow-md border-dotted border-2 border-gray-500">
				<div class="absolute flex flex-col items-center justify-center text-center px-4">
					<p class="p-6 text-gray-300 text-sm md:text-base font-medium">
						Vous voulez une couleur en particulier ? <br>
						<a href="/contact?message=<?= urlencode('Bonjour, je vous contacte pour la personnalisation du t-molding...') ?>" class="text-green-600 hover:text-green-500 underline">Contactez-nous !</a>
					</p>
				</div>
			</div>
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
				<p class="text-red-500"><?= isset($erreurs['joystick']) ? $erreurs['joystick'] : '' ?></p>
			</div>
		</div>
		</div>
	
		<!-- Liste des joysticks -->
		<div id="liste-joysticks" class="flex overflow-x-scroll p-5 hide-scroll-bar space-x-6 rounded-xl <?= $bgColor = isset($erreurs['joystick']) ? "bg-red-700/30" : "bg-light-teal/10" ?>">
			<?php foreach($joysticks as $joystick) : ?>
			<div class="relative w-52 h-52 md:w-72 md:h-72 bg-gray-800 rounded-lg overflow-hidden border-2 border-gray-700 <?= $hoverColor = isset($erreurs['joystick']) ? "hover:border-red-800" : "hover:border-green-700" ?> shadow-md shadow-gray-900 ease-in-out flex-shrink-0">
				<label>
					<input type="radio" id="joystick-<?= $joystick->id ?>" data-model="<?= $joystick->modele ?>" data-color="<?= $joystick->couleur ?>" name="joystick" value="<?= $joystick->id ?>" class="absolute top-3 right-3 w-5 h-5 cursor-pointer rounded-full border-gray-300 focus:ring-2 focus:ring-green-500 focus:outline-none">
				</label>
				
				<img loading="lazy" src="<?= base_url('./assets/images/bornes/joystick.jpg') ?>" alt="Joystick <?= htmlspecialchars($joystick->modele) ?>" class="w-full h-4/6 md:h-5/6 object-cover">
	
				<div class="p-4 flex items-center justify-between">
					<h3 class="font-bold text-base text-white"><?= $joystick->modele ?></h3>
					<div
						style="background-color: <?= $joystick->couleur ?>;"
						class="w-6 h-6 rounded-full border border-gray-300">
					</div>
				</div>
			</div>
			<?php endforeach; ?>
	
			<!-- Contact Joystick -->
			<div class="relative flex items-center justify-center w-52 h-52 md:w-72 md:h-72 bg-gray-800 rounded-lg overflow-hidden shadow-md border-dotted border-2 border-gray-500">
				<div class="absolute flex flex-col items-center justify-center text-center px-4">
					<p class="p-6 text-gray-300 text-sm md:text-base font-medium">
						Vous voulez un modèle ou une couleur particulière ? <br>
						<a href="/contact?message=<?= urlencode('Bonjour, je vous contacte pour la personnalisation des joysticks...') ?>" class="text-green-600 hover:text-green-500 underline">Contactez-nous !</a>
					</p>
				</div>
			</div>
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
					<p class="text-red-500"><?= isset($erreurs['bouton']) ? $erreurs['bouton'] : '' ?></p>
				</div>
			</div>
		</div>
		<div id="liste-boutons" class="flex overflow-x-scroll p-5 hide-scroll-bar space-x-6 rounded-xl <?= $bgColor = isset($erreurs['bouton']) ? "bg-red-700/30" : "bg-light-teal/10" ?>">
		<?php foreach($boutons as $bouton) : ?>
			<div class="relative w-52 h-52 md:w-72 md:h-72 bg-gray-800 rounded-lg overflow-hidden border-2 border-gray-700 <?= $hoverColor = isset($erreurs['bouton']) ? "hover:border-red-800" : "hover:border-green-700" ?> shadow-md shadow-gray-900 ease-in-out">
				<label>
					<input type="radio" id="bouton-<?= $bouton->id ?>" data-forme="<?= $bouton->forme ?>" data-model="<?= $bouton->modele ?>" data-color="<?= $bouton->couleur ?>" name="bouton" value="<?= $bouton->id ?>" class="absolute top-3 right-3 w-5 h-5 rounded-full border-gray-300 focus:ring-2 focus:ring-green-500 focus:outline-none">
				</label>

				<img loading="lazy" src="<?= base_url('./assets/images/bornes/bouton.png') ?>" alt="Joystick <?= htmlspecialchars($joystick->modele) ?>" class="w-full h-4/6 md:h-5/6 object-cover">
	
				<div class="p-4 flex items-center justify-between">
					<h3 class="font-bold text-base text-white"><?= $bouton->modele ?></h3>
					<div
						style="background-color: <?= $bouton->couleur ?>;"
						class="w-6 h-6 rounded-full border border-gray-300">
					</div>
				</div>
			</div>
		<?php endforeach; ?>
		
		<!-- Contact Bouton -->
		<div class="relative flex items-center justify-center w-52 h-52 md:w-72 md:h-72 bg-gray-800 rounded-lg overflow-hidden shadow-md border-dotted border-2 border-gray-500">
			<div class="absolute flex flex-col items-center justify-center text-center px-4">
				<p class="p-6 text-gray-300 text-sm md:text-base font-medium">
					Vous voulez un modèle ou une couleur en particulier ? <br>
					<a href="/contact?message=<?= urlencode('Bonjour, je vous contacte pour la personnalisation des boutons...') ?>" class="text-green-600 hover:text-green-500 underline">Contactez-nous !</a>
				</p>
			</div>
		</div>
	
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
					<?= form_submit('submit', 'Configurer la disposition', "class='md:mb-0 mb-10 bg-green-700 hover:bg-green-600 text-white font-bold py-2 px-6 rounded-3xl cursor-pointer w-full md:w-auto'"); ?>
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
	<?php if (count($suggestion_bornes)): ?>
		<div class="mt-20 px-0 md:px-20">
			<h2 class="py-5 md:px-7 px-0 md:mx-10 mx-5 font-bold text-2xl md:text-3xl text-gray-300">Bornes récemment vues</h2>
			<div class="flex overflow-x-scroll p-5 hide-scroll-bar space-x-6 rounded-xl bg-deep-blue">
				<?php foreach($suggestion_bornes as $borneSuggestion) : ?>
					<div class="bg-gray-800 p-4 rounded">
						<a href="/bornes/<?=$borneSuggestion->id?>">
							<img loading="lazy" src="<?= base_url($borneSuggestion->images[0]->chemin) ?>" alt="Image de <?=$borneSuggestion->nom?>" class="w-full mb-8 max-w-sm
								mx-auto h-auto relative z-0 transition duration-200 ease-in-out hover:scale-110" onerror="this.src = 'https://via.placeholder.com/150';">
							<h3 class="text-xl font-bold mb-2"><?=$borneSuggestion->nom?></h3>
							<p class="text-green-600 font-bold mb-4"><?=sprintf("%.02F €", $borneSuggestion->prix)?></p>
						</a>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	<?php endif; ?>
</section>
<?= view('commun/footer') ?>
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

