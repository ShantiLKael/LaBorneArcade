
<?= view('commun/header', ['titre' => $titre]) ?>
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
			<div class="bg-gray-800 shadow-md rounded-lg p-6">
				<div class="flex justify-between items-center mb-4">
				<div>
					<h2 class="text-xl font-bold mb-5">Commande #<?= $commande->id ?></h2>
					<p class="text-sm text-gray-400 ">Date : <?= $commande->dateCreation->format('d/m/Y') ?></p>
					<p class="text-sm text-gray-400 ">État : <span class="font-medium"><?= $commande->etat ?></span></p>
				</div>
				<p class="text-lg font-semibold text-green-500">Total : <?= $commande->borne->prix ?> €</p>
				</div>

				<!-- Détails des produits de la commande -->
				<div class="space-y-4">
				<!-- Produit 1 -->
				<div class="flex items-center justify-between border-b border-gray-700 pb-4">
					<div class="flex items-start">
					<img src="https://via.placeholder.com/100" alt="Image Borne" class="w-20 h-20 rounded-md mr-4">
					<div>
						<h3 class="text-lg font-semibold">Borne Rétro</h3>
						<p class="text-sm text-gray-400 ">Thème : <span class="font-medium"><?= $commande->borne->theme->nom ?></span></p>
						<p class="text-sm text-gray-400 ">Prix  : <span class="font-medium"><?= $commande->borne->prix ?> €</span></p>
					</div>
					</div>
				</div>
				</div>
			</div>
		<?php endforeach; ?>
	<?php endif; ?>
</section>
<?= view('commun/footer') ?>
