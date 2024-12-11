<?= view('commun/headerAdmin', ['titre' => $titre]) ?>
<?php // var_dump($boutons)  ?>
<div id="main-content" class=" p-8 w-full">
	<!-- Titre principal -->
	<h2 class="text-center text-3xl font-bold mb-4">Configuration des boutons</h2>
	<!-- Formulaire pour ajouter un commentaire -->

	<?php echo form_open('/admin/bouton'); ?>
	<table class="max-w-3xl mx-auto">
		<tbody>
			<tr>
				<td colspan=2 class="mt-5 p-0">
					<h3 class="text-center text-3xl font-bold mb-6">
						<?php echo form_label('Ajoutez un bouton ', 'bouton'); ?>
					</h3>
				</td>
			</tr>
            <tr><td><br></td></tr>
			<tr class="flex flex-col md:flex-row md:items-center">
                <td> <label class="text-lg font-medium mb-2 md:mb-0 md:mr-4" for="nom">Nom du modele : * </label> </td>
				<td class="">
					<!-- Champ pour le modèle -->
					<?php echo form_input(
						[
							'name' => 'modele',
							'value' => set_value('modele', ''),
							'placeholder' => 'Entrez le modèle ici...',
                            'class' => 'border border-gray-300 rounded-lg p-2 w-full md:w-auto bg-gray-100 text-black',
							'required' => 'required',
						]
					); ?>
				</td>
			</tr>
            <tr><td><br></td></tr>
			<tr class="flex flex-col md:flex-row md:items-center">
                <td> <label class="text-lg font-medium mb-2 md:mb-0 md:mr-4" for="nom">Forme du bouton : * </label> </td>
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
                            'class' => 'border border-gray-300 rounded-lg p-2 w-full md:w-auto bg-gray-100 text-black',
						]
					); ?>
				</td>
			</tr>
			<tr><td><br></td></tr>
			<tr class="flex flex-col md:flex-row md:items-center">
                <td> <label class="text-lg font-medium mb-2 md:mb-0 md:mr-4" for="nom">Couleur du bouton : * </label> </td>
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
			<tr><td><br></td></tr>
			<tr class="flex flex-col md:flex-row md:items-center">
                <td> <label class="text-lg font-medium mb-2 md:mb-0 md:mr-4" for="nom">Bouton lumineux : </label> </td>
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
			<tr><td><br></td></tr>
			<tr >
				<td class="flex justify-start md:justify-center">
					<!-- Bouton d'enregistrement -->
					<?php echo form_submit('submit', 'Enregistrer', "class='bg-vert-pastel hover:bg-vert-pastelF font-medium py-2 px-4 rounded-full'"); ?>
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
                <div class="flex justify-between items-center border-b border-gray-200 py-2 bg-FVertClair">
					<div class="text-lg font-medium font-bold w-1/3 min-w-[170px] truncate">
						<?= $bouton->modele ?>
					</div>

					<!-- Bouton de couleur -->
					<div class="flex justify-center items-center space-x-4">
						<!-- Forme dynamique en fonction du bouton -->
						<?php
						$taille = "w-8 h-8"; // Taille cohérente pour toutes les formes 
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
									border-left: 16px solid transparent;
									border-right: 16px solid transparent;
									border-bottom: 32px solid $couleur;
									'></div>
							</div>";
						}
						?>
					</div>

					<!-- Bouton Supprimer -->
					<div class="ml-auto">
						<?php echo form_open("/admin/bouton/delete/$bouton->id", ['onsubmit' => 'return confirm("Êtes-vous sûr de vouloir supprimer ce bouton ?")']); ?>
							<?php echo form_hidden('id', $bouton->id); ?>	
							<?php echo form_submit('delete', 'Supprimer', "class='bg-rouge-pastel hover:bg-rouge-pastelF font-medium py-1 px-4 rounded'"); ?>
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
<?= view('commun/footerAdmin') ?>