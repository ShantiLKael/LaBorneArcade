<?= view('commun/header', ['titre' => $titre]) ?>
<?php // var_dump($matieres)  ?>
<div class="text-white py-12 px-6">
	<!-- Titre principal -->
	<h2 class="text-center text-3xl font-bold mb-4">configuration des matiere</h2>

	<!-- Formulaire pour ajouter un commentaire -->
    <?php echo form_open('/admin/matiere'); ?>
    <table class="max-w-3xl mx-auto">
		<tbody>
			<tr>
				<td colspan=2 class="mt-5 p-0">
					<h3 class="text-center text-3xl font-bold mb-6">
						<?php echo form_label('Ajoutez une matiere : ', 'matiere'); ?>
					</h3>
				</td>
			</tr>
			<tr class="flex flex-col md:flex-row md:items-center">
				<td> <label class="text-lg font-medium mb-2 md:mb-0 md:mr-4" for="nom">Nom de la matiere : * </label> </td>
				<td class="">
					<!-- Champ pour le modèle -->
					<?php echo form_input(
						[
							'name' => 'nom',
							'value' => set_value('nom', ''),
							'placeholder' => 'Entrez votre nom de la matiere ici...',
							'class' => 'border border-gray-300 rounded-lg p-2 w-full md:w-auto',
							'required' => 'required',
						]
					); ?>
				</td>
			</tr>
            <tr><td><br></td></tr>
			<tr class="flex flex-col md:flex-row md:items-center">
				<td> <label class="text-lg font-medium mb-2 md:mb-0 md:mr-4" for="couleur">Couleur de la matiere : * </label> </td>
				<td class="">
					<!-- Champ pour la couleur -->
					<?php echo form_input(
						[
							'type' => 'color', // Définit le champ comme un sélecteur de couleur
							'name' => 'couleur',
							'value' => set_value('couleur', '#000000'), // Valeur par défaut (noir)
							'class' => '',
							'required' => 'required',
						]
					); ?>
				</td>
			</tr>
            <tr><td><br></td></tr>
			<tr>
				<td class="flex justify-start md:justify-center">
					<!-- Bouton d'enregistrement -->
					<?php echo form_submit('submit', 'Enregistrer', "class='bg-[#00bf63] hover:bg-green-700 text-white font-medium py-2 px-4 rounded-full'"); ?>
				</td>
			</tr>
		</tbody>
	</table>
	<p class=""><?= validation_show_error('texte_matiere') ?></p>
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

	<!-- Grille des matieres -->
	<h3 class="text-center text-3xl font-bold mb-4">Liste des matieres</h3>
	<div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-7xl mx-auto">
	<!-- matiere -->
		<?php if (!empty($matieres)) : ?>
			<?php foreach($matieres as $matiere) : ?>
                <div class="flex items-center border-b border-gray-700 py-3 bg-[#161c2d]">
					<!-- Nom de la matiere avec une largeur fixe -->
					<div class="text-lg font-medium text-white font-bold w-1/3 min-w-[150px] truncate">
						<?= $matiere->nom ?>
					</div>

					<!-- Pastille de couleur -->
					<div 
						class="w-6 h-6 rounded-full border-2 border-black flex-shrink-0 ml-4" 
						style="background-color: <?= $matiere->couleur ?>;"
						title="Couleur : <?= $matiere->couleur ?>">
					</div>

					<!-- Bouton Supprimer -->
					<div class="ml-auto">
						<?php echo form_open("/admin/theme/delete/$matiere->id", ['onsubmit' => 'return confirm("Êtes-vous sûr de vouloir supprimer ce thème ?")']); ?>
							<?php echo form_submit('delete', 'Supprimer', "class='bg-red-500 hover:bg-red-700 text-white font-medium py-1 px-4 rounded'"); ?>
						<?php echo form_close(); ?>
					</div>
				</div>
			<?php endforeach; ?>
		<?php else : ?>
			<p class="p-4">Aucune matiere disponible pour le moment.</p>
		<?php endif; ?>
	</div><br>
</div>
<script src="./assets/js/btn-faq.js">
</script>
<?= view('commun/footer') ?>