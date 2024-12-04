<?= view('commun/header', ['titre' => $titre]) ?>
<section class="container mx-auto my-8 px-4">
	<h1 class="text-3xl font-bold mb-6 text-center">Mes Commandes</h1>

	<!-- Liste des commandes -->
	<div class="space-y-6">

	<!-- Exemple d'une commande -->
	<div class="bg-gray-800 shadow-md rounded-lg p-6">
		<div class="flex justify-between items-center mb-4">
		<div>
			<h2 class="text-xl font-bold mb-5">Commande #12345</h2>
			<p class="text-sm text-gray-400 ">Date : 02/12/2024</p>
			<p class="text-sm text-gray-400 ">État : <span class="text-green-500 font-medium">Livrée</span></p>
		</div>
		<p class="text-lg font-semibold text-green-500">Total : 1500€</p>
		</div>

		<!-- Détails des produits de la commande -->
		<div class="space-y-4">
		<!-- Produit 1 -->
		<div class="flex items-center justify-between border-b border-gray-700 pb-4">
			<div class="flex items-start">
			<img src="https://via.placeholder.com/100" alt="Image Borne" class="w-20 h-20 rounded-md mr-4">
			<div>
				<h3 class="text-lg font-semibold">Borne Rétro</h3>
				<p class="text-sm text-gray-400 ">Thème : <span class="font-medium">Rétro</span></p>
				<p class="text-sm text-gray-400 ">Prix : <span class="font-medium">1500€</span></p>
			</div>
			</div>
		</div>
		</div>
	</div>

	<!-- Deuxième commande -->
	<div class="bg-gray-800 shadow-md rounded-lg p-6">
		<div class="flex justify-between items-center mb-4">
		<div>
			<h2 class="text-xl font-bold">Commande #12346</h2>
			<p class="text-sm text-gray-400 ">Date : 29/11/2024</p>
			<p class="text-sm text-gray-400 ">État : <span class="text-yellow-500 font-medium">En cours</span></p>
		</div>
		<p class="text-lg font-semibold text-green-500">Total : 2000€</p>
		</div>

		<!-- Détails des produits de la commande -->
		<div class="space-y-4">
		<!-- Produit 1 -->
		<div class="flex items-center justify-between border-b border-gray-700 pb-4">
			<div class="flex items-start">
			<img src="https://via.placeholder.com/100" alt="Image Borne" class="w-20 h-20 rounded-md mr-4">
			<div>
				<h3 class="text-lg font-semibold">Borne Moderne</h3>
				<p class="text-sm text-gray-400 ">Thème : <span class="font-medium">Futuriste</span></p>
				<p class="text-sm text-gray-400 ">Prix : <span class="font-medium">2000€</span></p>
			</div>
			</div>
		</div>
		</div>
	</div>

	<!-- Troisième commande -->
	<div class="bg-gray-800 shadow-md rounded-lg p-6">
		<div class="flex justify-between items-center mb-4">
		<div>
			<h2 class="text-xl font-bold">Commande #12347</h2>
			<p class="text-sm text-gray-400 ">Date : 25/11/2024</p>
			<p class="text-sm text-gray-400 ">État : <span class="text-red-500 font-medium">Annulée</span></p>
		</div>
		<p class="text-lg font-semibold text-green-500">Total : 1200€</p>
		</div>

		<!-- Détails des produits de la commande -->
		<div class="space-y-4">
		<!-- Produit 1 -->
		<div class="flex items-center justify-between border-b border-gray-700 pb-4">
			<div class="flex items-start">
			<img src="https://via.placeholder.com/100" alt="Image Borne" class="w-20 h-20 rounded-md mr-4">
			<div>
				<h3 class="text-lg font-semibold">Borne Mini</h3>
				<p class="text-sm text-gray-400 ">Thème : <span class="font-medium">Compact</span></p>
				<p class="text-sm text-gray-400 ">Prix : <span class="font-medium">1200€</span></p>
			</div>
			</div>
		</div>
		</div>
	</div>

	</div>
</section>
<?= view('commun/footer') ?>