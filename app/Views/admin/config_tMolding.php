<?= view('commun/header', ['titre' => $titre]) ?>
<?php // var_dump($tMoldings)  ?>
<div class="text-white py-12 px-6">
	<!-- Titre principal -->
	<h2 class="text-center text-3xl font-bold mb-4">Configuration des TMoldings</h2>

	<?php echo form_open('/admin/TMolding'); ?>
    <table class="max-w-3xl mx-auto">
		<tbody>
			<tr>
				<td colspan=2 class="mt-5 p-0">
					<h3 class="text-center text-3xl font-bold mb-6">
						<?php echo form_label('Ajoutez un tMolding : ', 'tMolding'); ?>
					</h3>
				</td>
			</tr>
			<tr class="flex flex-col md:flex-row md:items-center">
				<td> <label class="text-lg font-medium mb-2 md:mb-0 md:mr-4" for="nom">Nom du tmolding : * </label> </td>
				<td class="">
					<!-- Champ pour le modèle -->
					<?php echo form_input(
						[
							'name' => 'nom',
							'value' => set_value('nom', ''),
							'placeholder' => 'Entrez votre nom du TMolding ici...',
							'class' => 'border border-gray-300 rounded-lg p-2 w-full md:w-auto',
							'required' => 'required',
						]
					); ?>
				</td>
			</tr>
			<tr class="flex flex-col md:flex-row md:items-center">
				<td> <label class="text-lg font-medium mb-2 md:mb-0 md:mr-4" for="couleur">Couleur du tmolding : * </label> </td>
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
	<p class=""><?= validation_show_error('texte_tMolding') ?></p>
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

	<!-- Grille des tMoldings -->
	<h3 class="text-center text-3xl font-bold mb-4">Liste des tMoldings</h3>
	<div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-7xl mx-auto">
	<!-- tMolding -->
		<?php if (!empty($tMoldings)) : ?>
			<?php foreach($tMoldings as $tMolding) : ?>

                <?php // var_dump($theme)  ?>
				<div class="flex justify-between items-center border-b border-gray-700 py-2 bg-[#161c2d]">
					<!-- Nom du thème -->
					<div class="flex-1 text-lg font-medium text-white font-bold">
						<?= $tMolding->nom ?>
					</div>
                    <div 
						class="w-6 h-6 rounded-full border-2 border-black flex-shrink-0 ml-4" 
						style="background-color: <?= $tMolding->couleur ?>;"
						title="Couleur : <?= $tMolding->couleur ?>">
					</div>
					
					<!-- Bouton Supprimer -->
					<div>
						<?php echo form_open("/admin/theme/delete/$tMolding->id", ['onsubmit' => 'return confirm("Êtes-vous sûr de vouloir supprimer ce thème ?")']); ?>
							<?php echo form_submit('delete', 'Supprimer', "class='bg-red-500 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-full'"); ?>
						<?php echo form_close(); ?>
					</div>
				</div>
			<?php endforeach; ?>
		<?php else : ?>
			<p class="p-4">Aucun tMolding disponible pour le moment.</p>
		<?php endif; ?>
	</div><br>
</div>
<script src="./assets/js/btn-faq.js">
</script>
<?= view('commun/footer') ?>