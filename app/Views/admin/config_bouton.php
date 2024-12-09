<?= view('commun/header', ['titre' => $titre]) ?>
<?php // var_dump($boutons)  ?>
<div class="text-white py-12 px-6">
	<!-- Titre principal -->
	<h2 class="text-center text-3xl font-bold mb-4">Configuration des boutons</h2>
	<!-- Formulaire pour ajouter un commentaire -->
	<?php echo form_open('/admin/bouton'); ?>
	<table class="grid grid-cols-1 md:grid-cols-6 gap-6 max-w-3xl mx-auto flex items-center justify-start">
		<tbody>
			<tr>
				<td colspan=2 class="mt-5 p-0">
					<h3 class="text-center text-3xl font-bold mb-4">
						<?php echo form_label('Ajoutez un bouton : ', 'bouton'); ?>
					</h3>
				</td>
			</tr>
			<tr class="">
				<td class="">
					<!-- Champ pour le modèle -->
					<?php echo form_input(
						[
							'name' => 'modele',
							'value' => set_value('modele', ''),
							'placeholder' => 'Entrez le modèle ici...',
							'required' => 'required',
						]
					); ?>
				</td>
			</tr>
			<tr>
				<td class="">
					<!-- Liste déroulante pour la forme -->
					<?php echo form_dropdown(
						'forme',
						[
							'rond' => 'Rond',
							'carre' => 'Carré',
							'triangle' => 'Triangle',
						],
						set_value('forme', 'rond'), // Valeur sélectionnée par défaut
						[
							'required' => 'required',
							'class' => 'form-select', // Classe CSS personnalisée si besoin
						]
					); ?>
				</td>
			</tr>
			<tr>
				<td class="">
					<!-- Champ pour la couleur -->
					<?php echo form_input(
						[
							'type' => 'color', // Définit le champ comme un sélecteur de couleur
							'name' => 'couleur',
							'value' => set_value('couleur', '#000000'), // Valeur par défaut (noir)
							'required' => 'required',
						]
					); ?>
				</td>
			</tr>
			<tr>
				<td class="">
					<!-- Champ pour la couleur -->
					<?php echo form_input(
						[
							'type' => 'radio',
							'name' => 'eclairage',
							'value' => set_value('eclairage', ''), 
						]
					); ?>
				</td>
			</tr>
			<tr>
				<td class="">
					<!-- Bouton d'enregistrement -->
					<?php echo form_submit('submit', 'Enregistrer', "class='bouton'"); ?>
				</td>
			</tr>
		</tbody>
	</table>
	<p class=""><?= validation_show_error('texte_bouton') ?></p>
	<?php echo form_close(); ?>

	<?php if (session()->has('errors')): ?>
		<div class="alert alert-danger">
			<?php foreach (session('errors') as $error): ?>
				<p><?= $error ?></p>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>

	<?php if (session()->has('success')): ?>
		<div class="alert alert-success">
			<p><?= session('success') ?></p>
		</div>
	<?php endif; ?>

	<!-- Grille des boutons -->
	<h3 class="text-center text-3xl font-bold mb-4">Liste des boutons</h3>
	<div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-7xl mx-auto">
	<!-- bouton -->
		<?php if (!empty($boutons)) : ?>
			<?php foreach($boutons as $bouton) : ?>
				<?php // var_dump($bouton)  ?>
				<div class="border-b-2 border-white/50 p-4 bg-[#161c2d]1" id="div-bouton-<?= $bouton->id ?>">
					<div class="w-[15vw] h-[30px] flex items-center justify-start">
						<h3 class="text-lg font-bold pr-4"><?= $bouton->modele ?></h3>
					</div>
					<div class="flex justify-center items-center space-x-4">
						<!-- Forme dynamique en fonction du bouton -->
						<?php
						$taille = "w-16 h-16"; // Taille cohérente pour toutes les formes
						$couleur = $bouton->couleur; // Couleur dynamique

						if ($bouton->forme === 'rond') {
							// Cercle
							echo "<div class='rounded-full $taille' style='background-color: $couleur;'></div>";
						} elseif ($bouton->forme === 'carre') {
							// Carré
							echo "<div class='$taille' style='background-color: $couleur;'></div>";
						} elseif ($bouton->forme === 'triangle') {
							// Triangle
							echo "
							<div class='relative $taille'>
								<div class='absolute w-0 h-0' style='
									border-left: 32px solid transparent;
									border-right: 32px solid transparent;
									border-bottom: 64px solid $couleur;
									'></div>
							</div>";
						}
						?>
					</div>
					<div class="w-[45vw] h-[30px] flex items-center justify-start">
						<!-- Formulaire pour supprimer le bouton -->
						<?php echo form_open("/admin/bouton/delete/$bouton->id", ['onsubmit' => 'return confirm("Êtes-vous sûr de vouloir supprimer ce bouton ?")']); ?>
							<?php echo form_hidden('id', $bouton->id); ?>
							<?php echo form_submit('delete', 'Supprimer', "class='text-red-600 hover:text-red-800 font-bold'"); ?>
						<?php echo form_close(); ?>
					</div>
				</div>
			<?php endforeach; ?>
		<?php else : ?>
			<p class="p-4">Aucun bouton disponible pour le moment.</p>
		<?php endif; ?>
	</div><br>
</div>
<script src="./assets/js/btn-faq.js">
</script>
<?= view('commun/footer') ?>