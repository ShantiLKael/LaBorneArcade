<?= view('commun/header', ['titre' => $titre]) ?>
<section class="container mx-auto pt-16 px-4">
	<form action="/bornes/<?= $borne->id ?>" method="post" id="optionsForm"> <!-- Formulaire des options choisies -->
	<input type="hidden" id="id_borne" name="id_borne" value=<?= $borne->id?> />
	
	<!-- Section du produit principal -->
	<div class="flex flex-col md:flex-row gap-8 items-start">
		<!-- Images du produit -->
		<div class="w-full md:w-1/2 lg:w-7/12">
			<img src="image_principale.jpg" alt="Borne Arcade" class="w-full h-auto rounded-lg">
		</div>

		<!-- Informations produit -->
		<div class="flex-1">
			<h1 class="text-3xl font-bold mb-2"><?= $borne->nom ?></h1>
			<p class="text-green-400 text-2xl font-bold mb-4"><?= $borne->prix ?> €</p>

			<!-- Contenu de la borne -->
			<div class="bg-gradient-to-r from-medium-blue max-w-100 to-dark-teal p-4 rounded mb-4">
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
				<a href="/borne-perso/<?= $borne->id ?>" class="bg-blue-800 hover:bg-blue-700   text-white font-bold py-2 px-6 my-5 mb-8 rounded-3xl cursor-pointer">
					Personnaliser
				</a>
				<input type="submit" value="Ajouter au panier" class="bg-green-700 hover:bg-green-600 text-white font-bold py-2 px-6 my-5 mb-8 rounded-3xl cursor-pointer">
			</div>

			<!-- Infos supplémentaires -->
			<div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-6">
				<div class="text-center">
					<img src="fabrique_france_icon.png" alt="Fabriqué en France" class="w-10 mx-auto mb-2">
					<p class="text-sm">Fabriqué en France</p>
				</div>
				<div class="text-center">
					<img src="garantie_icon.png" alt="Garantie 2 ans" class="w-10 mx-auto mb-2">
					<p class="text-sm">Garantie 2 ans</p>
				</div>
				<div class="text-center">
					<img src="support_icon.png" alt="Support" class="w-10 mx-auto mb-2">
					<p class="text-sm">Assistance disponible</p>
				</div>
				<div class="text-center">
					<img src="paiement_icon.png" alt="Paiement sécurisé" class="w-10 mx-auto mb-2">
					<p class="text-sm">Paiement 100% sécurisé</p>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Section des options -->
<section class="container mx-auto px-4">
	<div class="mt-12">
		<h2 class="text-2xl font-bold mb-3 text-center">Options</h2>
		<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
			<?php foreach($borne->options as $option) : ?>
				<div class="relative p-4 rounded border-2 border-transparent hover:border-green-600/50  transition duration-300">
					<input type="checkbox" id="option<?= $option->nom ?>" name="options[]" value="<?= $option->nom ?>" class="absolute top-2 right-2 w-5 h-5 cursor-pointer">
					<img src="" alt="<?= $option->nom ?>" class="w-full h-40 object-cover rounded mb-4">
					<p class="text-green-400 text-lg font-bold mb-2"><?= $option->cout ?> €</p>
					<div class="text-base">
						<h3 class="font-bold text-lg text-left mb-2"><?= $option->nom ?></h3>
						<p class="text-left"><?= $option->description ?>.</p>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		</form>
	</div>
</section>
<script src="./assets/js/check-option-animation.js"></script>
<?= view('commun/footer') ?>