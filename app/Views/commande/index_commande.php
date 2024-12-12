<?= /** @noinspection PhpUndefinedVariableInspection */
view('commun/header', ['titre' => $titre]) ?>
<section class="container mx-auto my-16 px-4">
	<h1 class="text-3xl font-bold mb-6 text-center">Mes Commandes</h1>

	<!-- Liste des commandes -->
	<div class="space-y-6">

	<!-- Lister les commandes -->
	<?php if (count($commandes) == 0) : ?>
		<div class="flex items-center justify-between p-4 border border-gray-700 rounded-lg">
			<p>Aucune Commande</p>
		</div>
	<?php else : ?>
		<?php foreach($commandes as $commande) : ?>
			<div class="bg-gray-800 shadow-md rounded-t-lg border-b border-green-900 p-6">
				<div class="flex justify-between items-center mb-5 md:mb-10 space-y-2">
					<div>
						<h2 class="text-2xl font-bold">Commande #<?= $commande->id ?></h2>
						<p class="text-md text-gray-200 my-2">Date : <?= $commande->dateCreation->format('d/m/Y') ?></p>
						<p class="text-md text-gray-200">État : <span class="font-medium"><?= $commande->etat ?></span></p>
					</div>
					<div class="flex flex-row items-center">
						<p class="text-xl font-semibold text-green-500 md:pr-5 pr-2">Total :
							<?php
								$prixTotBorne = $commande->borne->prix;
								foreach ($commande->borne->options as $option) {
									$prixTotBorne += $option->cout;
								}

								echo $prixTotBorne
							?>
							€
						</p>
						<div class="flex justify-between items-center cursor-pointer" onclick="interrupteurReponse(<?= $commande->id ?>)">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
								<path id="fleche-<?= $commande->id ?>"  stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
							</svg>
						</div>
					</div>
				</div>

				<!-- Détails des produits de la commande -->
				<div class="space-y-4 hidden" id="detail-<?= $commande->id ?>">
					<!-- Produit -->
					<div class="flex items-center justify-between border-b border-gray-700 pb-4">
						<div class="flex items-start">
							<img loading="lazy" src="https://via.placeholder.com/100" alt="Image Borne" class="w-20 h-20 rounded-md mr-4">
							<div>
								<h3 class="text-lg font-semibold">Borne</h3>
								<p class="text-sm">Thème : <span class="font-medium text-blue-700"><?= empty($commande->borne->borne) ? 'Personnalisée' : $commande->borne->borne->theme->nom ?></span></p>
								<p class="text-sm">Prix : <span class="font-medium text-green-700"><?= $commande->borne->prix ?> €</span></p>
							</div>
						</div>
						
						<div class="flex items-end text-gray-400">
							<ul>
								<li>Prix de base <span class="text-green-600"><?= $commande->borne->prix ?> €</span></li>
								<?php foreach($commande->borne->options as $option) : ?>
									<li><?= $option->nom ?> <span class="text-green-500">+<?= $option->cout ?> €</span></li>
								<?php endforeach; ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	<?php endif; ?>
</section>
<?= view('commun/footer') ?>
<script src="./assets/js/btn-deroule.js"></script>
