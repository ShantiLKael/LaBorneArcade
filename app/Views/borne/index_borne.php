<?= /** @noinspection PhpUndefinedVariableInspection */
view('commun/header', ['titre' => $titre]) ?>
<?php $get = $_GET; ?>
<form action="/bornes" method="GET">
<section class="mx-auto">
	<!-- Section de sélection -->
	<div class="bg-gradient-to-r from-dark-teal max-w-100 to-medium-blue text-center py-10 mb-8">
		<h2 class="text-2xl font-bold mb-4">Choisis ta borne préférée</h2>
		<div class="grid col-span-1 md:flex md:justify-center md:space-x-4">
			<a href="/bornes<?= query_par_type($get, "sticker") ?>" class="<?= "sticker" === $selectionType ? "bg-green-700 hover:bg-green-800" : "bg-medium-blue/70 hover:bg-deep-blue/70" ?> my-2 md:my-0 md:mx-0 mx-20 border border-spacing-1 border-gray-400 text-white px-4 py-3 rounded-2xl">Sticker</a>
			<a href="/bornes<?= query_par_type($get, "wood") ?>" class="<?= "wood" === $selectionType ? "bg-green-700 hover:bg-green-800" : "bg-medium-blue/70 hover:bg-deep-blue/70" ?> my-2 md:my-0 md:mx-0 mx-20 border border-spacing-1 border-gray-400 text-white px-4 py-3 rounded-2xl">Classique Wood</a>
			<a href="/bornes<?= query_par_type($get, "gravure") ?>" class="<?= "gravure" === $selectionType ? "bg-green-700 hover:bg-green-800" : "bg-medium-blue/70 hover:bg-deep-blue/70" ?> my-2 md:my-0 md:mx-0 mx-20 border border-spacing-1 border-gray-400 text-white px-4 py-3 rounded-2xl">Classique Wood Gravé</a>
		</div>
		<p class="text-gray-300 mx-10 mt-8">
			Pour toute information complémentaire ou pour passer commande, prenez <a href="/contact" class="text-green-400 hover:text-green-300 underline">rdv</a>.
		</p>
		<p class="text-gray-300 mx-10 mt-5">
			Toutes nos bornes sont équipées de l’émulateur Hyperspin ainsi que 8000 jeux d’arcades et de consoles rétro. <a href="#" class="text-green-400 hover:text-green-300 underline">Lire plus</a>.
		</p>
	</div>
	<!-- Filtres -->
	<div class="flex flex-col md:flex-row md:space-x-8 mb-8 py-3 px-10">
		<!-- Conteneur des filtres -->
		<div class="md:w-1/4 md:h-auto bg-medium-blue p-6 my-5 md:my-0 rounded-lg border border-gray-700">
			
			<h3 class="text-lg font-bold mb-6 text-gray-300">Filtrer par :</h3>

			<!-- Champ de recherche -->
			<div class="relative mb-6">
				<?= form_input([
					'name'          => 'recherche',
					'id'            => 'recherche',
					'type'          => 'text',
					'class'         => 'w-full bg-gray-700 border border-gray-500 text-gray-300 placeholder:text-gray-400 text-sm rounded-md py-2 pl-3 pr-4 focus:outline-none focus:ring-2 focus:ring-green-500',
					'value'         => @$get['recherche'] ?: "",
					'placeholder'   => 'Rechercher...',
				]); ?>
			</div>
			
			<input type="hidden" name="page" value="<?= $page ?>">
			<input type="hidden" name="type" value="<?= @$get['type'] ?: "" ?>">

			<!-- Filtres des thèmes -->
			<div class="mb-6">
				<h4 class="text-md font-semibold text-gray-300 mb-4">Thèmes</h4>
				<div class="space-y-2">
					<?php foreach ($themes as $theme): ?>
						<?php $is_checked = in_array($theme->id, $selectionTheme) ? " checked" : ""; ?>
						<?= form_label(
							'<input type="checkbox" name="theme[]" value="'.$theme->id.'" class="mr-2 rounded text-green-500 focus:ring focus:ring-green-400"'.$is_checked.'>'
							.$theme->nom,
							'',
							['class' => 'block text-gray-400']
						) ?>
					<?php endforeach; ?>
				</div>
			</div>

			<!-- Filtres des matières -->
			<div class="mb-6">
				<h4 class="text-md font-semibold text-gray-300 mb-4">Matières</h4>
				<div class="space-y-2">
					<?php foreach ($matieres as $matiere): ?>
						<?php $is_checked = in_array($matiere->id, $selectionMatiere) ? " checked" : ""; ?>
						<?= form_label(
							'<input type="checkbox" name="matiere[]" value="'.$matiere->id.'" class="mr-2 rounded text-green-500 focus:ring focus:ring-green-400"'.$is_checked.'>'
							.$matiere->nom,
							'',
							['class' => 'block text-gray-400']
						) ?>
					<?php endforeach; ?>
				</div>
			</div>

			<!-- Filtre par prix -->
			<div class="mb-6">
				<h4 class="text-md font-semibold text-gray-300 mb-4">Prix</h4>
				<?= form_input([
						'name'          => 'prix_min',
						'id'            => 'prix_min',
						'type'          => 'number',
						'min'           => 0,
						'class'         => 'md:w-1/2 bg-gray-700 border border-gray-500 text-gray-300 placeholder:text-gray-400 text-sm rounded-md py-2 pl-3 focus:outline-none focus:ring-2 focus:ring-green-500',
						'value'         => @$get['prix_min'] ?: "",
						'placeholder'   => 'Min',
					]); ?>
				<h4 class="text-md text-gray-300 pl-2 mb-2 mt-2">à</h4>
				<label>
					<input
						type="number"
						name="prix_max"
						placeholder="Max"
						value="<?= @$get['prix_max'] ?: "" ?>"
						class="md:w-1/2 bg-gray-700 border border-gray-500 text-gray-300 placeholder:text-gray-400 text-sm rounded-md py-2 pl-3
						focus:outline-none focus:ring-2 focus:ring-green-500">
				</label>
			</div>

			<!-- Bouton de soumission -->
			<div>
				<?= form_submit('', 'Appliquer les filtres', "class='w-full bg-green-600 hover:bg-green-500 text-white py-2 px-4 rounded-md text-sm font-medium focus:outline-none focus:ring-2 focus:ring-green-500' role='button' id='submit'"); ?>
			</div>
		</div>

		<!-- Liste des bornes -->
		<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4 xl:w-3/4">
			<?php if (count($bornes)): ?>
				<?php foreach($bornes as $borne): ?>
					<div class="bg-gray-800 p-4 rounded">
						<a href="/bornes/<?= $borne->id ?>">
							<img loading="lazy" src="<?= $borne->image ?>" alt="Image de <?= $borne->nom ?>" class="w-full mb-8 max-w-sm mx-auto h-auto
						relative z-0 transition duration-200 ease-in-out hover:scale-110" onerror="this.src = 'https://via.placeholder.com/150';">
							<h3 class="text-xl font-bold mb-2"><?= $borne->nom ?></h3>
							<p class="text-green-600 font-bold mb-4"><?= sprintf("%.02F €", $borne->prix) ?></p>
						</a>
						<div class="grid grid-cols-1 md:grid-cols-2 mx-4">
							<a href="#" class="md:mr-2 bg-green-700 hover:bg-green-600 p-2 text-white text-center rounded-3xl">
								Ajouter au panier
							</a>
							<a href="/borne-perso/1" class="md:ml-2 bg-blue-800 hover:bg-blue-700 p-2 text-white text-center rounded-3xl">
								Personnaliser
							</a>
						</div>
					</div>
				<?php endforeach; ?>
			<?php else: ?>
				<span>Aucune borne à afficher</span>
			<?php endif; ?>
		</div>
	</div>
	<?= $pager_links ?>
</section>
</form>
<script src="/assets/js/filtres-responsifs.js"></script>
<?= view('commun/footer') ?>
