<?= /** @noinspection PhpUndefinedVariableInspection */
view('commun/header', ['titre' => $titre]) ?>
<!-- Formulaire des options choisies -->
<?= form_open('/bornes/'.$borne->id) ?>
<section id="section" class="container px-5 py-16 mx-auto bg-medium-blue rounded-xl ">
	<div class="px-0 md:px-20 mb-16">
		<!-- Section du produit principal -->
		<div class="flex flex-col md:flex-row gap-8 items-start">
			<!-- Images du produit -->
			<div class="w-full md:w-1/2 lg:w-7/12">
				<img loading="lazy" src="<?= base_url($borne->images[0]->chemin) ?>" alt="Borne Arcade" class="w-full h-auto rounded-lg">
			</div>
	
			<!-- Informations produit -->
			<div class="flex-1">
				<h1 class="text-3xl md:text-4xl font-bold mb-2"><?= $borne->nom ?></h1>
				<p  class="text-green-400 text-2xl md:text-3xl font-bold mb-4"><?= $borne->prix ?> €</p>
	
				<!-- Contenu de la borne -->
				<div class="bg-gradient-to-r from-dark-blue max-w-100 to-dark-teal p-4 rounded mb-4">
					<h2 class="text-lg font-bold text-green-400 mb-2">Votre borne contient</h2>
					<?= $borne->description ?>
					<p class="mt-4">Livrée sur rendez-vous en 3/4 semaines</p>
				</div>
	
				<!-- Boutons -->
				<div class="text-center md:flex md:items-center gap-4">
					<a href="/borne-perso/<?= $borne->id ?>" class="bg-blue-800 hover:bg-blue-700   text-white font-bold py-2 px-6 my-5 mb-8 rounded-3xl cursor-pointer">
						Personnaliser
					</a>
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
	
	<?php if (!empty($borne->options)) : ?>
	<!-- Séléction des options -->
	<div class="px-0 md:px-20">
		<h2 class="py-5 md:px-7 px-0 md:mx-10 mx-5 font-bold text-2xl md:text-3xl text-gray-300">Options</h2>
		<div class="flex overflow-x-scroll p-5 hide-scroll-bar space-x-6 rounded-xl bg-light-teal/10">
			<?php foreach($borne->options as $option) : ?>
				<div class="relative min-w-[300px] sm:min-w-[350px] md:min-w-[400px] bg-gray-800 rounded-lg overflow-hidden border-2 border-green-600 hover:border-green-700  shadow-gray-900 shadow-md hover:shadow-lg ease-in-out flex-shrink-0">
					<label>
						<input type="checkbox" id="option-<?= $option->id ?>" name="idOptions[]" value="<?= $option->id ?>" class="absolute top-3 right-3 w-6 h-6 cursor-pointer rounded-full border-gray-300 focus:ring-2 focus:ring-green-500 focus:outline-none">
					</label>
					<img loading="lazy" src="<?= base_url($option->image->chemin) ?>" alt="Option <?= $option->nom ?>" class="w-full h-64 object-cover">
					<div class="p-4">
						<p class="text-green-400 text-xl font-bold mb-2"><?= $option->cout ?> €</p>
						<h3 class="font-bold text-xl text-left mb-2"><?= $option->nom ?></h3>
						<p class="text-left text-sm text-gray-400"><?= $option->description ?>.</p>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	<?php endif; ?>
	
	<div class="px-0 md:px-20 mx-auto my-16">
	
		<h2 class="py-5 md:px-7 px-0 md:mx-10 mx-5 font-bold text-2xl md:text-3xl text-gray-200">Aperçu des touches</h2>
	
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
		<?php if (count($suggestion_bornes)) : ?>
			<div class="mt-20 px-0 md:px-20">
				<h2 class="py-5 md:px-7 px-0 md:mx-10 mx-5 font-bold text-2xl md:text-3xl text-gray-300">Bornes récemment vues</h2>
				<div class="flex overflow-x-scroll p-5 hide-scroll-bar space-x-6 rounded-xl bg-deep-blue">
					<?php foreach($suggestion_bornes as $borne) : ?>
						<div class="bg-gray-800 p-4 rounded">
							<a href="/bornes/<?=$borne->id?>">
								<img loading="lazy" src="<?= base_url($borne->images[0]->chemin) ?>" alt="Image de <?=$borne->nom?>" class="w-full mb-8 max-w-sm
								mx-auto h-auto
						relative z-0 transition duration-200 ease-in-out hover:scale-110" onerror="this.src = 'https://via.placeholder.com/150';">
								<h3 class="text-xl font-bold mb-2"><?=$borne->nom?></h3>
								<p class="text-green-600 font-bold mb-4"><?=sprintf("%.02F €", $borne->prix)?></p>
							</a>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endif; ?>
	</div>
</section>
<?= form_close() ?>
<script>
	const boutonsBorne   = <?= json_encode(isset($borne) ? $borne->boutons : null); ?>;
	const joysticksBorne = <?= json_encode(isset($borne) ? $borne->joysticks : null); ?>;
	const affichageUniquement = true;
	
	let nbJoueur = <?= count($borne->joysticks) ?>;
	let nbBoutonParJoueur = <?= (count($borne->boutons) > 1) ?
								 count($borne->boutons) / count($borne->joysticks) :
								 count($borne->boutons) ?>;
</script>
<script src="/assets/js/canva-boutons.js"></script>
<script src="/assets/js/check-option-animation.js"></script>
<?= view('commun/footer') ?>
