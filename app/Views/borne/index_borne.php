<?= view('commun/header', ['titre' => $titre]) ?>
<section class="mx-auto">
	<!-- Section de sélection -->
	<div class="bg-gradient-to-r from-dark-teal max-w-100 to-medium-blue text-center py-10 mb-8">
		<h2 class="text-2xl font-bold mb-4">Choisis ta borne préférée</h2>
		<div class="grid col-span-1 md:flex md:justify-center md:space-x-4">
			<a href="/bornes?option=sticker" class="bg-green-700      hover:bg-green-800    my-2 md:my-0 md:mx-0 mx-20 border border-spacing-1 border-gray-400 text-white px-4 py-3 rounded-2xl">Sticker</a>
			<a href="/bornes?option=wood"    class="bg-medium-blue/70 hover:bg-deep-blue/70 my-2 md:my-0 md:mx-0 mx-20 border border-spacing-1 border-gray-400 text-white px-4 py-3 rounded-2xl">Classique Wood</a>
			<a href="/bornes?option=gravure" class="bg-medium-blue/70 hover:bg-deep-blue/70 my-2 md:my-0 md:mx-0 mx-20 border border-spacing-1 border-gray-400 text-white px-4 py-3 rounded-2xl">Classique Wood Gravé</a>
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
		<div class="md:w-1/4 md:h-1/3 bg-medium-blue p-4 rounded mb-5 border border-gray-700">
			<h3 class="text-lg font-bold mb-4">Filtrer par :</h3>
			<?= form_open('/bornes') ?>
				<?php if (isset($themes)): ?>
					<?php foreach ($themes as $theme): ?>
							<?= form_label(
						'<input type="checkbox" name="theme[]" value="' . $theme->nom . '" class="mr-2"> ' . $theme->nom,
						'',
						['class' => 'block mb-2']
					) ?>
					<?php endforeach; ?>
				<?php else : ?>
					<p class="text-center mb-8">Aucun filtre</p>
				<?php endif; ?>
			<?= form_open('/connexion') ?>
		</div>

		<!-- Liste des bornes -->
		<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4 xl:w-3/4">
			<?php
			$bornesTest = [
				[
					'id'    => 1,
					'image' => 'https://via.placeholder.com/150',
					'title' => 'Borne D\'arcade Galaktronik',
					'price' => '1490,00 €',
				],
				[
					'id'    => 1,
					'image' => 'https://via.placeholder.com/150',
					'title' => 'Borne D\'arcade Pac-Man',
					'price' => '1490,00 €',
				],
				[
					'id'    => 1,
					'image' => 'https://via.placeholder.com/150',
					'title' => 'Borne D\'arcade Ken le survivant',
					'price' => '1490,00 €',
				],
			];

			foreach ($bornesTest as $borne) {
				echo "
				<div class='bg-gray-800 p-4 rounded'>
					<a href='/bornes/{$borne['id']}'>
						<img src='{$borne['image']}' alt='Image de {$borne['title']}' href='/bornes/{$borne['id']}' class='w-full mb-8 max-w-sm mx-auto h-auto relative z-0 transition duration-200 ease-in-out hover:scale-110'>
						<h3 class='text-xl font-bold mb-2'>{$borne['title']}</h3>
						<p class='text-green-600 font-bold mb-4'>{$borne['price']}</p>
					</a>
					<div class='grid grid-cols-1 md:grid-cols-2 mx-4'>
						<a href='#' class='md:mr-2 bg-green-700 hover:bg-green-600 p-2 text-white text-center rounded-3xl'>
							Ajouter au panier
						</a>

						<a href='/borne-perso/{$borne['id']}' class='md:ml-2 bg-blue-800 hover:bg-blue-700 p-2 text-white text-center rounded-3xl'>
							Personnaliser
						</a>
					</div>
				</div>
				";
			}
			?>
		</div>
	</div>
</section>
<?= view('commun/footer') ?>