<?= view('commun/header', ['titre' => $titre]) ?>
<?= form_open('/panier') ?>
<section class="container mx-auto my-8 px-4 lg:flex lg:gap-6">
	
	<!-- Section Panier -->
	<div class="w-full lg:w-2/3 bg-gray-800 rounded-lg shadow-md p-6">
	<h2 class="text-2xl font-bold mb-4">Votre Panier <?= (count($bornes) == 0) ? 'est vide' : '' ?></h2>
	<div class="space-y-4">

		<!-- Affichage des produits -->
		<?php $prixTot = $prixTotBorne = $i = 0; ?>
		<?php if (count($bornes) == 0) : ?>
			<div class="flex items-center justify-between p-4 border border-gray-700 rounded-lg">
				<p>Aucun Produit</p>
			</div>
		<?php else : ?>
			<?php foreach($bornes as $bornePerso) : ?>
				<div class="relative flex items-center justify-between p-4 border border-gray-700 rounded-lg hover:shadow-md transition">
					
					<!-- Bouton radio en haut à droite -->
					<div class="absolute top-2 right-2">
						<input type="radio" name="selected_borne" value="<?= $bornePerso->id ?>" class="form-radio w-5 h-5 cursor-pointer border hover:border-green-300 focus:ring-2 focus:ring-green-500"/>
					</div>

					<div class="flex">
						<?php if ($bornePerso->borne) : ?>
							<img loading="lazy" src="<?= /* $bornePerso->borne->image->chemin */ ''?>" alt="Image Borne <?= $bornePerso->nom ?>" class="w-25 h-25 rounded-md mr-4">
						<?php endif; ?>
						<div class="<?= $bornePerso->borne != null ? 'space-y-4' : 'space-y-2' ?>">
							<h3 class="text-lg font-semibold"><?= $bornePerso->nom ?></h3>
							<p class="text-md text-gray-400">Thème : <span class="font-medium text-blue-500"><?= empty($bornePerso->borne) ? 'Personnalisée' : $bornePerso->borne->theme->nom ?></span></p>
							<p class="text-md text-gray-400">Prix total  : 
								<span class="font-medium text-green-500">
								<?php
									$idPanierSession = null;
									if ($options) {
										$idPanierSession = array_search($bornePerso, session()->get('panier'));
										if ($options[$idPanierSession])
											foreach ($options[$idPanierSession] as $option)
												$prixTotBorne += $option->cout;

										$prixTotBorne += $bornePerso->prix;
									} else {
										foreach ($bornePerso->options as $option)
										$prixTotBorne += $option->cout;

										$prixTotBorne += $bornePerso->prix;
									}

									echo $prixTotBorne. ' €';
								?>
								</span>
							</p>
						</div>
					</div>
					<?php if (isset($options[$idPanierSession]) || isset($bornePerso->id)) :  ?>
					<div class="flex">
						<ul class="text-sm text-gray-400">
						<?php if (isset($options[$idPanierSession])) : ?>

							<li>Prix de base <span class="text-green-700"><?= $bornePerso->prix ?> €</span></li>
							<?php foreach($options[$idPanierSession] as $option) : ?>
								<li><?= $option->nom ?> <span class="text-green-600">+<?= $option->cout ?> €</span></li>
							<?php endforeach; ?>

						<?php else : ?>

							<li>Prix de base <span class="text-green-600"><?= $bornePerso->prix ?> €</span></li>
							<?php foreach($bornePerso->options as $option) : ?>
								<li><?= $option->nom ?> <span class="text-green-500">+<?= $option->cout ?> €</span></li>
							<?php endforeach; ?>
							
						<?php endif; ?>
						</ul>
					</div>
					<?php endif; ?>
					<a href="/panier/delete-borne/<?= $bornePerso->id ?: $idPanierSession ?>" class="pr-4 font-bold cursor-pointer">
						<svg class="w-6 h-6 fill-gray-400 hover:fill-red-500 " viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
							<path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"></path>
						</svg>
					</a>
				</div>
				<?php $prixTot += $prixTotBorne; ?>
				<?php $prixTotBorne = 0; ?>
				<?php $i += 1; ?>
			<?php endforeach; ?>
		<?php endif; ?>

		<!-- Total des prix -->
		<div class="flex justify-between items-center pt-4 mt-4 border-t border-gray-700">
			<h3 class="text-xl font-semibold">Total :</h3>
			<p class="text-xl font-bold text-green-500">
				<?= $prixTot ?> €
			</p>
		</div>
			<?php
				$class = 'mt-4 w-full py-3 px-4 tracking-wide rounded-lg text-white' . ((count($bornes) == 0 or isset($options)) ? ' opacity-30 border border-gray-700 cursor-not-allowed ' : ' shadow-xl hover:bg-green-500/60 cursor-pointer ') .'bg-green-600 focus:outline-none';
				echo form_submit('submit', 'Passer la commande', "class='".$class."'");
			?>
			<?php if (!session()->has('user')) :?>
				<div class="md:col-span-2 text-center mx-auto mt-15">
					<p>Vous voulez passer une commande ? <a href="/connexion" class="text-green-600 hover:text-green-500 font-bold hover:underline">Connectez vous !</a></p>
				</div>
			<?php endif; ?>

		</div>
	</div>

	<!-- Section "Contactez-nous" -->
	<div class="w-full lg:w-1/3 bg-medium-blue rounded-lg shadow-md p-10 mt-6 lg:mt-0">
	<h2 class="text-2xl font-bold mb-4">Contactez-nous</h2>
	<div class="space-y-4">
			<div class="flex items-center space-x-4">
				<a target="_blank" id="whatsapp-button" class="bg-green-700 hover:bg-green-600 p-2">
					<svg class="w-6 h-6 text-gray-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
					<path fill="currentColor" fill-rule="evenodd" d="M12 4a8 8 0 0 0-6.895 12.06l.569.718-.697 2.359 2.32-.648.379.243A8 8 0 1 0 12 4ZM2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10a9.96 9.96 0 0 1-5.016-1.347l-4.948 1.382 1.426-4.829-.006-.007-.033-.055A9.958 9.958 0 0 1 2 12Z" clip-rule="evenodd"/>
					<path fill="currentColor" d="M16.735 13.492c-.038-.018-1.497-.736-1.756-.83a1.008 1.008 0 0 0-.34-.075c-.196 0-.362.098-.49.291-.146.217-.587.732-.723.886-.018.02-.042.045-.057.045-.013 0-.239-.093-.307-.123-1.564-.68-2.751-2.313-2.914-2.589-.023-.04-.024-.057-.024-.057.005-.021.058-.074.085-.101.08-.079.166-.182.249-.283l.117-.14c.121-.14.175-.25.237-.375l.033-.066a.68.68 0 0 0-.02-.64c-.034-.069-.65-1.555-.715-1.711-.158-.377-.366-.552-.655-.552-.027 0 0 0-.112.005-.137.005-.883.104-1.213.311-.35.22-.94.924-.94 2.16 0 1.112.705 2.162 1.008 2.561l.041.06c1.161 1.695 2.608 2.951 4.074 3.537 1.412.564 2.081.63 2.461.63.16 0 .288-.013.4-.024l.072-.007c.488-.043 1.56-.599 1.804-1.276.192-.534.243-1.117.115-1.329-.088-.144-.239-.216-.43-.308Z"/>
					</svg>
				</a>
				<div>
					<p class="font-bold text-gray-300 text-lg">Whatsapp</p>
					<p class="text-sm text-gray-300 ">07 68 53 46 26</p>
				</div>
			</div>
			<div class="flex items-center space-x-4">
				<a href="mailto:contact@LaBorneArcade.com" class="bg-green-700 hover:bg-green-600 p-2">
					<svg class="w-6 h-6 text-gray-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
					<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16v-5.5A3.5 3.5 0 0 0 7.5 7m3.5 9H4v-5.5A3.5 3.5 0 0 1 7.5 7m3.5 9v4M7.5 7H14m0 0V4h2.5M14 7v3m-3.5 6H20v-6a3 3 0 0 0-3-3m-2 9v4m-8-6.5h1"/>
					</svg>
				</a>
				<div>
					<p class="font-bold text-gray-300 text-lg">E-mail</p>
					<p class="text-sm text-gray-300 ">Contact@LaBorneArcade.com</p>
				</div>
			</div>
			<div class="flex items-center space-x-4">
				<a href="tel:+33768534626" target="_blank" class="bg-green-700 hover:bg-green-600 p-2">
					<svg class="w-6 h-6 text-gray-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
					<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.427 14.768 17.2 13.542a1.733 1.733 0 0 0-2.45 0l-.613.613a1.732 1.732 0 0 1-2.45 0l-1.838-1.84a1.735 1.735 0 0 1 0-2.452l.612-.613a1.735 1.735 0 0 0 0-2.452L9.237 5.572a1.6 1.6 0 0 0-2.45 0c-3.223 3.2-1.702 6.896 1.519 10.117 3.22 3.221 6.914 4.745 10.12 1.535a1.601 1.601 0 0 0 0-2.456Z"/>
					</svg>
				</a>
				<div>
					<p class="font-bold text-gray-300 text-lg">Telephone</p>
					<p class="text-sm text-gray-300 ">07 68 53 46 26</p>
				</div>
			</div>
			<?php if (session()->has('user')) :?>
				<div class="flex items-center space-x-4 py-8 lg:py-20">
				<div>
					<p class="font-bold text-gray-300 text-lg">
						> Voir mes 
						<a href="/commandes" class="text-green-600 hover:text-green-500 hover:underline">
							commandes
						</a>
					</p>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</div>
</section>
<?= form_close() ?>
<?= view('commun/footer') ?>
<script src="./assets/js/btn-whatsapp.js"></script>
